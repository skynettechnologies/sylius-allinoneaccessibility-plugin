<?php

declare(strict_types=1);

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Fixture\Factory;

use Faker\Factory;
use Faker\Generator as FakerGenerator;
use Generator;
use Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Entity\AllinOneAccessibilityInterface;
use Sylius\Bundle\CoreBundle\Fixture\Factory\AbstractExampleFactory;
use Sylius\Bundle\CoreBundle\Fixture\OptionsResolver\LazyOption;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface;
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AllinOneAccessibilityExampleFactory extends AbstractExampleFactory
{
    private FactoryInterface $allinoneaccessibilityFactory;
    private ChannelRepositoryInterface $channelRepository;
    private TaxonRepositoryInterface $taxonRepository;
    private RepositoryInterface $localeRepository;
    private FakerGenerator $faker;
    private ?FileLocatorInterface $fileLocator;
    private OptionsResolver $optionsResolver;

    public function __construct(
        FactoryInterface $allinoneaccessibilityFactory,
        ChannelRepositoryInterface $channelRepository,
        TaxonRepositoryInterface $taxonRepository,
        RepositoryInterface $localeRepository,
        ?FileLocatorInterface $fileLocator = null
    ) {
        $this->allinoneaccessibilityFactory = $allinoneaccessibilityFactory;
        $this->channelRepository = $channelRepository;
        $this->taxonRepository = $taxonRepository;
        $this->localeRepository = $localeRepository;
        $this->fileLocator = $fileLocator;

        $this->faker = Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired('code')
            ->setDefault('code', function (Options $_options): string {
                return $this->faker->slug();
            })
            ->setAllowedTypes('code', ['string'])

            ->setDefault('main_text', function (Options $_options): string {
                return $this->faker->sentence(4);
            })
            ->setAllowedTypes('main_text', ['string', 'null'])

            ->setDefault('secondary_text', function (Options $_options): string {
                return $this->faker->sentence(9);
            })
            ->setAllowedTypes('secondary_text', ['string', 'null'])

            ->setDefault('button_text', 'Buy Now')
            ->setAllowedTypes('button_text', ['string', 'null'])

            ->setDefault('url', function (Options $_options): string {
                return $this->faker->url();
            })
            ->setAllowedTypes('url', ['string', 'null'])

            ->setDefault('image', function (Options $_options): string {
                return __DIR__ . '/../../Resources/fixtures/allinoneaccessibility/images/0' . rand(1, 4) . '.png';
            })
            ->setAllowedTypes('image', ['string'])

            ->setDefault('mobile_image', function (Options $_options): string {
                return __DIR__ . '/../../Resources/fixtures/allinoneaccessibility/mobile-images/0' . rand(1, 4) . '.png';
            })
            ->setAllowedTypes('mobile_image', ['string', 'null'])

            ->setDefault('channels', LazyOption::randomOnes($this->channelRepository, 3))
            ->setAllowedTypes('channels', 'array')
            ->setNormalizer('channels', LazyOption::findBy($this->channelRepository, 'code'))

            ->setDefault('taxons', [])
            ->setAllowedTypes('taxons', 'array')
            ->setNormalizer('taxons', LazyOption::findBy($this->taxonRepository, 'code'))
        ;
    }

    public function create(array $options = []): AllinOneAccessibilityInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var AllinOneAccessibilityInterface $allinoneaccessibility */
        $allinoneaccessibility = $this->allinoneaccessibilityFactory->createNew();
        $allinoneaccessibility->setCode($options['code']);

        foreach ($options['channels'] as $channel) {
            $allinoneaccessibility->addChannel($channel);
        }

        foreach ($options['taxons'] as $taxon) {
            $allinoneaccessibility->addTaxon($taxon);
        }

        /** @var string $localeCode */
        foreach ($this->getLocales() as $localeCode) {
            $allinoneaccessibility->setCurrentLocale($localeCode);
            $allinoneaccessibility->setFallbackLocale($localeCode);

            $allinoneaccessibility->setImageFile($this->createImage($options['image']));

            if ($options['main_text']) {
                $allinoneaccessibility->setMainText($options['main_text']);
            }
            if ($options['url']) {
                $allinoneaccessibility->setUrl($options['url']);
            }
            if ($options['secondary_text']) {
                $allinoneaccessibility->setSecondaryText($options['secondary_text']);
            }
            if ($options['button_text']) {
                $allinoneaccessibility->setButtonText($options['button_text']);
            }
            if ($options['mobile_image']) {
                $allinoneaccessibility->setMobileImageFile($this->createImage($options['mobile_image']));
            }
        }

        return $allinoneaccessibility;
    }

    protected function createImage(string $imagePath): UploadedFile
    {
        /** @var string $imagePath */
        $imagePath = null === $this->fileLocator ? $imagePath : $this->fileLocator->locate($imagePath);

        return new UploadedFile($imagePath, basename($imagePath));
    }

    protected function getLocales(): Generator
    {
        /** @var LocaleInterface[] $locales */
        $locales = $this->localeRepository->findAll();
        foreach ($locales as $locale) {
            yield $locale->getCode();
        }
    }
}
