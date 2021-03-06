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
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_glibi_domain_model_thing');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_glibi_domain_model_category');

    // Add plugin
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('Christianfutterlieb.Glibi', 'Thing', 'The "Thing" plugin (LLL)');
}, $_EXTKEY);
