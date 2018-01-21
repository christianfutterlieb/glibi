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

defined ('TYPO3_MODE') or die ('Access denied.');

call_user_func(function($extKey){
    // DEV: add test plugin
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('Christianfutterlieb.Glibi', 'Thing', [
        'Thing' => 'search,showBook'
    ], [
        'Thing' => 'search'
    ]);
}, $_EXTKEY);
