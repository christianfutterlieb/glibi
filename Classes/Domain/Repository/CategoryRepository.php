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

use Christianfutterlieb\Glibi\Domain\Model\Category;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * CategoryRepository
 */
class CategoryRepository extends AbstractRepository
{
    /**
     * @return QueryResultInterface
     */
    public function findAllParentCategories(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('parent_category', 0)
        );
        return $query->execute();
    }

    /**
     * @param Category $parentCategory
     * @return QueryResultInterface
     */
    public function findByParentCategory(Category $parentCategory): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('parent_category', $parentCategory->getUid())
        );
        return $query->execute();
    }
}
