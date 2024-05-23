<?php

header('Content-Type: application/json');

// 获取请求体中的 JSON 数据
$json_data = file_get_contents('php://input');

// 将 JSON 数据解析为 PHP 数组
$data = json_decode($json_data, true);

$username = $data['username'];
$password = $data['password'];
$realname = $data['realname'];
$phone_num = $data['phone_num'];

// //进行后端表单验证
// if(!strlen($realname) || !strlen($username)){
//     $_SESSION['check'] = "<div class='error text-center'>用户名和密码都必须填写</div>";
//     header('location:'. '/admin/add_repairMan.php');
//     exit;
// }
// if(strlen($password)<6 || strlen($password)>10){
//     $_SESSION['check'] = "<div class='error text-center'>密码长度不符</div>";
//     header('location:'. '/admin/add_repairMan.php');
//     exit;
// }
// if(!strlen($phone_num)){
//     $_SESSION['check'] = "<div class='error text-center'>手机号必须填写</div>";
//     header('location:'. '/admin/add_repairMan.php');
//     exit;
// }else{
//     //进行邮箱格式校验，preg_match()返回正则表达式匹配次数
//     if(!preg_match('/^[0-9]{11}$/', $phone_num)){
//         $_SESSION['check'] = "<div class='error text-center'>手机号格式不正确</div>";
//         header('location:'. '/admin/add_repairMan.php');
//         exit;
//     }
// }

$conn = mysqli_connect("localhost","root","","repairdb");
if(!$conn){
    die("Connection failed:" . mysqli_connect_error());
}

$raw_password = md5($password);
$sql = "INSERT INTO tbl_admin(username,password,role,realname,phone_num)
        VALUES('$username','$raw_password','B','$realname','$phone_num')";

$result = mysqli_query($conn, $sql);

// 初始化一个数组用于保存数据
$rdata = array();

// 检查是否成功执行了语句
if($result){
    $rdata['code'] = 1;
    $rdata['msg'] = "操作成功";
}else{
    $rdata['code'] = 0;
    $rdata['msg'] = "操作失败: " . mysqli_error($conn);
}

// 将结果转换为 JSON 格式并输出
echo json_encode($rdata);

//关闭连接
mysqli_close($conn);
?>