;<?php 
	include 'config.php';
	// echo $_GET['id'];
	// var_dump($_POST);

	// echo 123;

	$rs = $redis->hmset('huser'.$_GET['id'],$_POST);

	if($rs){

		echo '<script>alert("修改成功");location.href="list.php"</script>';
	} else {

		echo '<script>alert("修改失败");location.href="edit.php"</script>';
	}


