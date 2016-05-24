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
 * This class describes a polygon
 */
class Polygon implements BoundingBoxInterface
{
    /**
     * The array of the points defining this polygon
     *
     * @var array $points
     */
    private $points = array ();

    /**
     * Whether or not the polygon is closed
     *
     * @var boolean $closed
     */
    public $closed = true;

    /**
     * The coordinates of the top left corner of the polygon
     *
     * @var \Org_Heigl\ValueObjects\Gis\Point $topLeft
     */
    public $topLeft = null;

    /**
     * The coordinates of the bottom right corner of the polygon
     *
     * @var \Org_Heigl\ValueObjects\Gis\Point $bottomRight
     */
    public $bottomRight = null;

    /**
     * An individual Identifier
     *
     * @var mixed $id
     */
    public  $id;

    /**
     * This is the constructor of the class
     */
    public function __construct()
    {
        $this -> points      = array ();
        $this -> topLeft     = new Point ();
        $this -> bottomRight = new Point ();
    }

    /**
     * This method adds a point to the end of the array $points
     *
     * @param \Org_Heigl\ValueObjects\Gis\Point $point The point to add
     *
     * @return \Org_Heigl\ValueObjects\Gis\Polygon Provides a fluent interface
     */
    public function addPoint(Point $point)
    {

        $this -> points [] = $point;
        if ( count ( $this -> points ) == 1 ) {
            $this -> topLeft     = clone ( $point );
            $this -> bottomRight = clone ( $point );
        } else {
            if ( $point -> LAT > $this -> topLeft -> LAT ) {
                $this -> topLeft -> LAT = $point -> LAT;
            }
            if ( $point -> LON < $this -> topLeft -> LON ) {
                $this -> topLeft -> LON = $point -> LON;
            }
            if ( $point -> LAT < $this -> bottomRight -> LAT ) {
                $this -> bottomRight -> LAT = $point -> LAT;
            }
            if ( $point -> LON > $this -> topLeft -> LON ) {
                $this -> bottomRight -> LON = $point -> LON;
            }
        }
        return $this;
    }

    /**
     * This method returns the bounding box in LAT/LON space
     *
     * @return \Org_Heigl\ValueObjects\Gis\Rectangle
     */
    public function getBoundingBox()
    {
        return new Rectangle(
            $this->topLeft,
            $this->bottomRight
        );
    }

    /**
     * export the Polygon to an associative array
     *
     * @return array
     */
    public function exportToArray () {
        $coord                = array ();
        $coord['boundingBox'] = $this -> getBoundingBox () -> exportToArray ();
        foreach ( $this -> points as $key => $point ) {
            $coord['poly'][] = $point -> get ( 'x', 'y' );
        }
        return $coord;
    }
}