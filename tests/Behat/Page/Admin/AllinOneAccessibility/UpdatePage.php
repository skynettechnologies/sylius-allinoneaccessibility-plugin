<?php

declare(strict_types=1);

namespace Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Page\Admin\AllinOneAccessibility;

use Sylius\Behat\Page\Admin\Crud\UpdatePage as BaseUpdatePage;
use Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Behaviour\ContainsErrorTrait;

final class UpdatePage extends BaseUpdatePage implements UpdatePageInterface
{
    use ContainsErrorTrait;

    /**
     * @inheritdoc
     */
    public function fillCode(string $code): void
    {
        $this->getDocument()->fillField('Code', $code);
    }
}
