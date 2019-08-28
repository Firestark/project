Feature: Registered user adds habits
  In order to track my habits
  As a registered user
  I need to be able to add my habits

  Scenario: Adding a single habit as a registered user
    Given I am a registered user
    When I add a habit to the habit manager
    Then My habit should be added to the habit manager

  Scenario: User not registered
    Given I am not a registered user
    When I add a habit to the habit manager
    Then My habit should not be added to the habit manager