<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Org_Heigl\ValueObjects;

class Pixel
{
    /**
     * @var int $pixel
     */
    protected $pixel;

    /**
     * Create a new instance of a pixel
     *
     * @param int $pixel
     */
    public function __construct(int $pixel)
    {
        $this->pixel = $pixel;
    }

    /**
     * Get the amount of pixels stored in this object
     *
     * @return int
     */
    public function getPixels() : int
    {
        return $this->pixel;
    }
}