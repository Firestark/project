Feature: Registered user adds habits
    In order to remember my habits
    As a registered user
    I need to be able to register my habits

    Rules:
        - I cannot add habits for another user


    Scenario: Registered
        Given i am authenticated
        When i add a habit with title "Exercise"
        Then i should see a habit with title "Exercise"

    Scenario: Habbit title exists
        Given i am authenticated
        And i have added a habit with title "Psychology"
        When i try to add a habit with title "Psychology"
        Then i should see that a habit with title "Psychology" already exists

    Scenario: Unregistered user
        Given i am not authenticated
        When i try to add a habit
        Then i should see that i am unauthorized