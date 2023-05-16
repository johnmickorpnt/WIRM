<?php
class Reservation
{
    private $conn;
    private $table = "reservations";
    private $id, $customer_id, $room_id, $start_date, $end_date, $num_of_guests,
        $total_price, $status, $created_at, $updated_at, $columns;

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


    public function get($id, $collate)
    {
        $q = "SELECT * FROM {$this->table} WHERE id = {$id};";
        $stmt = $this->conn->prepare($q);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->setId($result["id"]);
        $this->setCustomer_id($result["customer_id"]);
        $this->setRoom_id($result["room_id"]);
        $this->setStart_date($result["start_date"]);
        $this->setEnd_date($result["end_date"]);
        $this->setNum_of_guests($result["num_of_guests"]);
        $this->setTotal_price($result["total_price"]);
        $this->setStatus($result["status"]);
        $this->setCreated_at($result["created_at"]);
        $this->setUpdated_at($result["updated_at"]);

        return $collate ? $result : $this;
    }

    public function rowCount($id)
    {
        $q = "SELECT COUNT(*) as count FROM {$this->table} WHERE id = {$id};";
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
        $sql = "UPDATE {$this->table} SET customer_id = :customer_id, room_id = :room_id,
        start_date = :start_date, end_date = :end_date, num_of_guests = :num_of_guests,
        total_price = :total_price, status = :status, created_at = :created_at, updated_at = :updated_at 
        WHERE id = {$id}";
        $stmt = $this->conn->prepare($sql);

        // Bind the values to the prepared statement
        $stmt->bindValue(':customer_id', $this->customer_id);
        $stmt->bindValue(':room_id', $this->room_id);
        $stmt->bindValue(':start_date', $this->start_date);
        $stmt->bindValue(':end_date', $this->end_date);
        $stmt->bindValue(':num_of_guests', $this->num_of_guests);
        $stmt->bindValue(':total_price', $this->total_price);
        $stmt->bindValue(':status', $this->status);
        $stmt->bindValue(':created_at', $this->created_at);
        $stmt->bindValue(':updated_at', $this->updated_at);

        // Execute the prepared statement
        $result = $stmt->execute();
        return $result;
    }

    public function insert()
    {
        // Example using PDO prepared statements
        $currentTimestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO {$this->table} (id, customer_id, room_id,
        start_date, end_date, num_of_guests, total_price, status, created_at, updated_at) 
            VALUES (NULL, :customer_id, :room_id, :start_date, :end_date, :num_of_guests, 
            :total_price, :status, :created_at, :updated_at)";
        $stmt = $this->conn->prepare($sql);

        // Bind the values to the prepared statement
        $stmt->bindValue(':customer_id', $this->customer_id);
        $stmt->bindValue(':room_id', $this->room_id);
        $stmt->bindValue(':start_date', $this->start_date);
        $stmt->bindValue(':end_date', $this->end_date);
        $stmt->bindValue(':num_of_guests', $this->num_of_guests);
        $stmt->bindValue(':total_price', $this->total_price);
        $stmt->bindValue(':status', $this->status);
        $stmt->bindValue(':created_at', $currentTimestamp);
        $stmt->bindValue(':updated_at', $currentTimestamp);
        $result = $stmt->execute();
        return $result;
    }
    /**
     * Get the value of total_price
     */
    public function getTotal_price()
    {
        return $this->total_price;
    }

    /**
     * Set the value of total_price
     *
     * @return  self
     */
    public function setTotal_price($total_price)
    {
        $this->total_price = $total_price;

        return $this;
    }

    /**
     * Get the value of customer_id
     */
    public function getCustomer_id()
    {
        return $this->customer_id;
    }

    /**
     * Set the value of customer_id
     *
     * @return  self
     */
    public function setCustomer_id($customer_id)
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of room_id
     */
    public function getRoom_id()
    {
        return $this->room_id;
    }

    /**
     * Set the value of room_id
     *
     * @return  self
     */
    public function setRoom_id($room_id)
    {
        $this->room_id = $room_id;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of start_date
     */
    public function getStart_date()
    {
        return $this->start_date;
    }

    /**
     * Set the value of start_date
     *
     * @return  self
     */
    public function setStart_date($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * Get the value of end_date
     */
    public function getEnd_date()
    {
        return $this->end_date;
    }

    /**
     * Set the value of end_date
     *
     * @return  self
     */
    public function setEnd_date($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * Get the value of num_of_guests
     */
    public function getNum_of_guests()
    {
        return $this->num_of_guests;
    }

    /**
     * Set the value of num_of_guests
     *
     * @return  self
     */
    public function setNum_of_guests($num_of_guests)
    {
        $this->num_of_guests = $num_of_guests;

        return $this;
    }

    public function format_columns()
    {
        $columnString = "";
        foreach ($this->columns as $index => $column) {
            $columnString .=  "$column";
            // Add commas
            $columnString .= $index >= 0 &&
                $index < sizeof($this->columns) - 1 ? "," : "";
        }
        return $columnString;
    }

    /**
     * Get the value of columns
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Set the value of columns
     *
     * @return  self
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;

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
}
