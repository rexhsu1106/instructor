<?php

require('lib/cj.db.class.php');
require('lib/members.php');
require('lib/skidiymembers.php');


$db = new DB();
$member = new Members($db);
$skidiymember = new SkiDiyMembers($db);

function loadMultiMembersBasicInfo($memberIDs)
{
	global $member;

	try{
		$info = $member->getMultiMembersBasicInfo($memberIDs);
		echo json_encode($info);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadMembersInfoByEmail($email)
{
	global $member;

	try{
		$info = $member->getMembersInfoByEmail($email);
		echo json_encode($info);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadSkiDiyMembersInfo($studentsInfo)
{
	global $skidiymember;

	try{
		$info = $skidiymember->getMembersInfo($studentsInfo);
		echo json_encode($info);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadSkiDiyMembersNotSelfEva()
{
	global $skidiymember;

	try{
		$info = $skidiymember->getMembersInfoNotSelfEva();
		echo json_encode($info);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function EvaluationLessonAndRecordMatchError()
{
	global $skidiymember;

	try{
		$info = $skidiymember->getEvaluationLessonAndRecordMatchError();
		echo json_encode($info);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadSkiDiyALLMembers()
{
	global $skidiymember;

	try{
		$info = $skidiymember->getALLMembersInfo();
		echo json_encode($info);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadSkiDiyInfoNotEvaluated()
{
	global $skidiymember;

	try{
		$info = $skidiymember->getInfoNotEvaluated();
		echo json_encode($info);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadSkiDiyAllEvaluationInfo()
{
	global $skidiymember;

	try{
		$info = $skidiymember->getAllEvaluationInfo();
		echo json_encode($info);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

if(isset($_POST['func']) && !empty($_POST['func'])) {
	$function = $_POST['func'];
	$memberIDs = $_POST['memberIDs'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$studentsInfo = $_POST['studentsInfo'];

	switch($function) {
		case 'loadMultiMembersBasicInfo':
			loadMultiMembersBasicInfo($memberIDs);
			break;
		case 'loadMembersInfoByEmail':
			loadMembersInfoByEmail($email);
			break;
		case 'loadSkiDiyMembersInfo':
			loadSkiDiyMembersInfo($studentsInfo);
			break;
		case 'loadSkiDiyMembersNotSelfEva':
			loadSkiDiyMembersNotSelfEva();
			break;
		case 'EvaluationLessonAndRecordMatchError':
			EvaluationLessonAndRecordMatchError();
			break;
		case 'loadSkiDiyALLMembers':
			loadSkiDiyALLMembers();
			break;
		case 'loadSkiDiyInfoNotEvaluated':
			loadSkiDiyInfoNotEvaluated();
			break;
		case 'loadSkiDiyAllEvaluationInfo':
			loadSkiDiyAllEvaluationInfo();
			break;
		default:
			break;
	}
}

?>