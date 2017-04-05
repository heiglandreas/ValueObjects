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
 * This Class describes a Rectangle
 *
 * @author    Andreas Heigl <andreas@heigl.org>
 * @copyright Andreas Heigl
 */
class Rectangle
{
    /**
     * The top-left Corner of the rectangle
     *
     * @var \Org_Heigl\ValueObjects\Gis\Point $topLeft
     */
    public $topLeft = null;

    /**
     * The lower-right Corner of the rectangle
     *
     * @var \Org_Heigl\ValueObjects\Gis\Point $bottomRight
     */
    public $bottomRight = null;

    /**
     * Create a new Rectangle
     */
    public function __construct(Point $topLeft, Point $bottomRight)
    {
        $this -> topLeft     = $topLeft;
        $this -> bottomRight = $bottomRight;
    }

    /**
     * Export the rectangle to an associative array
     *
     * <code>array( 'tl' => array ( 'x' => int, 'y' => int ),
     *              'br' => array ( 'x' => int, 'y' => int ) );
     * </code>
     *
     * @return array
     */
    public function exportToArray () {
        return array ('tl' => $this -> topLeft -> get ( 'x', 'y' ),
                      'br' => $this -> bottomRight -> get ( 'x', 'y' ) );
    }

    /**
     * Get the Latitude of the top-left corner
     *
     * @return float
     */
    public function getTop()
    {
        return $this->topLeft->getY();
    }

    /**
     * Get the Longitude of the top-left corner
     *
     * @return float
     */
    public function getLeft()
    {
        return $this->topLeft->getX();
    }
    /**
     * Get the Latitude of the bottom-right corner
     *
     * @return float
     */
    public function getBottom()
    {
            return $this->bottomRight->getY();
    }
    /**
     * Get the Longitude of the bottom-right corner
     *
     * @return float
     */
    public function getRight()
    {
        return $this->bottomRight->getX();
    }

    /**
     * Set the top-left corner of the rectangle
     *
     * @param float $top  The top value
     * @param float $left The left value
     *
     * @return \Org_Heigl\ValueObjects\Gis\Rectangle
     */
    public function setTopLeft($top, $left)
    {
        $topLeft = new Point($left, $top);

        return new self($topLeft, $this->bottomRight);
    }

    /**
     * Set the bottom-right corner of the rectangle
     *
     * @param float $bottom The bottom value
     * @param float $right  The right value
     *
     * @return \Org_Heigl\ValueObjects\Gis\Rectangle
     */
    public function setbottomRight($bottom, $right)
    {
        $bottomRight = new Point($right, $bottom);

        return new self($this->topLeft, $bottomRight);
    }

    /**
     * Create a rectangle from an array of coordinates
     *
     * The array contains the coordinates in the following key order:
     *
     *              2,3
     *  +-----------+
     *  |           |
     *  +-----------+
     * 0,1
     *
     * @param array $coords
     *
     * @return \Org_Heigl\ValueObjects\Gis\Rectangle
     */
    public static function fromArray(array $coords = null)
    {
        if (null === $coords) {
            $coords = array(0, 0, 0, 0);
        }

        $topLeft = new Point($coords[0], $coords[3]);
        $bottomRight = new Point($coords[2], $coords[1]);

        return new self($topLeft, $bottomRight);
    }

    /**
     * get the rectangles coordinates as array
     *
     * @return array
     */
    public function __toArray()
    {
        return array(
            $this->bottomRight->getX(),
            $this->topLeft->getY(),
            $this->topLeft->getX(),
            $this->bottomRight->getY()
        );
    }
}
