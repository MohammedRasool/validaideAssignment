<?php

namespace Validaide\Page;

use Behat\Mink\Session;

class CartPage
{
    private Session $session;
    private string $url = 'https://www.saucedemo.com/cart.html';

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function open(): void
    {
        $this->session->visit($this->url);
    }

    public function addItem(string $itemName): void
    {
        $page = $this->session->getPage();
        $button = $page->find('xpath', "//div[text()='" . $itemName . "']/ancestor::div[contains(@class,'inventory_item')]//button[contains(text(),'Add to cart')]");
        if ($button) {
            $button->click();
        }
    }

    public function proceedToCheckout(): void
    {
        $page = $this->session->getPage();
        $page->pressButton('checkout');
    }
} 