<?php

declare(strict_types=1);

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Twig;

use http\QueryString;
use Rector\CodeQuality\NodeAnalyzer\VariableDimFetchAssignResolver;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Doctrine\ORM\EntityManagerInterface;

final class AllinOneAccessibilityExtension extends AbstractExtension
{
    private ?string $slider = 'default';  // Default value for slider
    public function __construct()
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('all_in_one_accessibility', [$this, 'renderAccessibilityWidget']),
        ];
    }

    public function renderAccessibilityWidget(): string
    {
        return '<script>
            const scriptTag = document.createElement("script");
            scriptTag.id = "aioa-adawidget";
            scriptTag.src = "https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode=#&token=&position=";
            document.head.appendChild(scriptTag);
        </script>';
    }
    public function getName(): string
    {
        return 'allinoneaccessibility';
    }
}
