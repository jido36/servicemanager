<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class ShiftModel extends Database
{
    public function checkShift($userid, $start)
    {

        $query = "SELECT * FROM shift where user_id = ? and startdate = ?";


        try {
            $stmt = $this->connection->prepare($query);

            if ($stmt === false) {
                throw new Exception("Unable to do prepared statement: " . $query);
            }


            $stmt->bind_param("is", $userid, $start);


            $stmt->execute();

            return $stmt;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function saveShift($userid, $start, $end)
    {
        $query = "INSERT INTO shift (user_id, startdate, enddate) VALUES (?, ?, ?)";

        try {
            $stmt = $this->connection->prepare($query);

            if ($stmt === false) {
                throw new Exception("Unable to do prepared statement: " . $query);
            }


            $stmt->bind_param("iss", $userid, $start, $end);


            $stmt->execute();

            return $stmt;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
