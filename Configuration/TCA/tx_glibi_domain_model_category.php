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
        'title' => 'Category (LLL)',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'hideAtCopy' => true,
        'prependAtCopy' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.prependAtCopy',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title',
        //'iconfile' => 'EXT:aawskin_imtt/Resources/Public/Icons/Address.svg',
    ],
    'interface' => [
        'showRecordFieldList' => 'title, parent_category, things',
    ],
    'columns' => [
        'hidden' => $GLOBALS['TCA']['tt_content']['columns']['hidden'],
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
        'parent_category' => [
            'exclude' => true,
            'label' => 'Parent category (LLL)',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'tx_glibi_domain_model_category',
                'maxitems' => 1,
                'minitems' => 0,
                'treeConfig' => [
                    'parentField' => 'parent_category',
                    'appearance' => [
                        'expandAll' => 1,
                        'maxLevels' => 99,
                        'showHeader' => 1,
                    ],
                ],
                'default' => 0,

            ],
        ],
        'things' => [
            'exclude' => true,
            'label' => 'Things (LLL)',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_glibi_domain_model_thing',
                'foreign_table' => 'tx_glibi_domain_model_thing',
                'MM' => 'tx_glibi_domain_model_thing_category_mm',
                'MM_opposite_field' => 'categories',
                'minitems' => 0,
                'maxitems' => 999999,
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    title, parent_category,
                --div--;Things (LLL),
                    things,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
            ',
        ],
    ],
    'palettes' => [
        'hidden' => [
            'showitem' => '
                hidden;Visibility of category (LLL)
            ',
        ],
    ],
];
