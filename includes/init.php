<?php
$include_path = get_include_path();

/**
 * __FILE__ - PHP constant equals to absolute path to file where it appears
 * dirname - function accepts path to file and return path to directory that the file belongs to
 */
$this_folder = dirname(__FILE__);
$new_include_path = "{$this_folder}:{$include_path}";
set_include_path($new_include_path);

date_default_timezone_set('Asia/Jerusalem');

require_once('config.php');
require_once('functions.php');
require_once('constants.php');
