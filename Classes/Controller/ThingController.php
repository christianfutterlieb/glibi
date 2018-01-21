<?php
declare(strict_types=1);

namespace Christianfutterlieb\Glibi\Controller;

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
use TYPO3\CMS\Core\Messaging\AbstractMessage;

/**
 * ThingController
 */
class ThingController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \Christianfutterlieb\Glibi\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository;

    /**
     * @var \Christianfutterlieb\Glibi\Domain\Repository\BookRepository
     * @inject
     */
    protected $bookRepository;

    /**
     * @param SearchForm $searchForm
     */
    public function searchAction(SearchForm $searchForm = null)
    {
        if ($searchForm !== null) {
            $book = $this->bookRepository->findBySearchForm($searchForm);
            if ($book !== null && !$book->_isNew()) {
                return $this->redirect('showBook', null, null, ['book' => $book]);
            }
            $this->addFlashMessage('Sorry, there was no match for your search! Please specify other search options.', '', AbstractMessage::WARNING);
        }
        $this->view->assignMultiple([
            'categories' => $this->categoryRepository->findAllParentCategories(),
            'searchForm' => $searchForm
        ]);
    }

    /**
     * @param Book $book
     */
    public function showBookAction(Book $book)
    {
        $this->view->assignMultiple([
            'book' => $book,
        ]);
    }
}
