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
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @since     07.02.2017
 * @link      http://github.com/heiglandreas/org.heigl.ValueObjects
 */

namespace Org_Heigl\ValueObjectsTest\Gis;

use Org_Heigl\ValueObjects\Gis\Point;
use Org_Heigl\ValueObjects\Gis\Polygon;
use Org_Heigl\ValueObjects\Gis\Rectangle;
use PHPUnit\Framework\TestCase;

class PolygonTest extends TestCase
{
    /** @covers  Polygon::addPoint() */
    public function testThatCalculationOfBoundingBoxWorksAsExpected()
    {
        $polygon = new Polygon();

        $this->assertAttributeEquals(new Point(0, 0), 'topLeft', $polygon);
        $this->assertAttributeEquals(new Point(0, 0), 'bottomRight', $polygon);

        $polygon->addPoint(new Point( 1, 2));

        $this->assertAttributeEquals(new Point(1, 2), 'topLeft', $polygon);
        $this->assertAttributeEquals(new Point(1, 2), 'bottomRight', $polygon);

        $polygon->addPoint(new Point( 2, 1));

        $this->assertAttributeEquals(new Point(1, 2), 'topLeft', $polygon);
        $this->assertAttributeEquals(new Point(2, 1), 'bottomRight', $polygon);


    }
}
