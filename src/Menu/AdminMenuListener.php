<?php

declare(strict_types=1);

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Menu;

use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Asset\Packages;

final class AdminMenuListener implements EventSubscriberInterface
{
    private Packages $assets;
    public function __construct(Packages $assets)
    {
        $this->assets = $assets;
    }

    // This method must return an array of events and the associated handler methods
    public static function getSubscribedEvents(): array
    {
        return [
            MenuBuilderEvent::class => 'addAdminMenuItems',
        ];
    }

    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        /** @var ItemInterface $item */
        if (null === $menu->getChild('All in One Accessibility')) {
            $menu->addChild('All in One Accessibility');
        }
        $subMenu = $menu->getChild('All in One Accessibility');
        // Use the asset() function to get the correct path
        $iconPath = $this->assets->getUrl('bundles/skynettechnologiessyliusallinoneaccessibilityplugin/images/icons/accessibility.svg');
        $subMenu
            ->addChild('allinoneaccessibility', [
                'route' => 'sylius_all_in_one_accessibility_plugin.index.admin',
                'extras' => [
                    'icon_path' => $iconPath,
                ],
            ])
            ->setLabel('All in One Accessibility®')
            ->setAttribute('type', 'link')
            ->setLabelAttribute('icon', 'unhide accessibility');
    }
}
