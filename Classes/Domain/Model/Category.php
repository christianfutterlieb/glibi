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
 * Category
 */
class Category extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var \Christianfutterlieb\Glibi\Domain\Model\Category
     * @lazy
     */
    protected $parentCategory;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Christianfutterlieb\Glibi\Domain\Model\Category>
     */
    protected $childCategories;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Christianfutterlieb\Glibi\Domain\Model\Thing>
     */
    protected $things;

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
     * @return \Christianfutterlieb\Glibi\Domain\Model\Category|null
     * @todo Add nullable return type definition (?Category) when
     *       support for php < 7.1 is dropped
     */
    public function getParentCategory()
    {
        return $this->parentCategory;
    }

    /**
     * @param \Christianfutterlieb\Glibi\Domain\Model\Category $parentCategory
     */
    public function setParentCategory(Category $parentCategory)
    {
        $this->parentCategory = $parentCategory;
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
}
