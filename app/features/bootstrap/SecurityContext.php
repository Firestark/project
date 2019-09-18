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
        
        $this->guard
            ->shouldReceive ( 'authenticate' )
            ->with ( $user )
            ->andReturn ( true );
    }

    /**
     * @Given :username has registered a habit with title :title
     */
    public function hasRegisteredAHabitWithTitle ( string $username, string $title )
    {
        $habit = mockery::mock ( habit::class, [ $title ] );
        $this->habits [ $username ] [ ] = $habit;
    }

    /**
     * @When :username requests for a list of habits
     */
    public function henkRequestsForAListOfHabits ( string $username )
    {               
        $this->habitManager
            ->shouldReceive ( 'all' )
            ->once ( )
            ->andReturn ( $this->habits [ $username ] ?? [ ] );

        list ( $status, $payload ) = app::make ( 'i want to see my habits', [
            'user' => $this->registeredUsers [ $username ], 
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
     * @When :username requests to add a habit with title :title
     */
    public function userRequestsToAddAHabitWithTitle ( string $username, string $title )
    {
        $habit = mockery::mock ( habit::class, [ $title ] );

        $this->habitManager
            ->shouldReceive ( 'has' )
            ->with ( $habit )
            ->once ( )
            ->andReturn ( false );

        $this->habitManager
            ->shouldReceive ( 'add' )
            ->with ( $habit )
            ->once ( );

        $this->habitManager
            ->shouldReceive ( 'all' )
            ->once ( )
            ->andReturn ( [ $habit ] );

        list ( $status, $payload ) = app::make ( 'i want to add a habit', [
            'user' => $this->registeredUsers [ $username ],
            'guard' => $this->guard,
            'habit' => $habit,
            'habitManager' => $this->habitManager
        ] );

        $this->habits [ $username ] = $payload [ 'habits' ];
    }

    /**
     * @Then :username should have a habit with title :title
     */
    public function userShouldHaveAHabitWithTitle ( string $username, string $title )
    {
        $this->habitManager
            ->shouldReceive ( 'all' )
            ->once ( )
            ->andReturn ( $this->habits [ $username ] );

        list ( $status, $payload ) = app::make ( 'i want to see my habits', [
            'user' => $this->registeredUsers [ $username ],
            'guard' => $this->guard,
            'habitManager' => $this->habitManager
        ] );

        foreach ( $payload [ 'habits'] as $habit )
            if ( $habit->title === $title )
                return true;

        throw new exception ( "I cannot see a habit with title: {$title}." );
    }

    /**
     * @When :username requests to update a habit with title :from to :to
     */
    public function userRequestsToUpdateAHabitWithTitleTo ( string $username, string $from, string $to )
    {        
        $old = mockery::mock ( habit::class, [ $from ] );
        $new = mockery::mock ( habit::class, [ $to ] );

        $this->habitManager
            ->shouldReceive ( 'has' )
            ->with ( $new )
            ->once ( )
            ->andReturn ( false );

        $this->habitManager
            ->shouldReceive ( 'update' )
            ->with ( $old, $new )
            ->once ( );

        $this->habitManager
            ->shouldReceive ( 'all' )
            ->once ( )
            ->andReturn ( [ $new ] );

        list ( $status, $payload ) = app::make ( 'i want to update a habit', [
            'user' => $this->registeredUsers [ $username ],
            'guard' => $this->guard,
            'old' => $old,
            'new' => $new,
            'habitManager' => $this->habitManager
        ] );

        $this->habits [ $username ] = $payload [ 'habits' ];
    }

    /**
     * @When :username requests to remove a habit with title :title
     */
    public function userRequestsToRemoveAHabitWithTitle ( string $username, string $title )
    {
        $habit = mockery::mock ( habit::class, [ $title ] );

        $this->habitManager
            ->shouldReceive ( 'remove' )
            ->with ( $habit )
            ->once ( );

        list ( $status, $payload ) = app::make ( 'i want to remove a habit', [
            'user' => $this->registeredUsers [ $username ],
            'guard' => $this->guard,
            'habit' => $habit,
            'habitManager' => $this->habitManager
        ] );

        $this->payload = $payload;
    }

    /**
     * @When :username requests to complete a habit with title :title
     */
    public function userRequestsToCompleteAHabitWithTitle ( string $username, string $title )
    {
        $habit = mockery::mock ( habit::class, [ $title ] );

        $this->habitManager
            ->shouldReceive ( 'has' )
            ->with ( $habit )
            ->once ( )
            ->andReturn ( true );

        $this->habitManager
            ->shouldReceive ( 'complete' )
            ->with ( $habit )
            ->once ( );

        list ( $status, $payload ) = app::make ( 'i want to complete a habit', [
            'user' => $this->registeredUsers [ $username ],
            'guard' => $this->guard,
            'habit' => $habit,
            'habitManager' => $this->habitManager
        ] );

        $habit = $payload [ 'habit' ];
        $habit->completed = true;

        $this->replace ( $username, $habit );
    }

    /**
     * @Then :username should see a completed habit with title :title
     */
    public function userShouldSeeACompletedHabitWithTitle ( string $username, string $title )
    {
        foreach ( $this->habits [ $username ] as $habit )
            if ( $habit->title === $title )
                if ( $habit->completed !== true )
                    throw new exception ( "I see that my habit with title: {$title} is not completed." );
                else
                    return true;

        throw new exception ( "I can't see a habit with title: {$title}." );
    }

    /**
     * @Then :username should have an uncompleted habit with title :title
     */
    public function shouldAnUncompletedHabitWithTitle ( string $username, string $title )
    {
        foreach ( $this->habits [ $username ] as $habit )
            if ( $habit->title === $title )
                if ( $habit->completed !== false )
                    throw new exception ( "I see that my habit with title: {$title} is completed." );
                else
                    return true;

        throw new exception ( "I can't see a habit with title: {$title}." );
    }

    /** @AfterScenario */
    public function after ( $event )
    {
        mockery::close ( );
    }

    private function replace ( string $username, habit $habit )
    {
        foreach ( $this->habits [ $username ] as $key => $stored )
            if ( $habit->title === $stored->title )
                $this->habits [ $username ] [ $key ] = $habit;
    }
}
