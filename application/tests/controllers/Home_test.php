<?php

final class Home_test extends TestCase {

	public function test_index()
	{
		$output = $this->request('GET', '');
		$this->assertStringContainsString('this is a standard REST API', $output);
	}
}
