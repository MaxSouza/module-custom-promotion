# CustomPromotion module

The custom promotion module enables you to add a new approach to product category discount.

## Installation details

#### ✓ Install by Composer (recommended)
```
composer require max-souza/module-custom-promotion
php bin/magento module:enable
php bin/magento setup:upgrade
```

#### ✓ Install Manually
- Copy module to folder app/code/MaxSouza/CustomPromotion and run commands:
```
php bin/magento setup:di:compile
php bin/magento setup:upgrade
```

## Usage
The management options can be found under Marketing > Promotions > Custom Promotion.

![Custom promotion management](https://github.com/MaxSouza/module-custom-promotion/assets/5350377/83d95597-8cdc-4479-9d64-3d867d05a605)


Add, edit, delete custom promotions

![Custom promotion edit](https://github.com/MaxSouza/module-custom-promotion/assets/5350377/6de7102d-0e3b-43f9-a0cb-5178dcc00681)

## Requirements

- Magento 2.4.4 +
- PHP 8.0 +

## License
OSL-3.0
