<!DOCTYPE html>
<html>
<head>
  <?php
    require('head.php');
  ?>
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
  background: url("/photos/nozawa-2.jpg");
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
        <h1 class="login-box-title">申請新帳號</h1>
        <input class="login-box-input" type="email" name="name" placeholder="使用者稱呼" />
        <input class="login-box-input" type="email" name="email" placeholder="電子郵件信箱" />
        <input class="login-box-input" type="password" name="password" placeholder="密碼" />
        <input class="login-box-submit-button" type="submit" name="register_submit" value="註冊" />
      </div>
    </div>
    <div class="small-12 medium-6 column small-order-1 medium-order-2 login-box-social-section">
      <div class="login-box-social-section-inner">
      </div>
    </div>
  </div>
</div>

  <div class="row expanded">
    <div class="small-12 medium-6 column small-order-2 medium-order-1">

    </div>
  </div>

  <script type="text/javascript">
    document.querySelector('input[name="register_submit"]').addEventListener('click', function(e) {
      e.preventDefault();

      const name = document.querySelector('input[name="name"]').value.trim();
      const email = document.querySelector('input[name="email"]').value.trim();
      const password = document.querySelector('input[name="password"]').value;

      if (!name || !email || !password) {
        alert("請填寫所有必填欄位");
        return;
      }

      const coverElement = document.getElementById('cover');
      const submitButton = document.querySelector('input[name="register_submit"]');

      coverElement.style.display = 'block';
      submitButton.disabled = true;

      fetch('accountHandler.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          func: 'createAccount',
          user: { name, email, password }
        })
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('網絡響應不正常');
        }
        return response.json();
      })
      .then(data => {
        if (data.status === 'success') {
          alert('註冊成功');
          window.location.href = 'login.php';
        } else {
          alert(data.message || '註冊失敗，請稍後再試');
        }
      })
      .catch(error => {
        alert('系統錯誤，無法註冊：' + error.message);
      })
      .finally(() => {
        coverElement.style.display = 'none';
        submitButton.disabled = false;
      });
    });
  </script>
</body>

