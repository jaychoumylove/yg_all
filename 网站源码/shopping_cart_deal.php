<?php 
	include ("Include/mysql_open.php");
    include ("session_chk.php");
	$act=$_GET["act"];
	//$act="clear";
	if($act=="add"){
		$Id=$_GET["Id"];
		if(@$_SESSION["shopping_cart_Id"]==""){
			$_SESSION["shopping_cart_Id"]=$Id;
			$_SESSION["shopping_cart_much"]=1;
		}else{
			$shopping_cart_Id_arr=explode(",",$_SESSION["shopping_cart_Id"]);
			for($i=0;$i<count($shopping_cart_Id_arr);$i++){
				if($Id==$shopping_cart_Id_arr[$i]){
					exit("<script>window.location.href='YG_products.php';alert('该商品已在您的购物车中，试试添加别的吧！');</script>");
				}
			}
			array_push($shopping_cart_Id_arr,$Id);
			$shopping_cart_Id_str=implode(",",$shopping_cart_Id_arr);
			$_SESSION["shopping_cart_Id"]=$shopping_cart_Id_str;
			$shopping_cart_much_arr=explode(",",$_SESSION["shopping_cart_much"]);
			array_push($shopping_cart_much_arr,1);
			$shopping_cart_much_str=implode(",",$shopping_cart_much_arr);
			$_SESSION["shopping_cart_much"]=$shopping_cart_much_str;
		}
		exit("<script>window.location.href='YG_shopping_cart.php';alert('添加成功')</script>");
	}else if($act=="del"){
		$Id=$_GET["Id"];
		$shopping_cart_much_arr=explode(",",$_SESSION["shopping_cart_much"]);
		$shopping_cart_Id_arr=explode(",",$_SESSION["shopping_cart_Id"]);
		for($i=0;$i<count($shopping_cart_Id_arr);$i++){
			if($Id==$shopping_cart_Id_arr[$i]){
				unset($shopping_cart_Id_arr[$i]);
				unset($shopping_cart_much_arr[$i]);
			}
		}
		//exit();
		$shopping_cart_Id_str=implode(",",$shopping_cart_Id_arr);
		$_SESSION["shopping_cart_Id"]=$shopping_cart_Id_str;
		$shopping_cart_much_str=implode(",",$shopping_cart_much_arr);
		$_SESSION["shopping_cart_much"]=$shopping_cart_much_str;	
		exit("<script>window.location.href='YG_shopping_cart.php';alert('删除成功！')</script>");
	}else if($act=="clear"){
		unset($_SESSION["shopping_cart_Id"]);
		unset($_SESSION["shopping_cart_much"]);
		exit("<script>window.location.href='YG_shopping_cart.php';alert('清空成功！')</script>");
	}
?>