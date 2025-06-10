<?php

namespace Features\Bootstrap;

use Validaide\Page\CartPage;
use Validaide\Fixtures\TestData;

class CartContext extends MinkAwareContext
{
    private CartPage $cartPage;

    /**
     * @Given I add the backpack and bike light to the cart
     */
    public function iAddTheBackpackAndBikeLightToTheCart()
    {
        $this->cartPage = new CartPage($this->getSession());
        $products = TestData::products();
        foreach ([$products['backpack']['name'], $products['bike_light']['name']] as $itemName) {
            $this->cartPage->addItem($itemName);
        }
        $this->cartPage->open();
    }
} 