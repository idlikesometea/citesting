<?php
namespace Interfaces;

defined('BASEPATH') or exit('No direct script access allowed');

interface iCRUD {
	function __construct();
	function index();
	function get(int $id);
	function create();
	function update(int $id);
	function delete(int $id);
}
