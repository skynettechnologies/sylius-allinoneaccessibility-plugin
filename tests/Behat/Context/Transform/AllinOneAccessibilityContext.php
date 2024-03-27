<?php

declare(strict_types=1);

namespace Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Context\Transform;

use Behat\Behat\Context\Context;
use Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Entity\AllinOneAccessibilityInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webmozart\Assert\Assert;

final class AllinOneAccessibilityContext implements Context
{
    /** @var RepositoryInterface */
    private $allinoneaccessibilityRepository;

    public function __construct(
        RepositoryInterface $allinoneaccessibilityRepository
    ) {
        $this->allinoneaccessibilityRepository = $allinoneaccessibilityRepository;
    }

    /**
     * @Transform /^allinoneaccessibility "([^"]+)"$/
     * @Transform /^"([^"]+)" allinoneaccessibility$/
     * @param string $allinoneaccessibilityCode
     * @return AllinOneAccessibilityInterface
     */
    public function getAllinOneAccessibilityByCode(string $allinoneaccessibilityCode): AllinOneAccessibilityInterface
    {
        /** @var AllinOneAccessibilityInterface $allinoneaccessibility */
        $allinoneaccessibility = $this->allinoneaccessibilityRepository->findOneBy(['code' => $allinoneaccessibilityCode]);

        Assert::notNull(
            $allinoneaccessibility,
            'AllinOneAccessibility with code %s does not exist'
        );

        return $allinoneaccessibility;
    }
}
