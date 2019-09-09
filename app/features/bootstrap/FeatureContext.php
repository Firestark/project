<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Mockery as mockery;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $user = null;
    private $guard = null;
    private $addedHabits = [ ];

    private $payload = null;
    private $status = null;

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
     * @Given i have not added a habit with title :title
     */
    public function iHaveNotAddedAHabitWithTitle ( string $title )
    {
        // no code required
    }

    /**
     * @Given i already added a habit with title :title
     */
    public function iAlreadyAddedAHabitWithTitle ( string $title )
    {
        $habit = mockery::mock ( habit::class, [ $title ] );
        $this->addedHabits [ ] = $habit;
    }

    /**
     * @When i add a habit with title :title
     */
    public function iAddAHabitWithTitle ( string $title )
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
            ->andReturn ( array_merge ( $this->addedHabits, [ $habit ] ) );

        list ( $status, $payload ) = app::make ( 'i want to add a habit', [
            'user' => $this->user,
            'guard' => $this->guard,
            'habit' => $habit,
            'habitManager' => $this->habitManager
        ] );
        
        $this->status = $status;
        $this->payload = $payload;
    }

    /**
     * @When i try to add a habit with title :title
     */
    public function iTryToAddAHabitWithTitle ( string $title )
    {
        $habit = mockery::mock ( habit::class, [ $title ] );
        
        $this->habitManager
            ->shouldReceive ( 'has' )
            ->with ( $habit )
            ->once ( )
            ->andReturn ( true );
        
        list ( $status, $payload ) = app::make ( 'i want to add a habit', [
            'user' => $this->user,
            'guard' => $this->guard,
            'habit' => $habit,
            'habitManager' => $this->habitManager
        ] );

        $this->status = $status;
        $this->payload = $payload;
    }

    /**
     * @When i try to add a habit
     */
    public function iTryToAddAHabit()
    {
        $habit = mockery::mock ( habit::class, [ 'Some habit title' ] );

        list ( $status, $payload ) = app::make ( 'i want to add a habit', [
            'user' => $this->user,
            'guard' => $this->guard,
            'habit' => $habit,
            'habitManager' => $this->habitManager
        ] );

        $this->status = $status;
        $this->payload = $payload;
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
     * @When i update my habit with title :pervious to :to
     */
    public function iUpdateMyHabitWithTitleTo ( string $previous, string $to )
    {
        // add id to habit then find habit id using title
        
        $old = $this->find ( $previous );
        $new = mockery::mock ( habit::class, [ $to ] );

        $this->habitManager
            ->shouldReceive ( 'update' )
            ->with ( $old, $new )
            ->once ( );

        $this->habitManager
            ->shouldReceive ( 'all' )
            ->once ( )
            ->andReturn ( [ $new ] );


        list ( $status, $payload ) = app::make ( 'i want to update a habit', [
            'user' => $this->user,
            'guard' => $this->guard,
            'old' => $old,
            'new' => $new,
            'habitManager' => $this->habitManager
        ] );

        $this->status = $status;
        $this->payload = $payload;
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
     * @Then i should see that a habit with title :title already exists
     */
    public function iShouldSeeThatAHabitWithTitleAlreadyExists ( string $title )
    {
        assertThat ( $this->status, is ( 2000 ) );
        assertThat ( $this->payload [ 'habit' ]->title, is ( $title ) );
    }

    /**
     * @Then i should see that i am unauthorized
     */
    public function iShouldSeeThatIAmUnauthorized ( )
    {
        assertThat ( $this->status, is ( 0 ) );
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
     * @Then i should no longer see a habit with title :title
     */
    public function iShouldNoLongerSeeAHabitWithTitle ( string $title )
    {
        foreach ( $this->payload [ 'habits' ] as $habit )
            if ( $habit->title === $title )
                throw new exception ( "I can still see a habit with title: {$title}." );
    }

    /** @AfterScenario */
    public function after ( $event )
    {
        mockery::close ( );
    }

    private function find ( string $title ) : habit
    {
        foreach ( $this->addedHabits as $habit )
            if ( $habit->title === $title )
                return $habit;

        throw new exception ( "Can't find a habit with title {$title}." );
    } 
}