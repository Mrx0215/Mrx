<?php 
	include 'config.php';
	//根据id获取数据
	$rs = $redis->hgetall('huser'.$_GET['id']);
	// var_dump($rs);
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 </head>
 <body>
 	<form action="update.php?id=<?= $_GET['id']?>" method='post'>
		账号: <input type="text" name='uname' value="<?= $rs['uname']?>"><br/>	
		邮箱: <input type="text" name='email' value="<?= $rs['email']?>"><br/>	
		手机号: <input type="text" name='phone' value="<?= $rs['phone']?>"><br/>	
		班级: <input type="text" name='class' value="<?= $rs['class']?>"><br/>
		<button>修改</button>
	</form>
 </body>
 </html>