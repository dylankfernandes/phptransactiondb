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
            default:
                $this->login();
        }
    }

    private function checkFormFieldSubmission($field) {
        return isset($_POST[$field]) && !empty($_POST[$field]);
    }

    private function login() {
        // If the user has entered their username and password, then either login or register them as a new user
        if ($this->checkFormFieldSubmission("email") && $this->checkFormFieldSubmission("password")) {
            $_SESSION["name"] = $_POST["name"];
            $_SESSION["email"] = $_POST["email"];

            // If user is not in our database, create a new user

            // If the user is in our database, check their credentials
                // If the credentials are valid, show the history page

                // If the credentials are invalid, show an error message

            return;
        }
        include("templates/login.php");
    }

    private function new_transaction() {
        include("templates/newtransaction.php");
    }

    private function history() {
        // pull in user info from the session
        
        // pull in current balance from database

        // pull in totals per category from database
        

        include("templates/history.php");
    }

}

?>