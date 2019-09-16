Feature: Security manager secures habits
    In order to secure all user habits
    As a security manager
    I need to be able to make sure that user habits are private


    Scenario: Accessing user habits
        Given a registered user with username "admin" and password "admin"
        And a registered user with username "henk" and password "henk"
        And "admin" has registered a habit with title "Exercise"
        When "henk" requests for a list of habits
        Then "henk" should see an empty habit list

    Scenario: Adding user habits
        Given a registered user with username "admin" and password "admin"
        And a registered user with username "henk" and password "henk"
        And "admin" has registered a habit with title "Exercise"
        When "henk" requests to add a habit with title "Psychology"
        Then "admin" should have a habit with title "Exercise"
        And "henk" should have a habit with title "Psychology"

    Scenario: Updating user habits
        Given a registered user with username "admin" and password "admin"
        And a registered user with username "henk" and password "henk"
        And "admin" has registered a habit with title "Exercise"
        And henk has registered a habit with title "Exercising"
        When "henk" requests to update a habit with title "Exercising" to "Training"
        Then "admin" should have a habit with title "Exercise"
        And "henk" should have a habit with title "Training"

    Scenario: Deleting user habits
        Given a registered user with username "admin" and password "admin"
        And a registered user with username "henk" and password "henk"
        And "admin" has registered a habit with title "Exercise"
        And "henk" has registered a habit with title "Exercising"
        When "henk" requests to remove a habit with title "Exercising"
        Then "admin" should have a habit with title "Exercise"
        And "henk" should see an empty habit list

    Scenario: Mark a habit done
        Given a registered user with username "admin" and password "admin"
        And a registered user with username "henk" and password "henk"
        And "admin" has registered a habit with title "Exercise"
        And "henk" has registered a habit with title "Exercise"
        When "henk" requests to complete a habit with title "Exercise"
        Then "admin" should an uncompleted habit with title "Exercise"
        And "henk" should see a completed habit with title "Exercise"