<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

require __DIR__ . '/start.php';


/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $habitManager = null;
    private $user = null;
    private $userManager = null;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->habitManager = Mockery::mock ( habit\manager::class );
        $this->userManager = Mockery::mock ( user\manager::class );
    }

    /**
     * @Given I am a registered user
     */
    public function iAmARegisteredUser()
    {
        $user = Mockery::mock ( user::class );
        $this->userManager->shouldReceive ( 'registered' )->with ( $user )->andReturn ( true );
        $this->user = $user;
    }

    /**
     * @Given I am not a registered user
     */
    public function iAmNotARegisteredUser()
    {
        $user = Mockery::mock ( user::class );
        $this->userManager->shouldReceive ( 'registered' )->with ( $user )->andReturn ( false );
        $this->user = $user;
    }

    /**
     * @When I add a habit to the habit manager
     */
    public function iAddAHabitToMyHabitCollection()
    {
        $habit = Mockery::mock ( habit::class, [ uniqid ( ), 'Habit title' ] );
        
        $this->habitManager
            ->shouldReceive ( 'hasTitle' )
            ->with ( $habit->title, $this->user )
            ->andReturn ( false );

        $this->habitManager
            ->shouldReceive ( 'add' )
            ->with ( $habit, $this->user );

        list ( $status, $payload ) = app::make('i want to add a habit', [
            'habit' => $habit, 
            'habitManager' => $this->habitManager,
            'user' => $this->user, 
            'userManager' => $this->userManager
        ] );

        $this->status = $status;
        $this->payload = $payload;
    }

    /**
     * @Then My habit should be added to the habit manager
     */
    public function myHabitShouldBeAddedToMyHabitCollection()
    {
        assertThat ( $this->status, is ( identicalTo ( 1001 ) ) );
    }

    /**
     * @Then My habit should not be added to the habit manager
     */
    public function myHabitShouldNotBeAddedToMyHabitCollection()
    {
        assertThat ( $this->status, is ( identicalTo ( 0 ) ) );
    }
}


// I cannot check wether the habit with title 'exercise' was added...