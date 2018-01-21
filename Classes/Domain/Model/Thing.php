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
 * Thing
 */
class Thing extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @todo Add public visibility modifyer when support for php < 7.1
     *       is dropped.
     */
    const TYPE_TEXT = 0;

    /**
     * @var int
     */
    protected $type = self::TYPE_TEXT;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $bodytext;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Christianfutterlieb\Glibi\Domain\Model\Category>
     */
    protected $categories;

    /**
     * Object initializer
     */
    public function initializeObject()
    {
        $this->categories = new ObjectStorage();
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBodytext(): string
    {
        return $this->bodytext;
    }

    /**
     * @param string $bodytext
     */
    public function setBodytext(string $bodytext)
    {
        $this->bodytext = $bodytext;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Christianfutterlieb\Glibi\Domain\Model\Category>
     */
    public function getCategories(): ObjectStorage
    {
        return $this->categories;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Christianfutterlieb\Glibi\Domain\Model\Category> $categories
     */
    public function setCategories(ObjectStorage $categories)
    {
        $this->categories = $categories;
    }
}
