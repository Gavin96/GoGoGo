<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/2
 * Time: 15:51
 */
header("content-type:text/html;charset=utf-8");
session_start();
//define("ROOT",dirname(__FILE__));
//set_include_path(".".PATH_SEPARATOR.ROOT."/lib".PATH_SEPARATOR.ROOT."./core".PATH_SEPARATOR.get_include_path());

require_once "lib/common.func.php";
require_once "lib/image.func.php";
require_once "lib/mysql.func.php";
require_once "lib/page.func.php";
require_once "lib/string.func.php";
require_once "lib/upload.func.php";
require_once "configs/configure.php";
require_once "core/admin.inc.php";
