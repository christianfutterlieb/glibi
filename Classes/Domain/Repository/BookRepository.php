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

use Christianfutterlieb\Glibi\Domain\Model\Book;
use Christianfutterlieb\Glibi\Domain\Model\Dto\SearchForm;

/**
 * BookRepository
 */
class BookRepository extends AbstractRepository
{
    /**
     * @param string $identifierString
     * @return Book|null
     */
    public function findByIdentifierString(string $identifierString)
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->equals('identifier', $identifierString)
        )->execute()->getFirst();
    }

    /**
     * @param SearchForm $searchForm
     * @return Book|null
     */
    public function findBySearchForm(SearchForm $searchForm)
    {
        if ($identifierString = $searchForm->getBookIdentifier()) {
            return $this->findByIdentifierString($identifierString);
        }

        // Create a new book
        /** @var Book $book */
        $book = $this->objectManager->get(Book::class);
        $book->setIdentifier(sha1(random_bytes(32)));
        $book->setSearchconfig($searchForm->saveToRepresentationString());

        /** @var QueryResultInterface $things */
        $things = $this->objectManager->get(ThingRepository::class)->findBySearchForm($searchForm);

        if ($things->count() <= 0) {
            // No things in this search, return the empty transient book
            $book->setIdentifier('');
            return $book;
        }

        // Attach the things (in correct order)
        foreach ($things as $thing) {
            $book->addThing($thing);
        }

        // Persist the book and its relations
        $this->add($book);
        $this->persistenceManager->persistAll();

        return $book;
    }
}
