Feature: Registered user adds habits
    In order to remember my habits
    As a registered user
    I need to be able to register my habits


    Scenario: Registered
        Given i am a registered user
        When i register a habit with title "Exericse"
        Then i should see a registered habit with title "Exercise"

    Scenario: Habbit title exists
        Given i am a registered user
        And a habit with title "Psychology" exists for me
        When i try to add a habit with title "Psychology"
        Then i should see that a habit with title "Psychology" already exists

    Scenario: Unregistered
        Given i am not registered
        When i try to add a habit
        Then i should see that i am unauthorized