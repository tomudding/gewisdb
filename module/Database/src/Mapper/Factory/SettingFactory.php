<?php

namespace Database\Mapper\Factory;

use Database\Mapper\Setting as SettingMapper;
use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Container\ContainerInterface;

class SettingFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param $requestedName
     * @param array|null $options
     *
     * @return SettingMapper
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null,
    ): SettingMapper {
        /** @var EntityManager $em */
        $em = $container->get('database_doctrine_em');
        /** @var CacheItemPoolInterface $cache */
        $cache = $container->get('database_doctrine_cache');

        return new SettingMapper(
            $em,
            $cache,
        );
    }
}
