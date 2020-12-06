<?php 
	include ("Include/mysql_open.php");
	include ("session_chk.php");
	$act=$_GET["act"];
	if($act=="add"){
		$pro_Id=$_GET["pro_Id"];
		$user=$_SESSION["user"];
		if($user==""){
			exit("<script>window.location.href='YG_product_info.php?Id=".$pro_Id."';alert('收藏失败！');</script>");
		}
		$gwc=@$_GET["gwc"];
		$addtime=date("Y/m/d H:i:s",time());
		$sql="insert into `yg_farite`(`pro_Id`,`userName`,`addtime`) values('".$pro_Id."','".$user."','".$addtime."')";
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行数
		if($gwc=="gwc"){
			if($result && $affet_rows){
				echo "<script>window.location.href='YG_user_collection.php';alert('收藏成功！');</script>";
			}else{
				exit("<script>window.location.href='YG_user_collection.php';alert('收藏失败！');</script>");
			}
		}else{
			if($result && $affet_rows){
				echo "<script>window.location.href='YG_product_info.php?Id=".$pro_Id."';alert('收藏成功！');</script>";
			}else{
				exit("<script>window.location.href='YG_product_info.php?Id=".$pro_Id."';alert('收藏失败！');</script>");
			}
		}
	}else if($act=="del"){
		$Id=@$_GET["Id"];
		$pro_Id=@$_GET["pro_Id"];
		$sql="delete from `yg_farite` where `Id`=".$Id;
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行数
		if($pro_Id){
			if($result && $affet_rows){
				echo "<script>window.location.href='YG_product_info.php?Id=".$pro_Id."';alert('取消收藏成功！');</script>";
			}else{
				echo "<script>window.location.href='YG_product_info.php?Id=".$pro_Id."';alert('取消收藏失败！');</script>";
			}
		}else{
			if($result && $affet_rows){
				echo "<script>window.location.href='YG_user_collection.php';alert('取消收藏成功！');</script>";
			}else{
				echo "<script>window.location.href='YG_user_collection.php';alert('取消收藏失败！');</script>";
			}
		}
		
	}
?>