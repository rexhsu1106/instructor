<?php
require('lib/cj.db.class.php');
require('lib/account.php');
require('session.php');
require('lib/AI.db.class.php');

$db = new DB();
$database = new Database();
$account = new Account($db);
$newAccount = new Account($database);

function createAccount($user)
{
	global $newAccount;

	try {
		// 驗證用戶輸入
		if (!isset($user['name']) || !isset($user['email']) || !isset($user['password'])) {
			throw new Exception("缺少必要的用戶信息");
		}

		// 驗證電子郵件格式
		if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
			throw new Exception("無效的電子郵件地址");
		}

		// 驗證密碼強度（例如：至少8個字符）
		//if (strlen($user['password']) < 8) {
		//	throw new Exception("密碼必須至少包含8個字符");
		//}

		// 使用 password_hash 代替 md5
		//$hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);

		$result = $newAccount->createAccount($user['name'], $user['email'], md5($user['password']));

		echo json_encode([
			"status" => "success",
			"message" => "帳戶創建成功"
		]);
	}
	catch (Exception $e) { 
		echo json_encode([
			"status" => "error",
			"message" => "錯誤：" . $e->getMessage()
		]);
	}
}

function checkAccount($user)
{
	global $newAccount;

	try {
		if (!$user || !isset($user['email']) || !isset($user['password'])) {
			throw new Exception("無效的用戶數據");
		}

		$result = $newAccount->checkAccount($user['email'], md5($user['password']));
		if ($result) {
			echo json_encode([
				"status" => "success",
				"message" => "登入成功"
			]);
		} else {
			echo json_encode([
				"status" => "error",
				"message" => "帳號或密碼錯誤"
			]);
		}
	}
	catch (Exception $e) { 
		echo json_encode([
			"status" => "error",
			"message" => "Error: " . $e->getMessage()
		]);
	}
}

function updatePassword($user)
{
	global $account;

	try{
		$account->updatePassword($user['name'], $user['email'], md5($user['password']), md5($user['newPassword']));
		echo json_encode("success");
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function loadInstructor()
{
	global $account;

	try{
		$instructor = $account->loadInstructor();
		echo json_encode($instructor);
	}
	catch (Exception $e){ 
		echo json_encode('Error: '.$e->getMessage());
	}
}

function getJsonData()
{
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("無效的 JSON 數據");
    }
    
    return $data;
}

try {
    $data = getJsonData();
    
    if (!isset($data['func']) || empty($data['func'])) {
        throw new Exception("缺少函數名稱");
    }
    
    $function = $data['func'];
    $user = isset($data['user']) ? $data['user'] : null;
    
    switch($function) {
        case 'createAccount':
            createAccount($user);
            break;
        case 'checkAccount':
            checkAccount($user);
            break;
        case 'updatePassword':
            updatePassword($user);
            break;
        case 'loadInstructor':
            loadInstructor();
            break;
        default:
            throw new Exception("未知的函數: " . $function);
    }
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

// 移除原有的 if 語句，因為我們已經在上面處理了
/*
if(isset($_POST['func']) && !empty($_POST['func'])) {
	$function = $_POST['func'];
	$user = isset($_POST['user']) ? $_POST['user'] : null;

	switch($function) {
		case 'createAccount':
			createAccount($user);
			break;
		case 'checkAccount':
			checkAccount($user);
			break;
		case 'updatePassword':
			updatePassword($user);
			break;
		case 'loadInstructor':
			loadInstructor();
			break;
		default:
			break;
	}
}
*/
?>
