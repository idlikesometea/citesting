<?php
namespace Interfaces;

defined('BASEPATH') or exit('No direct script access allowed');

interface iHttpMethods {
	function __construct();
	function index();
	function get(int $id);
	function post();
	function put(int $id);
	function delete(int $id);
}
