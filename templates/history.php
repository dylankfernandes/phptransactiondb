<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="CS4640">
    <meta name="description" content="CS4640 Trivia Login Page">
    <title>Transaction Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Welcome, <?= $_SESSION["name"] ?> (<?= $_SESSION["email"] ?>)</a> <!-- TODO: Change this to user name-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- TODO: edit navbar links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="?command=history">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?command=newtransaction">New Transaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="?command=logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <p>You have $<?= $current_balance ? $current_balance : 0 ?> in your account.</p> <!-- TODO: Replace with actual balance -->
            <h2>Transaction Summary</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Category</th>
                        <th scope="col">Total for Category</th>
                    </tr>
                </thead>
                <tbody>
                        <!-- TODO: Replace with actual transaction data -->
                        <?php
                            foreach ($balance_per_category_data as $record) {
                                echo "<tr><td>". $record["category"] . "</td><td>" . $record["balance"] . "</td></tr>";
                            }
                        ?>
                    </tr>
                </tbody>
            </table>
            <h2>Transaction History</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Type</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- TODO: Replace with actual transaction data -->
                    <?php

                        for($i = 0; $i < count($transaction_data); $i++) {
                            $record = $transaction_data[$i];
                            echo "<tr><td>" . strval($i + 1) . "</td><td>" . $record["name"] . "</td><td>" . $record["category"] . "</td><td>" . $record["t_date"] . "</td><td>" . $record["amount"] . "</td><td>" . $record["t_type"] . "</td></tr>";
                        }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>