<?php 

//-----header info------
header("content-type: application/json");

$request= $_SERVER['REQUEST_METHOD'];

//-----check and execute the request methods------
switch ($request) {
	case 'GET':
		getMethod();
		break;
	case 'PUT':
		$data = json_decode(file_get_contents('php://input'),true);
		putMehod($data);
		break;
	case 'POST':
		$data = json_decode(file_get_contents('php://input'),true);
		postMehod($data);
		break;	
	case 'DELETE':
		$data = json_decode(file_get_contents('php://input'),true);
		deleteMehod($data);
		break;	
	default:
			echo '{"result": "no data found"}';
		break;
}


//-------get mehod for data show -------------
function getMethod(){

include "database.php";

$query = "SELECT * FROM `book_info`";
$result = mysqli_query($conn , $query);

if(mysqli_num_rows($result) > 0){
	$rows = array();
	while ( $r = mysqli_fetch_assoc($result)) {
		$rows['result'] [] = $r;
	}
	echo json_encode($rows);
}
else{
	echo '{"result": "no data found"}';
}

}

//-----post method for insert data------
function postMehod( $data){
include "database.php";
$book_name= $data['book_name'];
$auth_name= $data['author_name'];

$query = "INSERT INTO `book_info` (`id`, `book_name`, `author_name`) VALUES (NULL,'$book_name','$auth_name');";

if ($result = mysqli_query($conn , $query)) {
		echo '{"result": "data inserted"}';
}
else{
		echo '{"result": "data not inserted"}';
}

}


//------ put method for edit data-------
function putMehod( $data){
include "database.php";
$id= $data['id'];
$book_name= $data['book_name'];
$auth_name= $data['author_name'];

$query = "UPDATE `book_info` SET `book_name` = '$book_name', `author_name` = '$auth_name' WHERE `book_info`.`id` = $id;";

if ($result = mysqli_query($conn , $query)) {
		echo '{"result": "data updated"}';
}
else{
		echo '{"result": "data not updated"}';
}

}


//------ delete method for delete data ----------
function deleteMehod( $data){
include "database.php";
$id= $data['id'];

$query = "DELETE FROM `book_info` WHERE `id`= $id";

if ($result = mysqli_query($conn , $query)) {
		echo '{"result": "data delete"}';
}
else{
		echo '{"result": "data not deleted"}';
}

}


?>