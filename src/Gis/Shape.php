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
 * This class describes a polygonal shape
 *
 * @author    Andreas Heigl <andreas@heigl.org>
 * @copyright 2006-2008 Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 */
class Shape implements BoundingBoxInterface
{
    /**
     * An array of polygons, that create a certain shape
     *
     * @var array $polygons
     */
    protected $polygons = array ();

    /**
     * The bounding box in LAT/LON Space
     *
     * @var Rectangle $boundingBox
     */
    protected $boundingBox = null;

    /**
     * some additional parameters
     *
     * @var array $parameters
     */
    protected $parameters = array ();

    /**
     * This method adds a new Polygon to the shape and actualises the bounding
     * box
     *
     * @param \Org_Heigl\ValueObjects\Gis\Polygon $polygon The Polygon to add to this Shape
     *
     * @return \Org_Heigl\ValueObjects\Gis\Shape Provides a fluid Interface
     */
    public function addPolygon(Polygon $polygon)
    {

        $this -> polygons[] = $polygon;
        $bb                 = $polygon->getBoundingBox();
        if ( ! $this -> boundingBox instanceof Rectangle) {
            $this -> boundingBox = $bb;
        } else {

            if ( $bb -> topLeft -> LAT > $this -> boundingBox -> topLeft -> LAT ) {
                $this -> boundingBox -> topLeft -> LAT = $bb -> topLeft -> LAT;
            }

            if ( $bb -> topLeft -> LON < $this -> boundingBox -> topLeft -> LON ) {
                $this -> boundingBox -> topLeft -> LON = $bb -> topLeft -> LON;
            }

            if ( $bb -> bottomRight -> LAT < $this -> boundingBox -> bottomRight -> LAT ) {
                $this -> boundingBox -> bottomRight -> LAT = $bb -> bottomRight -> LAT;
            }

            if ( $bb -> bottomRight -> LON > $this -> boundingBox -> bottomRight -> LON ) {
                $this -> boundingBox -> bottomRight -> LON = $bb -> bottomRight -> LON;
            }
        }

        return $this;
    }

    /**
     * Create an Array containing some meta-Inforamtions and the coordinates
     * of the shape
     *
     * <code>
     * array ( 'meta'  => array (
     *             'boundingBox' => Org_Heigl_Gis_Rectangle::exportToArray()
     *            ),
     *         'shape' => array (
     *              Org_Heigl_Gis_Rectangle::exportToArray(),
     *              Org_Heigl_Gis_Rectangle::exportToArray(),
     *              [ etc ]
     *            )
     *       );
     * </code>
     *
     * @return array
     */
    public function exportToArray () {
        $arr                        = array ();
        $arr['meta']['boundingBox'] = $this -> boundingBox -> exportToArray ();
        foreach ( $this -> polygons as $polygon ) {
            $arr['shape'][] = $polygon -> exportToArray ();
        }
        return $arr;
    }

    /**
     * @return \Org_Heigl\ValueObjects\Gis\Rectangle
     */
    public function getBoundingBox()
    {
        return $this->boundingBox;
    }
}