Feature: Registered user lists habits
    In order to remember all my habits
    As a registered user
    I need to be able to list all habits

    Rules:
        - I cannot see another user's habits


    Scenario Outline: Registered
        Given i am authenticated
        And i have added a habit with title <title1>
        And i have added a habit with title <title2>
        When i request to see my habits
        Then i should see a habit with title <title1>
        And i should see a habit with title <title2>

        Examples:
            | title1      | title2       |
            | "Exercise"  | "Psychology" |
            | "Handstand" | "Philosophy" |

    Scenario: Unregistered user
        Given i am not authenticated
        When i request to see my habits
        Then i should see that i am unauthorized