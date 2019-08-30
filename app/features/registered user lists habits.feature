Feature: Registered user lists habits
    In order to remember all my habits
    As a registered user
    I need to be able to list all habits

    Rules:
        - I cannot see another users habits

    Scenario: Registered
        Given i am a registered user
        And i have registered a habit with title "Exercise"
        And i have registered a habit with title "Psychology"
        And i request to see my habits
        Then i should see a habit with title "Exercise" 
        And i should see a habit with title "Psychology"

    Scenario: Unregistered
        Given i am unregistered
        When i request to see my habits
        Then i should see that i am unauthorized