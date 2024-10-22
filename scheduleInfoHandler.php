<?php
require('lib/cj.db.class.php');
require('lib/schedule.php');

$db = new DB();
$schedule = new Schedule($db);

function getSchedules($instructor, $periodStart, $periodEnd)
{
	global $schedule;

 	try{
		$result = $schedule->getSchedules($instructor, 'both', $periodStart, $periodEnd);

		$startDate = new DateTime($periodStart);
		$endDate = new DateTime($periodEnd);
		$period = $endDate->diff($startDate)->days + 1;
		//$classNum = count((array)$parkInfo[$park]['timeslot']);

		for($i=0; $i<($period); $i++)
		{
			$scheduleByMonth[$i]['name'] = "none";
		}
		
		foreach($result as $s)
		{
			$date = new DateTime($s['date']);
			$startDate = new DateTime($periodStart);
			$diff = $date->diff($startDate)->days;
			$scheduleByMonth[$diff]['name'] = $s['park'];
		}

		echo json_encode($scheduleByMonth);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function storeSchedules($instructor, $schedules)
{
	global $schedule;

	$info['instructor'] = $instructor;
	$info['type'] = 'both';

	try{
		foreach($schedules as $date => $s)
		{
			$DATE = new DateTime($date);
			$info['date'] = $DATE->format('Y-m-d');
			$info['park'] = $s['park'];
			
			if($s['status']=='open')
			{
				$schedule->updateSchedule($info);
			}
			else if($s['status']=='close')
			{
				$schedule->deleteSchedule($info);
			}
			else if($s['status']=='update')
			{
				$schedule->updateSchedule($info);
			}
			
		}
		echo json_encode("success");
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function deleteSchedulesPatch($instructor, $periodStart, $periodEnd)
{
	global $schedule;

	try{
		$schedule->deleteSchedulesPatch($instructor, $periodStart, $periodEnd);
		echo json_encode("success");
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function increaseSchedulesPatch($instructor, $park, $periodStart, $periodEnd)
{
	global $schedule;

	try{
		$schedule->increaseSchedulesPatch($instructor, $park, $periodStart, $periodEnd);
		echo json_encode("success");
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

if(isset($_POST['func']) && !empty($_POST['func'])) {
	$function = $_POST['func'];
	$instructor = $_POST['instructor'];
	$periodStart = $_POST['periodStart'];
	$periodEnd = $_POST['periodEnd'];
	$schedules = $_POST['schedules'];
	$park = $_POST['park'];

	switch($function) {
		case 'getSchedules':
			getSchedules($instructor, $periodStart, $periodEnd);
			break;
		case 'storeSchedules':
			storeSchedules($instructor, $schedules);
			break;
		case 'deleteSchedulesPatch':
			deleteSchedulesPatch($instructor, $periodStart, $periodEnd);
			break;
		case 'increaseSchedulesPatch':
			increaseSchedulesPatch($instructor, $park, $periodStart, $periodEnd);
			break;
		default:
			break;
	}
}
?>