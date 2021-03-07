<?php

class BaseApi_test extends TestCase
{
	public function test_allowed_metods()
	{
		$output = $this->request('GET', 'welcome/index');
		$this->assertStringContainsString('<title>Welcome to CodeIgniter</title>', $output);
	}

	// public function test_method_404()
	// {
	// 	$this->request('GET', 'welcome/method_not_exist');
	// 	$this->assertResponseCode(404);
	// }

	// public function test_APPPATH()
	// {
	// 	$actual = realpath(APPPATH);
	// 	$expected = realpath(__DIR__ . '/../..');
	// 	$this->assertEquals(
	// 		$expected,
	// 		$actual,
	// 		'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
	// 	);
	// }
}
