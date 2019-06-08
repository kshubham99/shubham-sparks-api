<?php
class Appliance{
    private $conn;
    private $table = 'appliance';
    
    public $id;
    public $type;
    public $rating;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT * FROM appliance';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT * FROM appliance WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->type = $row['type'];
        $this->rating = $row['rating'];
    }

    public function create(){
        $query = 'INSERT INTO appliance SET
        type = :type,
        rating = :rating';

        $stmt = $this->conn->prepare($query);

        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->rating = htmlspecialchars(strip_tags($this->rating));

        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':rating', $this->rating);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;
    }

    public function update(){
        $query = 'UPDATE appliance SET
        type = :type,
        rating = :rating
        WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->id = htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':id', $this->id);


        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;
    }

    public function delete(){
        $query = 'DELETE FROM appliance where id = :id';

        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;

    }
}