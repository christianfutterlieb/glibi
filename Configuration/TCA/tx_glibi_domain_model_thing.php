<?php
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

return [
    'ctrl' => [
        'title' => 'Thing (LLL)',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'type' => 'type',
        'hideAtCopy' => true,
        'prependAtCopy' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.prependAtCopy',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title, bodytext',
        //'iconfile' => 'EXT:aawskin_imtt/Resources/Public/Icons/Address.svg',
    ],
    'interface' => [
        'showRecordFieldList' => 'type, title, bodytext, categories',
    ],
    'columns' => [
        'hidden' => $GLOBALS['TCA']['tt_content']['columns']['hidden'],
        'type' => [
            'exclude' => true,
            'label' => 'Type (LLL)',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Text (LLL)', \Christianfutterlieb\Glibi\Domain\Model\Thing::TYPE_TEXT],
                ],
                'default' => \Christianfutterlieb\Glibi\Domain\Model\Thing::TYPE_TEXT,
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => 'Title (LLL)',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'bodytext' => [
            'exclude' => true,
            'label' => 'Bodytext (LLL)',
            'config' => [
                'type' => 'text',
                'cols' => '80',
                'rows' => '15',
                'softref' => 'typolink_tag,images,email[subst],url',
                'eval' => 'trim',
            ],
        ],
        'categories' => [
            'exclude' => true,
            'label' => 'Categories (LLL)',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_glibi_domain_model_category',
                'MM' => 'tx_glibi_domain_model_thing_category_mm',
                'MM_oppositeUsage' => [
                    'tx_glibi_domain_model_category' => ['things'],
                ],
                'minitems' => 0,
                'maxitems' => 999999,
                'treeConfig' => [
                    'parentField' => 'parent_category',
                    'appearance' => [
                        'nonSelectableLevels' => '0,1',
                        'expandAll' => 1,
                        'maxLevels' => 99,
                        'showHeader' => 1,
                    ],
                ],
                'default' => 0,
            ],
        ],
        'books' => [
            'exclude' => true,
            'label' => 'Books (LLL)',
            'config' => [
                'readOnly' => true,
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_glibi_domain_model_book',
                'MM' => 'tx_glibi_domain_model_thing_book_mm',
                'MM_oppositeUsage' => [
                    'tx_glibi_domain_model_category' => ['things'],
                ],
                'minitems' => 0,
                'maxitems' => 999999,
                'default' => 0,
            ],
        ],
    ],
    'types' => [
        \Christianfutterlieb\Glibi\Domain\Model\Thing::TYPE_TEXT => [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    type, title, bodytext,
                --div--;Categories (LLL),
                    categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
            ',
            'columnsOverrides' => [
                'bodytext' => [
                    'config' => [
                        'enableRichtext' => true,
                        'richtextConfiguration' => 'default',
                    ],
                ],
            ],
        ],
    ],
    'palettes' => [
        'hidden' => [
            'showitem' => '
                hidden;Visibility of thing (LLL)
            ',
        ],
    ],
];
