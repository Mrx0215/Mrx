<?php
	//分析

		//需求  1. limit
				// 2.   页码  上一页  123456 下一页

		//已知
		//	1.每页显示几条数据   $num
		//	2.总的数据        $total
			
	/**
	*	分页类
	*/


	class Page
	{
		//成员属性
		public $total;
		public $num;
		public $p;

		//构造方法
		public function __construct($total,$num)
		{
			$this->total = $total;
			$this->num = $num;

			//$this->p = isset($_GET['p']) ? $_GET['p'] : 1;

		}



		//成员方法
		/**
		*	limit  1 0,5  2 5,5   3 10,5  4 15,5
		*/
		public function getLimit()
		{
			//页数
			$p = $this->getPage();
			//开始
			$start = ($p-1)*$this->num;
			//结束
			$end = $this->num;
			//拼接limit
			$limit = $start.','.$end;

			return $limit;
		}

		public function getPage()
		{
			return isset($_GET['p']) ? $_GET['p'] : 1;
		}
		/**
		*	页码  上一页 1234567 下一页
		*
		*/
		public function show()
		{

			$url = $_SERVER['SCRIPT_NAME'];
			// var_dump($url);die;
			//获取总页数
			$totalPage = ceil($this->total/$this->num);

			//页数
			//$p = isset($_GET['p']) ? $_GET['p'] : 1;
			$p = $this->getPage();

			if($p <= 1){

				$prev = 1;
			} else {

				$prev = $p-1;
			}

			//定义变量
			$str = '';

			$str .= "<a href ='{$url}?p= ".$prev."' ><<&nbsp;</a>";

			//获取页码
			for ($i=1; $i <= $totalPage ; $i++) { 

				//判断页码颜色
				if($p == $i) {

					$str .=  "<a href ='{$url}?p={$i}' class='cur'>{$i}</a>";
				} else {
					$str .=  "<a href ='{$url}?p={$i}' >{$i}</a>";
				}
			}

			//判断
			if($p >= $totalPage) {

				$next = $totalPage;
			} else {

				$next = $p +1;
			}


			$str .=  "<a href='{$url}?p=".$next."'>&nbsp;>></a>";


			return $str;

		}



	}

	//实例化对象
	// $page = new Page(38,5);

	// // $page->getLimit();

	// echo $page->show();