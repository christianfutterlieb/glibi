<?php
declare(strict_types=1);

namespace Christianfutterlieb\Glibi\Persistence;

use Christianfutterlieb\Glibi\Utility\RandomisationUtility;

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

/**
 * RandomOrderQueryResult
 */
class RandomOrderQueryResult extends \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
{
    /**
     * @var bool
     */
    protected $randomized = false;

    /**
     * {@inheritDoc}
     * @see \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult::initialize()
     */
    protected function initialize()
    {
        parent::initialize();
        if (!$this->randomized) {
            if (!empty($this->queryResult)) {
                RandomisationUtility::randomizeArray($this->queryResult);
            }
            $this->randomized = true;
        }
    }
}
