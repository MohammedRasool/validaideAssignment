<?php

namespace Features\Bootstrap;

use Validaide\Page\CheckoutPage;
use Validaide\Fixtures\TestData;

class CheckoutContext extends MinkAwareContext
{
    private CheckoutPage $checkoutPage;

    /**
     * @Then the total price should be correct
     */
    public function theTotalPriceShouldBeCorrect()
    {
        $this->checkoutPage = new CheckoutPage($this->getSession());
        $total = $this->checkoutPage->getTotalPrice();
        if (!$total || !preg_match('/Total: \$[\d.]+/', $total)) {
            throw new \Exception('Total price not found or invalid.');
        }
    }

    /**
     * @And I complete the purchase
     */
    public function iCompleteThePurchase()
    {
        $this->checkoutPage->finishCheckout();
    }

    /**
     * @And I should see the order completion message
     */
    public function iShouldSeeTheOrderCompletionMessage()
    {
        $msg = $this->checkoutPage->getOrderCompletionMessage();
        if (stripos($msg, 'Thank you for your order') === false) {
            throw new \Exception('Order completion message not found.');
        }
    }

    /**
     * @When I proceed to checkout and enter my information
     */
    public function iProceedToCheckoutAndEnterMyInformation()
    {
        $user = TestData::checkoutUser();
        $this->checkoutPage = new CheckoutPage($this->getSession());
        $this->checkoutPage->fillUserInfo($user['firstName'], $user['lastName'], $user['postalCode']);
    }
} 