<?php 

	// var_dump($_POST);
	include 'config.php';

	//添加id  
	$uid = $redis->incr('id');

	//把id信息存起来 
	$listid = $redis->rpush('listid',$uid);

	//把表单传过来的数据进行保存
	$hashs = $redis->hmset('huser'.$uid,$_POST);

	// echo $hashs;
	if($hashs){
		echo '
		<script>alert("添加成功");location.href="list.php";</script>';
	} else {
		echo '
		<script>alert("添加失败");setTimeout(function(){
				location.href="create.php";
		},3000)</script>';
	}



