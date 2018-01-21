<?php
declare(strict_types=1);

namespace Christianfutterlieb\Glibi\Persistence;

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

use Christianfutterlieb\Glibi\Utility\RandomisationUtility;

/**
 * Query
 */
class RandomOrderQuery extends \TYPO3\CMS\Extbase\Persistence\Generic\Query
{
    /**
     * @var array
     * @see \TYPO3\CMS\Extbase\Persistence\Generic\Query::$orderings
     */
    protected $orderings = [];

    /**
     * {@inheritDoc}
     * @see \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult::initialize()
     */
    public function execute($returnRawQueryResult = false)
    {
        if ($returnRawQueryResult) {
            $result = parent::execute($returnRawQueryResult);
            if (!empty($result)) {
                RandomisationUtility::randomizeArray($result);
            }
            return $result;
        }
        return $this->objectManager->get(RandomOrderQueryResult::class, $this);
    }

    /**
     * Override parent method to prevent ordering to be applied in SQL.
     *
     * {@inheritDoc}
     * @see \TYPO3\CMS\Extbase\Persistence\Generic\Query::getOrderings()
     */
    public function getOrderings()
    {
        return [];
    }


    /**
     * Override parent method to prevent ordering to be applied in SQL.
     *
     * {@inheritDoc}
     * @see \TYPO3\CMS\Extbase\Persistence\Generic\Query::setOrderings()
     */
    public function setOrderings(array $orderings)
    {
        return $this;
    }
}
