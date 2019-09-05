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
    /**
     * @Given a registered user with username :arg1 and password :arg2
     */
    public function aRegisteredUserWithUsernameAndPassword($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given :arg1 has registered a habit with title :arg2
     */
    public function hasRegisteredAHabitWithTitle($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When henk requests for a list of habits
     */
    public function henkRequestsForAListOfHabits()
    {
        throw new PendingException();
    }

    /**
     * @Then henk should see an empty habit list
     */
    public function henkShouldSeeAnEmptyHabitList()
    {
        throw new PendingException();
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
