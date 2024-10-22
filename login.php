<?php
require 'head.php';
?>

<!DOCTYPE html>
<html>
<head>
  <script src="loadDB.js?3" type="text/javascript"></script>
  <script src="common.js?3" type="text/javascript"></script>
</head>

<style type="text/css">

.login-box {
  box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
  background: #fefefe;
  border-radius: 0;
  overflow: hidden;
}

.login-box .or {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  display: inline-block;
  min-width: 2.1em;
  padding: 0.3em;
  border-radius: 50%;
  font-size: 0.6rem;
  text-align: center;
  font-size: 1.275rem;
  background: #cacaca;
  box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
}

@media screen and (max-width: 39.9375em) {
  .login-box .or {
    top: 85%;
  }
}

.login-box-title {
  font-weight: 300;
  font-size: 1.875rem;
  margin-bottom: 1.25rem;
}

.login-box-form-section,
.login-box-social-section-inner {
  padding: 2.5rem;
}

.login-box-social-section {
  /*background: url("https://images.pexels.com/photos/179124/pexels-photo-179124.jpeg?w=1260&h=750&auto=compress&cs=tinysrgb");
  */
  background: url("/photos/nozawa-1.jpg");
  background-size: cover;
  background-position: center;

  min-height: 200px;
}

.login-box-input {
  margin-bottom: 1.25rem;
  height: 2.5rem;
  border: 0;
  padding-left: 0;
  box-shadow: none;
  border-bottom: 1px solid #1779ba;
  font-weight: 400;
}

.login-box-input:focus {
  color: #1779ba;
  transition: 0.2s ease-in-out;
  box-shadow: none;
  border: 0;
  border-bottom: 2px solid #1779ba;
}

.login-box-submit-button {
  display: inline-block;
  vertical-align: middle;
  margin: 0 0 1rem 0;
  padding: 0.85em 1em;
  -webkit-appearance: none;
  border: 1px solid transparent;
  border-radius: 0;
  transition: background-color 0.25s ease-out, color 0.25s ease-out;
  font-size: 0.9rem;
  line-height: 1;
  text-align: center;
  cursor: pointer;
  background-color: #1779ba;
  color: #fefefe;
  display: block;
  width: 100%;
  margin-right: 0;
  margin-left: 0;
  border-radius: 0;
  text-transform: uppercase;
  margin-bottom: 0;
}

[data-whatinput='mouse'] .login-box-submit-button {
  outline: 0;
}

.login-box-submit-button:hover, .login-box-submit-button:focus {
  background-color: #126195;
  color: #fefefe;
}

.login-box-submit-button:hover,
.login-box-submit-button:focus {
  box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
}

.login-box-submit-button:active {
  box-shadow: 0 1px 2px rgba(10, 10, 10, 0.4);
}

.login-box-social-button-facebook {
  display: inline-block;
  vertical-align: middle;
  margin: 0 0 1rem 0;
  padding: 0.85em 1em;
  -webkit-appearance: none;
  border: 1px solid transparent;
  border-radius: 0;
  transition: background-color 0.25s ease-out, color 0.25s ease-out;
  font-size: 0.9rem;
  line-height: 1;
  text-align: center;
  cursor: pointer;
  background-color: #3b5998;
  color: #fefefe;
  display: block;
  width: 100%;
  margin-right: 0;
  margin-left: 0;
  font-weight: 500;
  margin-bottom: 1.25rem;
  text-transform: uppercase;
}

[data-whatinput='mouse'] .login-box-social-button-facebook {
  outline: 0;
}

.login-box-social-button-facebook:hover, .login-box-social-button-facebook:focus {
  background-color: #2f477a;
  color: #fefefe;
}

.login-box-social-button-twitter {
  display: inline-block;
  vertical-align: middle;
  margin: 0 0 1rem 0;
  padding: 0.85em 1em;
  -webkit-appearance: none;
  border: 1px solid transparent;
  border-radius: 0;
  transition: background-color 0.25s ease-out, color 0.25s ease-out;
  font-size: 0.9rem;
  line-height: 1;
  text-align: center;
  cursor: pointer;
  background-color: #55acee;
  color: #fefefe;
  display: block;
  width: 100%;
  margin-right: 0;
  margin-left: 0;
  font-weight: 500;
  margin-bottom: 1.25rem;
  text-transform: uppercase;
}

[data-whatinput='mouse'] .login-box-social-button-twitter {
  outline: 0;
}

.login-box-social-button-twitter:hover, .login-box-social-button-twitter:focus {
  background-color: #1a8fe8;
  color: #fefefe;
}

.login-box-social-button-google {
  display: inline-block;
  vertical-align: middle;
  margin: 0 0 1rem 0;
  padding: 0.85em 1em;
  -webkit-appearance: none;
  border: 1px solid transparent;
  border-radius: 0;
  transition: background-color 0.25s ease-out, color 0.25s ease-out;
  font-size: 0.9rem;
  line-height: 1;
  text-align: center;
  cursor: pointer;
  background-color: #dd4b39;
  color: #fefefe;
  display: block;
  width: 100%;
  margin-right: 0;
  margin-left: 0;
  font-weight: 500;
  margin-bottom: 1.25rem;
  text-transform: uppercase;
}

[data-whatinput='mouse'] .login-box-social-button-google {
  outline: 0;
}

.login-box-social-button-google:hover, .login-box-social-button-google:focus {
  background-color: #be3221;
  color: #fefefe;
}

[class*="login-box-social-button-"]:hover,
[class*="login-box-social-button-"]:focus {
  box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
}

.login-box-social-headline {
  display: block;
  margin-bottom: 2.5rem;
  font-size: 1.875rem;
  color: #fefefe;
  text-align: center;
}


</style>

<body>

  <div class="loading" id="cover" style="display: none;">
    <div class="row">
      <div class="small-12 text-center"><span><i class="fi-mobile-signal"></i> 連線中...</span></div>
    </div>
  </div>

<br>
<div class="hide-for-small-only">
<br>
<br>
<br>
</div>

<div class="login-box">
  <div class="row collapse expanded">
    <div class="small-12 medium-6 column small-order-2 medium-order-1">
      <div class="login-box-form-section">
        <h1 class="login-box-title">電子郵件登入</h1>
        <input class="login-box-input" type="email" name="email" placeholder="電子郵件信箱" />
        <input class="login-box-input" type="password" name="password" placeholder="密碼" />
        <input class="login-box-submit-button" type="submit" name="signup_submit" value="登入" />
        <br>
        <input class="login-box-submit-button" name="apply_account" value="申請新帳號" />
      </div>
<!--      
      <div class="or">OR</div>
-->
    </div>

    <div class="small-12 medium-6 column small-order-1 medium-order-2 login-box-social-section">
      <div class="login-box-social-section-inner">
<!--
        <span class="login-box-social-headline">社群網路登入</span>
        <a class="login-box-social-button-facebook">facebook登入</a>
-->
      </div>
    </div>
  </div>
</div>

  <script type="text/javascript">
    $('input.login-box-submit-button[name="apply_account"]').click(function(){
      window.location.href = "applyNewAccount.php";
    });

    $('input.login-box-submit-button[name="signup_submit"]').click(function(){
      // 在前端對用戶輸入進行驗證
      function validateInput() {
        // 驗證電子郵件
        var email = $('input.login-box-input[name="email"]').val();
        if (!email) {
            alert("請輸入電子郵件地址");
            return false;
        }
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("請輸入有效的電子郵件地址");
            return false;
        }

        // 驗證密碼
        var password = $('input.login-box-input[name="password"]').val();
        if (!password) {
            alert("請輸入密碼");
            return false;
        }
        /*
        if (password.length < 6) {
            alert("密碼長度至少為6個字符");
            return false;
        }
        */
        return true;
      }
      
      if (!validateInput()) {
        return;
      }

      $(this).attr('disabled', "");

      $('#cover').show();

      fetch('accountHandler.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          func: 'checkAccount',
          user: {
            email: document.querySelector('input.login-box-input[name="email"]').value,
            password: document.querySelector('input.login-box-input[name="password"]').value
          }
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          <?php
          //require('session.php');
          //if($_SESSION['history']['destination'])
          //  echo 'window.location.href = "'.$_SESSION['history']['destination'].'";';
          //else if($_SESSION['member']['type'] == "admin")
          //  echo 'window.location.href = "evaluation.php";';
          //else
          //  echo 'window.location.href = "evaluation.php";';
          ?>
          window.location.href = 'assign.php';
        } else {
          alert(data.message || '登入失敗，請檢查您的帳號和密碼。');
        }
      })
      .catch(error => {
        console.error('错误:', error);
        alert('系统错误，无法登录。请稍后再试。');
      })
      .finally(() => {
        document.querySelector('input.login-box-submit-button[name="signup_submit"]').removeAttribute('disabled');
        document.getElementById('cover').style.display = 'none';
      });
    });
  </script>
</body>

