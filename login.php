<?php
//login 

define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','PlantAssistanceSystem');

$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

if($conn == false){
    dir('Error: Unsuccessful');
}else{
    //echo"connection successfull"; 
}




?>








<!DOCTYPE html>
<html>
<head>
    <title>NatureU</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background.jpg');
            background-color: #009688;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: white;
            color: #009688;
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
            background-color: white;
            border-radius: 10px;
            margin-top: 50px;
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
            transition: transform 0.2s;
        }

        p {
            font-size: 1.2rem;
        }

        a {
            color: #009688;
            text-decoration: none;
        }

        .btn-danger {
            color: white;
        }

        .navbar-container {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .parent {
            text-align: center;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .child {
            width: 48%; /* Adjust the width as needed */
            margin: 10px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .button2 {
            background-color: white;
            color: black;
            width: 150px; /* Adjust the width as needed */
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        .button:hover {
    transform: scale(1.1); /* Enlarge the button by 10% on hover */
}
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">NatureU</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registration.php">Register</a>
                </li>
            </ul>

            <!-- Add Delete User button -->
            <a href="deleteReguser.php" class="btn btn-danger mr-2">Delete Account</a>

            <!-- Add Delete Instructor button -->
        </div>
    </nav>

    <header>
        <h1>Welcome to Nature U</h1>
        <p>Your Plant Care Companion</p>
    </header>

        <div class="container">
            <h3 class="card">Enhance your knowledge...read about plants</h3>
            <form method="post" action="searchPlant.php">
                <label for="searchTerm">Search for a Plant:</label>
                <input type="text" name="searchTerm" id="searchTerm" required>
                <input type="submit" name="search" value="Search">
            </form>
        </div>
        
        <div class="parent">
            <div class="child">
                <p> Need help? <br> Contact an  instructor now!  </p>
                <form action="getInstructor.php">
                    <input type="submit" value="Select an Instructor" class="button">
                </form>
            </div>

            <div class="child">
                <h3>Keep Us Updated!</h3>
                <form action="updateuserplantinfo.php">
                    <input type="submit" value="Enter your plant information " class="button">
                </form>
            </div>

            <div class ="child">
                <h3>Grow Anything!!</h3>
                <p>click here for steps</p>
                <form action="displayplantingtech.php">
                    <input type="submit" value="How to plant?" class="button">
                </form>
            </div>

            <div class="child">
                <h3>Looking for a fertilizer</h3>
                <form action="fertilizer.php">
                    <input type="submit" value="Fertilizers" class="button">
                </form>
            </div>
        </div>

        <div class="child">
            <h3>Worried about Plant Health</h3>
            <h4>We can help!!</h4>
            <form action="pestmanagement.php">
                <input type="submit" value="Click Here" class="button">
            </form>
        </div>

        <div class="child">
            <h3>For getting a personalized planting schedule</h3>
            <h4>Click here </h4>
            <form action="plantingschedule.php">
                <input type="submit" value="Click Here" class="button">
            </form>
        </div>

        
        <div class="child">
        <h3>Discover Your Green Oasis</h3>
<h4>Explore and Purchase Plants - Click Here</h4>

            <form action="userPurchase.php">
                <input type="submit" value="Click Here" class="button">
            </form>
        </div>


  <!--
    #bootstrap 
    <div class="row">
  <div class="col-4">
    <nav id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4 border-end">
      <nav class="nav nav-pills flex-column">
        <a class="nav-link" href="#item-1">Instructor</a>
        <nav class="nav nav-pills flex-column">
            <input type="submit" value="Select an Instructor" class="button">
          
          
        </nav>
        <a class="nav-link" href="#item-2">Item 2</a>
        <a class="nav-link" href="#item-3">Item 3</a>
        <nav class="nav nav-pills flex-column">
          <a class="nav-link ms-3 my-1" href="#item-3-1">Item 3-1</a>
          <a class="nav-link ms-3 my-1" href="#item-3-2">Item 3-2</a>
        </nav>
      </nav>
    </nav>
  </div>

  <div class="col-8">
    <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">
      <div id="item-1">
        <h4>Plant Info</h4>
        <form action="updateuserplantinfo.php">
                <input type="submit" value="Enter your plant information " class="button">
            </form>
      </div>
      <div id="item-1-1">
        <h5>Grow Anything!!</h5>
        <form action="displayplantingtech.php">
                <input type="submit" value="How to plant?" class="button">
            </form>

        <p></p>
      </div>
      <div id="item-1-2">
     <h5>Fertilizer</h5> 
      <form action="fertilizer.php">
                <input type="submit" value="Fertilizers" class="button">
            </form>

        <p></p>
      </div>
      <div id="item-2">
        <h4>Plant health</h4>
        <form action="pestmanagement.php">
            <input type="submit" value="Click Here" class="button">
        </form>
        <p></p>
      </div>
      <div id="item-3">
        <h4>Planting Schedule</h4>
        <form action="plantingschedule.php">
            <input type="submit" value="Click Here" class="button">
        </form>
        -->
      
      </div>
    </div>
  </div>
</div>
</body>
</html>
