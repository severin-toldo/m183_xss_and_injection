<?php
require_once('User.php');

class UserRepository {

    private $conn = null;


    public function __construct() {
        $servername = '127.0.0.1';
        $serverUsername = 'root';
        $serverPassword = '!24Zoro24!';
        $serverDB = 'owasp_risks';
        $port = 3306;

        $this->conn = new mysqli($servername, $serverUsername, $serverPassword, $serverDB, $port);

        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function executeQuery($sql) {
        $returnedUsers = [];

        if ($this->conn->multi_query($sql)) {
            do {
                if ($result = $this->conn->store_result()) {
                    while ($row = $result->fetch_row()) {
                        if (!empty($row)) {
                            $user = new User();
                            $user->setUsername($row[0]);
                            $user->setPassword($row[1]);
                            array_push($returnedUsers, $user);
                        }
                    }
                    $result->free();
                }
            } while ($this->conn->next_result());
        } else {
            die('Error: ' . mysqli_error($this->conn));
        }

        return $returnedUsers;
    }

    public function getConn() {
        return $this->conn;
    }

    public function printUsers($users) {
        $this->printDivider();

        foreach ($users as $user) {
            echo 'Username: ' . $user->getUsername() . '<br/>';
            echo 'Password: ' . $user->getPassword() . '<br/>';
            $this->printDivider();
        }
    }

    private function printDivider() {
        echo '---------------------------------- <br/>';
    }
}