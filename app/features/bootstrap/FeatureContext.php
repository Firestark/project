<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Mockery as mockery;

require __DIR__ . '/start.php';

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $user = null;
    private $guard = null;
    private $addedHabits = [ ];

    private $payload = [ ];
    private $status = -1;

    function __construct ( )
    {
        $this->user = mockery::mock ( user::class );
        $this->guard = mockery::mock ( guard::class );
        $this->habitManager = mockery::mock ( habit\manager::class );
    }

    /**
     * @Given i am authenticated
     */
    public function iAmAutenticated ( )
    {
        $this->guard
            ->shouldReceive ( 'authenticate' )
            ->with ( $this->user )
            ->once ( )
            ->andReturn ( true );
    }

    /**
     * @Given i am not authenticated
     */
    public function iAmNotAuthenticated ( )
    {
        $this->guard
            ->shouldReceive ( 'authenticate' )
            ->with ( $this->user )
            ->once ( )
            ->andReturn ( false );
    }

    /**
     * @Given i have added a habit with title :title
     */
    public function iHaveAddedAHabitWithTitle ( string $title )
    {
        $habit = mockery::mock ( habit::class, [ $title ] );
        $this->addedHabits [ ] = $habit;
    }

    /**
     * @Given i have not added a habit with title :arg1
     */
    public function iHaveNotAddedAHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When i add a habit with title :arg1
     */
    public function iAddAHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When i try to add a habit with title :arg1
     */
    public function iTryToAddAHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When i try to add a habit
     */
    public function iTryToAddAHabit()
    {
        throw new PendingException();
    }

    /**
     * @When i complete a habit with title :arg1
     */
    public function iCompleteAHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When i request to complete a habit
     */
    public function iRequestToCompleteAHabit()
    {
        throw new PendingException();
    }

    /**
     * @When i request to see my habits
     */
    public function iRequestToSeeMyHabits ( )
    {
        $this->habitManager
            ->shouldReceive ( 'all' )
            ->andReturn ( $this->addedHabits );

        list ( $status, $payload ) = app::make ( 'i want to see my habits', [
            'user' => $this->user,
            'guard' => $this->guard,
            'habitManager' => $this->habitManager
        ] );

        $this->status = $status;
        $this->payload = $payload;
    }

    /**
     * @When i remove a habit with title :arg1
     */
    public function iRemoveAHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When i request to remove a habit
     */
    public function iRequestToRemoveAHabit()
    {
        throw new PendingException();
    }

    /**
     * @When i update my habit with title :arg1 to :arg2
     */
    public function iUpdateMyHabitWithTitleTo($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When i request to update a habit
     */
    public function iRequestToUpdateAHabit()
    {
        throw new PendingException();
    }

    /**
     * @Then i should see a habit with title :title
     */
    public function iShouldSeeAHabitWithTitle ( string $title )
    {
        foreach ( $this->payload [ 'habits' ] as $habit )
            if ( $habit->title === $title )
                return true;

        throw new exception ( "I can't see a habit with title: {$title}." );
    }

    /**
     * @Then i should see that a habit with title :arg1 already exists
     */
    public function iShouldSeeThatAHabitWithTitleAlreadyExists($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then i should see that i am unauthorized
     */
    public function iShouldSeeThatIAmUnauthorized ( )
    {
        assertThat ( $this->payload, is ( emptyArray ( ) ) );
    }

    /**
     * @Then i should see habit with title :arg1 completed
     */
    public function iShouldSeeHabitWithTitleCompleted($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then i should see that a habit with title :arg1 does not exist
     */
    public function iShouldSeeThatAHabitWithTitleDoesNotExist($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then i should no longer see a habit with title :arg1
     */
    public function iShouldNoLongerSeeAHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /** @AfterScenario */
    public function after ( $event )
    {
        mockery::close ( );
    }
}