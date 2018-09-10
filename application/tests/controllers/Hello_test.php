<?php
	
	use PHPUnit\Framework\TestCase;

	class Hello_test extends TestCase
	{
		public function setUp() {
			parent::setUp();
		}

		public function testSum() {
			$sum = 1+2;
			$this->assertEquals(3, 1+2);
		}
	}
?>