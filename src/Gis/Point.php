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
 * @copyright Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 */

namespace Org_Heigl\ValueObjects\Gis;

/**
 * This class describes a point in a 3D-coordinate-system but it can be used for
 * 2D-coordinate-systems as well, as the 3rd dimension is 0 by default.
 */
class Point
{
    /**
     * This value defines the x-value of the point
     *
     * @var float $x
     */
    protected $x = 0;

    /**
     * This value defines the y-value of the point
     *
     * @var float $y
     */
    protected $y = 0;

    /**
     * This value defines the z-value of the point
     *
     * @var mixed $id
     */
    protected $z = null;

    /**
     * This is the constructor of the class
     *
     * @param float $x The x-value
     * @param float $y The y-value
     * @param mixed $z The z-value
     */
    public function __construct($x, $y, $z = 0)
    {
        $this->x = (float) $x;
        $this->y = (float) $y;
        $this->z = (float) $z;
    }

    public function setX($x)
    {
        return new self($x, $this->y, $this->z);
    }

    public function setY($y)
    {
        return new self($this->x, $y, $this->z);
    }

    public function setZ($z)
    {
        return new self($this->x, $this->y, $z);
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getZ()
    {
        return $this->z;
    }

    /**
     * This method returns the x/y/z coordinates
     *
     * The returned array contains the keys $x and $y for the Latitude and
     * Longitue Values respectively
     *
     * @param string $x Key for the X-Value ('x' by default)
     * @param string $y Key for the Y-value ('y' by default)
     * @param string $z Key for the Z-value ('z' by default)
     *
     * @return array
     */
    public function get($x = 'x', $y = 'y', $z = 'z') {
        return array(
            $x => (float) $this->x,
            $y => (float) $this->y,
            $z => (float) $this->z,
        );
    }
}