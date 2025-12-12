<?php

declare(strict_types=1);

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Fixture;

use Sylius\Bundle\CoreBundle\Fixture\AbstractResourceFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Doctrine\Persistence\ObjectManager;

class AllinOneAccessibilityFixture extends AbstractResourceFixture
{
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $node = $resourceNode->children();

        $node->scalarNode('code')->cannotBeEmpty();
        $node->arrayNode('channels')->scalarPrototype();
        $node->arrayNode('taxons')->scalarPrototype();
        $node->scalarNode('url');
        $node->scalarNode('main_text');
        $node->scalarNode('secondary_text');
        $node->scalarNode('button_text');
        $node->scalarNode('image');
        $node->scalarNode('mobile_image');
    }

    public function getName(): string
    {
        return 'allinoneaccessibility';
    }

    protected function loadResource(ObjectManager $manager): void
    {
        $entity = new \Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Entity\AllInOneAccessibility();
        $entity->setCode('example');
        $entity->setMainText('Main text example');
        $entity->setButtonText('Click me');

        $manager->persist($entity);
        $manager->flush();
    }
}
