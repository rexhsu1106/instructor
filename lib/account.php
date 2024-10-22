<?php
//namespace CALWORLD;

class Account
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
    * Decrypt data from a CryptoJS json encoding string
    *
    * @param mixed $passphrase
    * @param mixed $jsonString
    * @return mixed
    */
    function cryptoJsAesDecrypt($passphrase, $jsonString){
        $jsondata = json_decode($jsonString, true);
        $salt = hex2bin($jsondata["s"]);
        $ct = base64_decode($jsondata["ct"]);
        $iv  = hex2bin($jsondata["iv"]);
        $concatedPassphrase = $passphrase.$salt;
        $md5 = array();
        $md5[0] = md5($concatedPassphrase, true);
        $result = $md5[0];
        for ($i = 1; $i < 3; $i++) {
            $md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
            $result .= $md5[$i];
        }
        $key = substr($result, 0, 32);
        $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
        return json_decode($data, true);
    }

    /**
    * Encrypt value to a cryptojs compatiable json encoding string
    *
    * @param mixed $passphrase
    * @param mixed $value
    * @return string
    */

    function cryptoJsAesEncrypt($passphrase, $value){
        $salt = openssl_random_pseudo_bytes(8);
        $salted = '';
        $dx = '';
        while (strlen($salted) < 48) {
            $dx = md5($dx.$passphrase.$salt, true);
            $salted .= $dx;
        }
        $key = substr($salted, 0, 32);
        $iv  = substr($salted, 32,16);
        $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
        $data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
        return json_encode($data);
    }

    function base64url_encode($data) {
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    function base64url_decode($data) {
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    public function createAccount($name, $email, $password)
    {
        // 檢查成員是否已存在
        $existingMember = $this->db->select("SELECT * FROM members WHERE email = :email", [':email' => $email]);
        
        if (empty($existingMember)) {
            // 如果成員不存在，創建新成員
            $newMember = [
                'type' => 'student',
                'memberID' => $name,
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'createTime' => date('Y-m-d H:i:s')
            ];
            
            // 使用 AI.db.class.php 中的 insert 方法創建新成員
            $this->db->insert('members', $newMember);
            
            // 成功創建新成員
            return true;
        } else {
            // 成員已存在，拋出異常
            throw new Exception("該電子郵件地址已被使用", 1);
        }
    }

    public function updatePassword($name, $email, $password, $newPassword)
    {
        $sql = "SELECT * FROM `members`
                WHERE `name` = '{$name}'
                AND `email` = '{$email}'
                AND `password` = '{$password}'";

        $member = $this->db->query('SELECT', $sql);

        if(empty($member))
        {
            throw new Exception("舊密碼錯誤", 1);
        }
        else
        {
            unset($data);
            unset($where);
            $where['idx'] = $member[0]['idx'];
            $data = $member[0];
            $data['password'] = $newPassword;
            $res = $this->db->UPDATE('members', $data, $where);
        }
    }

    public function checkAccount($account, $password)
    {
        $sql = "SELECT * FROM `members` WHERE `email` = :email";
        $params = [':email' => $account];

        $member = $this->db->select($sql, $params);

        if (empty($member)) {
            $_SESSION['member'] = null;
            throw new Exception("沒有這個帳號", 1);
        }

        $member = $member[0]; // 假設 select 方法返回一個數組

        // 比較密碼
        if ($password !== $member['password']) {
            $_SESSION['member'] = null;
            throw new Exception("密碼錯誤", 1);
        }

        $_SESSION['member'] = $member;
        return true;
    }

    public function loadInstructor()
    {
        $sql = "SELECT * FROM `members`
                WHERE `type` = 'instructor'
                OR `type` = 'admin'
                ORDER BY `name` ASC";

        $member = $this->db->query('SELECT', $sql);
        $instructor = [];
        foreach ($member as $m) {
            if(!in_array($m['name'], $instructor))
            {
                array_push($instructor, $m['name']);
            }
        }
        return $instructor;
    }

    public function sendEmail($data)
    {
        if ( !is_array($data['ToAddresses']) or empty($data['ToAddresses']) ) {
            throw new \Exception('Address is not an array!');
        }

        $provider = CredentialProvider::ini('default', '/.aws/credentials');
        $provider = CredentialProvider::memoize($provider);

        $ses = new \Aws\Ses\SesClient([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'credentials' => $provider,
        ]);

//ses-smtp-user.20231117-063807
//AKIASZ3Y2XAYWZOM24VT
//BNzbatKPTO7BZGsh2L8/gFEOyskoHMfHPHbKox1ojYdI
/*
{
    "Version": "2012-10-17",
    "Statement": [
        {
            "Effect": "Allow",
            "Action": "ses:SendRawEmail",
            "Resource": "*"
        }
    ]
}
*/

        return $ses->sendEmail([
            'Destination' => [
                //'BccAddresses' => ['ericko@inn-com.tw', 'yihui.chen17@gmail.com'],
                'ToAddresses' => $data['ToAddresses'],
            ],
            'Message' => [
                'Body' => [
                    'Text' => [
                        'Charset' => 'UTF-8',
                        'Data' => $data['Text'],
                    ],
                ],
                'Subject' => [
                    'Charset' => 'UTF-8',
                    'Data' => $data['Subject'],
                ],
            ],
            'Source' => '=?utf8?B?'.base64_encode('SKIDIY 自助滑雪').'?=<itwchsu@gmail.com>',
        ]);
    }

    public function sendAuthenticationEmail($act, $code1, $code2){
        //$crypto = new crypto();
        //$idx = $crypto->ev($m['idx']);
        //$info1 = $crypto->ev($code1);   //email
        //$info2 = $crypto->ev($code2);   //fbid
        $link = HOST."/authentication.php?act={$act}&code1={$code1}&code2={$code2}";
        $context = "您好,\n\n請您點擊下面連結來驗證電子郵件，\n\n{$link}\n\n\n\n如有任何疑問歡迎來信寄到 itwchsu@gmail.com 我們將儘速回覆您。";

        var_dump($context); //for cj debug

        try{
            $result = $this->sendEmail([
                'ToAddresses'   => [$code1,],
                'Text'          => $context,
                'Subject'       => '🏂 電子郵件信箱確認信',
            ]);
        }catch(Exception $e){
            $_msg = json_encode( array('message'=>$e->getMessage() ), JSON_UNESCAPED_UNICODE);
            _log($_msg, 'aws');
            return false;
        }//catch
    }//sendAuthenticationEmail
}
?>
