<?php

namespace Validaide\Page;

use Behat\Mink\Session;

class LoginPage
{
    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function open(): void
    {
        $this->session->visit('https://www.saucedemo.com/');
    }

    public function login(string $username, string $password): void
    {
        $page = $this->session->getPage();
        $page->fillField('user-name', $username);
        $page->fillField('password', $password);
        $page->pressButton('Login');
    }

    public function getErrorMessage(): string
    {
        return $this->session->getPage()->find('css', '[data-test="error"]')->getText();
    }
} 