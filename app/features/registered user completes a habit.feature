Feature: Registered user completes a habit
    In order to mark a habit done for today
    As a register user
    I need to complete a habit

    Rules:
        - I cannot complete another user's habits

    Scenario: Mark a habit done
        Given i am authenticated
        And i have added a habit with title "Exercise"
        When i complete a habit with title "Exercise"
        Then i should see habit with title "Exercise" completed

    Scenario: Habit not found
        Given i am authenticated
        And i have not added a habit with title "Exercise"
        When i complete a habit with title "Exercise"
        Then i should see that a habit with title "Exercise" does not exist

    Scenario: Unregistered user
        Given i am not authenticated
        When i request to complete a habit
        Then i should see that i am unauthorized