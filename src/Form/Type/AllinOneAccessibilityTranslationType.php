<?php

declare(strict_types=1);

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Form\Type;

use Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Entity\AllinOneAccessibilityTranslationInterface;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;

final class AllinOneAccessibilityTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('imageFile', FileType::class, [
                'label' => 'skynettechnologies_sylius_allinoneaccessibility_plugin.form.allinoneaccessibility.image',
            ])
            ->add('mobileImageFile', FileType::class, [
                'label' => 'skynettechnologies_sylius_allinoneaccessibility_plugin.form.allinoneaccessibility.mobile_image',
                'required' => false
            ])
            ->add('url', TextType::class, [
                'label' => 'skynettechnologies_sylius_allinoneaccessibility_plugin.form.allinoneaccessibility.url',
                'required' => false
            ])
            ->add('mainText', TextType::class, [
                'label' => 'skynettechnologies_sylius_allinoneaccessibility_plugin.form.allinoneaccessibility.main_text',
                'required' => false
            ])
            ->add('secondaryText', TextType::class, [
                'label' => 'skynettechnologies_sylius_allinoneaccessibility_plugin.form.allinoneaccessibility.secondary_text',
                'required' => false
            ])
            ->add('buttonText', TextType::class, [
                'label' => 'skynettechnologies_sylius_allinoneaccessibility_plugin.form.allinoneaccessibility.button_text',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'validation_groups' => function (FormInterface $form): array {
                $allinoneaccessibilityTranslation = $form->getData();
                if (!$allinoneaccessibilityTranslation instanceof AllinOneAccessibilityTranslationInterface || null === $allinoneaccessibilityTranslation->getId()) {
                    return array_merge($this->validationGroups, ['skynettechnologies_image_create']);
                }
                return $this->validationGroups;
            },
            'constraints' => array(
                new Valid()
            )
        ]);
    }
}
