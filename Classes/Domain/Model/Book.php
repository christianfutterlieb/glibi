<?php
declare(strict_types=1);

namespace Christianfutterlieb\Glibi\Domain\Model;

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

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Book
 */
class Book extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var string
     */
    protected $identifier = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Christianfutterlieb\Glibi\Domain\Model\Thing>
     */
    protected $things;

    /**
     * @var string
     */
    protected $searchconfig = '';

    /**
     * Object initializer
     */
    public function initializeObject()
    {
        $this->things = new ObjectStorage();
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Christianfutterlieb\Glibi\Domain\Model\Thing>
     */
    public function getThings(): ObjectStorage
    {
        return $this->things;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Christianfutterlieb\Glibi\Domain\Model\Thing> $things
     */
    public function setThings(ObjectStorage $things)
    {
        $this->things = $things;
    }

    /**
     * @param \Christianfutterlieb\Glibi\Domain\Model\Thing $thing
     */
    public function addThing(Thing $thing)
    {
        $this->things->attach($thing);
    }

    /**
     * @return string
     */
    public function getSearchconfig(): string
    {
        return $this->searchconfig;
    }

    /**
     * @param string $searchconfig
     */
    public function setSearchconfig(string $searchconfig)
    {
        $this->searchconfig = $searchconfig;
    }
}
