<?php
//check the uploaded images #single
function check_upimage($file="filename")
{

	$size=2048000;
	$upimg_allow = explode(',',"jpg,jpeg,gif,png");
	if($_FILES[$file]['size']>$size){
		echo "<script laguage=javascript>alert('文件太大'); history.back(-1);</script>";

	}

	if(!in_array(FileExt($_FILES[$file]['name']),$upimg_allow)){
		echo "<script laguage=javascript>alert('文件格式不正确');history.back(-1);</script>";
		exit();
	}

	if(!preg_match('/^image\//i',$_FILES[$file]['type'])){
		echo "<script laguage=javascript>alert('文件格式不正确'); history.back(-1); '</script>";
		exit();
	}
	return true;
}
//check the uploaded images #lots
function xmfone_check_upimage($file="filename")
{
	if(is_array($_FILES)){
		for($i=0;$i<count($_FILES);$i++){

			if($_FILES[$file.$i]['name']){

				check_upimage($file.$i);
			}
		}
	}
}
//check if uploaded the images
function upload_img_num($file="filename")
{
	if(is_array($_FILES)){
		$num = 0;
		for($i=0;$i<count($_FILES);$i++){
			$num = ($_FILES[$file.$i]['error'] != 4) ? ($num + 1) : $num;
		}
		return $num;
	}
	else return 0;
}

//stared uploading the images
function start_upload($file_name,$destination_folder,$watermark =0,$limit_width='',$limit_height='',$edit_filename='',$edit_pre_filename=''){
	global $xm_global;
	!is_uploaded_file($_FILES[$file_name]['tmp_name']) && write_msg ("请重新选择您要上传的图片!");
    $file = $_FILES[$file_name];
	@createdir(dirname(__FILE__)."/..".$xm_global[cfg_images_dir].$destination_folder);
    $file_name=$file["tmp_name"];
    $pinfo=pathinfo($file["name"]);
    $ftype=$pinfo['extension'];
    $fname=$pinfo[basename];


		$destination_file = time().random().".".$ftype;
		$destination = dirname(__FILE__)."/..".$xm_global[cfg_images_dir].$destination_folder.$destination_file;



    if (file_exists($destination)){

        echo "<script laguage=javascript>alert('同名图片已存在，请重新选择您要上传的图片！'); history.back(-1);</script>";
    }

    if(!move_uploaded_file($file_name, $destination)){
    	echo "<script laguage=javascript>alert('图片上传失败，请重新选择您要上传的图片！'); history.back(-1);</script>";

    }



$xmfone_image = $xm_global[cfg_images_dir].$destination_folder.$destination_file;


    return $xmfone_image;
}

function FileExt($filename) {
	return trim(substr(strrchr($filename, '.'), 1, 10));
}


function random($length=5,$strtolower=1)
{
	$hash = '';
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
	$max = strlen($chars) - 1;
	mt_srand((double)microtime() * 1000000);
	for($i = 0; $i < $length; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	if($strtolower==1){
		$hash=strtolower($hash);
	}
	return $hash;
}

?>