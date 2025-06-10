<?php

namespace Validaide\Fixtures;

class TestData
{
    public static function loginUsers(): array
    {
        return [
            'standard' => [
                'username' => 'standard_user',
                'password' => 'secret_sauce'
            ],
            'invalid' => [
                'username' => 'invalid_user',
                'password' => 'invalid_password'
            ]
        ];
    }

    public static function products(): array
    {
        return [
            'backpack' => [
                'name' => 'Sauce Labs Backpack',
                'price' => 29.99
            ],
            'bike_light' => [
                'name' => 'Sauce Labs Bike Light',
                'price' => 9.99
            ]
        ];
    }

    public static function checkoutUser(): array
    {
        return [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'postalCode' => '12345',
        ];
    }
} 