<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
	<h1><a href="create.php">添加数据</a></h1>

	<table border='1' width='800px'>
		<tr>
			<th>ID</th>
			<th>账号</th>
			<th>邮箱</th>
			<th>手机号</th>
			<th>班级</th>
			<th>操作</th>
		</tr>

		<?php 
			include 'config.php';
			
			//每页显示几条数据 
			$num = 3;

			$p = isset($_GET['p']) ? $_GET['p'] : 1;

			$start = ($p-1)*$num;
			$end = ($p-1)*$num+($num-1);
			//获取id值
			$uid = $redis->lrange('listid',$start,$end);
			//页码
			include 'Page.php';
			//总条数
			$llen = $redis->llen('listid');
			$page = new Page($llen, $num);

			$show = $page->show();
			// echo $show;

			$arr = [];
			foreach($uid as $k => $v){
				
				$res = $redis->hgetall('huser'.$v);

				$res['id'] = $v;

				array_push($arr, $res);
				
			}

			foreach($arr as $ks => $vs):			
		?>

		<tr>
			<td><?= $vs['id']?></td>
			<td><?= $vs['uname']?></td>
			<td><?= $vs['email']?></td>
			<td><?= $vs['phone']?></td>
			<td><?= $vs['class']?></td>
			<td>
				<a href="edit.php?id=<?= $vs['id']?>">修改</a>
				<a href="destroy.php?id=<?= $vs['id']?>">删除</a>
			</td>
		</tr>

		<?php endforeach;?>
	</table>
	<style>
		.pagination{

			margin-left:500px;
			margin-top:30px;
		}

		.pagination a{
			position: relative;
		    float: left;
		    padding: 6px 12px;
		    margin-left: -1px;
		    line-height: 1.42857143;
		    color: #337ab7;
		    text-decoration: none;
		    background-color: #fff;
		    border: 1px solid #ddd;
		}

		.pagination .cur{
			    z-index: 3;
			    color: #fff;
			    cursor: default;
			    background-color: #337ab7;
			    border-color: #337ab7;
		}
	</style>
	
	<div class="pagination">
		<?= $show;?>
	</div>

	</center>
</body>
</html>
