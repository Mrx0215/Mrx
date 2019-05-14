<?php 

	include 'config.php';

	//id删除 
	$uid = $redis->lrem('listid',$_GET['id']);

	//数据删除 
	$res = $redis->del('huser'.$_GET['id']);

	if($res){

		echo '<script>alert("删除成功");location.href="list.php"</script>';
	} else {

		echo '<script>alert("删除失败");location.href="list.php"</script>';
	}
