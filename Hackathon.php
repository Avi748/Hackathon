<?php
    if(isset($_POST["btnSave"]) && $_POST["btnSave"] == 'Submit'){
        $cn = pg_connect("host=localhost port=5432 dbname=Hackathon user=postgres password=656565");
        $first_name=$_POST["first"];
        $last_name=$_POST["last"];
        $email=$_POST["email"];
        $phone_number=$_POST["phone"];
        $comments=$_POST["comment"];
        $query="call add_volunteer('".$first_name."','".$last_name."','".$email."','".$phone_number."','".$comments."')";
        $res = @pg_query($cn, $query);
    }else{
      //do nothing
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a83d7d08b5.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/project.css">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary " data-bs-theme="danger">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#"></a>
          <i class="fa-brands fa-pagelines fa-lg"></i>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#bimage">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#contact">Contact</a>
              </li>
          </div>
        </div>
      </nav>
  <header>
    <div class="jumbotron jumbotron-fluid" id="bimage">
      <div class="container">
      <h1 class="display-3" style="text-align:left; padding-top:5%;">Come work with Us</h1>
      <p class="lead" style="text-align:left;font-size:200%; ">The National Farmers Organization (NFO) Offer a scholarship for high-school senior </p>
    </div>
  </header>
    <div class="container" id="contact">
      <h1 class="my-5">Contact Us!</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="form-floating mb-3">
            <i class="icon fa-solid fa-user-tie fa-lg"></i>
            <input type="text" name="first" class="form-control" id="floatingFirstName" placeholder="First Name">
            <label for="floatingFirstName" style="margin-left: 20px;">First Name</label>
          </div>

          <div class="form-floating mb-3">
            <i class="icon fa-solid fa-user-tie fa-lg"></i>
            <input type="text" name="last" class="form-control" id="floatingLastName" placeholder="Last Name">
            <label for="floatingLastName" style="margin-left: 20px;">Last Name</label>
          </div>

          <div class="form-floating mb-3">
            <i class="icon fa-solid fa-envelope fa-lg"></i>
            <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Email">
            <label for="floatingEmail" style="margin-left: 24px;">Email</label>
          </div>

          <div class="form-floating mb-3">
            <i class="icon fa-solid fa-phone fa-lg"></i>
            <input type="text" name="phone" class="form-control" id="floatingPhone" placeholder="Phone">
            <label for="floatingPhone" style="margin-left: 20px;">Phone</label>
          </div>

          <div class="form-floating mb-3">
            <i class="icon-textarea fa-solid fa-message fa-lg"></i>
            <textarea class="form-control" name="comment" placeholder="Leave a Comment Here" id="floatingTextArea" style="height: 100px"></textarea>
            <label for="floatingTextArea" style="margin-left: 24px;">Comments</label>
          </div>
          <input type="submit" value="Submit" name="btnSave" id="" class="btn btn-outline-warning mb-5">
          
        </form>
      </div>
      <footer class="py-2 bg-dark text-body-light">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3 ">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Home</a></li>
      </ul>
      <p class="text-center text-white">© 2023</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>