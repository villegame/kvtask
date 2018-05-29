<?php

class DB {

    private $dbConfigData;
    private $conn;

    function __construct() {

        // Read database credentials and details from file outside webroot
        $dbConfigJson = file_get_contents('../db.json');
        $this->dbConfigData = json_decode($dbConfigJson, true);

        // Connect
        $this->connect();
    }

    function __destruct() {

        $this->disconnect();

    }

    private function connect() {

        // Connect to database
        $this->conn = new mysqli($this->dbConfigData["server"], $this->dbConfigData["user"], $this->dbConfigData["password"], $this->dbConfigData["database"]);
        if($this->conn->connect_error) die ("Connection failed! " . $this->conn->connect_error);

    }

    private function disconnect() {

        // Close connection
        $this->conn->close();

    }

    public function addEmail($email) {

        $sql = "INSERT INTO addresses (email) VALUES (?);";

        // Prepare statement (to avoid sql injections just in case)
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
    }

    public function getEmails() {

        $sql = "SELECT email FROM addresses;";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                print "email: " . $row["email"] . "<br />";
            }
        }
    }

}

?>