[![Magenizr Plus](https://images2.imgbox.com/9a/ca/3rXwQJY2_o.gif)](https://account.magenizr.com)
---

# Duplicate
Save time by duplicating records such as Catalog and Cart Price Rules, CMS Pages and Blocks or Categories. 

![Magenizr Duplicate - Backend Login](https://images2.imgbox.com/84/e6/hCnQzZYG_o.png)

## System Requirements
- Magento 2.4.x
- PHP 7.x

## Installation (Composer 2)

1. Update your composer.json `composer require "magenizr/magento2-duplicate":"1.0.0" --no-update`
2. Use `composer update magenizr/magento2-duplicate --no-install` to update your composer.lock file.

```
Updating dependencies
Lock file operations: 1 install, 1 update, 0 removals
  - Locking magenizr/magento2-duplicate (1.0.0)
```

3. And then `composer install` to install the package.

```
Installing dependencies from lock file (including require-dev)
Verifying lock file contents can be installed on current platform.
Package operations: 1 install, 0 update, 0 removals
  - Installing magenizr/magento2-duplicate (1.0.0): Extracting archive
```

4. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_Duplicate --clear-static-content
php bin/magento setup:upgrade
```

## Installation (Manually)
1. Download the code.
2. Extract the downloaded tar.gz file. Example: `tar -xzf Magenizr_Duplicate_1.0.0.tar.gz`.
3. Copy the code into `./app/code/Magenizr/Duplicate/`.
4. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_Duplicate --clear-static-content
```

## Features
* Enable / Disable module in `Stores > Configuration > General > Content Management > Duplicate`
* Duplicate Catalog and Cart Price Rules, CMS Pages and Blocks or Categories
* Copied items must be manually enabled

## Usage
Simply go and edit your Catalog Price Rule, Cart Price Rule, CMS Page, CMS Block or Category and hit the `Duplicate` button.

## Support
If you experience any issues, don't hesitate to open an issue on [Github](https://github.com/magenizr/Magenizr_Duplicate/issues).

## Purchase
This module is available for free on [GitHub](https://github.com/magenizr).

## Contact
Follow us on [GitHub](https://github.com/magenizr), [Twitter](https://twitter.com/magenizr) and [Facebook](https://www.facebook.com/magenizr).

## History
===== 1.0.0 =====
* Stable version

## License
[OSL - Open Software Licence 3.0](https://opensource.org/licenses/osl-3.0.php)
