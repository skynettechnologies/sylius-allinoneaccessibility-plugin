<?php

declare(strict_types=1);

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface;
use Symfony\Component\HttpFoundation\File\File;

class AllinOneAccessibility implements AllinOneAccessibilityInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
        getTranslation as private doGetTranslation;
    }
    use TimestampableTrait;
    use ToggleableTrait;

    protected ?int $id = null;
    protected ?string $code = null;

    /**
     * @psalm-var Collection<array-key, ChannelInterface>
     */
    protected Collection $channels;

    /**
     * @psalm-var Collection<array-key, TaxonInterface>
     */
    protected Collection $taxons;

    public function __construct()
    {
        $this->initializeTranslationsCollection();

        $this->channels = new ArrayCollection();
        $this->taxons = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function setImageFile(?File $file): void
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        $allinoneaccessibilityTranslation->setImageFile($file);
    }

    public function getImageFile(): ?File
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        return $allinoneaccessibilityTranslation->getImageFile();
    }

    public function setImageName(?string $imageName): void
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        $allinoneaccessibilityTranslation->setImageName($imageName);
    }

    public function getImageName(): ?string
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        return $allinoneaccessibilityTranslation->getImageName();
    }

    public function setMobileImageFile(?File $file): void
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        $allinoneaccessibilityTranslation->setMobileImageFile($file);
    }

    public function getMobileImageFile(): ?File
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        return $allinoneaccessibilityTranslation->getMobileImageFile();
    }

    public function setMobileImageName(?string $mobileImageName): void
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        $allinoneaccessibilityTranslation->setMobileImageName($mobileImageName);
    }

    public function getMobileImageName(): ?string
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        return $allinoneaccessibilityTranslation->getMobileImageName();
    }

    public function setUrl(?string $url): void
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        $allinoneaccessibilityTranslation->setUrl($url);
    }

    public function getUrl(): ?string
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        return $allinoneaccessibilityTranslation->getUrl();
    }

    public function setMainText(?string $mainText): void
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        $allinoneaccessibilityTranslation->setMainText($mainText);
    }

    public function getMainText(): ?string
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        return $allinoneaccessibilityTranslation->getMainText();
    }

    public function setSecondaryText(?string $secondaryText): void
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        $allinoneaccessibilityTranslation->setSecondaryText($secondaryText);
    }

    public function getSecondaryText(): ?string
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        return $allinoneaccessibilityTranslation->getSecondaryText();
    }

    public function setButtonText(?string $buttonText): void
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        $allinoneaccessibilityTranslation->setButtonText($buttonText);
    }

    public function getButtonText(): ?string
    {
        /** @var AllinOneAccessibilityTranslationInterface $allinoneaccessibilityTranslation */
        $allinoneaccessibilityTranslation = $this->getTranslation();

        return $allinoneaccessibilityTranslation->getButtonText();
    }

    public function getChannels(): Collection
    {
        return $this->channels;
    }

    public function hasChannel(ChannelInterface $channel): bool
    {
        return $this->channels->contains($channel);
    }

    public function addChannel(ChannelInterface $channel): void
    {
        if (!$this->hasChannel($channel)) {
            $this->channels->add($channel);
        }
    }

    public function removeChannel(ChannelInterface $channel): void
    {
        if ($this->hasChannel($channel)) {
            $this->channels->removeElement($channel);
        }
    }

    public function getTaxons(): Collection
    {
        return $this->taxons;
    }

    public function hasTaxon(TaxonInterface $taxon): bool
    {
        return $this->taxons->contains($taxon);
    }

    public function addTaxon(TaxonInterface $taxon): void
    {
        if (!$this->taxons->contains($taxon)) {
            $this->taxons->add($taxon);
        }
    }

    public function removeTaxon(TaxonInterface $taxon): void
    {
        if ($this->taxons->contains($taxon)) {
            $this->taxons->removeElement($taxon);
        }
    }

    public function getTranslation(?string $locale = null): TranslationInterface
    {
        /** @var AllinOneAccessibilityTranslation $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    protected function createTranslation(): TranslationInterface
    {
        return new AllinOneAccessibilityTranslation();
    }
}
