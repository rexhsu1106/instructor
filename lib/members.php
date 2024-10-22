<?php
//namespace CALWORLD;

class Members
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getMultiMembersBasicInfo($membersID)
    {
        $membersInfo = [];

        foreach ($membersID as $key) {
            $sql = "SELECT * FROM `members` WHERE `idx`='{$key}'";
            $member = $this->db->query('SELECT', $sql);

            $info = [];

            if(empty($member))
                throw new \Exception("找不到ID為{$key}的會員資料", 1);
            else
            {
                $info['name'] = $member[0]['name'];
                $info['email'] = $member[0]['email'];
                $membersInfo[$member[0]['idx']] = $info;
            }
        }

        return $membersInfo;
    }

    public function getMembersInfoByEmail($email)
    {
        $membersInfo = [];

        $sql = "SELECT * FROM `members` WHERE `email`='{$email}'";
        $member = $this->db->query('SELECT', $sql);

        if(empty($member))
                throw new \Exception("沒有這個帳號", 1);
        else
            return $member;
    }
}

?>