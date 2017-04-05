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
 * @since     04.04.2017
 * @link      http://github.com/heiglandreas/org.heigl.ValueObjects
 */

namespace Org_Heigl\ValueObjectsTest\Gis;

use Org_Heigl\ValueObjects\Gis\Point;
use Org_Heigl\ValueObjects\Gis\Rectangle;
use PHPUnit\Framework\TestCase;

/**
 * Class RectangleTest
 *
 * @package Org_Heigl\ValueObjectsTest\Gis
 * @coversDefaultClass \Org_Heigl\ValueObjects\Gis\Rectangle
 */
class RectangleTest extends TestCase
{
    /**
     * 0,3   2,3
     * +-----+
     * |     |
     * +-----+
     * 0,1   2,1
     *
     * @covers ::fromArray
     */
    public function testThatRectangleIsCreatedCorrectlyFromArray()
    {
        $rect = Rectangle::fromArray([0, 1, 2, 3]);

        $this->assertAttributeEquals(new Point(0, 3), 'topLeft', $rect);
        $this->assertAttributeEquals(new Point(2, 1), 'bottomRight', $rect);
    }

    /**
     * @covers ::fromArray
     */
    public function testThatRectangleIsCreatedCorrectlyWhenCalledWithoutParameter()
    {
        $rect = Rectangle::fromArray();

        $this->assertAttributeEquals(new Point(0, 0), 'topLeft', $rect);
        $this->assertAttributeEquals(new Point(0, 0), 'bottomRight', $rect);
    }

    /**
     * @covers ::__construct
     */
    public function testThatInstantiatingWorks()
    {
        $tl = new Point(0,1);
        $br = new Point(2,3);
        $rect = new Rectangle($tl, $br);

        $this->assertAttributeSame($tl, 'topLeft', $rect);
        $this->assertAttributeSame($br, 'bottomRight', $rect);
    }

    /**
     * @covers ::getBottom
     * @covers ::getTop
     * @covers ::getLeft
     * @covers ::getRight
     */
    public function testThatSingleValuesAreREturnedCorrectly()
    {
        $rect = new Rectangle(new Point(0, 1), new Point(2, 3));
        $this->assertEquals(0, $rect->getLeft());
        $this->assertEquals(3, $rect->getBottom());
        $this->assertEquals(2, $rect->getRight());
        $this->assertEquals(1, $rect->getTop());
    }

    /**
     * @covers ::setTopLeft
     */
    public function testThatANewInstanceIsReturnedOnSettingTopLeft()
    {
        $rect = new Rectangle(new Point(0, 1), new Point(2, 3));
        $rect2 = $rect->setTopLeft(5,4);
        $this->assertNotSame($rect2, $rect);
        $this->assertAttributeEquals(new Point(4,5), 'topLeft', $rect2);
        $this->assertAttributeEquals(new Point(2,3), 'bottomRight', $rect2);
    }

    /**
     * @covers ::setbottomRight
     */
    public function testThatANewInstanceIsReturnedOnSettingBottomRight()
    {
        $rect = new Rectangle(new Point(0, 1), new Point(2, 3));
        $rect2 = $rect->setBottomRight(5,4);
        $this->assertNotSame($rect2, $rect);
        $this->assertAttributeEquals(new Point(0,1), 'topLeft', $rect2);
        $this->assertAttributeEquals(new Point(4,5), 'bottomRight', $rect2);
    }

    /**
     * @covers ::__toArray
     */
    public function testThatArrayIsReturned()
    {
        $rect = new Rectangle(new Point(0, 1), new Point(2, 3));

        $this->assertEquals([2, 1, 0, 3], $rect->__toArray());
    }

    /**
     * @covers ::exportToArray
     */
    public function testThatExportingToArrayWorks()
    {
        $rect = new Rectangle(new Point(0, 1), new Point(2, 3));

        $this->assertEquals(
            [
                'tl' => ['x' => 0, 'y' => 1, 'z' => 0],
                'br' => ['x' => 2, 'y' => 3, 'z' => 0],
            ],
            $rect->exportToArray()
        );

    }
}
