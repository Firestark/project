Feature: Registered user removes habits
    In order to keep my habits up to date
    As a registered user
    I need to be able to remove habits

    Rules:
        - I cannot remove another users habits

    Scenario: Registered
        Given i am a registered user
        And i have registered a habit with title "Exercise"
        When i remove a habit with title "Exercise"
        Then i should no longer see a habit with title "Exercise"

    Scenario: Unregistered
        Given i am unregistered
        When i request to remove a habit
        Then i should see that i am unauthorized