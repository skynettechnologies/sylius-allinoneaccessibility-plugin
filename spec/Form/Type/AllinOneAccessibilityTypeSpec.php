<?php

declare(strict_types=1);

namespace spec\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Form\Type;

use Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Entity\AllinOneAccessibility;
use Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Form\Type\AllinOneAccessibilityType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Sylius\Bundle\TaxonomyBundle\Form\Type\TaxonAutocompleteChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;

final class AllinOneAccessibilityTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(AllinOneAccessibility::class, ['skynettechnologies']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AllinOneAccessibilityType::class);
    }

    function it_should_be_abstract_resource_type_object()
    {
        $this->shouldHaveType(AbstractResourceType::class);
    }

    function it_build_form_with_proper_fields(
        FormBuilderInterface $builder,
        FormFactoryInterface $factory
    ) {
        $builder->getFormFactory()->willReturn($factory);

        $builder->add('enabled', CheckboxType::class, Argument::any())->shouldBeCalled()->willReturn($builder);
        $builder->add('translations', ResourceTranslationsType::class, Argument::any())->shouldBeCalled()->willReturn($builder);
        $builder->add('taxons', TaxonAutocompleteChoiceType::class, Argument::any())->shouldBeCalled()->willReturn($builder);
        $builder->add('channels', ChannelChoiceType::class, Argument::any())->shouldBeCalled()->willReturn($builder);

        $builder
            ->addEventSubscriber(Argument::type(AddCodeFormSubscriber::class))
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $this->buildForm($builder, []);
    }
}
