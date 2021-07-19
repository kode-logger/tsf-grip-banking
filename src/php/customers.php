<?php
require('connect2db.php');

function displayCustomers()
{
    global $conn;
    $result = $conn->query("select * from customer");
    $index = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr><td>' . $index . '</td><td>' . ucwords($row['name']) . '</td><td>' . $row['email'] . '</td><td>' . 'Rs. ' . $row['balance'] . '</td><td><button type="submit" class="btn-primary btn" name="transfer" value="'.$row['id'].'">Transfer</button></td></tr>';
        $index++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--  site meta-data  -->
    <meta charset="UTF-8">
    <title>Bankamon: Customers</title>

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
                        <a class="nav-link" href="account.php">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active-page" aria-current="page" href="#">Customers</a>
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
        <h1>Customers</h1>
        <ul class="text-light">
            <li>Select a customer account to transfer money from that account to any other account.</li>
        </ul>
        <div class="cards table-center-card" style="padding: 10px;">
            <form action="transfer.php" method="post" id="form" style="width: 100%;margin: 10px 30px 10px 10px;">
                <table class="table table-hover table-bordered border-primary border border-3" style="vertical-align: middle">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Current Balance</th>
                        <th>Make Transaction</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php displayCustomers(); ?>
                    </tbody>
                </table>
            </form>
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

</body>
</html>
