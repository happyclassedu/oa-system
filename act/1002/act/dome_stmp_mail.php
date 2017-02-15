<?php
/*
 * 文件名称：mod_base_info.php
 * 功能描述：信息管理基础模型
 * 代码作者：孙振强（创建、重构）
 * 创建时间：2010-07-08
 * 修改时间：2010-07-08
 * 当前版本：v1.0
*/
include_once '../inc/common.php';

$tmp = i_mail_send('mirrado@163.com;haha', 'hah欢456迎来到cgsird.com！', '123<br>哈哈<hr>456');

print_r($tmp);

//i_mail_send($mail_addr, $mail_subject, $mail_body, $mail_replyto='')
//功能：可给多人发送邮件，邮件分割符可为";"，"，"，"；"，","。最好为";"。空格将被过滤。
//参数：$mail_addr，收件人邮箱地址。
//参数：$mail_subject，邮件主题。
//参数：$mail_body，邮件内容。
//参数：$mail_replyto，回复邮箱地址，可为空。
//返回：true or 错误提示。
//示例：$tmp = i_mail_send('800@lianhuren.com', '欢迎访问莲湖人才网！', '123<br>哈哈<hr>456');;

?>