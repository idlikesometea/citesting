<?php
namespace Interfaces;

defined('BASEPATH') or exit('No direct script access allowed');

interface iApi {
	function __construct();
	function prepareRequest(array $methods);
	function setAllowedMethods(array $methods);
	function getAllowedMethods();
	function setRequestMethod();
	function getRequestMethod();
	function setRequestParams();
	function getRequestParams();
	function response($data, int $http_response_code);
}
