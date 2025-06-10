<?php

namespace Features\Bootstrap;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Validaide\Page\LoginPage;
use Validaide\Fixtures\TestData;

class LoginContext extends MinkAwareContext
{
    private LoginPage $loginPage;
    private array $users;

    public function __construct()
    {
        $this->users = TestData::loginUsers();
    }

    /**
     * @Given I am on the login page
     */
    public function iAmOnTheLoginPage()
    {
        $this->loginPage = new LoginPage($this->getSession());
        $this->loginPage->open();
    }

    /**
     * @When I log in as a standard user
     */
    public function iLogInAsAStandardUser()
    {
        $user = $this->users['standard'];
        $this->loginPage->login($user['username'], $user['password']);
    }

    /**
     * @When I log in as a locked out user
     */
    public function iLogInAsALockedOutUser()
    {
        $user = $this->users['locked_out'];
        $this->loginPage->login($user['username'], $user['password']);
    }

    /**
     * @When I log in with invalid credentials
     */
    public function iLogInWithInvalidCredentials()
    {
        $user = $this->users['invalid'];
        $this->loginPage->login($user['username'], $user['password']);
    }

    /**
     * @Then I should see the products page
     */
    public function iShouldSeeTheProductsPage()
    {
        $this->assertPageAddress('/inventory.html');
    }

    /**
     * @Then I should see an error message :message
     */
    public function iShouldSeeAnErrorMessage($message)
    {
        $actual = $this->loginPage->getErrorMessage();
        if (strpos($actual, $message) === false) {
            throw new \Exception("Expected error message '$message', got '$actual'");
        }
    }

    /**
     * @When I fill in :field with :value
     */
    public function iFillInWith($field, $value)
    {
        $fieldMap = [
            'username' => 'user-name',
            'password' => 'password'
        ];
        $actualField = $fieldMap[$field] ?? $field;
        $this->getSession()->getPage()->fillField($actualField, $value);
    }

    /**
     * @When I press :button
     */
    public function iPress($button)
    {
        $this->getSession()->getPage()->pressButton($button);
    }

    /**
     * @Then I should be on the :page page
     */
    public function iShouldBeOnThePage($page)
    {
        $pageMap = [
            'inventory' => '/inventory.html',
            'dashboard' => '/inventory.html'
        ];
        $path = $pageMap[$page] ?? "/$page";
        $this->assertPageAddress($path);
    }

    /**
     * @Then I should see :text
     */
    public function iShouldSee($text)
    {
        $this->assertSession()->pageTextContains($text);
    }

    /**
     * @Given I am logged in as a standard user
     */
    public function iAmLoggedInAsAStandardUser()
    {
        $this->iAmOnTheLoginPage();
        $this->iLogInAsAStandardUser();
    }

    /**
     * @Then I complete the purchase
     */
    public function iCompleteThePurchase()
    {
        $js = 'var btn = document.querySelector("[data-test=\\"finish\\"]"); if (btn) { btn.scrollIntoView(true); btn.click(); }';
        $this->getSession()->executeScript($js);
    }

    /**
     * @Then I should see the order completion message
     */
    public function iShouldSeeTheOrderCompletionMessage()
    {
        $this->assertSession()->pageTextContains('Thank you for your order');
    }
} 