Feature: Registered user removes habits
    In order to keep my habits up to date
    As a registered user
    I need to be able to remove habits

    Rules:
        - I cannot remove another user's habits

    Scenario: Removing habit
        Given i am authenticated
        And i have added a habit with title "Exercise"
        When i remove a habit with title "Exercise"
        Then i should no longer see a habit with title "Exercise"

    Scenario: Unregistered user
        Given i am not authenticated
        When i request to remove a habit
        Then i should see that i am unauthorized