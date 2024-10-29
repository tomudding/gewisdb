<?php

declare(strict_types=1);

namespace Application\Extensions\Doctrine\Middleware;

use Doctrine\DBAL\Driver as DriverInterface;
use Doctrine\DBAL\Driver\Middleware as MiddlewareInterface;
use RuntimeException;

use function getenv;
use function implode;

class SetRoleMiddleware implements MiddlewareInterface
{
    public function wrap(DriverInterface $driver): DriverInterface
    {
        $isPgSQL = $driver instanceof DriverInterface\PDO\PgSQL\Driver;
        if (
            !$isPgSQL
            && !$driver instanceof DriverInterface\PDO\SQLite\Driver
        ) {
            throw new RuntimeException('Expected DBAL Driver to be PDO PgSQL, but got ' . $driver::class);
        }

        $roleDefault = getenv('DOCTRINE_DEFAULT_ROLE');
        if (false === $roleDefault) {
            throw new RuntimeException('Required `DOCTRINE_DEFAULT_ROLE` not set...');
        }

        $roleReport = getenv('DOCTRINE_REPORT_ROLE');
        if (false === $roleReport) {
            throw new RuntimeException('Required `DOCTRINE_REPORT_ROLE` not set...');
        }

        $roles = [
            implode(':', [
                getenv('DOCTRINE_DEFAULT_HOST'),
                getenv('DOCTRINE_DEFAULT_PORT'),
                getenv('DOCTRINE_DEFAULT_DATABASE'),
            ])
                => $roleDefault,
            implode(':', [
                getenv('DOCTRINE_REPORT_HOST'),
                getenv('DOCTRINE_REPORT_PORT'),
                getenv('DOCTRINE_REPORT_DATABASE'),
            ])
                => $roleReport,
        ];

        return new Driver($driver, $roles, $isPgSQL);
    }
}
