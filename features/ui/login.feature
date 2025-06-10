Feature: User Login
  As a user
  I want to be able to log in to the application
  So that I can access my account

  Scenario: Successful login with valid credentials
    Given I am on the login page
    When I fill in "username" with "standard_user"
    And I fill in "password" with "secret_sauce"
    And I press "Login"
    Then I should be on the inventory page
    And I should see "Products"

  Scenario: Failed login with invalid credentials
    Given I am on the login page
    When I fill in "username" with "invalid_user"
    And I fill in "password" with "invalid_password"
    And I press "Login"
    Then I should see "Epic sadface" 