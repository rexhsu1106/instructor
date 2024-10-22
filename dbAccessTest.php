<?php
require('lib/cj.db.class.php');
require('lib/rating.php');
require('lib/members.php');
require('lib/account.php');
require('lib/skidiymembers.php');
//require('lib/teachingRecord.php');


$db = new DB();
$rating = new Rating($db);
$member = new Members($db);
$account = new Account($db);
$diymember = new SkiDiyMembers($db);
//$teachingRecord = new TeachingRecord($db);

$type = "ski";
$year = 1;
$day = 6;
$level = 4;
$ability = "新手測試";
$evaluation = "test";
$qNum = 3;
$question = "問題11";
$description = "技術描述11";
$suggestion = "參加吧11";

$period['start'] = '2018-07-22';
$period['end'] = '2018-07-22';

$mail['ToAddresses'] = ['gis91597@yahoo.com.tw'];
$mail['Text'] = '今天天氣好';
$mail['Subject'] = '測試';

//$result = $account->sendEmail($mail);
//$result = $account->updatePassword("維倫", "wolf15tw@gmail.com", md5("123"), md5("123"));

//$result = $diymember->getInfoNotEvaluated();
$result = $diymember->getALLMembersInfo();
//var_dump($result);

/*
try{

$record['instructor'] = "CJ admin";
$record['date'] = "2018-09-11";

$record['orderNo'] = "0";
$record['name'] = "a";
$result = $teachingRecord->lookupStudentRecords($record);

$json = json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
echo '<pre>'.$json.'</pre>';

}
catch (Exception $e){
	echo json_encode('Error: '.$e->getMessage());
}
*/
?>

<?php
/*
require('PHPMailer/Exception.php');
require('PHPMailer/PHPMailer.php');
require('PHPMailer/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//include "PHPMailer/Exception.php";
//include "PHPMailer/PHPMailer.php";
//include "PHPMailer/SMTP.php";

//namespace PHPMailer\PHPMailer;

$mail = new PHPMailer(true);


$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com"; //SMTP服務器
$mail->Port = 465; //SSL預設Port 是465, TLS預設Port 是587
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //使用SSL, 如果是TLS 請改為 PHPMailer::ENCRYPTION_STARTTLS
$mail->Username = "itwchsu"; // 這裡填寫你的SMTP登入帳號, 例如 your.gmail.name@gmail.com 則填寫your.gmail.name
//$mail->Password = "Afwfwnbf123"; //這裡填寫你的SMTP登入密碼. 即是Gmail的密碼
$mail->Password = "rcye jbmx pkhi ylqd";

echo "success1\n";

$mail->From = "itwchsu@gmail.com"; //設定寄件人電郵
$mail->FromName = "Rex Hsu"; //設定寄件人名稱
$mail->Subject = "This is my test email"; //設定郵件主題
$mail->Body = "This is email body";  //設定郵件內容
echo "success2\n";
$mail->IsHTML(true);  //設定是否使用HTML格式
$mail->addAddress("gis91597@yahoo.com.tw", "person A"); //設定收件人電郵及名稱
//$mail->addCC("personC@gmail.com", "person C"); //設定收件人電郵及名稱(CC)
//$mail->addBCC("personD@gmail.com", "person D"); //設定收件人電郵及名稱(BCC)
//$mail->addAttachment("image1.jpg", "picture.jpg"); //設定附件, 對方會看到附件名稱為 picture.jpg
echo "success3\n";

if(!$mail->Send()){
  echo "Mailer error: " . $mail->ErrorInfo;
}
else{
  echo "Email sent";
}
*/
?>


