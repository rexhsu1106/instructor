<?php
require('lib/cj.db.class.php');
require('lib/basicInfo.php');

$db = new DB();
$basic = new BasicInfo($db);

function parkList()
{
	global $basic;
	$result = $basic->getParkInfo();

	foreach ($result as $parkname => $parkInfo) {
		$list[$parkname]['cname'] = $parkInfo['cname'];
		$list[$parkname]['maxStudentNum'] = $parkInfo['maxStudentNum'];
		$list[$parkname]['timeslot'] = json_decode($parkInfo['timeslot']);;
		$list[$parkname]['courseHours'] = $parkInfo['courseHours'];
	}
	ksort($list);
	
 	echo json_encode($list);
}

if(isset($_POST['func']) && !empty($_POST['func'])) {
	$function = $_POST['func'];

	switch($function) {
		case 'parkList':
			parkList();
			break;
		default:
			break;
	}
}
?>