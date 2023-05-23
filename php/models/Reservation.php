<?php
class Reservation
{
        private $table = 'reservations';
        private $id, $customer_id, $room_id, $start_date,
                $end_date, $num_of_guests, $total_price, $status, $created_at, $updated_at;
        private $conn;


        public function __construct($db)
        {
                $this->conn = $db;
        }

        public function save()
        {
                $query = "INSERT INTO {$this->table} (customer_id, room_id, start_date, end_date , total_price) 
					VALUES (:customer_id, :room_id, :start_date, :end_date, :total_price)";
                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(":customer_id", $this->customer_id);
                $stmt->bindParam(":room_id", $this->room_id);
                $stmt->bindParam(":start_date", $this->start_date);
                $stmt->bindParam(":end_date", $this->end_date);
                $stmt->bindParam(":total_price",  $this->total_price);
                $stmt->execute();
                return $stmt;
        }

        public function cancelReservation($reservationId)
        {
                // Update the reservation status to canceled in the reservations table
                $query = "UPDATE reservations SET status = 'cancelled' WHERE id = :reservationId";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":reservationId", $reservationId);
                $stmt->execute();

                // Delete the payment record associated with the reservation from the payments table
                $query = "DELETE FROM {$this->table} WHERE id = :paymentId";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":paymentId", $this->id);
                $stmt->execute();

                return true;
        }

        public function is_exists($id)
        {
                $q = "SELECT * FROM {$this->table} WHERE id = :id";
                $stmt = $this->conn->prepare($q);
                $stmt->bindValue(':id', $id);
                $stmt->execute();
                return $stmt->rowCount() > 0;
        }
        
        public function getReservationsByCustomerId($customer_id)
        {
                $query = "SELECT * FROM {$this->table} WHERE customer_id = :customer_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(':customer_id', $customer_id);
                $stmt->execute();

                $reservations = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $reservations[] = $row;
                }

                return $reservations;
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
}
