<?php

declare(strict_types=1);

namespace Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Page\Admin\AllinOneAccessibility;

use Sylius\Behat\Page\Admin\Crud\UpdatePageInterface as BaseUpdatePageInterface;
use Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Behaviour\ContainsErrorInterface;

interface UpdatePageInterface extends BaseUpdatePageInterface, ContainsErrorInterface
{
    /**
     * @param string $code
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function fillCode(string $code): void;
}
