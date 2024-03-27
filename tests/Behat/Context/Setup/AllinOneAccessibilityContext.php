<?php

declare(strict_types=1);

namespace Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;
use Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Entity\AllinOneAccessibilityInterface;
use Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Repository\AllinOneAccessibilityRepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class AllinOneAccessibilityContext implements Context
{
    /** @var FactoryInterface */
    private $allinoneaccessibilityFactory;

    /** @var AllinOneAccessibilityRepositoryInterface */
    private $allinoneaccessibilityRepository;

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        FactoryInterface $allinoneaccessibilityFactory,
        AllinOneAccessibilityRepositoryInterface $allinoneaccessibilityRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->allinoneaccessibilityFactory = $allinoneaccessibilityFactory;
        $this->allinoneaccessibilityRepository = $allinoneaccessibilityRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $code
     * @Given there is an existing allinoneaccessibility with :code code
     */
    public function thereIsAAllinOneAccessibilityWithCode(string $code): void
    {
        $allinoneaccessibility = $this->createAllinOneAccessibility($code);

        $this->saveAllinOneAccessibility($allinoneaccessibility);
    }

    /**
     * @param int $quantity
     * @Given the store has( also) :quantity allinoneaccessibilitys
     */
    public function theStoreHasAllinOneAccessibilitys(int $quantity): void
    {
        for ($i = 1;$i <= $quantity;$i++) {
            $this->saveAllinOneAccessibility($this->createAllinOneAccessibility('Test'.$i));
        }
    }

    /**
     * @param string $code
     * @return AllinOneAccessibilityInterface
     */
    private function createAllinOneAccessibility(string $code): AllinOneAccessibilityInterface
    {
        /** @var AllinOneAccessibilityInterface $allinoneaccessibility */
        $allinoneaccessibility = $this->allinoneaccessibilityFactory->createNew();

        $allinoneaccessibility->setCode($code);
        $allinoneaccessibility->setCurrentLocale('en_US');

        $path = __DIR__.'/../../Resources/images/';
        $filename = 'logo_skynettechnologies.png';
        $allinoneaccessibility->setImageFile(new UploadedFile($path.$filename, $filename));
        $allinoneaccessibility->setMobileImageFile(new UploadedFile($path.$filename, $filename));
        $allinoneaccessibility->setUrl('https://skynettechnologies.com.ar');

        return $allinoneaccessibility;
    }

    /**
     * @param AllinOneAccessibilityInterface $allinoneaccessibility
     */
    private function saveAllinOneAccessibility(AllinOneAccessibilityInterface $allinoneaccessibility): void
    {
        $this->allinoneaccessibilityRepository->add($allinoneaccessibility);
    }
}
