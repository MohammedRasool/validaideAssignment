<?php

namespace Validaide\Page;

use Behat\Mink\Session;

class InventoryPage
{
    private Session $session;
    private string $url = 'https://www.saucedemo.com/inventory.html';

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function open(): void
    {
        $this->session->visit($this->url);
    }

    public function isAt(): bool
    {
        return str_contains($this->session->getCurrentUrl(), $this->url);
    }

    public function sortBy(string $option): void
    {
        $page = $this->session->getPage();
        file_put_contents('/tmp/behat_inventory_page.html', $page->getContent());
        $optionMap = [
            'Name (Z to A)' => 'za',
            'Name (A to Z)' => 'az',
            'Price (low to high)' => 'lohi',
            'Price (high to low)' => 'hilo'
        ];
        $value = $optionMap[$option] ?? $option;
        $dropdown = $page->find('css', 'select[data-test="product-sort-container"]');
        if ($dropdown) {
            $dropdown->selectOption($value, false);
        } else {
            throw new \Exception('Sort dropdown not found');
        }
    }

    public function getProductNames(): array
    {
        $page = $this->session->getPage();
        $elements = $page->findAll('css', '.inventory_item_name');
        return array_map(fn($el) => $el->getText(), $elements);
    }

    public function getProductPrices(): array
    {
        $page = $this->session->getPage();
        $elements = $page->findAll('css', '.inventory_item_price');
        return array_map(function($el) {
            $text = $el->getText();
            return (float) str_replace('$', '', $text);
        }, $elements);
    }
} 