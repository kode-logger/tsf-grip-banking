<?php
require('connect2db.php');

function checkAccountDB(): bool
{
    global $conn;
    $email = $_POST['email'];
    $query = "select * from customer where email = '$email'";
    $result = $conn->query($query);
    if (mysqli_num_rows($result) > 0)
        return false;
    else
        return true;
}

function addAccountDB(): bool
{
    global $conn;

    $name = ucfirst($_POST['name']);
    $email = $_POST['email'];
    $balance = $_POST['balance'];
    $gender = ($_POST['gender'] == "Male") ? 'M' : 'F';

    if (checkAccountDB()) {
        if ($conn->query("insert into customer(name, email, balance, gender) value('$name', '$email', '$balance', '$gender')"))
            return true;
        else
            return false;
    } else
        return false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--  site meta-data  -->
    <meta charset="UTF-8">
    <title>Bankamon: Accounts</title>

    <!--  custom CSS  -->
    <link rel="stylesheet" href="../../static/css/style.css">

    <!--  Bootstrap   -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

</head>
<body class="bg-color">
<!-- Header-->
<header>
    <!--  Home Page Nav Bar  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg ">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                    aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <a class="navbar-brand" href="#"
                   style="border: 2px #FFFFFF solid;border-radius: 50%; padding: 5px;">BM</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active-page" aria-current="page" href="#">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customers.php">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transaction.php">Transactions</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Header-->

<!-- Main -->
<main id="main">
    <!--  Home Page Content  -->
    <div class="container" id="main-container">
        <h1>Account</h1>
        <ul class="text-light">
            <li>Need to urgently transfer money and you are new here?</li>
            <li>No worries, fill in the requested details below and submit the form.</li>
            <li>All the following fields are mandatory.</li>
        </ul>

        <!-- Cards -->
        <div class="cards">
            <!-- Center Card -->
            <div class="center-card" style="background-color: #0E49B5">
                <!-- Left Card -->
                <div class="left-card" style="margin:5px;">
                    <img src="../../static/img/male_profile_icon.svg"
                         width="120px" height="120px" alt="profile-icon"
                         id="profile-icon">
                    <p id="name-display">Name</p>
                    <p id="balance-display">Balance</p>
                    <p id="gender-display">Gender</p>
                </div>
                <!-- End of Left Card -->

                <!-- Right Card -->
                <div class="right-card" style="width: 60%;margin:5px;">
                    <form action="#" method="post" id="createForm" name="myForm">
                        <!-- Name field -->
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" id="name" placeholder="Full Name"
                                       onclick="updateName()" class="form-control" required>
                            </div>
                        </div>

                        <!-- Email field -->
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" id="email"
                                       placeholder="someone@email.com" onclick="updateBalance()" class="form-control"
                                       required>
                            </div>
                        </div>

                        <!-- Balance field -->
                        <div class="mb-3 row">
                            <label for="balance" class="col-sm-2 col-form-label">Balance</label>
                            <div class="col-sm-6"><input type="number" name="balance" id="balance"
                                                         placeholder="Rs 00000" onclick="updateBalance()"
                                                         class="form-control" required>
                            </div>
                        </div>

                        <!-- Gender field -->
                        <div class="form-group">
                            <label class="control-label" style="margin-top: 10px;">Gender</label>
                        </div>
                        <div style="margin-left: 18%;margin-top:-24px;">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male"
                                       required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female"
                                       required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>

                        <!-- Create Button -->
                        <div class="form-group">
                            <input type="submit" name="submit" value="Create" id="createBtn"
                                   class="btn-center btn btn-primary me-2">
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['submit']) && strlen($_POST['name']) > 0 && strlen($_POST['email']) > 0) {
                        if (!addAccountDB()) {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"> Email already in Use
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                            <?php
                        } else {
                            echo "<script>window.location.href='../php/customers.php'</script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Main -->

<!-- Footer -->
<footer class="bg-dark text-center text-white footer">
    <div class="text-center p-3" style="background-image: linear-gradient(to bottom, #153E90, #03256C);padding: 10px;">

        <!-- Google -->
        <a class="btn btn-outline-light btn-floating m-1" href="mailto:nkrishnaraj0907@gmail.com" role="button"
           target="_blank"><i class="fab fa-google"></i></a>

        <!-- Instagram -->
        <a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/kodereaper/
" role="button" target="_blank"><i class="fab fa-instagram"></i></a>

        <!-- Linkedin -->
        <a class="btn btn-outline-light btn-floating m-1" href="https://www.linkedin.com/in/n-krishna-raj-746688127/
" role="button" target="_blank"><i class="fab fa-linkedin-in"></i></a>

        <!-- Github -->
        <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/kode-logger" role="button"
           target="_blank"><i class="fab fa-github"></i></a>
        <p style="font-family: 'Prompt', sans-serif; margin: 10px 0 0 0;">© 2021 Copyright: N.KRISHNA RAJ (JUL21 Intern)
            @
            The Sparks
            Foundation</p>
    </div>
</footer>
<!-- Footer -->

<!-- Javascript Form Handler-->
<script crossorigin="anonymous" src="../../static/js/accountFormHandler.js"></script>

</body>
</html>
