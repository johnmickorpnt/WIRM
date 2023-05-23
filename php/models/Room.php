<?php
class Room
{
    private $table = 'rooms';
    private $id, $room_number, $type, $occupancy,
        $rate_sun_thurs, $rate_fri_sat, $description, $availability;
    private $conn;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function available_rooms($room_type)
    {
        $condition = $room_type != null ? "WHERE type = '{$room_type}' AND availability = 1" : "";
        $q = "SELECT * FROM {$this->table} {$condition};";
        $stmt = $this->conn->prepare($q);
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) array_push($data, $row);
        return $data;
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
}
