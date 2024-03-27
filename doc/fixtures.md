## Fixtures

This plugin comes with fixtures:

### AllinOneAccessibilitys

Simply add this configuration on your fixture suite:

```yml
# config/packages/_sylius.yaml
sylius_fixtures:
    suites:
        default:
            fixtures:
                allinoneaccessibility:
                    options:
                        random: 3
```
