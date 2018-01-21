<?php
declare(strict_types=1);

namespace Christianfutterlieb\Glibi\Domain\Model\Dto;

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

use Christianfutterlieb\Glibi\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Thing
 */
class SearchForm extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    const CONJUNCTION_OR = 0;
    const CONJUNCTION_AND = 1;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Christianfutterlieb\Glibi\Domain\Model\Category>
     */
    protected $categories;

    /**
     * @var int
     */
    protected $conjunction = self::CONJUNCTION_AND;

    /**
     * @var string
     */
    protected $bookIdentifier = '';

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

    /**
     * @return int
     */
    public function getConjunction(): int
    {
        return $this->conjunction;
    }

    /**
     * @param int $conjunction
     */
    public function setConjunction(int $conjunction)
    {
        $this->conjunction = $conjunction;
    }

    /**
     * @return bool
     */
    public function isConjunctionAnd(): bool
    {
        return $this->conjunction === self::CONJUNCTION_AND;
    }

    /**
     * @return bool
     */
    public function isConjunctionOr(): bool
    {
        return $this->conjunction === self::CONJUNCTION_OR;
    }

    /**
     * @return string
     */
    public function getBookIdentifier(): string
    {
        return $this->bookIdentifier;
    }

    /**
     * @param string $bookIdentifier
     */
    public function setBookIdentifier(string $bookIdentifier)
    {
        $this->bookIdentifier = $bookIdentifier;
    }

    /**
     * @param string $representation
     * @return self
     */
    public static function createFromRepresentationString(string $representation): self
    {
        /** @var ObjectManager $objectManager */
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        /** @var SearchForm $object */
        $object = $objectManager->get(static::class);

        $representation = json_decode($representation, true);
        if (!is_array($representation)) {
            // Return the empty object
            return $object;
        }

        // Conjunction
        $object->setConjunction($representation['conjunction']);

        // Categories
        $categories = new ObjectStorage();
        $categoryRepository = $objectManager->get(CategoryRepository::class);
        foreach ($representation['categories'] as $categoryUid) {
            $category = $categoryRepository->findByIdentifier($categoryUid);
            if ($category) {
                $categories->attach($category);
            }
        }
        $object->setCategories($categories);
        return $object;
    }

    /**
     * @return string
     */
    public function saveToRepresentationString(): string
    {
        return $this->__toString();
    }

    /**
     * {@inheritDoc}
     * @see \TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject::__toString()
     */
    public function __toString(): string
    {
        $representation = [
            'conjunction' => $this->conjunction,
            'categories' => [],
        ];

        foreach ($this->categories as $category) {
            $representation['categories'][] = $category->getUid();
        }
        return json_encode($representation);
    }
}
