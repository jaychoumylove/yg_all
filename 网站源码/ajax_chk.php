<?
	require("Include/mysql_open.php");
	$user=$_GET["user"];
	if($user==""){
		exit("<font color='#ff0000'>请输入你的昵称！</font>");
	}
	$sql="select * from `yg_user` where `user`='".$user."';";
	//exit($sql);
	$result=mysql_query($sql);
	$affected_rows=mysql_affected_rows();
	if($affected_rows){
		echo "no";
	}else{
		echo "ok";
	}
?>