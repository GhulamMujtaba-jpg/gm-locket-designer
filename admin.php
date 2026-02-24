<?php
$host="localhost";
$user="root";
$pass="";
$db="gm_locket";

$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){ die("Connection Failed: ".$conn->connect_error); }

$result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>GM Locket – Admin Dashboard</title>
<link rel="stylesheet" href="style.css">
<style>
table{width:100%;border-collapse:collapse;margin-top:20px;}
th,td{border:1px solid #fff;padding:8px;text-align:center;}
th{background:#ff6f61;}
td img{width:50px;height:50px;}
.status-paid{color:lime;font-weight:bold;}
.status-pending{color:orange;font-weight:bold;}
</style>
</head>
<body>
<div class="header">GM Official – Admin Dashboard</div>
<table>
<tr>
<th>ID</th>
<th>Customer Name</th>
<th>Phone</th>
<th>Material</th>
<th>Price</th>
<th>Photo</th>
<th>Mockup</th>
<th>Design</th>
<th>Payment Status</th>
<th>Download</th>
</tr>

<?php while($row=$result->fetch_assoc()){ ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['customer_name'] ?></td>
<td><?= $row['phone'] ?></td>
<td><?= $row['material'] ?></td>
<td><?= $row['price'] ?></td>
<td><?php if($row['photo']){ ?><img src="<?= $row['photo'] ?>"><?php } ?></td>
<td><?= $row['mockup_type'] ?></td>
<td><?= $row['design_name'] ?></td>
<td class="<?= $row['payment_status']=='paid'?'status-paid':'status-pending' ?>"><?= $row['payment_status'] ?></td>
<td><a href="#">Download</a></td>
</tr>
<?php } ?>
</table>
</body>
</html>
