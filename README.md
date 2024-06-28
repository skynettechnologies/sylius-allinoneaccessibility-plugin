# All in One Accessibility™: Sylius Extension

## Description
All in One Accessibility AI Widget Supports 140 Languages and includes 70+ features. Screen Reader, Talk & Type, Voice Navigation, Dictionary, Virtual Keyboard, Accessibility Profiles, Sign language Libras (Brazilian Portuguese) Custom Widget Color, Icon size, Position, Talk & Type, GA4 Tracking and custom accessibility statement link are some of the top features.
   
Our AI automatically remediates images Alternative text and uses the accessibility interface which handles UI and design related adjustments. All in One Accessibility app enhances your website accessibility to people with hearing or vision impairments, motor impaired, color blind, dyslexia, cognitive & learning impairments, seizure and epileptic, and ADHD problems.
   
It improves website ADA compliance and browser experience for ADA, WCAG 2.1 & 2.2, Section 508, California Unruh Act, Australian DDA, European EAA EN 301 549, UK Equality Act (EA), Israeli Standard 5568, Ontario AODA, Canada ACA, German BITV, France RGAA, Brazilian Inclusion Law (LBI 13.146/2015), Spain UNE 139803:2012, JIS X 8341 (Japan), Italian Stanca Act and Switzerland DDA Standards.
   
Follows the best industry security, SEO practices and standards ISO 9001:2015 & ISO 27001:2013 and complies with GDPR, COPPA regulations. Member of W3C and International Association of Accessibility Professionals (IAAP). It is a flexible & lightweight widget that can be changed according to law and reduces the risk of time-consuming accessibility lawsuits.

Following features can be added as an addon:
- PDF/Document Remediation
- Modify Accessibility Menu
- White Label and Custom Branding
- Live Website Translations
- VPAT / ACR Report
- Manual Accessibility Audit

For more details/features, Please visit [All in One Accessibility](https://www.skynettechnologies.com/all-in-one-accessibility).


## Installation

### Prerequisites

- Sylius version ^1.12

### Steps

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

## Live Demo

https://sylius.skynettechnologies.us/

## Screenshots

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/Screenshot-1.jpg?v=2)

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/Screenshot-2.jpg?v=2)

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/Screenshot-3.jpg?v=2)

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/Screenshot-4.jpg?v=2)

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/Screenshot-5.jpg?v=2)

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/Screenshot-6.jpg?v=2)

## Video

[![All in One Accessibility](https://img.youtube.com/vi/czwC0PKIqkc/0.jpg)](https://www.youtube.com/watch?v=czwC0PKIqkc)

## Acknowledgements

 - [Sylius All in One Accessibility](https://www.skynettechnologies.com/sylius-website-accessibility)

## Documentation

[All in One Accessibility - User Guide](https://www.dropbox.com/s/de41n4xm9zjwxix/All-in-One-Accessibility-PRO-App-Usage-and-Functionality.pdf?dl=0)

## Submit a Support Request

Please visit our [support page](https://www.skynettechnologies.com/report-accessibility-problem) and fill out the form. Our team will get back to you as soon as possible.

## Send Us an Email

Alternatively, you can send an email to our support team:
[hello@skynettechnologies.com](mailto:hello@skynettechnologies.com)

## Partnership Opportunities

#### [Agency](https://www.skynettechnologies.com/agency-partners)

Partner with us as an agency to provide comprehensive accessibility solutions to your clients. Get access to exclusive resources, training, and support to help you implement and manage accessibility features effectively.

#### [Affiliate](https://www.skynettechnologies.com/affiliate-partner)

Join our affiliate program and earn commissions by promoting All in One Accessibility™. Share our Widget with your network and help businesses improve their website accessibility while generating revenue.

For more details, Please visit [Partnership Opportunities](https://www.skynettechnologies.com/partner-program)

## About

This addon is developed and maintained by [Skynet Technologies USA LLC](https://www.skynettechnologies.com)
