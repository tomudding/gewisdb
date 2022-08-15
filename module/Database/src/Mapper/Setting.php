<?php

namespace Database\Mapper;

use Database\Model\Enums\SettingTypes;
use Database\Model\Setting as SettingModel;
use Doctrine\ORM\{
    EntityManager,
    EntityRepository,
};
use Psr\Cache\CacheItemPoolInterface;

/**
 * Settings mapper
 */
class Setting
{
    public function __construct(
        protected readonly EntityManager $em,
        protected readonly CacheItemPoolInterface $cache,
    ) {
    }

    public function find(SettingTypes $name): ?SettingModel
    {
        $qb = $this->getRepository()->createQueryBuilder('s');
        $qb->where('s.name = :name')
            ->setParameter(':name', $name);

        $query = $qb->getQuery();
        $query->setResultCache($this->cache)
            ->enableResultCache(
                3600,
                'setting' . $name->value,
            );

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Persist a setting.
     */
    public function persist(SettingModel $setting): void
    {
        $this->em->persist($setting);
        $this->em->flush();
        $this->cache->deleteItem('setting.' . $setting->getName()->value);
    }

    /**
     * Find all.
     *
     * @return array<array-key, SettingModel>
     */
    public function findAll(): array
    {
        return $this->getRepository()->findAll();
    }

    /**
     * Get the repository for this mapper.
     */
    public function getRepository(): EntityRepository
    {
        return $this->em->getRepository(SettingModel::class);
    }
}
