<?php
//session_start();
header('Content-Type: application/json');

// 获取请求体中的 JSON 数据
$json_data = file_get_contents('php://input');

// 将 JSON 数据解析为 PHP 数组
$data = json_decode($json_data, true);

// 获取用户名和密码
$username = $data['username'];
$raw_password = md5($data['password']);

// 生成token
function generateToken($length = 30) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charsLength = strlen($characters);
    $randomToken = '';

    for ($i = 0; $i < $length; $i++) {
        $randomToken .= $characters[rand(0, $charsLength - 1)];
    }

    return $randomToken;
}

//创建数据库连接
$conn = mysqli_connect("localhost", "root", "", "repairdb");

// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "连接成功";

//查询用户和密码的sql
$sql = "select * from tbl_admin where username = '$username' and password = '$raw_password'";

mysqli_query($conn, "set names utf8");

//执行查询语句
$result = mysqli_query($conn, $sql);

//统计结果的行数
$count = mysqli_num_rows($result);

if($count!=0){

    $randomToken = generateToken();

    $row['status']="1";
    $row['msg']="success";
    $row['token']=$randomToken;
}else{
    $row['status']="0";
    $row['msg']="fail";
}
echo(json_encode($row));
?>

