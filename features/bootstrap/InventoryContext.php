<?php

namespace Features\Bootstrap;

use Behat\Mink\Mink;
use Validaide\Page\InventoryPage;
use Validaide\Fixtures\TestData;

class InventoryContext extends MinkAwareContext
{
    private InventoryPage $inventoryPage;

    public function setMink(Mink $mink)
    {
        parent::setMink($mink);
        $this->inventoryPage = new InventoryPage($this->getSession());
    }

    /**
     * @Given I am on the inventory page
     */
    public function iAmOnTheInventoryPage()
    {
        $this->inventoryPage->open();
    }

    /**
     * @When I sort products by :sortOption
     */
    public function iSortProductsBy($sortOption)
    {
        $this->inventoryPage->sortBy($sortOption);
    }

    /**
     * @When I sort products by name Z to A
     */
    public function iSortProductsByNameZToA()
    {
        $this->iSortProductsBy('Name (Z to A)');
    }

    /**
     * @Then the products should be sorted by :sortOption
     */
    public function theProductsShouldBeSortedBy($sortOption)
    {
        $products = $this->inventoryPage->getProductPrices();
        $expected = $products;
        sort($expected);
        if ($sortOption === 'Price (high to low)') {
            $expected = array_reverse($expected);
        }
        if ($products !== $expected) {
            throw new \Exception('Products are not sorted correctly.');
        }
    }

    /**
     * @Then the products should be sorted in descending alphabetical order
     */
    public function theProductsShouldBeSortedInDescendingAlphabeticalOrder()
    {
        $products = $this->inventoryPage->getProductNames();
        $expected = $products;
        rsort($expected, SORT_STRING);
        if ($products !== $expected) {
            throw new \Exception('Products are not sorted in descending alphabetical order.');
        }
    }
} 