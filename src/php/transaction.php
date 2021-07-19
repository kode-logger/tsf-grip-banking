<?php
require('connect2db.php');

function displayTransactions()
{
    global $conn; // accessing the database connection object
    $query = "select * from transaction"; // a query to get all the rows from the transaction table
    $result = $conn->query($query);

    if ($result) {
        $index = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $sid = $row['sender'];
            $rid = $row['receiver'];
            $sname = '';
            $rname = '';
            // getting sender name
            $result_sender = $conn->query("select name from customer where id ='$sid'");
            while ($row_sender = mysqli_fetch_assoc($result_sender))
                $sname = $row_sender['name'];
            // getting receiver name
            $result_receiver = $conn->query("select name from customer where id ='$rid'");
            while ($row_receiver = mysqli_fetch_assoc($result_receiver))
                $rname = $row_receiver['name'];
            // final html output
            echo '<tr><td>' . $index . '</td><td>' . $sname . '</td><td>' . $rname . '</td><td> Rs. ' . $row['amount'] . '</td><td>' . $row['transaction_time'] . '</td></tr>';
            $index++;
        }
    }

}

function addTransaction()
{
    if (!empty($_POST)) {
        global $conn;
        $query = "insert into transaction(sender, receiver, amount, transaction_time) value(" . $_POST['sid'] . ", " . $_POST['rid'] . ", " . $_POST['amount'] . ", now())";
        $conn->query($query);
        updateCustomer($_POST['sid'], $_POST['rid'], $_POST['amount']);
    }
}

function updateCustomer($sid, $rid, $amount): bool
{
    global $conn;
    $sbal = (int)explode(' ', $_POST['sbal'])[1] - $amount;
    $rbal = 0;
    if ($conn->query("update customer set balance = $sbal where id = '$sid'")) {
        $result = $conn->query("select balance from customer where id = '$rid'");
        while ($row = mysqli_fetch_assoc($result))
            $rbal = $row['balance'];
        $rbal += $amount;
        if ($conn->query("update customer set balance = $rbal where id = '$rid'"))
            return true;
        else
            return false;
    } else
        return false;
}

function checkValidity()
{
    $sbal = (int)explode(' ', $_POST['sbal'])[1]; // removing "Rs." from "Rs. 123" and converting "123" to 123.
    if ($_POST['amount'] > $sbal) {
        echo '<div class="alert alert-danger alert-dismissible fade show myAlert" role="alert">Insufficient Balance, Redirecting to Customer page 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>';
        echo '<script>setTimeout(function(){
            window.location.href = "../php/customers.php";
         }, 4000);</script>';

    } else {
        addTransaction();
        echo '<div class="alert alert-success alert-dismissible fade show myAlert" role="alert">Transfer Successful 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--  site meta-data  -->
    <meta charset="UTF-8">
    <title>Bankamon: Transactions</title>

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

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
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
                        <a class="nav-link" href="customers.php">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active-page" aria-current="page" href="transaction.php">Transactions</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Header-->

<!-- Main -->
<?php
if (isset($_POST['amount'])) {
    checkValidity();
}
?>
<main id="main">
    <!--  Home Page Content  -->
    <div class="container" id="main-container">
        <h1>Transactions</h1>
        <ul class="text-light">
            <li>All the previous transactions are listed below.</li>
        </ul>

        <div class="cards table-center-card">
            <table class="table table-hover table-bordered border-primary border border-3" style="vertical-align: middle;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Amount Transferred</th>
                    <th>Transaction Time</th>
                </tr>
                </thead>
                <tbody>
                <?php displayTransactions(); ?>
                </tbody>
            </table>
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
