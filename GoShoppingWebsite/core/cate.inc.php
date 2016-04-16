<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/10
 * Time: 10:11
 */
function addCate(){
    $link = connect();
    $arr=$_POST;
    //删除以post方式提交的act
    unset($arr['act']);
    if(insert($link,"go_cate",$arr)){
        $mes="分类添加成功!<br/><a href='addCate.php'>继续添加</a>|<a href='listCate.php'>查看分类</a>";
    }else{
        $mes="分类添加失败！<br/><a href='addCate.php'>重新添加</a>|<a href='listCate.php'>查看分类</a>";
    }
    return $mes;
}

function getCateByPage($page,$pageSize=2){
    $link = connect();
    $sql="select * from go_cate";
    global $totalRows;
    $totalRows=getResultNum($link,$sql);
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
    if($page<1||$page==null||!is_numeric($page)){
        $page=1;
    }
    if($page>=$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;
    $sql="select id,name from go_cate order by id limit {$offset},{$pageSize} ";
    $rows=fetchAll($link,$sql);
    return $rows;
}


function delCate($id){
    $link = connect();
    $res=checkProExist($link,$id);
    if($res){
        alertMes("不能删除分类，请先删除该分类下的商品", "listPro.php");
    }else{
        $where="id=".$id;
        if(delete($link,"go_cate",$where)){
            $mes="分类删除成功!<br/><a href='listCate.php'>查看分类</a>|<a href='addCate.php'>添加分类</a>";
        }else{
            $mes="删除失败！<br/><a href='listCate.php'>请重新操作</a>";
        }
        return $mes;
    }


}


function getAllCate(){
    $link = connect();
    $sql="select id,name from go_cate";
    $rows=fetchAll($link,$sql);
    return $rows;
}