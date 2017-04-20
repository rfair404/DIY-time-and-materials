# DIY-time-and-materials
A WordPress plugin for displaying time, materials and for DIY bloggers.

This is an example project that I wrote as part of an interview process. It is intended for demonstration purposes only. While you're free to use this code in any way you wish, there is absolutley no warranty or support.

### Requirements
Required WordPress Version 4.7.0 or later
Requires PHP Version 5.3 or later

### Coding Standards
I applied both the WordPress, WordPress VIP coding standards using PHP_CodeSniffer, as well as php 5.3 compatability, which I grabbed from [here](https://github.com/wimg/PHP53Compat_CodeSniffer)

Use the following commands before submitting code:
```
phpcs --standards=WordPress --extensions=php ./
phpcs --standards=WordPress-VIP --extensions=php ./
phpcs --standards=PHPCompatibility --extensions=php ./
```

### PHP Unit tests
A set of test cases is included in the plugin. To run the unit tests issue the following command:
```
phpunit
```

### Filters
A number of filters exist to make customizing the display of the taxonomy data easy.
* `diy_tam_color` a filter to over-ride the color of the taxonomy terms.




