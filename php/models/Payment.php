<?php
class Payment
{
    private $table = 'payments';
    private $id, $reservation_id, $amount, $bank_name, $bank_location, $proof_of_payment;
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function save()
    {
        $query = "INSERT INTO {$this->table} (reservation_id, amount, bank_name, bank_location, proof_of_payment)
                VALUES (:reservation_id, :amount, :bank_name, :bank_location, :proof_of_payment)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":reservation_id", $this->reservation_id);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":bank_name", $this->bank_name);
        $stmt->bindParam(":bank_location", $this->bank_location);
        $stmt->bindParam(":proof_of_payment", $this->proof_of_payment);

        $stmt->execute();
        return $stmt;
    }

    public function getPaymentIdByReservationId($reservationId)
    {
        $query = "SELECT id FROM {$this->table} WHERE reservation_id = :reservationId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':reservationId', $reservationId);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($row && isset($row['id'])) ? $row['id'] : null;
    }

    // Add other methods as needed

    // Getters and Setters

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getReservationId()
    {
        return $this->reservation_id;
    }

    public function setReservationId($reservation_id)
    {
        $this->reservation_id = $reservation_id;
        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function getBankName()
    {
        return $this->bank_name;
    }

    public function setBankName($bank_name)
    {
        $this->bank_name = $bank_name;
        return $this;
    }

    public function getBankLocation()
    {
        return $this->bank_location;
    }

    public function setBankLocation($bank_location)
    {
        $this->bank_location = $bank_location;
        return $this;
    }

    public function getProofOfPayment()
    {
        return $this->proof_of_payment;
    }

    public function setProofOfPayment($proof_of_payment)
    {
        $this->proof_of_payment = $proof_of_payment;
        return $this;
    }
}
