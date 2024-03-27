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

//        $item = $menu->getChild('catalog');
//        if (null == $item) {
//            $item = $menu;
//        }

        $subMenu
            ->addChild('allinoneaccessibility', ['route' => 'skynettechnologies_sylius_allinoneaccessibility_plugin_admin_allinoneaccessibility_create'])
            ->setLabel('All in One Accessibility')
            ->setAttribute('type', 'link')
            ->setLabelAttribute('icon', 'unhide')
            ->setLabelAttribute('color', 'green')
        ;
    }
}
