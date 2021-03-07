<?php
namespace Interfaces;

defined('BASEPATH') or exit('No direct script access allowed');

interface iApi {
	function __construct();
	function setAllowedMethods(array $methods);
	function getAllowedMethods();
	function setMethod();
	function getMethod();
	function response($data, int $http_response_code);
}
