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
    private ?string $slider;

    public function __construct(
        ?string $slider
    ) {
        $this->slider = $slider;
    }

    public function getFunctions() :array
    {
        return [
            new TwigFunction('allinoneaccessibility_slider_name', [$this, 'getAllinOneAccessibilitySliderName'])
        ];
    }

    public function getAllinOneAccessibilitySliderName(): string
    {
        return $this->slider !== null ? $this->slider : 'default';
    }

    public function getName(): string
    {
        return 'allinoneaccessibility';
    }
}
