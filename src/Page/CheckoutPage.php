<?php

namespace Validaide\Page;

use Behat\Mink\Session;

class CheckoutPage
{
    private Session $session;
    private string $url = 'https://www.saucedemo.com/checkout-step-one.html';

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function open(): void
    {
        $this->session->visit($this->url);
    }

    public function fillUserInfo(string $firstName, string $lastName, string $postalCode): void
    {
        $this->open();
        $page = $this->session->getPage();
        $page->fillField('firstName', $firstName);
        $page->fillField('lastName', $lastName);
        $page->fillField('postalCode', $postalCode);
        $page->pressButton('continue');
    }

    public function getTotalPrice(): ?string
    {
        $page = $this->session->getPage();
        $el = $page->find('css', '.summary_total_label');
        return $el ? $el->getText() : null;
    }

    public function finishCheckout(): void
    {
        $page = $this->session->getPage();
        $page->pressButton('finish');
    }

    public function getOrderCompletionMessage(): ?string
    {
        $page = $this->session->getPage();
        $el = $page->find('css', '.complete-header');
        return $el ? $el->getText() : null;
    }
} 