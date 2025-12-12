<?php

declare(strict_types=1);

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Menu;

use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        /** @var ItemInterface $item */
        if (null === $menu->getChild('All in One Accessibility')) {
            $menu->addChild('All in One Accessibility');
        }

        $subMenu = $menu->getChild('All in One Accessibility');

        // No asset(), no constructor, no icon path
        $subMenu
            ->addChild('allinoneaccessibility', [
                'route' => 'sylius_all_in_one_accessibility_plugin.index.admin',
            ])
            ->setLabel('All in One Accessibility®')
            ->setAttribute('type', 'link')
            ->setLabelAttribute('icon', 'unhide accessibility');
    }
}
