<?php
class AbstractModel {
    protected $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    protected function executeQuery($sql, $params = [], $fetch = false) {
        if ($stmt = $this->conn->prepare($sql)) {
            foreach ($params as $index => $param) {
                $stmt->bindValue($index + 1, $param);
            }

            if ($stmt->execute()) {
                return $fetch ? $stmt->fetchAll(PDO::FETCH_ASSOC) : true;
            } else {
                error_log("SQL Error: " . implode(" ", $stmt->errorInfo()));
                return false;
            }
        }

        return false;
    }
}
?>
