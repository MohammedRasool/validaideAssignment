<?php

namespace Features\Bootstrap;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkAwareContext as MinkAwareContextInterface;
use Behat\Mink\Mink;
use Behat\Mink\Session;

class MinkAwareContext implements Context, MinkAwareContextInterface
{
    private ?Mink $mink = null;
    private ?Session $session = null;

    public function setMink(Mink $mink)
    {
        $this->mink = $mink;
        $this->session = $mink->getSession('default');
    }

    public function setMinkParameters(array $parameters)
    {
        // Optionally handle parameters
    }

    public function getSession($name = null)
    {
        if (!$this->mink) {
            throw new \RuntimeException('Mink instance not set. Make sure you have configured the MinkExtension in your behat.yml.');
        }
        if ($name === null) {
            $name = 'default';
        }
        return $this->mink->getSession($name);
    }

    protected function visit(string $path): void
    {
        $this->getSession()->visit($path);
    }

    protected function assertPageAddress(string $path): void
    {
        $currentUrl = $this->getSession()->getCurrentUrl();
        if (!str_ends_with($currentUrl, $path)) {
            throw new \Exception("Current page is not $path. Current URL: $currentUrl");
        }
    }

    protected function assertSession()
    {
        if (!isset($this->mink)) {
            throw new \RuntimeException('Mink is not initialized. Make sure you have configured the MinkExtension in your behat.yml.');
        }
        return $this->mink->assertSession();
    }
} 