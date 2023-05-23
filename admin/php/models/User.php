<?php
class User
{
    private $conn;
    private $table = "users";
    private $id, $firstname, $lastname, $contact_number, $email, $password,
        $created_at, $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $q = "SELECT id, firstname, lastname, contact_number, email FROM {$this->table};";
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
        $this->setFirstname($result["firstname"]);
        $this->setLastname($result["lastname"]);
        $this->setContact_number($result["contact_number"]);
        $this->setEmail($result["email"]);
        $this->setPassword($result["password"]);
        $this->setCreated_at($result["created_at"]);
        $this->setUpdated_at($result["updated_at"]);

        return $collate ? $result : $this;
    }

    public function save()
    {
        if (empty($this->getId())) $this->insert();
        else $this->update($this->getId());
    }


    public function update($id)
    {
        $sql = "UPDATE {$this->table} SET firstname = :firstname, lastname = :lastname,
        contact_number = :contact_number, email = :email, password = :password, created_at = :created_at,
        updated_at = :updated_at WHERE id = {$id}";
        $stmt = $this->conn->prepare($sql);

        /// Bind the values to the prepared statement
        $stmt->bindValue(':firstname', $this->firstname);
        $stmt->bindValue(':lastname', $this->lastname);
        $stmt->bindValue(':contact_number', $this->contact_number);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':password', $this->password);
        $stmt->bindValue(':updated_at', $this->updated_at);


        // Execute the prepared statement
        $result = $stmt->execute();
        return $result;
    }

    public function insert()
    {
        // Example using PDO prepared statements
        $currentTimestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO {$this->table} (id, firstname, lastname,
        contact_number, email, password, created_at, updated_at) 
            VALUES (NULL, :firstname, :lastname, :contact_number, :email, 
            :password, :created_at, :updated_at)";
        $stmt = $this->conn->prepare($sql);

        // Bind the values to the prepared statement
        $stmt->bindValue(':firstname', $this->firstname);
        $stmt->bindValue(':lastname', $this->lastname);
        $stmt->bindValue(':contact_number', $this->contact_number);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':password', $this->password);
        $stmt->bindValue(':created_at', $currentTimestamp);
        $stmt->bindValue(':updated_at', $currentTimestamp);

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
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

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
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of contact_number
     */
    public function getContact_number()
    {
        return $this->contact_number;
    }

    /**
     * Set the value of contact_number
     *
     * @return  self
     */
    public function setContact_number($contact_number)
    {
        $this->contact_number = $contact_number;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
