<?php

declare(strict_types=1);

namespace Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Page\Admin\AllinOneAccessibility;

use Sylius\Behat\Page\Admin\Crud\IndexPageInterface as BaseIndexPageInterface;

interface IndexPageInterface extends BaseIndexPageInterface
{
    /**
     * @param string $code
     */
    public function deleteAllinOneAccessibility(string $code): void;
}
