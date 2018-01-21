<?php
declare(strict_types=1);

namespace Christianfutterlieb\Glibi\ViewHelpers;

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

/**
 * ChildCategoriesViewHelper
 */
class ChildCategoriesViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * @var \Christianfutterlieb\Glibi\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository;

    /**
     * {@inheritDoc}
     * @see \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper::initializeArguments()
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('category', Category::class, 'The category', true);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function render(): \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        return $this->categoryRepository->findByParentCategory($this->arguments['category']);
    }
}
