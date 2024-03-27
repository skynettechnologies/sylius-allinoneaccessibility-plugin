<?php

declare(strict_types=1);

namespace spec\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Form\Type;

use Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Entity\AllinOneAccessibilityTranslation;
use Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Form\Type\AllinOneAccessibilityTranslationType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;

final class AllinOneAccessibilityTranslationTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(AllinOneAccessibilityTranslation::class, ['skynettechnologies']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AllinOneAccessibilityTranslationType::class);
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

        $builder->add('imageFile', FileType::class, Argument::any())->shouldBeCalled()->willReturn($builder);
        $builder->add('mobileImageFile', FileType::class, Argument::any())->shouldBeCalled()->willReturn($builder);
        $builder->add('url', TextType::class, Argument::any())->shouldBeCalled()->willReturn($builder);
        $builder->add('mainText', TextType::class, Argument::any())->shouldBeCalled()->willReturn($builder);
        $builder->add('secondaryText', TextType::class, Argument::any())->shouldBeCalled()->willReturn($builder);
        $builder->add('buttonText', TextType::class, Argument::any())->shouldBeCalled()->willReturn($builder);

        $this->buildForm($builder, []);
    }
}
