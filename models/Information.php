<?php
    class Information {
        //DB Stuff
        private $conn;
        private $table = 'information';

        //information Properties
        public $id;
        public $client_id;
        public $name;
        public $email;
        public $number;
        public $subject;
        public $message;
        public $created_at;
        // Constructor with DB
        public function __construct($db)
        {
            $this -> conn = $db;
        }
        //Get information
        public function read()
        {
            //create query
            $query = 'SELECT
                i.number as phone_number,
                i.id,
                i.client_id,
                i.name,
                i.email,
                i.subject,
                i.message,
                i.created_at
            FROM
                ' . $this -> table . ' i

            ORDER BY
                i.created_at DESC';
            
            // Prepare statement
            $stmt = $this -> conn -> prepare ($query);

            //Execute query
            $stmt -> execute();

            return $stmt;
        }
        // Get Single Information
        public function read_single() {
            // Create query
            $query = 'SELECT
                i.number as phone_number,
                i.id,
                i.client_id,
                i.name,
                i.email,
                i.subject,
                i.message,
                i.created_at
                FROM
                ' . $this -> table . ' i
                WHERE
                    i.id = ?
                LIMIT 0,1';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->name = $row['name'];
            $this->phone_number = $row['phone_number'];
            $this->subject = $row['subject'];
            $this->message = $row['message'];
            $this->email = $row['email'];
            $this->client_id = $row['client_id'];
        }
        // Create Information
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . ' SET name = :name, email = :email, number = :number, subject = :subject, message = :message ';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->number = htmlspecialchars(strip_tags($this->number));
            $this->subject = htmlspecialchars(strip_tags($this->subject));
            $this->message = htmlspecialchars(strip_tags($this->message));

            // Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':number', $this->number);
            $stmt->bindParam(':subject', $this->subject);
            $stmt->bindParam(':message', $this->message);
            // Execute query
            if($stmt->execute()) {
            return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }


            // Delete Information
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
            return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }