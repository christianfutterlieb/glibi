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

use Christianfutterlieb\Glibi\Domain\Model\Dto\SearchForm;
use Christianfutterlieb\Glibi\Domain\Model\Book;
use Christianfutterlieb\Glibi\Utility\RandomisationUtility;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * ThingRepository
 */
class ThingRepository extends AbstractRepository
{
    /**
     * @param SearchForm $searchForm
     * @return QueryResultInterface
     */
    public function findBySearchForm(SearchForm $searchForm, $returnRawQueryResult = false): QueryResultInterface
    {
        $query = $this->createRandomOrderQuery();

        $categoryUids = [];
        foreach ($searchForm->getCategories() as $category) {
            $categoryUids[] = $category->getUid();
        }
        if (empty($categoryUids)) {
            // Run a query that will always return an empty result set
            return $query->matching($query->equals('uid', -1))->execute($returnRawQueryResult);
        }

        if ($searchForm->isConjunctionOr()) {
            /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $qb */
            $qb = $this->getQueryBuilderForTable('tx_glibi_domain_model_thing_category_mm');
            $qb->select('uid_local AS uid')
                ->from('tx_glibi_domain_model_thing_category_mm')
                ->where(
                    $qb->expr()->in('uid_foreign', $qb->createNamedParameter($categoryUids, Connection::PARAM_STR_ARRAY))
                )
            ;
        } else {
            /** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder $qb */
            $qb = $this->getQueryBuilderForTable('tx_glibi_domain_model_thing');
            $qb->select('thing.uid')
                ->from('tx_glibi_domain_model_thing', 'thing')
            ;

            // Add a join for every category
            foreach ($categoryUids as $c => $categoryUid) {
                $qb->join('thing', 'tx_glibi_domain_model_thing_category_mm', 'mm' . $c,
                    'mm' . $c . '.uid_local=thing.uid AND mm' . $c . '.uid_foreign=' . $categoryUid
                );
            }
        }

        // Collect thing uids
        $thingUids = [];
        foreach ($qb->execute()->fetchAll() as $row) {
            $thingUids[] = $row['uid'];
        }
        $thingUids = array_unique($thingUids);

        if (empty($thingUids)) {
            // Run a query that will always return an empty result set
            return $query->matching($query->equals('uid', -1))->execute($returnRawQueryResult);
        }

        $query->matching(
            $query->in('uid', $thingUids)
        );

        return $query->execute($returnRawQueryResult);







        RandomisationUtility::randomizeArray($thingUids);
        $book = [
            'crdate' => $GLOBALS['EXEC_TIME'],
            'identifier' => sha1(random_bytes(32)),
            'things' => count($thingUids),
            'searchconfig' => $searchForm->saveToRepresentationString()
        ];

        $connection = $this->getConnectionForTable('tx_glibi_domain_model_book');
        try {
            $connection->beginTransaction();
            $connection->insert(
                'tx_glibi_domain_model_book',
                $book,
                [
                    \PDO::PARAM_STR,
                    \PDO::PARAM_INT,
                    \PDO::PARAM_STR,
                ]
            );
            $bookUid = $connection->lastInsertId('tx_glibi_domain_model_book');

            // Insert mn relations
            foreach ($thingUids as $thingUid) {
                $sorting = 0;
                $this->getConnectionForTable('tx_glibi_domain_model_thing_book_mm')->insert(
                    'tx_glibi_domain_model_thing_book_mm',
                    [
                        'uid_local' => $thingUid,
                        'uid_foreign' => $bookUid,
                        'sorting' => (++$sorting),
                    ],
                    [
                        \PDO::PARAM_INT,
                        \PDO::PARAM_INT,
                        \PDO::PARAM_INT,
                    ]
                );
            }
            $connection->commit();

        } catch (\Exception $e) {
            $connection->rollBack();
            throw $e;
        }

        return $this->findByBookIdentifier($bookUid);

        return $this->objectManager->get(BookRepository::class)->findByIdentifier($bookUid);

//         return $query->execute();
    }

    /**
     * @param int $bookUid
     * @return QueryResultInterface
     */
    public function findByBookIdentifier(int $bookUid): QueryResultInterface
    {
        $book = $this->objectManager->get(BookRepository::class)->findByIdentifier($bookUid);
        if ($book) {
            return $this->findByBook($book);
        }
        // Otherwise, return empty result set
        $query = $this->createQuery();
        $query->matching($query->equals('uid', -1))->execute();
    }

    /**
     * @param string $bookIdentifier
     * @return QueryResultInterface
     */
    public function findByBookIdentifierString(string $bookIdentifier): QueryResultInterface
    {
        $book = $this->objectManager->get(BookRepository::class)->findByIdentifierString($bookIdentifier);
        if ($book) {
            return $this->findByBook($book);
        }
        // Otherwise, return empty result set
        $query = $this->createQuery();
        $query->matching($query->equals('uid', -1))->execute();
    }

    /**
     * @param Book $book
     * @return QueryResultInterface
     */
    public function findByBook(Book $book): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching(
            $query->contains('books', $book)
        );
        return $query->execute();
    }
}
