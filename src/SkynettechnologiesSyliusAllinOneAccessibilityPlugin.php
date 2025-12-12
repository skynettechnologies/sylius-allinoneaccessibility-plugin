<?php

declare(strict_types=1);

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class SkynettechnologiesSyliusAllinOneAccessibilityPlugin extends Bundle
{
    use SyliusPluginTrait;

   /* public function build(ContainerBuilder $container): void
    {
        parent::build($container);
    }*/
}
