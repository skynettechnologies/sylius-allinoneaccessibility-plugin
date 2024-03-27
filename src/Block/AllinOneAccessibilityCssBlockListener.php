<?php

declare(strict_types=1);

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Block;

use Sonata\BlockBundle\Event\BlockEvent;
use Sonata\BlockBundle\Model\Block;

final class AllinOneAccessibilityCssBlockListener
{
    public function onBlockEvent(BlockEvent $event): void
    {
        $template = '@SkynettechnologiesSyliusAllinOneAccessibilityPlugin/Shop/AllinOneAccessibility/_allinoneaccessibility_css.html.twig';
        $block = new Block();
        $block->setId(uniqid('', true));
        $block->setSettings(array_replace($event->getSettings(), [
            'template' => $template,
        ]));
        $block->setType('sonata.block.service.template');

        $event->addBlock($block);
    }
}
