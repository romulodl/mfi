<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Romulodl\Mfi;

final class MfiTest extends TestCase
{
	public function testCalculateWithWrongTypeValues(): void
	{
		$this->expectException(Exception::class);

		$mfi = new Mfi();
		$mfi->calculate(['poop']);
	}

	public function testCalculateWithEmptyValues(): void
	{
		$this->expectException(Exception::class);

		$mfi = new Mfi();
		$mfi->calculate([]);
	}

	public function testCalculateWithValidValues(): void
	{
		$val = require(__DIR__ . '/values.php');
        $values = array_slice($val, -14);

		$mfi = new Mfi();
		$mfi = $mfi->calculate($values);

		$this->assertSame(41.56, round($mfi, 2));
	}
}
