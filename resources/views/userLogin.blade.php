<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <title>Login Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #5696fc;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 300px;
      text-align: center;
    }

    .login-container h2 {
      color: #333;
    }

    .login-form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
    }

    .form-group input {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-group input[type="submit"] {
      background-color: #4caf50;
      color: #fff;
      cursor: pointer;
    }

    .form-group input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

<div class="login-container">
  <h2>Login Form</h2>
  <div class="login-form">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" id="email" name="email" placeholder="Enter your email" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>
    </div>
    <div class="form-group">
      <input id="login_btn" type="submit" value="Login">
    </div>
  </div>
</div>

<script>
        $("#login_btn").click(function() {
        var email = $("#email").val();
        var password = $("#password").val();
        var data={
            email:email,
            password:password,
            "_token":"{{csrf_token()}}"
        }
        $.ajax({
        type: 'POST',
        data:data,
        url: "{{url('api/login')}}",       
        success: function(data){
            console.log(data);
            if(data.success){
                // window.location.href = `{{url('${data.url}')}}`;
            }                    
        }
    });
});
</script>
</body>
</html>
