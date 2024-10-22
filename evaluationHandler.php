<?php

require('lib/cj.db.class.php');
require('lib/rating.php');
require('lib/members.php');


$db = new DB();
$rating = new Rating($db);
$member = new Members($db);

function loadEvaluationItems($type)
{
	global $rating;

	try{
		$items = $rating->getEvaluationItems($type);
		echo json_encode($items);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function setEvaluationItems($type, $level, $itemNo, $mappingID)
{
	global $rating;

	try{
		$result = $rating->setEvaluationItems($type, $level, $itemNo, $mappingID);
		echo json_encode("success");
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadAbilityList($type)
{
	global $rating;

	try{
		$items = $rating->getAbilityList($type);
		echo json_encode($items);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function setAbilityList($type, $level, $itemNo, $item)
{
	global $rating;

	try{
		$result = $rating->setAbilityList($type, $level, $itemNo, $item);
		echo json_encode("success");
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadRatingRecords($studentID)
{
	global $rating;

	try{
		$records = $rating->getRatingRecords($studentID);
		echo json_encode($records);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadRatingRecordsForOneLesson($type, $studentID, $lessonID)
{
	global $rating;

	try{
		$records = $rating->getRatingRecordsForOneLesson($studentID, $lessonID);
		echo json_encode($records);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function setRatingRecords($type, $studentID, $lessonID, $comment, $instructor, $records)
{
	global $rating;

	try{
		$result = $rating->setRatingRecords($type, $studentID, $lessonID, $comment, $instructor, $records);
		echo json_encode("success");
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadSelfRatingRecords($studentID)
{
	global $rating;

	try{
		$records = $rating->getSelfRatingRecords($studentID);
		echo json_encode($records);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function setSelfRatingRecords($type, $studentID, $comment, $records)
{
	global $rating;

	try{
		$result = $rating->setSelfRatingRecords($type, $studentID, $comment, $records);
		echo json_encode("success");
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadLessonRecordsByIdx($lessonID)
{
	global $rating;

	try{
		$records = $rating->getLessonRecordsByIdx($lessonID);
		echo json_encode($records);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadMultiLessonRecords($lessonIDs)
{
	global $rating;

	try{
		$records = $rating->getMultiLessonRecords($lessonIDs);
		echo json_encode($records);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadLessonRecordsByInstructor($type, $period, $instructor)
{
	global $rating;

	try{
		$records = $rating->getLessonRecordsByInstructor($type, $period, $instructor);
		echo json_encode($records);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadLessonRecordsByStudentID($type, $period, $studentID)
{
	global $rating;

	try{
		$records = $rating->getLessonRecordsByStudentID($type, $period, $studentID);
		echo json_encode($records);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function setLessonRecords($type, $lessonNo, $startDate, $endDate, $park, $instructor, $studentIDs)
{
	global $rating;

	try{
		$result = $rating->setLessonRecords($type, $lessonNo, $startDate, $endDate, $park, $instructor, $studentIDs);
		if($result=='add new')
			echo json_encode("add new");
		else
			echo json_encode("success");
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function deleteLessonRecords($type, $lessonID)
{
	global $rating;

	try{
		$result = $rating->deleteLessonRecords($type, $lessonID);
		echo json_encode("success");
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

if(isset($_POST['func']) && !empty($_POST['func'])) {
	$function = $_POST['func'];
	$type = $_POST['type'];
	$level = $_POST['level'];
	$itemNo = $_POST['itemNo'];
	$mappingID = $_POST['mappingID'];
	$item = $_POST['item'];
	$studentID = $_POST['studentID'];
	$records = $_POST['records'];
	$lessonNo = $_POST['lessonNo'];
	$lessonID = $_POST['lessonID'];
	$instructor = $_POST['instructor'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$park = $_POST['park'];
	$studentIDs = $_POST['studentIDs'];
	$period = $_POST['period'];
	$lessonIDs = $_POST['lessonIDs'];
	$comment = $_POST['comment'];

	switch($function) {
		case 'loadEvaluations':
			loadEvaluationItems($type);
			break;
		case 'setEvaluations':
			setEvaluationItems($type, $level, $itemNo, $mappingID);
			break;
		case 'loadAbilityList':
			loadAbilityList($type);
			break;
		case 'setAbilityList':
			setAbilityList($type, $level, $itemNo, $item);
			break;
		case 'loadRatingRecords':
			loadRatingRecords($studentID);
			break;
		case 'loadRatingRecordsForOneLesson':
			loadRatingRecordsForOneLesson($type, $studentID, $lessonID);
			break;
		case 'setRatingRecord':
			setRatingRecords($type, $studentID, $lessonID, $comment, $instructor, $records);
			break;
		case 'loadSelfRatingRecord':
			loadSelfRatingRecords($studentID);
			break;
		case 'setSelfRatingRecord':
			setSelfRatingRecords($type, $studentID, $comment, $records);
			break;
		case 'loadLessonsByIdx':
			loadLessonRecordsByIdx($lessonID);
			break;
		case 'loadMultiLessons':
			loadMultiLessonRecords($lessonIDs);
			break;
		case 'loadLessonsByInstructor':
			loadLessonRecordsByInstructor($type, $period, $instructor);
			break;
		case 'loadLessonsByStudent':
			loadLessonRecordsByStudentID($type, $period, $studentID);
			break;
		case 'setLessonRecord':
			setLessonRecords($type, $lessonNo, $startDate, $endDate, $park, $instructor, $studentIDs);
			break;
		case 'deleteLessonRecord':
			deleteLessonRecords($type, $lessonID);
			break;
		default:
			break;
	}
}

?>