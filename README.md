# DIY-time-and-materials
A WordPress plugin for displaying time, materials and difficulty of a project (post) for DIY bloggers.

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
* `diy_tam_project_post_type` a filter to over-ride the post type used to the taxonomies, allowing developers to customize the post type.
* `diy_tam_taxonomy_name_%TAXONOMY%` a filter to over-ride the taxonomy name on the frontend.
* `diy_tam_taxonomy_classes_%TAXONOMY%` a filter to over-ride the css classes output wrapping the taxonomy name on the frontend.
* `diy_tam_taxonomy_before_%TAXONOMY%` a filter to append markup before the taxonomy name on the frontend.

### Options
The plugin provides two options. An administrator can edit them by going to Settings > DIY Time and Materials. _Color_ sets the color of the taxonomy names. _Enable Font Awesome_ turns on (or off) the icon output.

### Changelog

* `diy_tam_taxonomy_name_%TAXONOMY%` a filter to over-ride the taxonomy name on the frontend.
* `diy_tam_taxonomy_classes_%TAXONOMY%` a filter to over-ride the css classes output wrapping the taxonomy name on the frontend.
* `diy_tam_taxonomy_before_%TAXONOMY%` a filter to append markup before the taxonomy name on the frontend.

### Options
The plugin provides two options. An administrator can edit them by going to Settings > DIY Time and Materials. _Color_ sets the color of the taxonomy names. _Enable Font Awesome_ turns on (or off) the icon output.

### Changelog

### 0.1
The cleaned up version of the [0.1](https://github.com/rfair404/DIY-time-and-materials/releases/tag/0.1) release.
#### 0.1-alpha
The initial release