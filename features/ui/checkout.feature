Feature: Checkout Process
  As a user
  I want to complete a purchase and verify the total price

  Scenario: Add items to cart and complete checkout
    Given I am logged in as a standard user
    And I add the backpack and bike light to the cart
    When I proceed to checkout and enter my information
    Then the total price should be correct
    And I complete the purchase
    And I should see the order completion message 