<?php
class Room
{
    private $conn;
    private $table = "rooms";
    private $id, $room_number, $type, $occupancy, $rate_sun_thurs, $rate_fri_sat, $description,
        $availability;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $q = "SELECT * FROM {$this->table};";
        $stmt = $this->conn->prepare($q);
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function read_available()
    {
        $q = "SELECT * FROM {$this->table} WHERE availability = 1;";
        $stmt = $this->conn->prepare($q);
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function get($id, $collate)
    {
        $q = "SELECT * FROM {$this->table} WHERE id = {$id};";
        $stmt = $this->conn->prepare($q);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->setId($result["id"]);
        $this->setRoom_number($result["room_number"]);
        $this->setType($result["type"]);
        $this->setOccupancy($result["occupancy"]);
        $this->setRate_sun_thurs($result["rate_sun_thurs"]);
        $this->setRate_fri_sat($result["rate_fri_sat"]);
        $this->setDescription($result["description"]);
        $this->setAvailability($result["availability"]);

        return $collate ? $result : $this;
    }

    public function rowCount()
    {
        $q = "SELECT COUNT(*) as count FROM {$this->table} WHERE id = {$this->id};";
        $stmt = $this->conn->prepare($q);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }

    public function save()
    {
        if (empty($this->getId())) $this->insert();
        else $this->update($this->getId());
    }

    public function update($id)
    {
        $sql = "UPDATE {$this->table} SET room_number = :room_number, type = :type,
        occupancy = :occupancy, rate_sun_thurs = :rate_sun_thurs, rate_fri_sat = :rate_fri_sat,
        description = :description, availability = :availability WHERE id = {$id}";
        $stmt = $this->conn->prepare($sql);

        /// Bind the values to the prepared statement
        $stmt->bindValue(':room_number', $this->room_number);
        $stmt->bindValue(':type', $this->type);
        $stmt->bindValue(':occupancy', $this->occupancy);
        $stmt->bindValue(':rate_sun_thurs', $this->rate_sun_thurs);
        $stmt->bindValue(':rate_fri_sat', $this->rate_fri_sat);
        $stmt->bindValue(':description', $this->description);
        $stmt->bindValue(':availability', $this->availability);

        // Execute the prepared statement
        $result = $stmt->execute();
        return $result;
    }

    public function insert()
    {
        // Example using PDO prepared statements
        $currentTimestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO {$this->table} (id, room_number, type,
        occupancy, rate_sun_thurs, rate_fri_sat, description, availability) 
            VALUES (NULL, :room_number, :type, :occupancy, :rate_sun_thurs, :rate_fri_sat, 
            :description, :availability)";
        $stmt = $this->conn->prepare($sql);

        // Bind the values to the prepared statement
        $stmt->bindValue(':room_number', $this->room_number);
        $stmt->bindValue(':type', $this->type);
        $stmt->bindValue(':occupancy', $this->occupancy);
        $stmt->bindValue(':rate_sun_thurs', $this->rate_sun_thurs);
        $stmt->bindValue(':rate_fri_sat', $this->rate_fri_sat);
        $stmt->bindValue(':description', $this->description);
        $stmt->bindValue(':availability', $this->availability);
        $result = $stmt->execute();
        return $result;
    }

    public function is_exists($id)
    {
        $q = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($q);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->rowCount();
    }

    /**
     * Get the value of availability
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * Set the value of availability
     *
     * @return  self
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of room_number
     */
    public function getRoom_number()
    {
        return $this->room_number;
    }

    /**
     * Set the value of room_number
     *
     * @return  self
     */
    public function setRoom_number($room_number)
    {
        $this->room_number = $room_number;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of occupancy
     */
    public function getOccupancy()
    {
        return $this->occupancy;
    }

    /**
     * Set the value of occupancy
     *
     * @return  self
     */
    public function setOccupancy($occupancy)
    {
        $this->occupancy = $occupancy;

        return $this;
    }

    /**
     * Get the value of rate_sun_thurs
     */
    public function getRate_sun_thurs()
    {
        return $this->rate_sun_thurs;
    }

    /**
     * Set the value of rate_sun_thurs
     *
     * @return  self
     */
    public function setRate_sun_thurs($rate_sun_thurs)
    {
        $this->rate_sun_thurs = $rate_sun_thurs;

        return $this;
    }

    /**
     * Get the value of rate_fri_sat
     */
    public function getRate_fri_sat()
    {
        return $this->rate_fri_sat;
    }

    /**
     * Set the value of rate_fri_sat
     *
     * @return  self
     */
    public function setRate_fri_sat($rate_fri_sat)
    {
        $this->rate_fri_sat = $rate_fri_sat;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
