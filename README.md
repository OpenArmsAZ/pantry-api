# Open Arms Pantry App

Open Arms Pantry is an inventory management system developed for the 
[Open Arms Church of Arizona](http://www.openarmsaz.org/)
to help us better assist in supporting our local community through our food pantry. 

This is the back-end API project that

## Setup
 
```bash
# Install Composer dependencies.
composer install

# Spin up Docker
cd docker
./dev up
```
Visit [http://localhost](http://localhost)

# Code Style
Always run `composer check-style` before committing any work. 
All our code must be [PSR-2 Compliant](https://www.php-fig.org/psr/psr-2/).

# Unit Tests
Always run `composer test` before committing any work to ensure all tests are passing. 
It is ideal to pair all new or modified code with unit test cases.  