<?php

declare(strict_types=1);

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

interface AllinOneAccessibilityRepositoryInterface extends RepositoryInterface
{
    public function findByEnabledQueryBuilder(?ChannelInterface $channel, ?TaxonInterface $taxon): QueryBuilder;

    public function findByChannel(ChannelInterface $channel): array;

    public function findByTaxon(TaxonInterface $taxon): array;

    public function findByChannelAndTaxon(ChannelInterface $channel, TaxonInterface $taxon): array;
}
