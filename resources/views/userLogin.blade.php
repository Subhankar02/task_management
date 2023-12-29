<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="{{asset('style.css')}}">
  <title>Login Form</title>
  
</head>
<body>

<div class="login-container">
  <h2>Login Form</h2>
  <form class="login-form" method="post" action="{{url('login')}}">
    @csrf
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
  </form>
</div>

<!-- <script>
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
</script> -->
</body>
</html>
