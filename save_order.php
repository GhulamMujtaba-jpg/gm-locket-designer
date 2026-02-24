<?php
$host="localhost";
$user="root";
$pass="";
$db="gm_locket";

$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){ die("Connection Failed: ".$conn->connect_error); }

$customer_name = $_POST['customerName'];
$phone = $_POST['customerPhone'];
$address = $_POST['customerAddress'];
$material = $_POST['orderMaterial'];
$design_name = $_POST['designName'];
$mockup_type = $_POST['mockupType'];
$price = $_POST['price'];
$payment_status = "pending";

$photo = "";
if(isset($_FILES['photo'])){
    $target_dir = "uploads/";
    if(!is_dir($target_dir)) mkdir($target_dir,0777,true);
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
    $photo = $target_file;
}

$stmt = $conn->prepare("INSERT INTO orders (customer_name, phone, address, material, design_name, mockup_type, photo, price, payment_status) VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssis",$customer_name,$phone,$address,$material,$design_name,$mockup_type,$photo,$price,$payment_status);

if($stmt->execute()){
    $order_id = $stmt->insert_id;
    echo json_encode(["status"=>"success","order_id"=>$order_id,"message"=>"Order Saved!"]);
} else {
    echo json_encode(["status"=>"error","message"=>"Failed to save order"]);
}
$stmt->close();
$conn->close();
?>
