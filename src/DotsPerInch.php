<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Org_Heigl\ValueObjects;

class DotsPerInch
{
    /**
     * @var int $dpi
     */
    protected $dots;

    /**
     * Create a new instance of a DPI-Object
     *
     * @param int $dots
     */
    public function __construct(int $dots)
    {
        $this->dots = $dots;
    }

    /**
     * Get the amount of dots per inch  stored in this object
     *
     * @return float
     */
    public function getDpi() : float
    {
        return $this->dots;
    }
}

class_alias('Org_Heigl\\ValueObjects\\DotsPerInch', 'Org_Heigl\\ValueObjects\\DPI');