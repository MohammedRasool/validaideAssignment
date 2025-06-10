Feature: Product Sorting
  As a user
  I want to sort products by name (Z to A)
  So that I can see the correct order

  Scenario: Sort products by name Z to A
    Given I am logged in as a standard user
    When I sort products by name Z to A
    Then the products should be sorted in descending alphabetical order 