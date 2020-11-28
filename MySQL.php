<?php


class MySQL {

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

    public function executeQuery($sql) {
        if ($this->conn->multi_query($sql)) {
            $this->printDivider();

            do {
                if ($result = $this->conn->store_result()) {
                    while ($row = $result->fetch_row()) {
                        foreach ($row as $key => $value) {
                            echo 'key: ' . $key . '<br/>';
                            echo 'value: ' . $value . '<br/>';
                        }
                    }
                    $result->free();
                }

                if ($this->conn->more_results()) {
                    $this->printDivider();
                }
            } while ($this->conn->next_result());

            $this->printDivider();
        } else {
            die('Error: ' . mysqli_error($this->conn));
        }
    }

    public function __destruct() {
        $this->conn->close();
    }

    private function printDivider() {
        echo '---------------------------------- <br/>';
    }
}