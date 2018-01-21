<?php
declare(strict_types=1);

namespace Christianfutterlieb\Glibi\Utility;

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

/**
 * RandomisationUtility
 */
class RandomisationUtility
{
    /**
     * Randomizes the order of array elements in $array.
     *
     * @param array $array
     */
    public static function randomizeArray(&$array)
    {
        usort($array, function($a, $b) {
            return random_int(-1, 1);
        });
    }
}
