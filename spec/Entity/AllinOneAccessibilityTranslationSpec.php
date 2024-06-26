<?php

declare(strict_types=1);

namespace spec\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Entity;

use Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Entity\AllinOneAccessibilityTranslation;
use Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Entity\AllinOneAccessibilityTranslationInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Model\AbstractTranslation;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

final class AllinOneAccessibilityTranslationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AllinOneAccessibilityTranslation::class);
    }

    function it_extends_abstract_translation()
    {
        $this->shouldImplement(AbstractTranslation::class);
    }

    function it_implements_allinoneaccessibility_translation_interface()
    {
        $this->shouldImplement(AllinOneAccessibilityTranslationInterface::class);
    }

    function it_implements_resource_interface()
    {
        $this->shouldImplement(ResourceInterface::class);
    }

    function it_implements_translation_interface()
    {
        $this->shouldImplement(TranslationInterface::class);
    }

    function it_implements_timestamplable_interface()
    {
        $this->shouldImplement(TimestampableInterface::class);
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_url_by_default()
    {
        $this->getUrl()->shouldReturn(null);
    }

    function it_is_timestampable()
    {
        $dateTime = new \DateTime();
        $this->setCreatedAt($dateTime);
        $this->getCreatedAt()->shouldReturn($dateTime);
        $this->setUpdatedAt($dateTime);
        $this->getUpdatedAt()->shouldReturn($dateTime);
    }

    function it_allows_access_via_properties()
    {
        $this->setUrl('allinoneaccessibility_url');
        $this->getUrl()->shouldReturn('allinoneaccessibility_url');
    }
}
