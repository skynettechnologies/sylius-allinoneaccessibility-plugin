# All in One Accessibility: Sylius Extension

[All in One Accessibility](https://www.skynettechnologies.com/all-in-one-accessibility) extension improves Sylius website ADA compliance and browser experience for ADA, WCAG 2.1 & 2.2, Section 508, Australian DDA, European EAA EN 301 549, UK Equality Act (EA), Israeli Standard 5568, California Unruh, Ontario AODA, Canada ACA, German BITV, France RGAA, Brazilian Inclusion Law (LBI 13.146/2015), Spain UNE 139803:2012, JIS X 8341 (Japan), Italian Stanca Act and Switzerland DDA Standards.

It uses the accessibility interface which handles UI and design related adjustments. All in One Accessibility app enhances your Sylius website accessibility to people with hearing or vision impairments, motor impaired, color blind, dyslexia, cognitive & learning impairments, seizure and epileptic, and ADHD problems.

## Features
#### Skip Links
- Skip to Menu
- Skip to Footer
- Skip to Navigation
- Open Accessibility Toolbar

#### Content Adjustments
- Content Scaling
- Readable Fonts
- Highlight Title
- Highlight Links
- Text Magnifier
- Adjust Font Sizing
- Adjust Line Height
- Adjust Letter Spacing
- Align Center
- Align Left
- Align Right

#### Color and Contrast Adjustments
- High Contrast

#### Orientation Adjustments
- Hide Images (Text Only)
- Miscellaneous
- Accessibility Statement
- Dynamic Application Color
- Choose Application Trigger Button Position
- Choose Application Position
- Multi Language

#### Supports 140 languages
- English
- Italian
- French
- German
- Russian
- Spanish
- Finnish
- Portuguese
- Arab
- Polish
- Hungarian
- Slovak
- Japanese
- Turkish
- Greek
- Latin
- Hebrew
- Bulgarian
- Catalan
- Chinese
- Czech
- Danish
- Dutch
- Hindi
- Indonesian
- Korean
- Malay
- Norwegian
- Romanian
- Slovenian
- Swedish
- Thai
- Ukrainian
- Vietnamese
- Bengali
- Lithuanian
- Sinhala
- Amharic
- Hmong
- Burmese
- Latvian
- Estonian
- Serbian
- Portuguese (Brazil)
- Chinese Traditional
- Croatian
- Georgian
- Hawaiian
- Welsh
- Cebuano
- Samoan
- Haitian Creole
- Faroese
- Montenegrin
- Australian
- Azeri
- Basque
- Canada
- Filipino
- Galician
- Norwegian
- Persian
- Punjabi
- Spanish (Mexico)
- United Kingdom


## Installation

1. Run `composer require skynettechnologies/sylius-allinoneaccessibility-plugin`


2. Enable the plugin in bundles.php

```php
<?php
// config/bundles.php

return [
    // ...
    Skynettechnologies\SyliusAllinOneAccessibilityPlugin\SkynettechnologiesSyliusAllinOneAccessibilityPlugin::class => ['all' => true],
];
```

3. Import the plugin configurations

```yml
# config/packages/_sylius.yaml
imports:
    # ...
    - { resource: "@SkynettechnologiesSyliusAllinOneAccessibilityPlugin/Resources/config/config.yaml" }
```

4. Add the shop and admin routes

```yml
# config/routes.yaml
skynettechnologies_sylius_allinoneaccessibility_plugin_admin:
    resource: "@SkynettechnologiesSyliusAllinOneAccessibilityPlugin/Resources/config/routing/admin.yaml"
    prefix: /admin

skynettechnologies_sylius_allinoneaccessibility_plugin_shop:
    resource: "@SkynettechnologiesSyliusAllinOneAccessibilityPlugin/Resources/config/routing/shop.yaml"
    prefix: /{_locale}/allinoneaccessibility
    requirements:
        _locale: ^[A-Za-z]{2,4}(_([A-Za-z]{4}|[0-9]{3}))?(_([A-Za-z]{2}|[0-9]{3}))?$
```

5. Create allinoneaccessibility folder: run `mkdir public/media/allinoneaccessibility-image -p` and insert a .gitkeep file in that folder


6. Finish the installation updating the database schema and installing assets

```
php bin/console doctrine:migrations:migrate
php bin/console sylius:theme:assets:install
php bin/console cache:clear
```

7. Build and run the package using below command

```
symfony server:start
```

## Screenshots

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/screenshot3.png)

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/screenshot1.png)

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/screenshot2.png)

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/screenshot4.png)

## Video

[![All in One Accessibility](https://img.youtube.com/vi/czwC0PKIqkc/0.jpg)](https://www.youtube.com/watch?v=czwC0PKIqkc)

## Acknowledgements

 - [Sylius All in One Accessibility](https://www.skynettechnologies.com/sylius-website-accessibility)
 - [Sylius All in One Accessibility Extension installation steps blog](https://www.skynettechnologies.com/blog/sylius-web-accessibility-widget-installation)

## Documentation

[All in One Accessibility - User Guide](https://www.dropbox.com/s/de41n4xm9zjwxix/All-in-One-Accessibility-PRO-App-Usage-and-Functionality.pdf?dl=0)

## Support
For any kind of queries/support please Email us at [Skynet Technologies Support](mailto:hello@skynettechnologies.com)
