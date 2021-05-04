<?php
include "Conexao.php";
$con=Conexao::getConexao();
if(isset($_POST['message'])){
	$timestamp = time()*1000;
	$sql="INSERT INTO message VALUES (0,'".$_POST['message']."','".$_POST['nick']."','".$timestamp."')";
	if($con->query($sql)){
		echo $timestamp;
	}else{
		echo null;
	}
}else if(!empty($_GET['timestamp'])){ 
	$sql="SELECT * FROM  message WHERE timestamp>".$_GET['timestamp'];
	
	if($resultado=$con->query($sql)){
        $return["status"]="ok";
        $return["rows"]=$resultado->rowCount();
		$messages=null;
		while($message = $resultado->fetch(PDO::FETCH_ASSOC)){
			$messages[]=$message;
        }
        $return["msg"]=$messages;
		echo json_encode($return);
	}else{
		echo null;
    }
}else{
    echo "{status:error}";
}
