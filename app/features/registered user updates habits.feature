Feature: Registered user updates habits
    In order to keep my habits up to date
    As a registered user
    I need to be able to update my habits

    Rules:
        - I cannot update another user's habits

    Scenario Outline: Updating habit
        Given i am authenticated
        And i have added a habit with title <registered>
        And i have not added a habit with title <unregistered>
        When i update my habit with title <registered> to <unregistered>
        Then i should no longer see a habit with title <registered>
        And i should see a habit with title <unregistered>

        Examples:
            | registered  | unregistered |
            | "Exercise"  | "Fitness" |
            | "Handstand" | "Training" |

    Scenario: Updated title exists
        Given i am authenticated
        And i have added a habit with title "Exercise"
        And i have added a habit with title "Training"
        When i update my habit with title "Exercise" to "Training"
        Then i should see that a habit with title "Training" already exists

    Scenario: Unregistered
        Given i am not authenticated
        When i request to update a habit
        Then i should see that i am unauthorized