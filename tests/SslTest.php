<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Romulodl\Ssl;

final class SslTest extends TestCase
{
	public function testCalculateWithWrongTypeValues(): void
	{
		$this->expectException(Exception::class);

		$ssl = new Ssl();
		$ssl->calculate(['poop']);
	}

	public function testCalculateWithEmptyValues(): void
	{
		$this->expectException(Exception::class);

		$ssl = new Ssl();
		$ssl->calculate([]);
	}

	public function testCalculateWithValidValues(): void
	{
		$values = require(__DIR__ . '/values.php');

		$ssl = new Ssl();
		$ssl = $ssl->calculate($values);

		$this->assertSame(-1, $ssl);
	}
}
