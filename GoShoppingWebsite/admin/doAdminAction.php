<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/3
 * Time: 13:03
 */
require_once "../include.php";
$act = $_REQUEST['act'];
if($act=="logout"){
    logout();
}