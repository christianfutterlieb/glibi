<?php
declare(strict_types=1);

namespace Christianfutterlieb\Glibi\ViewHelpers\Form;

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

/**
 * ConjunctionOptionsViewHelper
 */
class ConjunctionOptionsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * @return array
     */
    public function render()
    {
        return [
            SearchForm::CONJUNCTION_AND => 'And (LLL)',
            SearchForm::CONJUNCTION_OR => 'Or (LLL)',
        ];
    }
}
