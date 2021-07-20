<?php
require("connect2db.php");

$sender['name'] = '';
$sender['balance'] = '';
$sender['email'] = '';

function getSender()
{
    global $conn, $sender;
    $user_id = $_POST['transfer'];
    $query = "select name, balance, email from customer where id=$user_id";
    $result = $conn->query($query);
    while ($row = mysqli_fetch_assoc($result)) {
        $sender['name'] = ucwords($row['name']);
        $sender['balance'] = $row['balance'];
        $sender['email'] = $row['email'];
    }
    $sender['id'] = $user_id;
}

function getCustomers()
{
    global $conn;
    $user_id = $_POST['transfer'];
    $query = "select id, name, balance, email from customer where id != $user_id";
    $result = $conn->query($query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . ' ( Rs. ' . $row['balance'] . ' )' . '</option>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!--  site meta-data  -->
    <meta charset="UTF-8">
    <title>Bankamon: Transfer</title>

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
                        <a class="nav-link active-page" aria-current="page" href="customers.php">Go Back</a>
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
        <div class="cards table-center-card" style="padding: 10px;">
            <form action="transaction.php" method="post" id="form" style="width: 100%;margin: 10px 30px 10px 10px;">
                <h2 class="display-5" style="margin-left: 10px;">From</h2>
                <?php getSender(); ?>

                <div class="transfer-text">
                    <input type="hidden" name="sid" value="<?php echo $sender['id'];?>">
                    <div class="form-group row">
                        <label for="sname" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="sname"
                                   value="<?php echo $sender['name']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="semail" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="semail"
                                   value="<?php echo $sender['email']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sbalance" class="col-sm-2 col-form-label">Balance:</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="sbalance" name="sbal"
                                   value="Rs. <?php echo $sender['balance']; ?>">
                        </div>
                    </div>
                </div>


                <h5 class="display-5" style="margin:20px 10px;">To</h5>
                <div class="transfer-text">
                    <div class="form-group">
                        <select class="form-select" id="rid" name="rid" required>
                            <option selected disabled value="-1">Select a customer</option>
                            <?php getCustomers(); ?>
                        </select>
                    </div>
                    <div class="form-group form-group-lg">
                        <label for="amount" class="form-label col-2"></label>
                        <div class="col-lg-8">
                            <input type="number" class="form-control input-lg" id="amount" name="amount"
                                   placeholder="Enter Transfer Amount" required>
                        </div>
                    </div>
                    <div class="form-group-row">
                        <input type="submit" name="pay" class="btn-primary btn" style="margin:20px;padding:10px 40px;"
                               value="Transfer">
                    </div>
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

