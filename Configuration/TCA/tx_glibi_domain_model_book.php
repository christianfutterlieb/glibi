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
        'title' => 'Book (LLL)',
        'hideTable' => true,
        'label' => 'identifier',
        'crdate' => 'crdate',
        'searchFields' => 'identifier',
        //'iconfile' => 'EXT:aawskin_imtt/Resources/Public/Icons/Address.svg',
    ],
    'interface' => [
        'showRecordFieldList' => 'identifier, things',
    ],
    'columns' => [
        'identifier' => [
            'exclude' => true,
            'label' => 'Identifier (LLL)',
            'config' => [
                'readOnly' => true,
                'type' => 'input',
                'size' => 50,
                'max' => 64,
                'eval' => 'required',
            ],
        ],
        'things' => [
            'exclude' => true,
            'label' => 'Things (LLL)',
            'config' => [
                'readOnly' => true,
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_glibi_domain_model_thing',
                'foreign_table' => 'tx_glibi_domain_model_thing',
                'MM' => 'tx_glibi_domain_model_thing_book_mm',
                'MM_opposite_field' => 'books',
                'minitems' => 0,
                'maxitems' => 999999,
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'identifier, things',
        ],
    ],
    'palettes' => [],
];
