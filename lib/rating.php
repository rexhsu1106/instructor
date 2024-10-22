<?php
//namespace CALWORLD;

class Rating
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getEvaluationItems($type)
    {
        $sql = "SELECT * FROM `evaluationItems`
                WHERE `type` = '{$type}'
                ORDER BY `level`,`number` ASC";

        $items = $this->db->query('SELECT', $sql);

        return $items;
    }

    public function setEvaluationItems($type, $level, $itemNo, $id)
    {
        $sql = "SELECT * FROM `evaluationItems`
                WHERE `type` = '{$type}'
                AND `level` = '{$level}'
                AND `number` = '{$itemNo}'";

        $result = $this->db->query('SELECT', $sql);

        $data = [];

        if(empty($result)) //insert
        {
            $data['type'] = $type;
            $data['level'] = $level;
            $data['number'] = $itemNo;
            $data['mappingItemID'] = $id;

            $this->db->insert('evaluationItems', $data);
        }
        else //update
        {
            $where['idx'] = $result[0]['idx'];
            $data = $result[0];
            $data['mappingItemID'] = $id;

            $this->db->update('evaluationItems', $data, $where);
        }

        return "success";
    }

    public function getAbilityList($type)
    {
        $sql = "SELECT * FROM `abilityList` 
                WHERE `type` = '{$type}'
                ORDER BY `level`,`number` ASC";

        $items = $this->db->query('SELECT', $sql);

        return $items;
    }

    public function setAbilityList($type, $level, $itemNo, $item)
    {
        $sql = "SELECT * FROM `abilityList`
                WHERE `type` = '{$type}'
                AND `level` = '{$level}'
                AND `number` = '{$itemNo}'";

        $result = $this->db->query('SELECT', $sql);

        $data = [];

        if(empty($result)) //insert
        {
            $data['type'] = $type;
            $data['level'] = $level;
            $data['number'] = $itemNo;
            $data['item'] = $item;
            $data['explanation'] = '';

            $this->db->insert('abilityList', $data);
        }
        else //update
        {
            $where['idx'] = $result[0]['idx'];
            $data = $result[0];
            $data['item'] = $item;

            $this->db->update('abilityList', $data, $where);
        }

        return "success";
    }

    public function getRatingRecords($studentID)
    {
        $sql = "SELECT * FROM `evaluationRecords` WHERE `studentIdx` = '{$studentID}'";

        $records = $this->db->query('SELECT', $sql);
/*
        $lessons = [];
        $orderedRecords = []; 

        foreach ($records as $rec) {
            $sql = "SELECT * FROM `lessonRecords` WHERE `idx` = '{$rec['lessonIdx']}'";
            $l = $this->db->query('SELECT', $sql);
            $lessons[$l[0]['startDate']] = $l[0]['idx'];
        }

        ksort($lessons);

        foreach ($lessons as $key => $idx) {
            foreach ($records as $rec) {
                if($rec['lessonIdx']==$idx) {
                    array_push($orderedRecords, $rec);
                    break;
                }
            }
        }
*/
        return $records;
    }

    public function getRatingRecordsForOneLesson($studentID, $lessonID)
    {
        $sql = "SELECT * FROM `evaluationRecords`
                WHERE `studentIdx` = '{$studentID}'
                AND `lessonIdx` = '{$lessonID}'";

        $records = $this->db->query('SELECT', $sql);

        return $records;
    }

    public function setRatingRecords($type, $studentID, $lessonID, $comment, $instructor, $records)
    {
        $sql = "SELECT * FROM `evaluationRecords`
                WHERE `studentIdx` = '{$studentID}'
                AND `lessonIdx` = '{$lessonID}'";

        $result = $this->db->query('SELECT', $sql);

        $data = [];

        if(empty($result)) //insert
        {
            $data['studentIdx'] = $studentID;
            $data['lessonIdx'] = $lessonID;
            $data['knew'] = json_encode($records['knew']);
            $data['familiar'] = json_encode($records['familiar']);
            $data['excellent'] = json_encode($records['excellent']);
            $data['modifiedTime'] = date('Y-m-d H:i:s');
            $data['comment'] = $comment;
            $data['instructor'] = $instructor;

            $this->db->insert('evaluationRecords', $data);
        }
        else //update
        {
            $where['idx'] = $result[0]['idx'];
            $data = $result[0];
            $data['knew'] = json_encode($records['knew']);
            $data['familiar'] = json_encode($records['familiar']);
            $data['excellent'] = json_encode($records['excellent']);
            $data['modifiedTime'] = date('Y-m-d H:i:s');
            $data['comment'] = $comment;
            $data['instructor'] = $instructor;

            $this->db->update('evaluationRecords', $data, $where);
        }

        return "success";
    }

    public function getSelfRatingRecords($studentID)
    {
        $sql = "SELECT * FROM `studentSelfEvaluation` WHERE `studentIdx` = '{$studentID}'";

        $records = $this->db->query('SELECT', $sql);

        return $records;
    }

    public function setSelfRatingRecords($type, $studentID, $comment, $records)
    {
        $sql = "SELECT * FROM `studentSelfEvaluation`
                WHERE `studentIdx` = '{$studentID}'";

        $result = $this->db->query('SELECT', $sql);

        $data = [];

        if(empty($result)) //insert
        {
            $data['studentIdx'] = $studentID;
            $data['knew'] = json_encode($records['knew']);
            $data['familiar'] = json_encode($records['familiar']);
            $data['excellent'] = json_encode($records['excellent']);
            $data['modifiedTime'] = date('Y-m-d H:i:s');
            if($type == 'sb')
            {
                $data['commentSB'] = $comment;
                $data['commentSKI'] = "";
                $data['updateDateSB'] = (date('Y-m-d'));
                $data['updateDateSKI'] = "";
            }
            else
            {
                $data['commentSB'] = "";
                $data['commentSKI'] = $comment;
                $data['updateDateSB'] = "";
                $data['updateDateSKI'] = (date('Y-m-d'));
            }
            //$data['comment'] = $comment;

            $this->db->insert('studentSelfEvaluation', $data);
        }
        else //update
        {
            $where['idx'] = $result[0]['idx'];
            $data = $result[0];
            $data['knew'] = json_encode($records['knew']);
            $data['familiar'] = json_encode($records['familiar']);
            $data['excellent'] = json_encode($records['excellent']);
            $data['modifiedTime'] = date('Y-m-d H:i:s');
            if($type == 'sb')
            {
                $data['commentSB'] = $comment;
                $data['updateDateSB'] = (date('Y-m-d'));
            }
            else
            {
                $data['commentSKI'] = $comment;
                $data['updateDateSKI'] = (date('Y-m-d'));
            }
            //$data['comment'] = $comment;

            $this->db->update('studentSelfEvaluation', $data, $where);
        }

        return "success";
    }

    public function getLessonRecordsByIdx($lessonID)
    {
        $sql = "SELECT * FROM `lessonRecords` WHERE `idx` = '{$lessonID}'";

        $records = $this->db->query('SELECT', $sql);

        return $records;
    }

    public function getMultiLessonRecords($lessonIDs)
    {
        if(empty($lessonIDs))
            return [];

        $sql = "SELECT * FROM `lessonRecords` WHERE `idx` IN (".implode(',',$lessonIDs).")"." ORDER BY `startDate` ASC";

        $records = $this->db->query('SELECT', $sql);

        return $records;
    }

    private function getMultiLessonRecordsBeforeOneDate($lessonIDs, $date)
    {
        if(empty($lessonIDs))
            return [];

        $sql = "SELECT * FROM `lessonRecords` WHERE `idx` IN (".implode(',',$lessonIDs).")"." AND DATE(`startDate`) <= '{$date}' ORDER BY `startDate` ASC";

        $records = $this->db->query('SELECT', $sql);

        return $records;
    }

    public function getLessonRecordsByInstructor($type, $period, $instructor)
    {
        if($period == null)
            $sql = "SELECT * FROM `lessonRecords` WHERE `instructor` = '{$instructor}' ORDER BY `startDate` ASC";
        else
            $sql = "SELECT * FROM `lessonRecords`
                    WHERE `instructor` = '{$instructor}'
                    AND DATE(`startDate`) >= '{$period['start']}'
                    AND DATE(`startDate`) <= '{$period['end']}'
                    ORDER BY `startDate` ASC";

        $records = $this->db->query('SELECT', $sql);

        return $records;
    }

    public function getLessonRecordsByStudentID($type, $period, $studentIdx)
    {
        return [];
    }

    public function setLessonRecords($type, $lessonNo, $startDate, $endDate, $park, $instructor, $studentIDs)
    {
        $sql = "SELECT * FROM `lessonRecords`
                WHERE `lessonNo` = '{$lessonNo}'";

        $result = $this->db->query('SELECT', $sql);

        $data = [];

        if(empty($result)) //insert
        {
            //$newIdx = $this->db->query('SELECT', 'SELECT MAX(`idx`)+1 AS `idx` FROM `lessonRecords`');

            //$data['lessonNo'] = sprintf('S%02d%02d%d%03d', (int) substr(date('Y'),3,1),(int) date('i')+date('s'), (int) $newIdx[0]['idx'], rand(11,999));
            $data['lessonNo'] = $lessonNo;
            $data['type'] = $type;
            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate;
            $data['park'] = $park;
            $data['instructor'] = $instructor;
            $data['students'] = json_encode($studentIDs);
            $data['modifiedTime'] = date('Y-m-d H:i:s');

            $this->db->insert('lessonRecords', $data);

            $sql = "SELECT * FROM `lessonRecords`
                WHERE `lessonNo` = '{$lessonNo}'";
            $result = $this->db->query('SELECT', $sql);

            foreach ($studentIDs as $id) {
                $this->copyClosestEvaluationRecords($id, $startDate, $result[0]['idx'], $instructor);
            }

            return "add new";
        }
        else //update
        {

            $data = $result[0];

            if($data['lessonNo']!=$lessonNo || $data['type']!=$type || $data['startDate']!=$startDate
                 || $data['endDate']!=$endDate || $data['park']!=$park || $data['instructor']!=$instructor)
            {
                throw new Exception("課程資料不符合，請洽管理員", 1);
            }
            else
            {
                if($data['students']!=json_encode($studentIDs))
                {
                    throw new Exception("學生名單不符，請洽管理員", 1);
                    /*
                    $where['idx'] = $result[0]['idx'];
                    $data['students'] = json_encode($studentIDs);
                    $data['modifiedTime'] = date('Y-m-d H:i:s');
                    $this->db->update('lessonRecords', $data, $where);
                    $this->checkStudentsInLessonRecord(json_decode($result[0]['students']), $studentIDs, $startDate, $data['idx'], $instructor);
                    */
                }
            }
        }

        return "success";
    }

    public function deleteLessonRecords($type, $lessonIdx)
    {
        $sql = "SELECT * FROM `lessonRecords`
                WHERE `idx` = '{$lessonIdx}'";

        $lesson = $this->db->query('SELECT', $sql);

        if(empty($lesson)) //insert
        {
            throw new Exception("找不到這一個課程", 1);
        }
        else if(count($lesson) > 1)
        {
            throw new Exception("超過一個課程在記錄表上", 1);
        }
        else
        {
            $sql = "SELECT * FROM `evaluationRecords`
                WHERE `lessonIdx` = '{$lessonIdx}'";

            $records = $this->db->query('SELECT', $sql);
            foreach ($records as $rec) {
                unset($where);
                $where['idx'] = $rec['idx'];
                $this->db->delete('evaluationRecords', $where); 
            }

            unset($where);
            $where['idx'] = $lesson[0]['idx'];
            $this->db->delete('lessonRecords', $where); 
        }
    }

    private function checkStudentsInLessonRecord($oldStudentIDs, $newStudentIDs, $startDate, $lessonIdx, $instructor)
    {
        //find remove elements
        $diff = array_diff($oldStudentIDs, $newStudentIDs);
        if(!empty($diff))
        {
            foreach ($diff as $id) {
                //throw new Exception("Not support to remove student", 1);
                //remove related evaluation records
                $this->deleteEvaluationRecords($id, $lessonIdx);
            }
        }

        $diff = array_diff($newStudentIDs, $oldStudentIDs);
        if(!empty($diff))
        {
            foreach ($diff as $id) {
                $this->copyClosestEvaluationRecords($id, $startDate, $lessonIdx, $instructor);
            }
        }
    }
    private function deleteEvaluationRecords($studentIdx, $lessonIdx)
    {
        $sql = "SELECT * FROM `evaluationRecords`
                WHERE `studentIdx` = '{$studentIdx}'
                AND `lessonIdx` = '{$lessonIdx}'";

        $records = $this->db->query('SELECT', $sql);

        if(!empty($records))
        {
            foreach ($records as $rec) {
                unset($where);
                $where['idx'] = $rec['idx'];
                $this->db->delete('evaluationRecords', $where);       
            }   
        }
    }
    /*
    if insert a student in a lesson, have to evaluation for this student at that lesson, so find the closest evaluation records before that lesson, and copy the evaluation results.
    */
    private function copyClosestEvaluationRecords($studentIdx, $startDate, $NewlessonIdx, $instructor)
    {
        //check if the evaluation records of  
        $sql = "SELECT * FROM `evaluationRecords`
                WHERE `studentIdx` = '{$studentIdx}'
                AND `lessonIdx` = '{$NewlessonIdx}'";

        $records = $this->db->query('SELECT', $sql);

        if(!empty($records))
            throw new Exception("有重複的評量紀錄", 1);

        //find if any evaluation records for this student
        $sql = "SELECT * FROM `evaluationRecords`
                WHERE `studentIdx` = '{$studentIdx}'";

        $records = $this->db->query('SELECT', $sql);

        //if records is not empty, copy latest rating record
        if(!empty($records))
        {
            $lessonIDs = [];
            foreach ($records as $rec) {
                array_push($lessonIDs, $rec['lessonIdx']);
            }
            //find all lessons which are sorted by start date
            $lessonRecords = $this->getMultiLessonRecordsBeforeOneDate($lessonIDs, $startDate);

            if(!empty($lessonRecords))
            {
                $closestLessonIdx = end($lessonRecords)['idx'];
                $sql = "SELECT * FROM `evaluationRecords`
                        WHERE `studentIdx` = '{$studentIdx}'
                        AND `lessonIdx` = '{$closestLessonIdx}'";

                $evaluationRecord = $this->db->query('SELECT', $sql);
                if(!empty($evaluationRecord))
                {
                    unset($data);    
                    $data['studentIdx'] = $studentIdx;
                    $data['lessonIdx'] = $NewlessonIdx;
                    $data['knew'] = $evaluationRecord[0]['knew'];
                    $data['familiar'] = $evaluationRecord[0]['familiar'];
                    $data['excellent'] = $evaluationRecord[0]['excellent'];
                    $data['modifiedTime'] = date('Y-m-d H:i:s');
                    $data['comment'] = "";
                    $data['instructor'] = $instructor;//$evaluationRecord[0]['instructor'];

                    $this->db->insert('evaluationRecords', $data);
                }
            }
            else
                return 0;
        }
        else //if records is empty, create a new rating record with 'null' ratings
        {
            unset($data);    
            $data['studentIdx'] = $studentIdx;
            $data['lessonIdx'] = $NewlessonIdx;
            $data['knew'] = 'null';
            $data['familiar'] = 'null';
            $data['excellent'] = 'null';
            $data['modifiedTime'] = date('Y-m-d H:i:s');
            $data['comment'] = "";
            $data['instructor'] = $instructor;

            $this->db->insert('evaluationRecords', $data);
        }
        return 0;
    }
}

?>