<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/2
 * Time: 14:17
 */
//连接数据库

function connect(){

    $link = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DBNAME) or die("数据库连接失败");

    mysqli_set_charset($link,DB_CHARSET);
    //mysqli_select_db($link,DB_DBNAME) or die("指定数据库打开失败");
    return $link;

}

function insert($link,$table,$array){
   // global $link;
    $keys = join(",",array_keys($array));
    $vals = "'".join("','",array_values($array))."'";
    $sql = "insert {$table}($keys) values({$vals})";
    mysqli_query($link,$sql);
    return mysqli_insert_id($link);
}

function update($link,$table,$array,$where=null){
   // global $link;
    $str = null;
    foreach($array as $key=>$val){
        if($str == null)
            $sep = "";
        else
            $sep = ",";
        $str.=$sep.$key."='".$val."'";
    }
    $sql = "update {$table} set {$str}".($where==null?null:"where ".$where);
    mysqli_query($link,$sql);
    return mysqli_affected_rows($link);
}

function delete($link,$table,$where=null){
   // global $link;
    $where=($where==null?null:"where ".$where);
    $sql = "delete from {$table} {$where}";
    mysqli_query($link,$sql);
    return mysqli_affected_rows($link);
}

function fetchOne($link,$sql,$result_type=MYSQLI_ASSOC){
    //global $link;
    $result = mysqli_query($link,$sql);
    $rows = mysqli_fetch_array($result,$result_type);
    return $rows;
}

function fetchAll($link,$sql,$result_type=MYSQLI_ASSOC){
    //global $link;
    $result = mysqli_query($link,$sql);
    while($row=mysqli_fetch_array($result,$result_type)){
        $rows[]=$row;
    }
    return $rows;
}

function getResultNum($link,$sql){
    //global $link;
    $result = mysqli_query($link,$sql);
    return mysqli_num_rows($result);
}