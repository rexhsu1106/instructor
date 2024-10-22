<?php

class Schedule
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getSchedules($instructor, $type, $periodStart, $periodEnd)
    {
        $sql = "SELECT * FROM `privateSchedules`
                WHERE `instructor` = '{$instructor}'
                AND DATE(`date`) >= '{$periodStart}'
                AND DATE(`date`) <= '{$periodEnd}'";
        
        $info = $this->db->query('SELECT', $sql);

        return $info;
    }

    private function createNewSchedule($schedule)
    {
        $sql = "SELECT * FROM `privateSchedules`
                WHERE `instructor` = '{$schedule['instructor']}'
                AND `date` = '{$schedule['date']}'";
        
        $info = $this->db->query('SELECT', $sql);

        if(!empty($info))
            throw new Exception("已經有舊的行程，無法新增", 1);
        else
        {
            unset($data);
            $data['instructor'] = $schedule['instructor'];
            $data['park'] = $schedule['park'];
            $data['date'] = $schedule['date'];
            $data['type'] = "both";
            $data['createDateTime'] = date('Y-m-d H:i:s');

            $this->db->insert('privateSchedules', $data);
            return "success";
        }
    }

    public function deleteSchedule($schedule)
    {
        //unset($where);
        //$where['instructor'] = $schedule['instructor'];
        //$where['date'] = $schedule['date'];
        //$this->db->delete('privateSchedules', $where); 

        $sql = "UPDATE `privateSchedules`
                SET `park` = 'none'
                WHERE `instructor` = '{$schedule['instructor']}'
                AND `date` = '{$schedule['date']}'";

        $info = $this->db->query('UPDATE', $sql);

        return "success";
    }

    public function updateSchedule($schedule)
    {
        $sql = "SELECT * FROM `privateSchedules`
                WHERE `instructor` = '{$schedule['instructor']}'
                AND `date` = '{$schedule['date']}'";
        
        $info = $this->db->query('SELECT', $sql);

        if(empty($info))
        {
            $this->createNewSchedule($schedule);
        }
        else
        {
            $sql = "UPDATE `privateSchedules`
                    SET `park` = '{$schedule['park']}' 
                    WHERE `instructor` = '{$schedule['instructor']}'
                    AND `date` = '{$schedule['date']}'";

            $info = $this->db->query('UPDATE', $sql); 
        }

        return "success";
    }

    public function deleteSchedulesPatch($instructor, $periodStart, $periodEnd)
    {/*
        $sql = "DELETE FROM `privateSchedules`
                WHERE `instructor` = '{$instructor}'
                AND `date` BETWEEN '{$periodStart}' AND '{$periodEnd}'";

        $info = $this->db->query('DELETE', $sql);
*/
        $sql = "UPDATE `privateSchedules`
                SET `park` = 'none'
                WHERE `instructor` = '{$instructor}'
                AND `date` BETWEEN '{$periodStart}' AND '{$periodEnd}'";

        $info = $this->db->query('UPDATE', $sql);

    }

    public function increaseSchedulesPatch($instructor, $park, $periodStart, $periodEnd)
    {
        $date = new DateTime($periodStart);
        $endDate = new DateTime($periodEnd);
        $period = $endDate->diff($date)->days + 1;

        $format = "2020-05-04";

        for($i=0; $i<$period; $i++)
        {
            $format = $date->format('Y-m-d');

            $date->add(new DateInterval('P1D')); 

            $sql = "SELECT * FROM `privateSchedules`
                WHERE `instructor` = '{$instructor}'
                AND `date` = '{$format}'";

            $info = $this->db->query('SELECT', $sql);

            if(!empty($info))   //會蓋掉原本舊有的行程
            {
                $sql = "UPDATE `privateSchedules`
                    SET `park` = '{$park}' 
                    WHERE `instructor` = '{$instructor}'
                    AND `date` = '{$format}'";

                $this->db->query('UPDATE', $sql);
            }
            else
            {
                unset($data);
                $data['instructor'] = $instructor;
                $data['park'] = $park;
                $data['date'] = $format;
                $data['type'] = "both";
                $data['createDateTime'] = date('Y-m-d H:i:s');

                $this->db->insert('privateSchedules', $data);
            }
        }
    }
}


