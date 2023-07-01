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
![Custom promotion Management](https://github.com/MaxSouza/module-custom-promotion/assets/5350377/904d078c-4640-4004-b3b3-693e1a98fcad)

Add, edit, delete custom promotions
![Custom promotion edit](https://github.com/MaxSouza/module-custom-promotion/assets/5350377/4587c635-7bcd-46ce-8f2f-2905b6cb5910)

## Requirements

- Magento 2.4.4 +
- PHP 8.0 +

## License
OSL-3.0
