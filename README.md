# Stuff to be converted

```php
$valueObject = new Pixels(2000);
$dimension = new DotsPerInch(72);
$converter = new Converter(new DotsPerInch(72));
$converter->from(new Pixels(2000))
          ->to('\\Org_Heigl\\ValueObjects\\Length\\Meter')
          ->convert();