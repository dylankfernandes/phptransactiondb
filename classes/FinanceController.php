<?php 

class FinanceController {
    private $command;
    private $db;

    public function __construct($command) {
        session_start();
        $this->command = $command;
        $this->db = new Database();
    }

    public function run() {
        switch($this->command) {
            case "newtransaction":
                $this->new_transaction();
                break;
            case "history":
                $this->history();
                break;
            case "logout":
                $this->logout();
            default:
                $this->login();
        }
    }

    private function logout() {
        session_destroy();
    }

    private function checkLogin() {
        if (!isset($_SESSION["email"])) {
            header("Location: ?command=login");
        }
    }

    private function checkFormFieldSubmission($field) {
        return isset($_POST[$field]) && !empty($_POST[$field]);
    }

    private function login() {
        $message = "";
        if ($this->checkFormFieldSubmission("email") && $this->checkFormFieldSubmission("password")) {
            $check_for_user = $this->db->query("SELECT id, name, email, password FROM dkf5gz.hw5_user WHERE email = ?;", "s", $_POST["email"]);
            if ($check_for_user === false) {
                $error_msg = "<div class='alert alert-danger'>An error occurred when checking for user.</div>";
            } else if (!empty($check_for_user)) {
                if (password_verify($_POST["password"], $check_for_user[0]["password"])) {
                    $message = "<div class='alert alert-success'>Success! Logging in...</div>";
                    $_SESSION["name"] = $check_for_user[0]["name"];
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["id"] = $check_for_user[0]["id"];
                    header("Location: ?command=history");
                } else {
                    $message = "<div class='alert alert-danger'>Password is incorrect</div>";
                }
            } else {
                $insert = $this->db->query("INSERT INTO dkf5gz.hw5_user (name, email, password) VALUES (?, ?, ?);", 
                        "sss", $_POST["name"], $_POST["email"], 
                        password_hash($_POST["password"], PASSWORD_DEFAULT));
                if ($insert === false) {
                    $message = "<div class='alert alert-danger'>Error while creating new user</div>";
                } else {
                    $check_for_user = $this->db->query("SELECT id, name, password FROM dkf5gz.hw5_user WHERE email = ?;", "s", $_POST["email"]);
                    $_SESSION["id"] = $check_for_user[0]["id"];
                    $_SESSION["name"] = $check_for_user[0]["name"];
                    $_SESSION["email"] = $_POST["email"];
                    header("Location: ?command=history");
                }
            }
        }
        include("templates/login.php");
    }

    private function new_transaction() {
        $this->checkLogin();

        if (isset($_POST["amount"])) {
            if ($_POST["type"] == "credit"){
            $insert = $this->db->query(
                "INSERT INTO dkf5gz.hw5_transaction (user_id, name, category, t_type, t_date, amount) VALUES (?, ?, ?, ?, ?, ?);",
                "issssd",
                $_SESSION["id"],
                $_POST["name"],
                $_POST["category"],
                $_POST["type"],
                $_POST["date"],
                $_POST["amount"]
            );
        }
        else{
            $insert = $this->db->query(
                "INSERT INTO dkf5gz.hw5_transaction (user_id, name, category, t_type, t_date, amount) VALUES (?, ?, ?, ?, ?, ?);",
                "issssd",
                $_SESSION["id"],
                $_POST["name"],
                $_POST["category"],
                $_POST["type"],
                $_POST["date"],
                -1* $_POST["amount"]
            );
        }
            header("Location: ?command=history");
            return;
        }
        include("templates/new-transaction.php");
    }

    private function history() {
        $this->checkLogin();

        // pull in current balance from database
        $current_balance_data = $this->db->query("SELECT SUM(amount) as balance FROM `hw5_transaction` WHERE user_id = ?;", "i", $_SESSION["id"]);
        $current_balance = $current_balance_data[0]["balance"];

        // pull in totals per category from database
        $balance_per_category_data = $this->db->query("SELECT SUM(amount) as balance, category FROM `hw5_transaction` WHERE user_id = ? GROUP BY category;", "i", $_SESSION["id"]);
        
        // pull in all transaction data for this user
        $transaction_data = $this->db->query("SELECT * FROM `hw5_transaction` WHERE user_id = ? ORDER BY t_date DESC;", "i", $_SESSION["id"]);

        include("templates/history.php");
    }

}

?>