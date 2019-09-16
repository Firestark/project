<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Mockery as mockery;

/**
 * Defines application features from the specific context.
 */
class SecurityContext implements Context
{
    private $registeredUsers = [ ];
    private $habitManager = null;
    private $habits = [ ];

    private $payload = null;
    private $status = null;

    function __construct ( )
    {
        $this->guard = mockery::mock ( guard::class );
        $this->habitManager = mockery::mock ( habit\manager::class );
    }

    /**
     * @Given a registered user with username :username and password :password
     */
    public function aRegisteredUserWithUsernameAndPassword ( string $username, string $password )
    {
        $user = mockery::mock ( user::class, [ $username, $password ] );
        $this->registeredUsers [ $username ] = $user;
    }

    /**
     * @Given :username has registered a habit with title :title
     */
    public function hasRegisteredAHabitWithTitle ( string $username, string $title )
    {
        $habit = mockery::mock ( habit::class, [ $title ] );
        $this->habits [ $username ] = $habit;
    }

    /**
     * @When :username requests for a list of habits
     */
    public function henkRequestsForAListOfHabits ( string $username )
    {       
        $user = $this->registeredUsers [ $username ];
        $this->guard
            ->shouldReceive ( 'authenticate' )
            ->with ( $user )
            ->once ( )
            ->andReturn ( true );

        $this->habitManager
            ->shouldReceive ( 'all' )
            ->once ( )
            ->andReturn ( $this->habits [ $username ] ?? [ ] );

        list ( $status, $payload ) = app::make ( 'i want to see my habits', [
            'user' => $user, 
            'guard' => $this->guard, 
            'habitManager' => $this->habitManager
        ] );

        $this->status = $status;
        $this->payload = $payload;
    }

    /**
     * @Then :username should see an empty habit list
     */
    public function henkShouldSeeAnEmptyHabitList ( string $username )
    {
        assertThat ( $this->payload [ 'habits' ], is ( emptyArray ( ) ) );
    }

    /**
     * @When henk requests to add a habit with title :arg1
     */
    public function henkRequestsToAddAHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then admin should a habit with title :arg1
     */
    public function adminShouldAHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then henk should a habit with title :arg1
     */
    public function henkShouldAHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given henk has registered a habit with title :arg1
     */
    public function henkHasRegisteredAHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When henk requests to update a habit with title :arg1 to :arg2
     */
    public function henkRequestsToUpdateAHabitWithTitleTo($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When henk requests to remove a habit with title :arg1
     */
    public function henkRequestsToRemoveAHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When henk requests to complete a habit with title :arg1
     */
    public function henkRequestsToCompleteAHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then admin should an uncompleted habit with title :arg1
     */
    public function adminShouldAnUncompletedHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then henk should see a completed habit with title :arg1
     */
    public function henkShouldSeeACompletedHabitWithTitle($arg1)
    {
        throw new PendingException();
    }

    /** @AfterScenario */
    public function after ( $event )
    {
        mockery::close ( );
    }
}
