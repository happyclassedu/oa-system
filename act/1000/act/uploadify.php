<?php
/* 
 * 文件名称：ajax_list_test.php
 * 功能描述：测试文件。
 * 代码作者：qianbaowei
 * 当前版本：V1.0
 * 创建日期：2010-05-24
 * 修改日期：2010-05-24
*/

include_once '../inc/common.php';
exit;
if (!empty($_FILES)) {
    $file_tmp = $_FILES['file_data']['tmp_name'];
//    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
//    $targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
//    $file_src =  'c:/var/www/hr_oa_act/1000/act/' . $_FILES['file_data']['name'];
//    echo $_GET['i_name'];
    $tmp = $_POST['i_name'];
    $file_src =  g_doc.'tmp/'.$tmp . '.jpg';
//    $file_src =  g_doc.'tmp/abc.jpg';
//	$newFileName = $_GET['name'].'_'.(($_GET['location'] != '')?$_GET['location'].'_':'').$_FILES['Filedata']['name'];
//	$targetFile =  str_replace('//','/',$targetPath) . $newFileName;

    // $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
    // $fileTypes  = str_replace(';','|',$fileTypes);
    // $typesArray = split('\|',$fileTypes);
    // $fileParts  = pathinfo($_FILES['Filedata']['name']);

    // if (in_array($fileParts['extension'],$typesArray)) {
    // Uncomment the following line if you want to make the directory if it doesn't exist
    // mkdir(str_replace('//','/',$targetPath), 0755, true);

    move_uploaded_file($file_tmp, $file_src);
    echo '照片“ '.$_FILES['file_data']['name'].' ”上传成功！';
    // } else {
    // 	echo 'Invalid file type.';
    // }
}
?>