<?php
declare(strict_types=1);

namespace Christianfutterlieb\Glibi\Domain\Repository;

/*
 * Copyright 2018 Corinne & Christian Futterlieb
 *
 * This file is part of the "Glibi" Extension for TYPO3 CMS.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Christianfutterlieb\Glibi\Persistence\RandomOrderQuery;
use TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface;

/**
 * AbstractRepository
 */
abstract class AbstractRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * Object initializer
     */
    public function initializeObject()
    {
        /** @var QuerySettingsInterface $querySettings */
        $querySettings = $this->objectManager->get(QuerySettingsInterface::class);
        $querySettings->setRespectStoragePage(false);
        $this->defaultQuerySettings = $querySettings;
    }

    /**
     * @return RandomOrderQuery
     */
    public function createRandomOrderQuery(): RandomOrderQuery
    {
        $q = $this->createQuery();
        /** @var RandomOrderQuery $query */
        $query = $this->objectManager->get(RandomOrderQuery::class, $this->objectType);
        $query->setQuerySettings($q->getQuerySettings());
        return $query;
    }

    /**
     * @param string $table
     * @return \TYPO3\CMS\Core\Database\Query\QueryBuilder
     */
    protected function getQueryBuilderForTable(string $tableName): \TYPO3\CMS\Core\Database\Query\QueryBuilder
    {
        return $this->objectManager->get(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getQueryBuilderForTable($tableName);
    }

    /**
     * @param string $table
     * @return \TYPO3\CMS\Core\Database\Connection
     */
    protected function getConnectionForTable(string $tableName): \TYPO3\CMS\Core\Database\Connection
    {
        return $this->objectManager->get(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getConnectionForTable($tableName);
    }
}
