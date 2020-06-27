# Money Flow Index

Calculate the Money Flow Index (MFI) in pure PHP

## Instalation

```
composer require romulodl/mfi
```

or add `romulodl/mfi` to your `composer.json`. Please check the latest version in releases.

## Usage

```php
$mfi = new Romulodl\Mfi();
$mfi->calculate(array $hlcv_values); // [high, low, close, volume]
//returns float
```

Example of use:
```php
$mfi = new Romulodl\Mfi();
$mfi->calculate([
  [9950.00,9250.66,9786.80,602528.438],
  [9843.50,9100.00,9310.73,504107.096],
  [9585.00,9210.03,9374.99,287768.201],
  [9880.00,9317.16,9678.57,300859.340],
  [9958.67,9450.00,9731.10,363732.370],
  [9900.00,9462.00,9773.64,376313.845],
  [9838.00,9281.42,9508.11,334423.590],
  [9573.00,8812.20,9060.00,461439.193],
  [9259.38,8920.00,9166.40,276008.073],
  [9300.00,9076.90,9176.41,201589.660],
  [9294.44,8674.00,8711.37,339643.378],
  [8977.00,8623.38,8895.65,302980.106],
  [9011.82,8693.18,8837.05,275619.158],
  [9230.00,8811.00,9197.32,272253.998],
]);
```

## Why did you do this?

The PECL Trading extension is crap and not everyone wants to install it.
I am building a trading bot which will need the SSL value as part of the calculation.
