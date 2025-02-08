<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @font-face {
  font-family: 'Material Symbols Outlined';
  font-style: normal;
  font-weight: 300;
  src: url(../fonts/material-symbols.woff2) format('woff2');
}

@font-face {
  font-family: 'Fredoka';
  font-style: normal;
  src: url(../fonts/fredoka.ttf);
}

.material-symbols-outlined {
  font-family: 'Material Symbols Outlined';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;
  line-height: 1;
  letter-spacing: normal;
  text-transform: none;
  display: inline-block;
  white-space: nowrap;
  word-wrap: normal;
  direction: ltr;
  -webkit-font-feature-settings: 'liga';
  -webkit-font-smoothing: antialiased;
}

body {
	margin:0;
	padding:0;
}

p, h1, h2, h3, h4, h5, h6, div {
	padding:0;
	margin:0;
}

*::-webkit-scrollbar {
display:none;
}

* {
	-webkit-user-select: none;
	-ms-user-select: none;
	user-drag: none;
    -webkit-user-drag: none;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
	user-select: none;
	font-family: Fredoka;
	font-weight:500;
}

        body, html {
            background: #724DDD;
        }

        .login-popup {
            background: white;
            width: 380px;
            height: 420px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 40px;
            padding: 20px;
        }

        .login-popup img{
            background: white;
            width: 60px;
            height: 60px;
            position: relative;
            left: 50%;
            transform: translate(-50%, 0);
            border-radius: 15px;
            margin: 10px 0;
        }

        .login-popup p, .login-popup h1, .login-popup h2, .login-popup h3, .login-popup h4, .login-popup h5, .login-popup h6 {
            text-align: center;
        }

        .login-popup form input:not([type=submit]) {
            padding: 14px 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            outline: none;
            box-sizing: border-box;
            width: 70%;
            position: relative;
            left: 50%;
            transform: translate(-50%, 0);
            margin: 5px 0px;
        }

        .login-popup form input[type=submit] {
            background: rgba(200, 200, 200, 0.6);
            padding: 14px 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            outline: none;
            box-sizing: border-box;
            width: 70%;
            position: relative;
            left: 50%;
            transform: translate(-50%, 0);
            margin: 5px 0px;
            cursor: pointer;
            transition: 1s;
            color: black;
        }

        .google-logon {
            padding: 14px 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            outline: none;
            box-sizing: border-box;
            width: 70%;
            cursor: pointer;
            transition: 1s;
            color: black;
            text-decoration: none;
            text-align: center;
            margin: auto;
            position: relative;
        }

        .google-logon:hover {
            background: rgba(190, 190, 190, 0.6);
        }

        .login-popup form input[type=submit]:hover {
            background: rgba(190, 190, 190, 0.6);
        }

        .g_id_signin {
            padding: 14px 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            outline: none;
            box-sizing: border-box;
            width: 70%;
            position: relative;
            left: 50%;
            transform: translate(-50%, 0);
            margin: 5px 0px;
        }
    </style>
</head>
<body>
<script src="https://accounts.google.com/gsi/client" async></script>
    <div class="login-popup" style="align: center;">
        <img src="../images/1.png">
        
        <h1 style="margin-top:8px; font-size:40px;">Percle v4.0</h1>
        <p>Please log in</p>
        <hr style="border: 1px solid rgba(100, 100, 100, 0.3); margin:23px 30px; outline:none; border-radius:2px">
        <a style="display: flex; justify-content: center;" class="google-logon" href="../auth/google_login.php">Login with Google</a>
        <hr style="border: 1px solid rgba(100, 100, 100, 0.3); margin:23px 30px; outline:none; border-radius:2px">
    </div>
   </body>
</html>