<?php
header('Content-Type: application/json');

// 获取请求体中的 JSON 数据
$json_data = file_get_contents('php://input');

// 将 JSON 数据解析为 PHP 数组
$data = json_decode($json_data, true);

$aid = $data['aid'];

$conn = mysqli_connect("localhost","root","","repairdb");
if(!$conn){
    die(json_encode(['code' => 0, 'msg' => "数据库连接失败: " . mysqli_connect_error()]));
}

// 使用预处理语句删除数据，防止SQL注入
$stmt = mysqli_prepare($conn, "DELETE FROM tbl_admin WHERE aid = ?");
if ($stmt === false) {
    die(json_encode(['code' => 0, 'msg' => "准备语句失败: " . mysqli_error($conn)]));
}

mysqli_stmt_bind_param($stmt, "i", $aid);
$result = mysqli_stmt_execute($stmt);

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