<?php

class SkiDiyMembers
{
    const EVA_START_IDX_2324 = 70;
    const LESSON_START_IDX_2324 = 47;
    const STUDETN_START_IDX_2324 = 18;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getMembersInfo($studentsInfo)
    {
        $membersInfo = [];

        //$emails = ['a@mail', 'b@mail'];

        foreach ($studentsInfo as $key) {

            $sql = "SELECT * FROM `skidiymembers`
                    WHERE `email`='{$key['email']}'
                    AND `name`='{$key['name']}'";
            $member = $this->db->query('SELECT', $sql);

            $info = [];

            if(empty($member))
            {
                //throw new \Exception("沒有這個帳號", 1);
                unset($data);
                $data['type'] = "student";
                $data['name'] = $key['name'];
                $data['email'] = $key['email'];
                $data['createTime'] = date('Y-m-d H:i:s');

                $res = $this->db->INSERT('skidiymembers', $data);

                $sql = "SELECT * FROM `skidiymembers`
                        WHERE `email`='{$key['email']}'
                        AND `name`='{$key['name']}'";
                $member = $this->db->query('SELECT', $sql);
            }

            $info['name'] = $member[0]['name'];
            $info['email'] = $member[0]['email'];
            $membersInfo[$member[0]['idx']] = $info;
        }

        return $membersInfo;


/*
        $sql = "SELECT * FROM `skidiymembers` WHERE `email`='{$email}'";
        $member = $this->db->query('SELECT', $sql);

        if(empty($member))
        {
            //throw new \Exception("沒有這個帳號", 1);
            unset($data);
            $data['type'] = "student";
            $data['name'] = $name;
            $data['email'] = $email;
            $data['createTime'] = date('Y-m-d H:i:s');

            $res = $this->db->INSERT('skidiymembers', $data);

            $sql = "SELECT * FROM `skidiymembers` WHERE `email`='{$email}'";
            $member = $this->db->query('SELECT', $sql);
            return $member;
        }
        else
            return $member;
            */
    }

    /*尋找沒有完成自我評量的學員清單*/
    public function getMembersInfoNotSelfEva()
    {
/*
        $sql = "SELECT `idx` FROM `skidiymembers` ORDER BY `idx` DESC LIMIT 1";
        $lastIdx = $this->db->query('SELECT', $sql)[0]['idx'];

        //var_dump($Idx);

        $membersInfo = [];

        $startIdxFor2324 = self::STUDETN_START_IDX_2324; //學生idx

        for($i=$startIdxFor2324; $i<=$lastIdx; $i++)
        {
            $sql = "SELECT * FROM `studentselfevaluation`
                    WHERE `studentIdx`='{$i}'";
            $member = $this->db->query('SELECT', $sql);

            if(empty($member))
            {
                $sql = "SELECT * FROM `skidiymembers`
                        WHERE `idx`='{$i}'";
                $member = $this->db->query('SELECT', $sql);

                $info['name'] = $member[0]['name'];
                $info['email'] = $member[0]['email'];
                $membersInfo[$member[0]['idx']] = $info;
            }
        }

        //$membersInfo['max'] = $lastIdx;

        return $membersInfo;
*/
        $startIdxFor2324 = self::STUDETN_START_IDX_2324; //學生idx

        $sql = "SELECT * FROM `skidiymembers` WHERE `idx` >= '{$startIdxFor2324}' ORDER BY `idx`";
        $info = $this->db->query('SELECT', $sql);

        foreach ($info as $key => $value) {
            $studentIdx = $value['idx'];
            //var_dump($studentIdx);
            $sql = "SELECT * FROM `studentselfevaluation`
                    WHERE `studentIdx`='{$studentIdx}'";
            $result = $this->db->query('SELECT', $sql);

            if(!empty($result))
                unset($info[$key]);
        }

        return $info;
    }

    /*尋找系統錯誤，課程紀錄跟評量紀錄需要同時存在，否則就是有問題*/
    public function getEvaluationLessonAndRecordMatchError()
    {
        $startIdxFor2324 = self::LESSON_START_IDX_2324;  //課程idx

        $sql = "SELECT * FROM `lessonRecords` WHERE `idx` >= '{$startIdxFor2324}' ORDER BY `idx`";
        $lessons = $this->db->query('SELECT', $sql);

        $studentList = [];
        $lessonList = [];
        $index = 0;
        $info = [];

        foreach ($lessons as $l) {
            $studentsIdx = json_decode($l['students']);
            
            foreach ($studentsIdx as $s)
            {
                $sIdx = intval($s);
                //var_dump($sIdx);
                $sql = "SELECT * FROM `evaluationRecords`
                    WHERE `studentIdx`='{$sIdx}'
                    AND `lessonIdx`='{$l['idx']}'";

                $record = $member = $this->db->query('SELECT', $sql);

                if(empty($record))
                {
                    $studentList = array_unique(array_merge ($studentList, [$sIdx]));
                    $info['pair'][$index++] = [$l['idx'], $sIdx];
                    $info['lesson'][$l['idx']] = $l;
                }
            }
        }

        if(!empty($studentList))
        {
            $sql = "SELECT * FROM `skidiymembers` WHERE `idx` IN (".implode(',',$studentList).")";
            $membersInfo = $this->db->query('SELECT', $sql);

            foreach($membersInfo as $mi)
            {
                $info['student'][$mi['idx']] = $mi;
            }
        }

        return $info;
    }

    /*帶著完成"自我評量時間"的會員資料*/
    public function getALLMembersInfo()
    {
        $startIdxFor2324 = self::STUDETN_START_IDX_2324; //學生idx

        $sql = "SELECT * FROM `skidiymembers` WHERE `idx` >= '{$startIdxFor2324}' ORDER BY `idx`";
        $info = $this->db->query('SELECT', $sql);

        foreach ($info as $key => $value) {
            $studentIdx = $value['idx'];
            //var_dump($studentIdx);
            $sql = "SELECT * FROM `studentselfevaluation`
                    WHERE `studentIdx`='{$studentIdx}'";
            $result = $this->db->query('SELECT', $sql);

            if(empty($result))
                $info[$key]['selfEvaUpdateTime'] = 'none';
            else
                $info[$key]['selfEvaUpdateTime'] = $result[0]['modifiedTime'];
        }

        return $info;
    }

    /*尚未完成評量的課程與學員資料*/
    public function getInfoNotEvaluated()
    {
        $startIdxFor2324 = self::EVA_START_IDX_2324; //課程idx

        //教練一旦點選評量連結，就會立刻產生評量紀錄，透過查詢紀錄更新時間與建立時間，看看是否已經有評量完成
        $sql = "SELECT * FROM `evaluationRecords`
                WHERE `idx` >= '{$startIdxFor2324}'
                AND `modifiedTime` = `createdTime`
                ORDER BY `idx`";
        $records = $this->db->query('SELECT', $sql);
        $info = [];
        $index = 0;
        $studentList = [];
        $lessonList = [];

        foreach ($records as $r) {
            $info['pair'][$index++] = [$r['lessonIdx'], $r['studentIdx']];
            $studentList = array_unique(array_merge ($studentList, [$r['studentIdx']]));
            $lessonList = array_unique(array_merge ($lessonList, [$r['lessonIdx']]));
        }

        //var_dump($studentList);
        //var_dump($lessonList);

        if(!empty($studentList))
        {
            $sql = "SELECT * FROM `skidiymembers` WHERE `idx` IN (".implode(',',$studentList).")";
            $membersInfo = $this->db->query('SELECT', $sql);

            foreach($membersInfo as $mi)
            {
                $info['student'][$mi['idx']] = $mi;
            }
        }

        if(!empty($lessonList))
        {
            $sql = "SELECT * FROM `lessonRecords` WHERE `idx` IN (".implode(',',$lessonList).")";
            $LessonsInfo = $this->db->query('SELECT', $sql);

            foreach($LessonsInfo as $li)
            {
                $info['lesson'][$li['idx']] = $li;
            }
        }

        return $info;
    }

    /*所有的評量紀錄*/
    public function getAllEvaluationInfo()
    {
        $startIdxFor2324 = self::EVA_START_IDX_2324; //課程idx

        $sql = "SELECT * FROM `evaluationRecords`
                WHERE `idx` >= '{$startIdxFor2324}'
                ORDER BY `idx`";
        $records = $this->db->query('SELECT', $sql);
        $info = [];
        $index = 0;
        $studentList = [];
        $lessonList = [];

        foreach ($records as $r) {
            if($r['modifiedTime'] == $r['createdTime'])
                $info['pair'][$index++] = [$r['lessonIdx'], $r['studentIdx'], 0];
            else
                $info['pair'][$index++] = [$r['lessonIdx'], $r['studentIdx'], 1];
            $studentList = array_unique(array_merge ($studentList, [$r['studentIdx']]));
            $lessonList = array_unique(array_merge ($lessonList, [$r['lessonIdx']]));
        }

        if(!empty($studentList))
        {
            $sql = "SELECT * FROM `skidiymembers` WHERE `idx` IN (".implode(',',$studentList).")";
            $membersInfo = $this->db->query('SELECT', $sql);

            foreach($membersInfo as $mi)
            {
                $info['student'][$mi['idx']] = $mi;
            }
        }

        if(!empty($lessonList))
        {
            $sql = "SELECT * FROM `lessonRecords` WHERE `idx` IN (".implode(',',$lessonList).")";
            $LessonsInfo = $this->db->query('SELECT', $sql);

            foreach($LessonsInfo as $li)
            {
                $info['lesson'][$li['idx']] = $li;
            }
        }

        return $info;
    }
}

?>