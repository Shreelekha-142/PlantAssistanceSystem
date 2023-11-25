<?php


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

// grouping instructors based on their field of specialization 
$query = "
    SELECT Name, FieldofSpecialization
    FROM instructor
    WHERE FieldofSpecialization IN (
        SELECT FieldofSpecialization
        FROM instructor
        GROUP BY FieldofSpecialization
        HAVING COUNT(*) > 1
    );
";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error in the query: " . mysqli_error($conn);
    exit();
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Nature U</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Impact
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section><!-- End Top Bar -->

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Nature U <span>.</span></h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="#hero">Home</a></li>
          <li><a href="#about">Read</a></li>
          <li><a href="#services">Instructors</a></li>
          <li><a href="#portfolio">Shop</a></li>
          <li><a href="#team">How to plant?</a></li>
          <li><a href="instructorreg.php">I am an Instructor</a></li>
          <li class="dropdown"><a href="#"><span>More</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li>
              <a href="registration.php" style="display: inline-block; background-color: #009688; color: white; padding: 10px 50px; text-decoration: none; border-radius: 5px;">Register here</a>
              


              </li>
             
              <li><a href="deleteReguser.php" class="btn btn-danger mr-2">Delete Account</a></li>
              <li><a href="avg_time.php" style="display: inline-block; background-color: #009688; color: white; padding: 10px 50px; text-decoration: none; border-radius: 5px;">Time spent</a></li> 
              
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2>Welcome to <span>Nature U </span></h2>
          <p>Your plant care companion</p>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#about" class="btn-get-started">Get Started</a>
           
        </div>
    </div>
            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span></span></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="assets/img/hero-img.svg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div>
      </div>
    </div>

    <div class="icon-boxes position-relative">
      <div class="container position-relative">
        <div class="row gy-4 mt-5">

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-easel"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Contact an Instructor</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-gem"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Plant Library</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-geo-alt"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Grow Anything</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-command"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Purchase Plants</a></h4>
            </div>
          </div><!--End Icon Box -->

        </div>
      </div>
    </div>

    </div>
  </section>
  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Enhance your knowledge</h2>
          <p>Read about plants</p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-6">
          <div class="container">
            <h3 class="card"></h3>
            <form method="post" action="searchPlant.php">
                <label for="searchTerm">Search for a Plant:</label>
                <input type="text" name="searchTerm" id="searchTerm" required>
                <input type="submit" name="search" value="Search">
            </form>
        </div>
          </div>
          <div class="col-lg-6">
            <div class="content ps-0 ps-lg-5">
              <p class="fst-italic">
                
              </p>
              <ul>
              <img src="https://images.jdmagicbox.com/comp/kolhapur/h5/0231px231.x231.190904104149.s3h5/catalogue/plant-library-nursery-5-star-midc-kagal-kolhapur-plant-nurseries-90oazaa56v.jpg" alt="">
              </ul>
              <p>
                
                
              </p>

              <div class="position-relative mt-4">
                
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container" data-aos="zoom-out">

        
      </div>
    </section><!-- End Clients Section -->

    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4 align-items-center">

          <div class="col-lg-6">
            <img src="assets/img/stats-img.svg" alt="" class="img-fluid">
          </div>

          <div class="col-lg-6">

            

          </div>

        </div>

      </div>
    </section><!-- End Stats Counter Section -->

    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action" class="call-to-action">
      <div class="" data-aos="zoom-out">
       
      </div>
    </section><!-- End Call To Action Section -->

    <!-- ======= Our Services Section ======= -->
    <section id="services" class="services sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Meet Our Experienced team</h2>
          <p>Need help? Contact our skilled instructors now</p>
        </div>

        <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-4 col-md-6">
            
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-broadcast"></i>
              </div>
              <h3>Connect to an instructor now!!</h3>
              <p></p>
              <p>  <br>  </p>
              <table border="1">
        <tr>
            <th>Name</th>
            <th>Field of Specialization</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['FieldofSpecialization'] . "</td>";
            echo "</tr>";
        }
        ?>
         </table>
            
           
                <form action="getInstructor.php">
                    <input type="submit" value="Select an Instructor" class="button">
                </form>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
          
           
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
           
          </div><!-- End Service Item -->

          
          </div><!-- End Service Item -->

        </div>

      </div>
    </section><!-- End Our Services Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Stay Green and Thriving: Manage Your Planting Schedule with Ease!</h2>
          <p style="margin-bottom: 50px;">We help you maintain a record of your planting activities so you never miss a moment in the growth of your green companions. Enter your plant information below and let the gardening journey begin!</p>
          <div style="background-color:; padding:; width:;color: white;">

    
          <form action="updateuserplantinfo.php" style="display: ; flex-direction: ;">
          
          
                    <input style="background-color: #009688; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;"type="submit" value="Enter your plant information " class="button">
                
          
          </form>
          </div>
        </div>

            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <div class="d-flex align-items-center">
                   
                  
                </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Discover Your Green Oasis</h2>
          <p> Purchase plants here</p>

         

        </div>

        <div style="margin-bottom: 50px;" class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

          

          <div class="row gy-4 portfolio-container">

            <div class="col-xl-4 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="assets/img/portfolio/app-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKoDR9JzLsiOSEVcRXlvdnRAit6PUElD6qIg&usqp=CAU" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Flowering Plants</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-product">
              <div class="portfolio-wrap">
                <a href="assets/img/portfolio/product-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-AdSm-nlgK7bxBn8pDzuiQFS0s0U4UXvc8g&usqp=CAU" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Edibles</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
              <div class="portfolio-wrap">
                <a href="assets/img/portfolio/branding-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeu_Su1is4XagM6w5vvMZY-Ty893lPpsaItw&usqp=CAU" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Medicinal Herbs</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-books">
              <div class="portfolio-wrap">
                <a href="assets/img/portfolio/books-1.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUTExMVFhUWGBgYFhgYGBcXFxUeFxgXGBodGh0dHSggGB0lGxgXIzEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OGxAQGy0lICYtLS0tLS0tLS0tLS0vLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAKsBJgMBIgACEQEDEQH/xAAcAAACAgMBAQAAAAAAAAAAAAAFBgMEAAIHAQj/xABMEAACAQIDBAgCBQkFBwIHAAABAgMAEQQSIQUxQVEGEyJhcYGRoTKxQlKSwdEHFCMzYnKC4fBDY6KywhUkJTRTc/GDwxZUdJOj0uL/xAAZAQADAQEBAAAAAAAAAAAAAAACAwQBAAX/xAA2EQABAwIDBQgCAQQCAwEAAAABAAIRAyESMUFRcYGx8AQTImGRocHRMuFCIzPC8YKiUmKyFP/aAAwDAQACEQMRAD8A5S5rFrHFa5qUtK2NboKjBqVK5cFuDW61par+zNlyztaJb23ncq+J+7fQOcGiSmTAuqZrU6V0DZPQMHWRi/O3YQeLHU+1FVwWz4eyZsCh72Rj5nX50g9oaBI+v37JDu0t/iCVx/ESVCldm/2RhpxZHwc/crREnyNjQTanQWMf2ckJ7rlfQ/cRWM7c3JzSPf8Afsp3dpH8gQuaMK2ioxtjo5PBdiM6D6a8P3hvX5d9B1Wq2va8S0ymghwkK6k1hRrovsI4yRwZkhSNc7ySaKovYDeNT48DS+tXocNKy5VWRlvmsFYre1r6C17caOShIARHaXR2eFetADw6lJo2DI4BtmBBuPPdWmOwpkw4xYAH6TqZbC13yh1e24ZxcH9pCfpWHR/yUYN2wuLw8qMAGEiBhuJXKbX/AHdaBpskrgdqx5SFR4JU0NrDrGNjxsOyfCpu/wDHhPr5TB5j1yBQA3XPgKtQQ3rzDw3o5gsDVbWSUFRy22bg6vnC2q9gsOAKc+h3RwSfp3UFQbIp+Ekb2PMDlzvVEBoup4LjAXNNqRWTdSfKO2a7z036UPBeKOGIgaO80iRqe5FJBI8KW4ttYKUomKgijEqB1kQrIlySrZltmUdYrjNqNOFedXrk/iJ4jqVTSBbldc8wS1dZ7U4bc6GKqdbhyCrarlbNG37ra29fSkmdCpIYEEaEHQik06gqSBMjMEXHD5yOhXoU6gcLKni5L1rg99SYiG2p0FaYS16ogwj1VjGHSoMKt6mxNZhUodFxzVfFYaqDwkUwMt6glw9YCgcyckEyVsqVdkw9eJDRJJaVHDFRKBa0SO1SqaByppsgK/hsPc1LiYAK1ilCrULYvNTBAGSW8uLs1vh8QFJrKHTb6yhzXGkCZQd68C15evc9GhBWwFSqKhDVYgQsQoFyTYDxrkSubL2e07hV0G92O5BxJ5nkONPGN6QYbBRrBDHmYDcdLX+k55nfb5aUGxEowmHFvjcnJ3kfFIRxA0AHO3I0v7PwE2Ie0aM7E6nfqeZ5+9RPaK3jeYYMhlPmTy12pAip4nfjp5+at7V27PiD+kc5eCDRR5cfO9CJxwFOA2JhML/zs+aQf2EPaYdzEEBfMr4VZw/S2JGEeEwF77rvZj4hE9yxpzCGjwtgenG8HiQmF1vA23ABc+Gz5Cb9VJ45G/Cj2yOkuNwvZSZwv/Tk7aHuytu8rV0zAYpmiMk8GGhX67SPkXxYkZz3KPOtINuYM3IMkqqdWVRFHfkpbtt8u+lHtWIThlu3T3F+EqXvDmW23/rkqXR3pDFjCI5YGikO541Zom/eG+P3HfW2M/JxCZwXvGrfVsI2PPmvkQPCmbAY5cRGzYeBQF4zh7HwIk19qpx9IsQoFsPh5IL2cRsx5hspJKg/sm3iKTLQZnCDqCeZaBuk2SoE4meHdMIXLgtlYR+r/OcMrg2OVGkZSODOM2X+Iii23MPLDAJcNBh57jMGJchwRvXK4B9dam2r0QwWLTrgq2YXzhSHFuDFe1cbtb7txrOhuzpcGfzZ367BTawvcMYWO7UaNG3MbiRcC9Nd2VmYz0xeIO4mc+Eea0Nab87oZ+SzpNLisTJHJHCg6sn9GjKd9tczGi+GmCpjlKArGsT6XDPeSW6k+CafvGt9gdHfzbaskiiyTQt5Orrf1Bv61ZXBN1eN/vOrQfaf72oKjGmSBH5W2eAHmFxiBx5JWweA2fj7dSermP0HARz4EXV/c+FD8fsKaBspRm5FQW9QN1X+i/RFVBknIKofo3INuVx2jfy+47sPpaTNKrYQxRKNHbWUtwvfRrjkdOZvpW3tDWEmk7wD/wAjb/jrHEA6Wul4Ru62JWw2zZmIBRkHEsp+W8mnqOVVijiEmZhkVVAORdRct9Zt510vW+DxuKkbMXyR6kAhWJHfcVcxOKS5DRowAFzfK12OgFvEVPU7TWqjESI0BaWjbNnOJ4i2cStDRGft+ylPbnQ2DE4uWaRZXLN8KuqpppwUtw51rP0W2eiokkVurUqt5cQbAu72uB2u07HzpgxiuYmkwbyKASGja9msbXU3+RvQbZG3Ip/93nzdZfKFka++9yHbW/IGlO7RVEAkTFrAiNL3J2fjOVgtxlromDps4QrGwdlQx3GFjbLINQZZXjPC5SQCx5Ea0TTY+Hi7Zj61r2bq1UlbcGN7+Wp7qXNqLiMGJI4pCqyA2a18vC6/VI3G1A+iCz4eQrILwS6SWcEg8JF1vmB15nWlNwVSXVyC4WAMAAbIFnbzwEQmNhwJJuNqYNtbcmQnqMHh5APotJKsvmrqgJ7gWpZXpTh5ZOrxeEOGJNidXUX4tG6hgPAmj+BxGJV2EsyTwX7Kyxl3A7n0YHxzVLPsmGfQqpX6pYWXwzG6+ItTW90IhjP+IwkcAD7OQGq0GCAd1ilnpR0LyKJIrZWF0ZTeKQHXQ/RPt86UEjKkgggjQg7xXbdjYCPCxHDsrdS30HcHLfit2uOdhS/tbohCZwrl7Ot4ZI7dsD6LAg3IH9bqoacJjFLdp0OwmFRSrln5SR55jeuZE14Wpyx/QgC/Vz+UkbD1Yae1Lm0+j+JhGZo7p9dDnT1G7ztRsc1/4kHcQeSrHaGOyPxzQqaoI2qyI7iouoIpgyWh7SVITWA141eKaBNCkzcKlK2FQA1tJJWhYVowr2o2kNZWrYQla8IrxDXrGmlRjNeCmfojs7M3WHQdoAncoUEyOe5Vv78qWkUsQF1JIA7ydBXUsBscGDqU1MpEItvMaENIe7O9ge7PU9d4ENOvLX1y4oK74EbeWqAYHZjbQnaZv0eHUWUsbBY03XPAWuSeZNa7X6TBQYMFeKEaGQdmSXz3oncNTx5VnS/bi/8AJ4c2hjNpGH9s6/8AtqdAOJF+VKwomsJOJ2eg2fvoQmU2au4DZ+1ZweGaRgiC5J/8k91PkOGg2dhxLKM7v+rTc0xG8t9WMf1qa06C7HRI2xE2iBDJIfqxrqAO9vvFKXSHbL4udpn0voi8I0HwqPAb+ZJNKLe+dB/EH1P0s/uuj+I9ypMTjZ8dOvWvfkBokSjflXcoA9dKd8FsYERoRZLAhe4br8ydWPiOdL35P9m9bKB9d8nkO03rp6V0VXEmLOUdlSFXwXS/mFv51H24ufDG5SB7XO+Le6n7Q6XYdB0Vd6STLhMAxXSy6eO4e5FcKwG05sO/WQyMjcbahv3gdGHiK6h+WTH2EOHB39tvAbvc/wCGuUSCvTa0M8I3J9Kn4Z6t+5XWugHTuKVxHKBDK9gQP1Ux3XW/wP8AsnfwJNgDe0scuzJGkIc4aZwXjGvVOx1kjH0b6lhfUjddq5L0J2UMRiQh5Dy7QF/IX9qf9l7eXHfnOEkAbqy3UA73iQ5SCd5YWDX3691Jce7BwiwzHOOHQzU7gQ4gaRP1uXT4JEkEcqMHBAKuNzAjePEEelKU20i82Nw1/hlhVf2Q0QkY+t/UVa6AQLDheoEhfI5YX3qHYkDu/G9ZDhIopMTirXaVy9yL6KoRbC/JRYd/fQ9ocHshv8uREGeHuQFzocLIX/tQOZsP+bYlUhFo5UzIGIA3HQ776i4IHfao4FSPDyYmaZB1dvi7WvIga3PhcnhV/YE000pvM7Abr2ANz9UaAd39HXpLsqHEq0YCdYTlI4NqNfLfzHCkO8Qa8iQJAAt5SN2yeaXYmVa6OTtikLqyGI2MbC9xvzgncVvbkRqCLitZsLnOZmuqSZhbQM2gXxsvDvvwFW5o1weEWKIWzARIO4aevfQnF40xx5At+0Lk8CeA79NT5U3tD2U/y0Ge0xl1t9BJiOtySdsfns8oTM0cUZBi4KO1fMANWa9yDR7b2yRiEVyOrnt2W3dZb63f30RwmHVLNJqTuHKtp5ElCtI6okmkZ0DNbcAx0GutvGoGOq1QAdAABrlmT/q29E8l4DSMtEH6MzvPHJg5h+lS7Rlt9xvB+XnU3RjFqC+HkABNzGzLmCkfEptrbw3a17gEJnVt2IgNn/vY92YcyPuqLpdCYcUJYyVzgSIRvBOjWroAaHkZWNtPseUZjRLyv1Cuz4zqwS2HY2OvVam3MKTc+F/LhU35v18ZfDsrHiJFZWXudTlZfOim0NpynCxToyq4UdatlYG43i4OnhzFJmJ6fdTPafDKRYMssBySAHQggkq+oOl1G6nMoND+7Oedxht5C+W4X11TAwPOHM9cDxHFVp+kvVP1GNw7p+6esQjmt7EDw1pp2JJFNB1UUoeO94CdGikGoXwPLhevMQ2A2vCVSResAuumWSM96nh4XB4GkOH852ZMdLi+Vgb9XKBwbkeIO8Hcd9W9y1pka2/U5+eZGoFkxtBptk7Zofr4UuO6Q43CTvH1rOgN1WYCTsnUC7drT4dDvU0Z2R0zhc/pVOHc/TW7xH94fEB9ryoltvEYfFQxzmIvFIDc6Z4nuQwJG4k3Nxv5Ul47o3dTJhX65OKj9YviOJ7rA0D+7e+HfkNcjwIvfenB1N/hqCDlPWXHgnLaXRqCcZ1CozC6vHYxyd4tofDQ95pOxuxXibK48GG4/wA+6heyOkM+EJ6troT24nF428RwPeLH5V0LZO2YMdGQo7QF3ibV0A4odOtT3HdpT21Cz87jbrxHyLakNElKq0alK4Mj3XPcbg7UNKEU87W2XkOhuh3Hl40DxWBFqeWBwxNyTKPatqBE1qTUuJhymq5NJiFeDK8asraMHgL1ldK6EHJrBWlq2WmqRqJbGiLTxAC/bU+SkMfYGui9INofmeD7JtPibpHzjjH6xhyJvlB5sTwpc/J7s3rZS1tSQi+JsT93qa3/ACpyX2g6A9iNIo05ZQgbTxZmPnUuEPryf4iBvN/ayCz6sHTmlIVd2Thetmjj4Mwv4DVvYGqNMvQPD5sQx+rHYeLMgHtem1n4GFwT6j8DC7YEz9P8Z1OChw66NiD1sn/bjNo18C2v8Fc5Jpq/Kjic20ZUHwwLHCvgiBj/AInelSiYwMaGjRdSZhYAuofkdhBdTyZz7KPvph6LJmxLj9r5Cl38juKRA7OwCqWuTw0Q0x9G9mMzntlOsJP7TDu5Dv41G5vjbAnxOK8+pPeHefhLPT3ZGJxm0JeqS6IFQMSFXQXNuJ1J3DhQGb8n+NsSFjNuAe3+YAe9T9JdpYqXEyYaHP1ayGNUjBGaxt2yPiP7xsO6mjYfRWLAIuIxUjvMdUjjYi57tRcc2bTebAC9VQ6ZJHXEKvE5rRcbo53CUOiMcuC2hD18bICchzDQg2Oh3HUDcatx4VMBiGlMqZ1kfq9SbpmI0A1OZdL2sL10R8fIULPEsYOqCzux8bDNbv0tyoBjosNO36aOMOBlHWa3tc5Va1wN5GvOkPqguwj21/XudAQkd7eTrGXkjuxscvaeM9mVAyHnmsR87+ZrXb+LIUxjiFA8zc+wodspI4+rjTRV3Akm1yWFjc3GptXmNPWzG+5Sb+RIFeeSWi24ISBEIx0YdYw7g3spJ8hYD+udQdEo+skaZgdGbJyJfS48FAHnQeCfLDiW5kL6m+nlTP0Dw/VwJf8Aaka/DiPbL6Vb2cYqoByYPeY+J9ksNkDzKj6YSkyqi69UpJHsf83tQGLGklA57ALMmnxHQEN+0uvrTL0eAxDYlm3uQinll7X3r6UvNGsMrwzLeKQkH9htQGHIg+1RuDi8PcfC+SDxyPlAHQQvJnFt6Hsp2xqFXYyhXHw9nMF7zqKgw2ILbOZQfhS2nHKTVfBDN+ixABB0jnGmaxtaThcHj60RwkPViWB97ByvI3FyB33uaawGzTaQb8Fs3goFg8Uywx5I26yF2KuFJEl27SEjdpbhwo50jAmwUUw/s2sf3W1++q/RJ5OoZlkIAc3TKrC5VTfUX1v7UTRutixMZA7aK4sAB4geNcxpcy+rR7XHuM0Hz18KHofiwcM4l1C3EZ3BSqjskjcDvBbTWlzpLsCHGrnw7BZYwbodL87jl+0NNdQKk6IYJ5zIscjJIi5hlO/XKwI+kPh0qj0m2TilKuhCSxuGV17NzYixHDf4Hduo6FV4wbL3PPhwtrZEx8FrsvP/AEknATS4eYMt0ljbjvBG8EcQeI4g12SLqdowJIQB1oysN+RxpY919PNTSDteIYuA4nJ1eIgsuJjGmh+F1/ZOtuWo3Wq7+TnGXeXDMexKhYDkyfit/QVW/C8FruthB9INvWQrqox0sUXbfryi4UErybOn6t1LQtdZF+spIPhmX4lPeeZqvt+F8LKJ4HIDWIZdzBhmVrcQR703bci/PcGxbWaBmic8SVtkY+KlSfFqVtkP+cYN4G+KE2F+CSE2+zID9sVK4xJdctz82G8ndn5EGM1mK2PZY+bSoJY49oqcgWPGAXy7lxAG/Lyf+tRqFXDyvFIGUskiNoRcMpGnka8bMDpcMDoQbEEciNxvRLHl8RklcfpTdJGsB1mTLlcgfSIaxPHIO+rgMIVLWYLDLl+uSeth7bXGoUYAYgAlkGizgDVkHB7b14/IPi4SrZN4b4T93iKHbM2DLdXRirqQVI0II3EU9Y3D5o0nZQGuBMANA3B15BvncVPj/wDzuxN/A5jZ5jy2jipO0UA04hlr9oAeiRkW+tK+0+j0sTWtcc66fiOkKRJbSljG7bWU7iL86pJkqtrcDV70S2LHkJe1zWUJxGPePRDYVlebV7FVc8nEmt7ZTAySEBXlq2NYBXqpAC6z+SmDKiyW+FJJfMBrey1y6bFNJlZzdsqgnnlAAv5V2P8AJMgaFV+tEy+oYVxQIV7J3rofEaGlUR4SfN3NI7Pm4naVvTt+S0fp3/8AT/zGkm9Nv5OJss7jmoP2WH40PaLUid3MI+0j+k7rVUemrk7QxhP/AMxMPSRgPYCg1MH5Qosu0sUOcgf/AO4iSf66h6JYPrJwxFxHZvFibL73P8NNe4NBcck4uAbKd+hOweqjXrD8brmHC5tp/Ct/O1NXRhWXaEysTcMR5DRfKwFu6lHpjtf81lwsIOi9qTzAufVh9imfCS9diY5UNusiHWkcOrJU+ZGX7VQCZa854geYI4FQOnECdb/fx7q5szZkavJiHubGRmvawXOwUL+/a9+XjQvZWKmxG0u3CGXKSrG/YOltL2ygcLcDrrRXbmMUYdQzCNZmLsx0CxoOz7AetWeh8QSKSdZZZQUUoZWuRdb8hYaiqGtE2yHM3J9Mt6FoyG3/AHy5q3tTEyZjBhTGHHxvIwDE66KN58dwuKT8RKZWeDFIgfWwO85TY2Nsrm4J7OvdxqvK+JnZrdVNGWYqHXtKA2gzL2l0sQSd1UcbP2DHKpK3zdh+sZGHFWbVT/FQVHYrOEde22ZvsXEy5XcFgo4IxlmkZw4BRwlkBB1TKASDxv8AfrXxOOy3P1iWPgN3uRQ2HHF4w+t7WN9Dcd3CquOnuCO5R73qN5JfJGSNwOEo6uuDXnLIT5aD76bdl4nLhp5OGXIPOlqYBcLhh+zf1vRTaD9XgI14yMW9BQU6hbjOsfAj3KW4Q4eQRLoXiLwEfSjYt4q1i3pdT5Vt092fmUSqPiF/MD7x/lpf6JbW6vEKtgUvq6tmFiLWI4aa+NP8uF6yGSA/Eh7PlqvtpVgpiv2XA3MZbx95bpW4ZGDrL/Y4JB6O4hHzQSfDMCAfqyW0PmLf1ejOOwhlwwLaSxdhz3roredvlSbjIzHKUGmbVe4/R97jzp+6K44YiI5viYFH/eUAX8xY0uge/pd2c4t8fXFKbfPck/o/JLE5VUzI7EMBvBsN45ab/lvo5s5lGKUKbrIGX1BJHjmv51WgUxYoqNC+7udd3ru/iq9tLqgcLMl1csFcWte1teROhF6Fp/pgzkZ4TcfY8lmXBKWyWMGObeLO6m2mnl6+VM/R3pRHjHGGxIVZipZHGgcDQ3HOl/pJFlx0oGmax+0pFc52nj2XFCRD2oimXxTtfMkV3YwRUdT0Ezwt7QmdnYS8t0uuqdIcJ+a4tXdQI2HVyW3NG5Aa/wC6SHH7tJ2zYThtpJGd6TZPENdfcGnfpY/5zgWZNRlRgOKrIudfK1x5UnbTctjMFPxkXCOf3lKo3+JDVMHxA+fvfmCn9mEAt3j2kfKZujUt8VjITukhV/NOz8m9qVNjSZMeyfRnzRnxkAZf/wAgWmHo/J/xSfkuGYH7UZ++kjbE5XEZ13rkYeK2I97UDW4ntB1ZB9f2ioNxQ3awcgFptJAk7g8Tf1N/neiWFxiACq/ThB1wddzoCPAksPZhSyZiKZRBfSadYj0t8Kzs9T+mCetF0nZ23EXfamPDdIYSCGF1YZWHMH7xvHhXE/zxhxqVNrMONGaTgnnA4QV0DbWzWEoANwNx4Mp1Rh4ipIsAbWy3NUOje1DPhrE9uA2B5xuez9l7jwYU/bEljYKDYnjW9jbANMm7eWn0vNxvpnu8wOWiRZujOJkN1Sw76yux5bgZbV7V2BCWhfOKdFsUf7OpR0PxWnYHrXWgp51mW++pHVADGZXoNpyJ0Qv8mOHfDvFHJobsPI6/fSjt7oFP+dT5MuUzSFfBnJHsafMQ3VSRS8FcX8D/AOPemjaGGHXM/BgGHmKylPiads+v7lRsaG1njj1xBXDMX0ExUYDEKQeVEOj3R2aCXrWtYKQR3HX5gV0XbWLDNkG5d9Vo0BU3HDWmVKYcwg6hMw4gWoD0y6KNipY8QrAB4VDfvR3Q/wCEJXnRLYXUzJETmLuHJ7tAB8z5007OnvhiD8UD6j9luyfcLVbYDZ9oXtuA05aVE9+OkydS0fBCRimk0HaAeCXOlPRpsXiXlz2FyoHg7fjRjo/gjhsPMpYlhkiBO/tW+5var6N8z63NUWxB6tr7ziQD5FvwFZUcG9na7WJ/6/tbV/tDrQprw4Bx0SG1lhIA8v51cjZfzdjoFkktpwBfhbuHClvaO0xDjw7X+BlHeWQBfei+EmthcOf72P5iipvkOHm74HJLJAdG9ebS6KNLCkcE/wCahSDbqxJnAGgftA+QNKu0PyREnrIJYklF9yuiNe+pUEkeR9a6OmIF99WVlq8U2CITW2sFyuPoHjlQh2wxbmjyWPLfGLH1oPtToxioImeXq8gI+E3NywA+iDb8a7NM1AOlMOfCzL+wSPFe0PcVHWoNDSWrS0FpCTNsaQYUc0++inSWJpGw+GjtnyWF9ACRfWw3aGgqP1z4OMcEUH7TE+wFMuyf0u0pX4RAgeOij2zV5lJuMwP5Fo4ASfhTxJJ3ILF0DmRkkvCrKQSVZ9bbxbKAbjnT5DjcrxSHdLGoPjb8dKINHcUvY8/7oCN8ckq/ZdiPkK9fAKVx1f6JWVTaRn9JZ/KNg8kmZdxOYeDb/wDED61X6B7SIxckZNg4SUDvFka3r7UW6Ut1+ESQbxdT56j3FKvRdwMTAx33kT/BmHveoWODO0SMjHv+5SnAZjem7pvCUl6xdCMsg8Qdf67qp7X2gpWw3M8cyd2ZWuPl6Ux9LYM8UbeKn+IX++ue4qU9VFf6LFPRgR/nNZ2gFheN54EX5+oCyraYRHpw1sbccVXz1IrjquWYsd5JJ8SbmuwdJR1m0o0GvwA+rE+1aydEInxOURgsGDFhuy7+0Prf14uoHC97ozOm0E24zn9qig7CXHzR3orgf9wYuLF4IUseUKaf4i1JE0QH+z2O5JZcx5COZpW9BeugbcmaNFhj3tp4KPiPgFv5kUoNsvrooo75TI+JZTyW8Vx5i/kxo3TjA1jmfiVzf7gHD1/2qXRKfM2OxPNBGv8A6j6edkHrSdtKXNK54XIHgNB8q6B/sZoIBhIjeRi0zngNAqX9AaUpOieJC3CgimMZ4iRoAAqqQGMuGQEDhmtOkXaw2Ef9gJ9kZP8A26WhTTtfCSDAwKyHMsjgi3C7t/rpYykbwa2kCAR5nnPymU7Diea8dKozrV8ms6m9OBTQEb6J4sQyIToj/o3/AHX0v5Gzfw0y9HccIcdJHIxANitzpr/O9LuFwavHoam6SQlxFMD2ioRj3p/O9JMsqtdtkfI+UNRgL2kayPkLteGxQIuraVlc86JbSJisWJI0rKrDrJDmQYTVGprxhW+fTSpsGnE1MxrWzCpe4nNePgOsjZD9IenI+tquYLGM+DuR+khurDjpp91TRqCb8BqaE4faapiGci0UnZcd24N8vSud4Tj4Hdt4FSVrEPGnJDCRe3Em5ogFAFue+vJsB1btfUA6d4Oo9qjXfa+p9hTHXNjkqGkYd612dNkxF5BaOYFG9LX9NfKtNinq9qMh4ED2NayQ9exF7KvHlbj60JfGsmOikfRuwrd+UZQfMAV59fwEbMQd9j59VJWbhdIyJ90eh0kYH6LuPe49iKCbQeyy92IDfauR86P4iVVxkyt8LhZF9gfmvpQLpDFYYgLu/RSjysp+VKqSaQbskekjkmuANC2hV7b0XWYjPwSFXPiy2H3+1G8WxXZyEb0ZD5hhS5DiCYJJDvkdYx4Itv8AR70wg59nSDkL/JqxhxNeBqHHr0lSn+5PkjM0asAw3MAR56iq6ow3Mw8zVXoxjw+FjvvW6c/hOn+ErV4TLzHrXptcHgO2iVQCSJWhz/Xb1qGRWa4LEg3B86tFhzrUCsIkpgXPuhcNsWA39kr+1xRfo0HKyyqxHWSHdxA/mTVXDWjm2hIv0QQPFzr700bJwHVQRx8QozeJ1PuTUXZqPjtpPqTHwVI0R7qlLPNu6x/tGrEUn+4SE62kffvN7fjW2NKg2uKoYrFZdmufrSv7XH3UyqS0Pv8AxK6pceqq7EfPg50+p2h/DrQborgs+L3/AKrO/j2WT5uD5US/J++frk+sg9x/KhnR/EiLFkk2BQg6E7wNABqSSLAVNTjvKc7Tzn/JIH4tXSMSufC94yn7q5xPBml6rnPF6Ncn5Cuk4I3w7D+7U+7Vzp5VXFNIdyKz+agqPcirO1NFnHcUJExuUuEw8mJx8rxtlyaZ/q37JOu76dNRxUeGAhg7cjhiXbW9hqx4kXsPOg+wYJY4coVS8hMjZiVFzxawJsBw5k+VzBYQJmkkfM7/ABPawsNAFHBddBqdeJNbQplrBOee6flVUqJIvZYcRnw/WDWR+zrqc1ytu4XvVXHkRzw/9PCxMXPfIAqjxOQG3fWbEb9NMvBCJADpYuupPK1j9o1Ev+9SHKLwxtmP98/M/siw05ACsmWg6/R+1wlwAGZj219VJsuJiks8g7cutvqr9Eenzq1OQqKo3kVLj5zlsB3VThYnRhqo0NUUxharWtDRhCjlQEWIBsfn/wCKrQYCFiQY1PlV6OIsDfTl31Vy5HF+dY+7SAb5oqbcJuhmI6G4d72XKbX0oTJ0JF1Cvv01p2jUhmPMaVXwZuy3Hwk3rsRuiFkk/wDwxNGSBY620oftDCyrh5FdSMrh1J7xkNv6410xYmLC44kn7q829COpsyi1gdaW/wAQ3QfQrnGQN45rmnQrEEM4PL8KynSfBRHKyoFJGtuNZThUgLnCTZMGHTTXdyqcHUAbqrNKdbcat4d+rQyvw3DmaEIXXWm2cUI06sHU6sfuoThIt+bUnu3DlVR5WkYs2pOvhRLEQrFGpzanWurOLWWzRUmguVhjdBGTqo/Rk8R9U+HA+VDhdQb/ABNoPvqASM5vrUzSfpMx1AGtt2lDRJDYK51MNNslahAQZf4n7+QoJ0xi7KSD4kbtHlm3Dyt70XgW4F/3m+4VV2kgeF1P0gTfv+j70NRvegtHRQVKc0yPRebXxIvg8TwIKN8tfJgfKrW2YQzBeBR42/iFwfUe9ANmSfnGAlhPxwnOBxsNG9ifs0V2VjFlwMjsbyKCrc7oLg+J7JqKmC/jfjEH3E7iEim4FpbtuOCHxt/umGH1nkb/AAfzpq6Kv1mFkT9n/Tl+6l3YoVhgFbcwlB84wBRvoQpVpYjvXMp/hc/jS6E963Ybf9UiPEFF+T2bsSxnerq32gVP+QUySRC0mnH76UOhMmXF4lPP7L//ANU5u2r9/wCFXdjM0Wym0/xVWaFexoOP3Vv+aDNew4fKt23L41OTuqmAmSkTZWGzPiYz9PFqp8AxY+wppx+ARYzpQ3BQ5cbKvDrlkH8UD/6r1f2/jESMl2AFxbmbchvPlSKTQ1jp2lJCFbRjVQhsNzE+VqD7fmY4fCYVPjcFiO+Vri/kR61mKx7YmwRGWFbh5CN43t4GwIAFzci9r2IhNp5sRJiSLlexEo4sRYAdwHzFS1CCY6iQeYHCUuqZMdeaaeimGSHGCJTcZLE82tr4b91BNm4VH2gYpASn6QMA2W4UMd/Aaa0Y6PbMkw+Iw7Sn9JMZC4+qTlsvkKr7Di/40w4Bpb/Yf8aHuzia1w/mPcNSiL8U17KxN4Zh9VLejsK52vbxCjgXW/gJAT7U37Bl/QTnhk+cj/hS10bjVsSucMQAxIWxPuRzpr394WTt/wAilsvh61TZJL2bi+Z+yoGptW0+GYWZgAwHYUnsxD6zn61T/wC2MPD+rUmRtBcHOe4LbSl/bGImkVpJT1can4N7O3AG3E1dUqAC3sqXVS+cPW8qBwZmMGG3Gxnmt8eUceS8l438TV7Z79VGQt7Hd5c6vbAwZgwjs3xspdu4nQDyFhWggskRt8Qa/eKVSEEE+mzrVU0aWBs6mFFHtAkE5Rbna9QDEve3EjsnnWuDSySAC12sK3kwpESX3iqIaE6XQq8LyAnMbk1ptGT9EM3x37PO1bxQuQSGNhUGJAjUSHVibLfdQyMYhdfCiuHxwCKrfFaqePns4KneLtUOzYiUMjbq2SO7gcMpdvuFIAwuI2JsyAVPDtFiouO1f2qPa21s0DI48Kjwc5spNruzHwC1T2kLqxtbX76OBeyFbzvaKM7ia9qFiLC5vy7qyuGS4lM+z4TIw/rSqG3sdmk6pSMig27yBe9HpwYogi26yQHyH891JuIe0jEahR66W0o2iShVnAuvZLGw1vYelXcTKstgNLc6F4W7AX0BN/wq5nFrKdePdUteCcN+iqaUgSpMw+FdO/wraM7tBxyjhYb2NQRyLqb9kb+Z8K8mNzlvq1i3cBuH31Q2i1ohtkk1C65V1cSrLpfLexP0nPdVbEJqRppq3dbhWCYAgpqdydw+t51CHFjrcA/aPEnuFEymG5IXPJzQjFA4TFR4gDsSfGOWbeD4r99eYeHqZ54M3YeN2T9rKjMhHih9RRnaGB62Jw97Fb3sdCNx8b2HhSzJKzQq50mwrdW195UkgX8CSv8AGKiqNDHBwNj0R1sUtQYXzx+1YWcrh8E671Zx/gU03bAxAOMzDdMubzy2b3S/8VI+Glvg4Tf9VOubuB0/00Z6P4oo4lbSKPrWB5DUZfXLbxqYNLXhw2j2j9+qXExwVnYZ/wCKYi24K3zSnZDr5Uj9AEaWTEYpho5yr5nM3+mnVG3Vd2ZsMEpjMlIT2R41T2jiGSSN7ExgEHKCTcg8BrvCjzNSzyhUJYgAHeSAPeoGxCSCwKuCLGxuNfCnP2IyEIxeJmkm6xEMOYBA7lbn4rXFjbRm576H4/DQxdvEyGd+A3A+PMe3dVjGbMhViFeQMfhjVwb+NwSo7zUf/wAGmUjNOwa2vZvbwufepyx7icIk77fCQWnVAcVtSWYiJAMznIiLoF8BwA3k9w5U59Geh6QZJHIeTh9VOduZ76s9GOicOGzuLvIezna1wOSgaKKZo4vg7qf2bsgZ4n3PXXJCG3koBt7TFYT/ALjfIClnZj5dp4x9ewszaAnkOHjR7beIDYuIbykiqLcCblvmg8b0v7NBzbTm4ZXUHxLk/IUt1+0T/wCwPo2PhLcL9bFZ2C2XBzn9mMf5nPzpe6PpmaQ3Ismlja5LDTw30WilybNlP1pMv2VC0I6NCQ5hGozOQMzHsrlubkDU791R0oxU52T7uKGm2XNBE2Thh5IsOI3ay9knQDO7HQDmTVSGIuwlcWsHZEP0TuzNzYn00qDBR9WskjkvL8IkI1XnlH0bjlRKQguQBoHiW3IWH316eG1/RXtE/SKbR7OHYfur8r1Rxk+RVtqVARBzJFzVvbTgRIDxf1tehbSEM/8AdA7+LN/RrAIJKcrOAwoa19y6nvPGqe08XmuBurddolcOv1n31BJgybOD6+F6wQDieVpvZqhmkIS+4Md3dVbayX6ocPxrbFStch/EciBXuO1w4t8SkHv7/aimCCuzBV3GRhYGROABNU8Mbsg+shX0uK02fibxSk78lQ4HEherJ3BmBPK9rUtzYBG/kiBv6KPCNbqxbczIfetsUCVdf6NZIcrNfekobxDaV7iJMwcnkPu/Gjd+SFuSoth24jTS3ffjWVcLjqlIsRcjThvrKUKhhEWiUS2vtPMzyHvVR37vYe5oZhYWsxbRTqTxHJfH8a9jg7QJNguijkeZ89asY6UEWJ0BsOGY6VRkICAXzUMbmRtAbA6W7uAqTE6N1Y36X8bcanwPZXUakW0Pw/jQyfEW6x76k2XzpTYe/wAhkmOlrd6s5xcm/Yj0A4M3P+uVeYeXQsx1YZm4kLf2J3VXljARV4Lq3edNPlWoe5s264aT/Sg+VOBsSOus0ki4BVszA2F7M1yT9RBW+HcMwAFgNw9x/wDsaHYmX4tO0xGYb/3UHhvNEOj8F5Lk9hAWc9w1JvyO7woDLWwMytmTJRzaUoVUhvbdJJ3AHsA+La+VK23dlYiSdjCoUSoA50s1rEg33HRaIRYwszzFbmQ3yn7Ma92mp8+daYva8kYJh7T2IBJ4AnM2vNv8ooarQafXV0t4nNUZ9izxxfp8VljAAIsu4C1tRrpQaKU4lvzfDgrCNXc72t9Jjy5DvrMRgsRiCZMTIQqgEDfmve1uH9bqL4UpCrIgst7d7EWuxPHU6VL3ZN3LGMxW0904dHjGkCogsE7J8d9/O9E7ilnolN1hkS+oGYDwNvvpgCMN4qkZJjmwYUWJ2bG5u+ZrbhmNh4WqKbY0DAAxr6WPqNavBqpbQ2xDB+skAPLex8ANa7C3MoSdq3wWx4o/1aAXOp1JPmdaOQRAPfupI/25isQbYaLq0/6km/yG4e9enAxjtYrFPK31VY2/l7Vwrtb+I+B7pJKbptswR3UuGcn4E7bHyG7ztWYbaUsr5EjEdhqWIZlHMqNAeQJNL+zVeTsYWIQx8ZLa+vE+F6cNl4FYkyoDzJO9jxJptJ76hnTrbz5oYQ/amFSOOIKLWlRiTvaxZiSeJ3mkxexsl31vO7OfAuF9Oz70z9N3cdWq31SYgc2yrGnvLQHp9g+pgjgU6JEAe8l1F/UGlVTDnEfxbHrEICMz5Hkgm1Xy7NgXjIzv6tYfKruwMN1UAdtCQco4nNx8LaVR6URkyYfCj+zjRSO8i7fOjQly2UDNLuUbxGAN5vxt6UjszIqOJ0hvoBPC3Gw1W0G+InZbrzW+0WtCFPxyHMBy8fKsiNrt9bKBz7A1b51SLBW1Ic31P1mJ+FT47zVx2O64vcaDdwso7ufhXoERA6660KpBm63xsxY4ZTxu32mGlU53zLM1/iksP4Rr86sYs5cSgvcxxj17T39q2w8BEUN/pPc+LN+AFKLo9UYEqvtLsRqvIC/jbWreHcrAubfY38zp7WoTtRw0wzfCZAD4XoqHJzAjuHgB+FK7RZjW8Uyl+RKE41iSmmlzr71tA92Ve/7taikkOU2BJU6ga6AEe1V8BiSJFbkd/CtLS+kI81wcGvM6oquHCyWG52KleV6B4uMjOAdB72NE9q4vK8bjeRfz4VVxygSyDmlx52J9KNskgnUA/H0hNvf7+1JKpOc3/s4vc1pPYhwDpk/l9wrXES9XuJ1hQgjfoV9LEVIoGSR+cZNr997+hrNJ6yC7LrzKk2PhAkdjqCbjyuKyvMKScOmuoZgbd+tZU8k5ppF1qu619R2mtfS+5Ry/rlWjHO/h41ZHwt+9+NRwfEfH8KrqHCClNEkL3HNYgcefIUNbEZuRUHs31JPp/VxRLG/DKe4j1FUerGZBbgW87DX2pNNuFnW9Me6XLXET2+L6JU37+VudRDFBNLHTXwJ4+NqrS6rF3kk95vvqQN2R3tIT3lV09K0tgQCuDryQoevsd/rfdvt5neaYGmVcKiKRea7SnlHGdQf3msLcr0JijGYacve9X9uIBLKALdtF8hGWA8Lm9GSRJ61QQFXbaB1AuCL20+kwyqP4U1NVkOYkLezADvyKbeVzYDwqhI5yjXeB/jbtetY0hEbMDY9rX90EL6DdyrTeEAV7aOPPwi3Z4c2IsPQUJlxRvv0H3f171BLMwA1O4e4qFfi/rlSqk5bE2mi3Rvbxw+LRiGKapJbU2bkONiAfKurYXb2GkTrEmRlGhsdQeRXeD3WvXJcFColU21v91VcTM0fXhDl8NDu576zHAshqN1T70g6SMxKrIuHj4sbGZvBfoeetAsHLGDeCBpGJ1ll+eulc+n2tNDIOre1yN4VuX1geZoftbbmIxH66VnAvYaBRr9UAC/lW9w513FT4b3XccHs+abWacKv1EOn4e1NWyNj4VbWCM37RDH0O70r5YwyA/wBdxqxhHaMGSNmR1tlZWKkeBBpzKbW6SfNd3a+xIIxyFWAQK+dejPTnaEkbh8S5y5baICN3ELej+yZnnBM0ksm/RpHK7j9HNb2o3VhJWtougJ96WbawqSQl5VJQksiEO+jRuOyNdSgFKGIxM2LnVpFKrJKoAPBQc1vJRr3k1JsXAxp8KKPAUW2hpJh+4TN5iJtaVVhoI2kfSEt8JKVTiTJippgLksyx+egPkLetF2QqRCt+tf8AWNvyjiAefPyFVOicYy5rahGYHkedZhXPVyPfta68edB2YeAed+J+kNIQyd60JDMOruFDdVFp9I72POwPvRDCLmKqtwL5I778q/G3eTqb91D49I4baWjkbzN9fei2xls8XdFp3XZfxPrTmmb9acpHp5pxEW61+vdDcTc4uU8BdR/DE6/dTHBlMUVzqMrDu7R+6lVXP5xNr9Kf5NRQOckRvr1a+zNSK34g9apjM4Q/bTBZSb6A5vQg0TkxIBlbS1iV8CL/AH0O2/8AE39cKliX9EvcLD2rK4mm1y2mYeQq2CcjM/IMfQfzoUmI3c/a33cKKdIuyrBdBm4eFAIeHjVFBsNxHVLqmTGxGtqwEwQtY3u1/W+vyqxjEBkudxiOYcrJfT3rTa+6AcCDp6VHiv18/dDp3dn+dA27Rx/+giOZ3/4qLHWCqQf7I2vqdf5/Kp4JLwG+/qGI8lQVpjv7L/tVNhP+XP8A9O/+UV2nWwLuvcqzgHyxW5tf2/8AFZUGBPb/AIf9RrKmYwFoKa43X//Z" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Indoor plants</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <a href="assets/img/portfolio/app-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXeRszEKeqVKfCiUgt6vK_MAItmmhRMcYMfA&usqp=CAU" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Cactus</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-product">
              <div class="portfolio-wrap">
                <a href="assets/img/portfolio/product-2.jpg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTD2CpskAu-mRfqaS8Q4aMivARv-GOc5EXBFQ&usqp=CAU" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><a href="portfolio-details.html" title="More Details">Low maintenance plants</a></h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                </div>
              </div>
              
            </div><!-- End Portfolio Item -->
            

            <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
              <div class="portfolio-wrap">
                
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-books">
              <div class="portfolio-wrap">
                
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-product">
              <div class="portfolio-wrap">
                
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
              <div class="portfolio-wrap">
                
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-xl-4 col-md-6 portfolio-item filter-books">
              <div class="portfolio-wrap">
                
                </div>
              </div>
            </div><!-- End Portfolio Item -->

          </div><!-- End Portfolio Container -->

        </div>
        <div style="text-align: center;">
        
        <form action="userPurchase.php">
        <input type="submit" value="Purchase here" style="background-color: #009688; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onmouseover="this.style.backgroundColor='#00796b'" onmouseout="this.style.backgroundColor='#009688'">
    </form>
</div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Unleash Your Green Thumb: A Guide to Growing Anything!</h2>
          <p style="margin-bottom: 50px;">Discover the secrets to cultivating a thriving garden with our comprehensive guide. Whether you're a seasoned gardener or just starting, "Grow Anything!!" has the tips and tricks you need. Click below to explore step-by-step instructions and elevate your planting skills to new heights.</p>
          <form action="display_tech.php">
                    <input style="background-color: #009688; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;"type="submit" value="How to plant?" class="button">
                </form>
        </div>

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="member">
              
          </div><!-- End Team Member -->

        </div>

      </div>
    </section><!-- End Our Team Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Revitalize Your Garden: Expert Solutions for Plant Health Concerns</h2>
          <p style="margin-bottom: ;">Concerned about the well-being of your plants? Worry not! We here to provide top-notch solutions to ensure the health and vitality of your garden. Explore our comprehensive pest management strategies by clicking the button below and give your plants the care they deserve.</p>
          
        </div>

        <div class="row g-4 py-lg-5" data-aos="zoom-out" data-aos-delay="100">

          <div class="col-lg-4">
            <div class="pricing-item">
              
              
             
              
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-lg-4">
            <div class="pricing-item featured">
             
              <div class="text-center"><a href="pestmanagement.php" class="buy-btn">Click here</a></div>
            </div>
          </div><!-- End Pricing Item -->

          <div class="col-lg-4">
            <div class="pricing-item">
              
          </div><!-- End Pricing Item -->

        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-4">
           
          </div>

          <div class="col-lg-8">

              </div><!-- # Faq item-->

             
              </div><!-- # Faq item-->

             
              </div><!-- # Faq item-->

            </div>

          </div>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-posts" class="recent-posts sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
       
          
          <h2>Explore a World of Nutrients with the Best Fertilizers</h2>
          <p style="margin-bottom: 50px;">Enhance your plant's growth and health by choosing the perfect fertilizer from our curated selection. Whether you're a seasoned gardener or just starting, we have the right nutrients for your plants' needs.</p>
          <form action="fertilizer.php">
            <input type="submit" value="Discover Fertilizers" class="button">
          </form>


        </div>

      

          
          </div><!-- End post list item -->

          

            </article>
          </div><!-- End post list item -->

        </div><!-- End recent posts list -->

      </div>
    </section><!-- End Recent Blog Posts Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Requirements</h2>
          <p></p>

          <h3></h3>
          <h4></h4>

            <form action="display_req.php">
                <input type="submit" value="Click Here" class="button">
            </form>
        </div>
        </div>

        <div class="row gx-lg-0 gy-4">

          <div class="col-lg-4">

            <div class="info-container d-flex flex-column align-items-center justify-content-center">
              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Location:</h4>
                  <p>A108 Adam Street, New York, NY 535022</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <p>info@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-phone flex-shrink-0"></i>
                <div>
                  <h4>Call:</h4>
                  <p>+1 5589 55488 55</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-clock flex-shrink-0"></i>
                <div>
                  <h4>Open Hours:</h4>
                  <p>Mon-Sat: 11AM - 23PM</p>
                </div>
              </div><!-- End Info Item -->
            </div>

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="7" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="index.html" class="logo d-flex align-items-center">
            <span>Nature U </span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>
            A108 Adam Street <br>
            New York, NY 535022<br>
            United States <br><br>
            <strong>Phone:</strong> +1 5589 55488 55<br>
            <strong>Email:</strong> info@example.com<br>
          </p>

        </div>

      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Impact</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/impact-bootstrap-business-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>