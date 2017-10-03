# Magento 2 Cache Tags Helper
[![Build Status](https://scrutinizer-ci.com/g/dakzilla/magento2-cachetags-helper/badges/build.png?b=master)](https://scrutinizer-ci.com/g/dakzilla/magento2-cachetags-helper/build-status/master) [![Code Climate](https://codeclimate.com/github/dakzilla/magento2-cachetags-helper/badges/gpa.svg)](https://codeclimate.com/github/dakzilla/magento2-cachetags-helper) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dakzilla/magento2-cachetags-helper/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dakzilla/magento2-cachetags-helper/?branch=master)

Displays the cache tags from the current page in the console.

![](https://i.imgur.com/1X64r9C.png)

## Practical use
Knowing which cache tags are used on a page allows you to selectively invalidate full page cache for certain tags only. This tool allows you to know which cache tags are used so that you can develop your own cache invalidation functionality. An example of that would be to create a cron job that invalidates the full page cache for the home page only:

```
class Cron {
     protected $_cache;

     public function __construct(
            \Magento\Framework\Cache\FrontendInterface $cache
        ) {
            $this->_cache = $cache;
        }
        
     public function execute() {
        $this->_cache->clean(\Zend_Cache::CLEANING_MODE_MATCHING_TAG, ['cms_page_2']); // default home page tag in 2.1.x
     }
}
``` 

## Installation

`composer require dakzilla/magento2-cachetags-helper`

`php bin/magento setup:upgrade`

## Usage
The module only works in developer mode with full page cache disabled. To disable only the full page cache, run this command:
 
`php bin/magento cache:disable full_page`

Upon reloading the page, you should see the cache tags appear in your developer console.

## Compatibility
This module has been tested with the 2.1 and 2.2 stable branches of Magento 2.

## License
This module is licensed under the MIT License

Copyright 2017 Simon Dakin

Made with ♥ in Montreal