<?php
// main file leads to login.php
require_once "config.php";

$username = $password = $confirm_password="";
$username_err = $password_err = $confirm_password_err = "";  

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    }
    
    else{
        $sql = "SELECT id FROM users WHERE UserName = ?";
        $stmt = mysqli_prepare($conn,$sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt,"s",$param_username);
            $param_username = trim($_POST['username']);
            if(mysqli_stmt_execute($stmt)){
                $result=mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result)==1)
                {
                    $username_err = "This username is already taken ";

                }
                else{
                    $username = trim($_POST['username']);
                }

            }
            else{
                echo "something went wrong..";
            }
        }
    }
    mysqli_stmt_close($stmt);  


if(empty(trim($_POST['password']))){
    $password_err = "Please fill password";
}
elseif(strlen(trim($_POST['password'])) <5){
    $password_err = "Password cannot be less than 5 characters";



}
else{
    $password = trim($_POST['password']);
}
if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
    $password_err = "Password should match";
}


if(empty($username_err)&& empty($password_err) && empty
($confirm_password_err))
{
    $sql = "INSERT INTO users(username,password) VALUES (?,?)";
    $stmt = mysqli_prepare($conn,$sql);
    if($stmt)
    {
        mysqli_stmt_bind_param($stmt,"ss",
        $param_username,$param_password);

        $param_username = $username;
        $param_password = password_hash($password,PASSWORD_DEFAULT);

        if(mysqli_stmt_execute($stmt))
        {
            header("location:login.php");
        }else{
            echo "Cannot Redirect";
        }


    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);



} 







?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #009688;
            color: white;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 3rem;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            margin-top: 50px;
        }

        p {
            font-size: 1.2rem;
        }

        a {
            color: #009688;
            text-decoration: none;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #009688;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
        }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">NatureU</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Shop</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          About Us
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      
    </ul>
    
  </div>
</nav>

<header>
        <h1>Welcome to Nature U</h1>
        <p>Your Plant Care Companion</p>
    </header>

    <div class="container">
        <p>Are you a plant enthusiast? Nature U is here to help you with all your plant care needs. Whether you're a seasoned gardener or just getting started, we have the resources and community to support you in your plant journey.</p>
        <p>Explore a world of plants, get personalized care recommendations, connect with fellow plant lovers, and learn about gardening techniques. Nature U is your one-stop destination for everything related to plants.</p>
        <p>Ready to get started? Join our community and embark on a journey to discover the wonders of nature.</p>
        <a href="registration.html" class="button">Join Nature U</a>
    </div>


<div class='container'>
<form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" name = "username" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control" name="confirm_password" id="exampleInputPassword2" placeholder="Confirm Password">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div> 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    
  </body>
</html>
   