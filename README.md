## This project was created to fulfill the Automated test requirements of the Test Automation Engineer assignment from Validaide
### Author: [Mohammed Rasool Abdul Azeez](https://www.linkedin.com/in/mohammed-rasool-abdul-azeez/)
#### Email: razuldt@gmail.com

This project is a BDD test automation framework using Behat (PHP), Selenium (Firefox), and HTML reporting. It covers UI scenarios for Sauce Demo.

## Table of Contents
- [Software/OS Versions](#softwareos-versions)
- [Assumptions](#assumptions)
- [Pre-Requisites](#pre-requisites)
- [Application Setup](#application-setup)
- [Test Scenarios](#test-scenarios)
- [Test Locations](#test-locations)
- [Framework Details](#framework-details)
- [Test Data](#test-data)
- [Running Tests](#running-tests)
  - [Local Execution](#local-execution)
- [Test Results](#test-results)

## Software/OS Versions
1. PHP version: `8.1`
2. Behat version: `3.22`
3. Mink: `1.12`
4. MinkGoutteDriver: `1.2`
5. MinkSelenium2Driver: `1.7`
6. Firefox: `123.0`
7. Selenium version: `3.141.59`
8. Language: PHP
9. OS: `MacOS`

## Assumptions
- The application works on Firefox browser (configured in docker-compose.yml)
- The automated tests run as expected on MacOS
- The Sauce Demo website is accessible and functional

## Pre-Requisites
1. Install PHP 8.1
2. Install Composer
3. Install Docker
4. Clone this project
5. Open the project in an IDE
6. Run `composer install` to install dependencies

## Application Setup
- **Please make sure that the website "Sauce Demo" (https://www.saucedemo.com/) is accessible and functional before running the automated tests.**

## Test Scenarios
1. **Scenario 1: Login Functionality Tests**
   - Automated Test Steps:
     - Test login with valid credentials (standard_user)
     - Test failed login with invalid credentials
     - Verify appropriate error messages

2. **Scenario 2: Product Sorting Tests**
   - Automated Test Steps:
     - Sort products by name (Z to A)
     - Verify products are sorted in descending alphabetical order

3. **Scenario 3: Checkout Process Tests**
   - Automated Test Steps:
     - Add backpack and bike light to cart
     - Complete checkout process with user information
     - Verify total price
     - Verify order completion message

## Test Locations
- UI Tests are located in: `./features/ui/`
  - Login tests: `login.feature`
  - Sorting tests: `sorting.feature`
  - Checkout tests: `checkout.feature`

## Framework Details
1. **Context Classes:**
   - Located at: `./features/bootstrap/`
   - `LoginContext.php` - Contains login-related step definitions
   - `InventoryContext.php` - Contains inventory page step definitions
   - `CartContext.php` - Contains cart page step definitions
   - `CheckoutContext.php` - Contains checkout page step definitions

2. **Page Objects:**
   - Located at: `./src/Page/`
   - Implements the Page Object Model (POM) design pattern
   - Each page object encapsulates:
     - Page-specific selectors
     - Page-specific actions
     - Page-specific assertions
   - Available Page Objects:
     - `LoginPage.php`: Handles login form interactions
     - `InventoryPage.php`: Manages product listing and sorting
     - `CartPage.php`: Controls shopping cart operations
     - `CheckoutPage.php`: Manages checkout process

3. **Configuration:**
   - `behat.yml` - Main configuration file for Behat
   - `docker-compose.yml` - Docker configuration for Selenium and Firefox
   - `composer.json` - PHP dependencies and project configuration

4. **Reporting:**
   - HTML reports are generated using `emuse/behat-html-formatter`
   - Reports are located in the project root directory

## Test Data
The project uses a centralized `TestData` class (`src/Fixtures/TestData.php`) to manage test data across different scenarios:

1. **Login Users** (`loginUsers()`):
   - Standard user: `standard_user` / `secret_sauce`
   - Invalid user: `invalid_user` / `invalid_password`

2. **Products** (`products()`):
   - Sauce Labs Backpack: $29.99
   - Sauce Labs Bike Light: $9.99

3. **Checkout Information** (`checkoutUser()`):
   - First Name: John
   - Last Name: Doe
   - Postal Code: 12345

This test data is used across various test contexts:
- `LoginContext`: Uses login credentials
- `CartContext`: Uses product information
- `CheckoutContext`: Uses checkout user information

## Running Tests

### Local Execution
1. Start Selenium server (runs Firefox in headless mode):
```bash
docker-compose up -d
```

2. Run all tests and Generate HTML report:
```bash
composer ui-test-run-with-report
```

Note: Tests run in headless mode by default using Firefox in a Docker container. No visible browser window will appear during test execution.

## Test Results
- Report is attached here: ```./reports/report.html``` (screenshot seen below)
- ![Image](https://github.com/user-attachments/assets/69ba82de-d18d-4838-963d-59692ec44732)