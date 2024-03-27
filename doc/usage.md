## Usage

For the administration you will have the AllinOneAccessibility menu.
Feel free to modify the plugin templates like you want.

You can choose your js library by configuration:

```yml
# config/packages/skynettechnologies_sylius_allinoneaccessibility.yaml
skynettechnologies_sylius_allinoneaccessibility:
    slider: #swiper, glide, sliderpro. If you don't want any use ~
```

### Partial routes

To render allinoneaccessibility images you can do something like this:

```twig
{{ render(url('skynettechnologies_sylius_allinoneaccessibility_plugin_shop_partial_allinoneaccessibility', {'template': '@SkynettechnologiesSyliusAllinOneAccessibilityPlugin/Shop/allinoneaccessibility/_allinoneaccessibility.html.twig'})) }}
``` 
   
And to render allinoneaccessibility images by taxon:

```twig
{{ render(url('skynettechnologies_sylius_allinoneaccessibility_plugin_shop_partial_allinoneaccessibility_by_taxon', {'taxon': taxon.slug, 'template': '@SkynettechnologiesSyliusAllinOneAccessibilityPlugin/Shop/allinoneaccessibility/_allinoneaccessibility.html.twig'})) }}
```

### Form validation group

For forms use the validation group named `skynettechnologies`
