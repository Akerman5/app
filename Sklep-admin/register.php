<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Створіть акаунт!</h1>
                            </div>
                            <form class="user" action="Main.php" method="post">
                                
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Пошта" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password" name="password"
                                        placeholder="Пароль" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="phone" name="phone"
                                        placeholder="Номер телефону" required="true">
                                </div>
                                
                                <input type="submit"  id="reg-btn" name="reg-btn" class="btn btn-primary btn-user btn-block" value="Створити акаунт">
                                    
                                </input>
                                
                            </form>
                            <hr>
                            <?php
                            if(isset($_SESSION["checkEmail"]))if($_SESSION["checkEmail"]=="false")
                            {
                                echo
							                      "<div class='alert alert-warning probootstrap-animate fadeInUp probootstrap-animated' role='alert'>
                                      Акаунт з такою поштою вже є
                                    </div>
                                    
                                    ";
                            $_SESSION["checkEmail"]="true";
                            }
                            if(isset($_SESSION["successReg"]))if($_SESSION["successReg"]=="true")
                            {
                                echo
							                      "<div class='alert alert-success probootstrap-animate fadeInUp probootstrap-animated' role='alert'>
                                      Акаунт створено очікуйте активації від головного адміністратора!
                                    </div>
                                    
                                    ";
                            $_SESSION["successReg"]="false";
                            }
                            ?>
                            <div class="text-center">
                                <a class="small" href="login.php">Вже є акаунт? Увійдіть!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>