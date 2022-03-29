<?php 

class FinanceController {
    private $command;
    private $db;

    public function __construct($command) {
        session_start();
        $this->command = $command;
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

    private function login() {
        include("templates/login.php");
    }

    private function new_transaction() {
        include("templates/newtransaction.php");
    }

    private function history() {
        include("templates/history.php");
    }

}

?>