<?php

declare(strict_types=1);

namespace Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Page\Admin\AllinOneAccessibility;

use Sylius\Behat\Page\Admin\Crud\CreatePageInterface as BaseCreatePageInterface;
use Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Behaviour\ContainsErrorInterface;

interface CreatePageInterface extends BaseCreatePageInterface, ContainsErrorInterface
{
    /**
     * @param string $code
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function fillCode(string $code): void;

    /**
     * @param string $url
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function fillUrl(string $url): void;

    /**
     * @param string $file
     * @param string $locator
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function uploadFile(string $file, string $locator): void;
}
