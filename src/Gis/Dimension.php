<?php

/**
 * Copyright (c) Andreas Heigl<andreas@heigl.org>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author    Andreas Heigl <andreas@heigl.org>
 * @copyright 2008-2015 Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 */

namespace Org_Heigl\ValueObjects\Gis;

/**
 * This class describes the dimension of a rectangle
 *
 * @author    Andreas Heigl <andreas@heigl.org>
 * @copyright Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 */
class Dimension
{

    /**
     * The width of the Dimension
     *
     * @var int $_width
     */
    protected $_width = null;

    /**
     * The height of the Dimension
     *
     * @var int $_height
     */
    protected $_height = null;

    /**
     * The main constructor that sets width and height of the dimension
     *
     * @param int $width  The Width of the Dimension
     * @param int $height The Height of the Dimension
     */
    public function __construct ( $width, $height ) {
        $this -> setWidth ( $width );
        $this -> setHeight ( $height );
    }

    /**
     * Getter-method for the width
     *
     * @return int
     */
    public function getWidth () {
        return $this -> _width;
    }

    /**
     * Getter-method for the height
     *
     * @return int
     */
    public function getHeight () {
        return $this -> _height;
    }

    /**
     * Setter-method for the width
     *
     * @param int $width the Width to set
     *
     * @return Org_Heigl_Gis_Dimension Provide a fluent Interface
     */
    public function setWidth ( $width ) {
        $this -> _width = $width;
        return $this;
    }

    /**
     * Setter-method for the height
     *
     * @param int $height the Height to set
     *
     * @return Org_Heigl_Gis_Dimension Provide a fluent Interface
     */
    public function setHeight ( $height ) {
        $this -> _height = $height;
        return $this;
    }

    /**
     * Get the dimanesion as associative array.
     *
     * Width and height can be accessed via the keys 'w' and 'h' respectively
     *
     * @return array
     */
    public function getDimension () {
        return array ( 'w' => $this -> getWidth (),
                       'h' => $this -> getHeight () );
    }
}