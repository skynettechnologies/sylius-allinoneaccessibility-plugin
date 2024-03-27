<?php

declare(strict_types=1);

namespace Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Page\Admin\AllinOneAccessibility;

use Sylius\Behat\Page\Admin\Crud\IndexPage as BaseIndexPage;

final class IndexPage extends BaseIndexPage implements IndexPageInterface
{
    /**
     * @inheritdoc
     */
    public function deleteAllinOneAccessibility(string $code): void
    {
        $this->deleteResourceOnPage(['code' => $code]);
    }
}
