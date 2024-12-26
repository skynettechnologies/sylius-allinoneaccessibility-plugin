
All in One Accessibility AI free Widget Supports limited 23 features only and includes 140 Languages. 

It improves website ADA compliance and browser experience for ADA, WCAG 2.0, 2.1 & 2.2, Section 508, California Unruh Act, Australian DDA, European EAA EN 301 549, UK Equality Act (EA), Israeli Standard 5568, Ontario AODA, Canada ACA, German BITV, France RGAA, Brazilian Inclusion Law (LBI 13.146/2015), Spain UNE 139803:2012, JIS X 8341 (Japan), Italian Stanca Act and Switzerland DDA Standards.

Follows the best industry security, SEO practices and standards ISO 9001:2015 & ISO 27001:2013 and complies with GDPR, COPPA regulations. Member of W3C and International Association of Accessibility Professionals (IAAP). It is a flexible & lightweight widget that can be changed according to law and reduces the risk of time-consuming accessibility lawsuits.

For more details/features, Please visit [All in One Accessibility®](https://www.skynettechnologies.com/all-in-one-accessibility)

Unlock over 70 features with the All in One Accessibility Widget through a paid subscription. See the detailed comparison of Paid vs. Free features [here](https://www.skynettechnologies.com/all-in-one-accessibility/features).

We provide a 10-day free trial. Get started [here](https://ada.skynettechnologies.us/trial-subscription?utm_source=all-in-one-accessibility&utm_medium=landing-page&utm_campaign=trial-subscription).

### Supported Languages (140+ Languages):

English (USA), English (UK), English (Australian), English (Canadian), English (South Africa), Español, Español (Mexicano), Deutsch, عربى, Português, Português (Brazil), 日本語, Français, Italiano, Polski, Pусский, 中文, 中文 (Traditional), עִברִית, Magyar, Slovenčina, Suomenkieli, Türkçe, Ελληνικά, Latinus, Български, Català, Čeština, Dansk, Nederlands, हिंदी, Bahasa Indonesia, 한국인, Lietuvių, Bahasa Melayu, Norsk, Română, Slovenščina, Svenska, แบบไทย, Українська, Việt Nam, বাঙালি, සිංහල, አማርኛ, Hmoob, မြန်မာ, Eesti keel, latviešu, Cрпски, Hrvatski, ქართული, ʻŌlelo Hawaiʻi, Cymraeg, Cebuano, Samoa, Kreyòl ayisyen, Føroyskt, Crnogorski, Azerbaijani, Euskara, Tagalog, Galego, Norsk Bokmål, فارسی, ਪੰਜਾਬੀ, shqiptare, Hայերեն, অসমীয়া, Aymara, Bamanankan, беларускі, bosanski, Corsu, ދިވެހި, Esperanto, Eʋegbe, Frisian, guarani, ગુજરાતી, Hausa, íslenskur, Igbo, Gaeilge, basa jawa, ಕನ್ನಡ, қазақ, ខ្មែរ, Kinyarwanda, Kurdî, Кыргызча, ພາສາລາວ, Lingala, Luganda, lëtzebuergesch, македонски, Malagasy, മലയാളം, Malti, Maori, मराठी, Монгол, नेपाली, Sea, ଓଡିଆ, Afaan Oromoo, پښتو, Runasimi, संस्कृत, Gàidhlig na h-Alba, Sesotho, Shona, سنڌي, Soomaali, basa Sunda, kiswahili, тоҷикӣ, தமிழ், Татар, తెలుగు, ትግሪኛ, Tsonga, Türkmenler, Ride, اردو, ئۇيغۇر, o'zbek, isiXhosa, יידיש, Yoruba, Zulu, भोजपुरी, डोगरी, कोंकणी, Kurdî, Krio, मैथिली, Meiteilon, Mizo tawng, Sepedi, Ilocano'.

## Installation

### Prerequisites

- Sylius version ^1.14.0

### Steps

1. Run `composer require skynettechnologies/sylius-allinoneaccessibility-plugin`

2. Import the plugin configurations

```yml
# config/packages/_sylius.yaml
imports:
    # ...
    - { resource: "@SkynettechnologiesSyliusAllinOneAccessibilityPlugin/Resources/config/config.yaml" }
```

3. Add the shop and admin routes

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

skynettechnologies_sylius_allinoneaccessibility_plugin_admin_allinoneaccessibility_create:
    resource: "@SkynettechnologiesSyliusAllinOneAccessibilityPlugin/Resources/config/routes.yaml"
```

4. Add the package services

```yml
# config/services.yaml
Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Controller\Admin\DefaultAdminController:
    arguments:
        $client: '@Symfony\Contracts\HttpClient\HttpClientInterface'
        $connection: '@doctrine.dbal.default_connection'  # Default DB connection
    tags:
        - { name: controller.service_arguments }
Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Twig\AllinOneAccessibilityExtension:
    tags: [ 'twig.extension' ]

app.listener.admin.menu_builder:
    class: Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Menu\AdminMenuListener
    tags:
        - { name: kernel.event_listener, event: sylius.menu.admin.main, method: addAdminMenuItems }
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

## Usage

Once you have registered the settings in the Control Panel, make sure to add the tag to any of the layouts of your website. The tag to use is:

``` bash
{{ all_in_one_accessibility() | raw }}
```

## Live Demo
https://sylius.skynettechnologies.us/

## Screenshots

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/screenshot-1-free.jpg?v=2)

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/screenshot-2-free.jpg?v=2)

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/screenshot-3-free.jpg?v=2)

![App Screenshot](https://www.skynettechnologies.com/sites/default/files/screenshot-4-free.jpg?v=2)


## Video

[![All in One Accessibility](https://img.youtube.com/vi/I-DjgZyleeI/0.jpg)](https://www.youtube.com/watch?v=I-DjgZyleeI)

## Documentation

- [Purchase Sylius All in One Accessibility](https://www.skynettechnologies.com/sylius-website-accessibility)
- [How to install All in One Accessibility plugin on Sylius](https://www.skynettechnologies.com/blog/sylius-web-accessibility-widget-installation)
- [All in One Accessibility - Features Guide](https://www.skynettechnologies.com/sites/default/files/accessibility-widget-features-list.pdf)


## Submit a Support Request

Please visit our [support page](https://www.skynettechnologies.com/report-accessibility-problem) and fill out the form. Our team will get back to you as soon as possible.

## Send Us an Email

Alternatively, you can send an email to our support team:
[hello@skynettechnologies.com](mailto:hello@skynettechnologies.com)

## Partnership Opportunities

#### [Agency Partnership](https://www.skynettechnologies.com/agency-partners)

Partner with us as an agency to provide comprehensive accessibility solutions to your clients. Get access to exclusive resources, training, and support to help you implement and manage accessibility features effectively.

#### [Affiliate Partnership](https://www.skynettechnologies.com/affiliate-partner)

Join our affiliate program and earn commissions by promoting All in One Accessibility™. Share our Widget with your network and help businesses improve their website accessibility while generating revenue.

For more details, Please visit [Partnership Opportunities Page](https://www.skynettechnologies.com/partner-program)

## Credits

This addon is developed and maintained by [Skynet Technologies USA LLC](https://www.skynettechnologies.com)

## Current Maintainers
- [Skynet Technologies USA LLC](https://github.com/skynettechnologies)
