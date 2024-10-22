<?php

class BasicInfo
{
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getParkInfo($park = null)
    {
        $sql = "SELECT * FROM `parkInfo`";

        $info = $this->db->query('SELECT', $sql);

        if( sizeof($info)==0 ){
            throw new \Exception('No park info.');
        }

        $data = [];
        foreach ($info as $n => $park) {
            //$park->timeslot = json_decode($park->timeslot);
            $key = $park['name'];
            //unset($park->idx, $park->name, $park->timestamp);
            //unset($park->timestamp);
            $data[$key] = (array) $park;
        }
        return $data;
    }
}


