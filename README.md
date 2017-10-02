# Magento 2 Cache Tags Helper
Displays the cache tags from the current page in the console.

## Practical use
Knowing which cache tags are used on a page allows you to selectively invalidate full page cache for certain tags only. This tool shows allows you to know which cache tags are used so that you can develop your own cache invalidation functionality. An example of that would be to create a cron job that invalidates the full page cache for the home page only:

```
class Cron {
     protected $_cache;

     public function __construct(
            \Magento\Framework\App\CacheInterface $cache
        ) {
            $this->_cache = $cache;
        }
        
     public function execute() {
        $this->_cache->clean(['cms_page_2']); // cms_page_2 = default home page tag
     }
}
``` 

## Installation

`composer require dakzilla/magento2-cachetags-helper`

`php bin/magento setup:upgrade`

## Usage
The module only works in developer mode with full page cache disabled. To disable full page cache, run this command:
 
`php bin/magento cache:disable full_page`

Upon reloading the page, you should see a red block of text in your developer console.

## License
This module is licensed under the MIT License

Copyright 2017 Simon Dakin

Made with ♥ in Montreal