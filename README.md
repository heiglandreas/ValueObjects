[![Build Status](https://travis-ci.org/heiglandreas/ValueObjects.svg?branch=master)](https://travis-ci.org/heiglandreas/ValueObjects)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/97183970fe5240c0956ad951f5b64e11)](https://www.codacy.com/app/github_70/ValueObjects?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=heiglandreas/ValueObjects&amp;utm_campaign=Badge_Grade)

# Value Objects

A collection of ValueOpjects that help me make my life easier.

The collection currently includes

* Gis - A component for Geographic shapes like Points, Rectangles, Dimensions, Polygons and Shapes.
* Pixel - A Pixel-Representation
* DPI - A DPI-Representation




# Stuff to be converted

```php
$valueObject = new Pixels(2000);
$dimension = new DotsPerInch(72);
$converter = new Converter(new DotsPerInch(72));
$converter->from(new Pixels(2000))
          ->to('\\Org_Heigl\\ValueObjects\\Length\\Meter')
          ->convert();