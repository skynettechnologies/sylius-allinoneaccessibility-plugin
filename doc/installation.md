## Installation

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

