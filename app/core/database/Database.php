<?php
class Database
{
    use QueryBuiler;
    private $conn;
    public function __construct()
    {
        global $dbConfig;
        $this->conn = Connection::getInstance($dbConfig);
    }


    //fn find and update
    public function findAndUpdate($tableName, $dataToUpdate, $conditions = [])
    {

        if (empty($dataToUpdate) || empty($tableName)) {
            return false;
        }

        try {

            $this->conn->beginTransaction();

            $updates = [];
            $params = [];

            foreach ($dataToUpdate as $key => $value) {
                $updates[] = "$key = :$key";
                $params[":$key"] = $value;
            }

            $sql = "UPDATE $tableName SET " . implode(", ", $updates);

            if (!empty($conditions)) {
                $whereConditions = [];

                foreach ($conditions as $key => $condition) {
                    $whereConditions[] = "$key = :condition_$key";
                    $params[":condition_$key"] = $condition;
                }

                $sql .= " WHERE " . implode(" AND ", $whereConditions);
            }

            $stmt = $this->conn->prepare($sql);
            $status = $stmt->execute($params);

            if ($status) {
                $this->conn->commit();
                return true;
            } else {
                $this->conn->rollBack();
                return false;
            }
        } catch (PDOException $e) {
            $this->conn->rollBack();
            $mess = $e->getMessage();
            $line = $e->getFile();
            $file = $e->getLine();
            App::$app->loadError('database', ['message' => $mess, 'line' => $line, 'file' => $file]);
            die();
        }
    }

    // fn find with id
    public function findById($tableName, $select = '*', $id)
    {

        $sql = "SELECT $select FROM $tableName WHERE id = $id";
        // var_dump($sql);
        $stmt = $this->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // fn delete with id
    public function findIdAndDelete($tableName, $id)
    {
        $this->conn->beginTransaction();

        $sql = "DELETE FROM $tableName WHERE id = $id";
        $stmt = $this->query($sql);

        if ($stmt) {
            $this->conn->commit();
            return true;
        } else {
            $this->conn->rollBack();
            return false;
        }
    }

    // find with id and update
    public function findByIdAndUpdate($tableName, $id, $dataToUpdate)
    {
        try {
            $this->conn->beginTransaction();
            $updates = [];
            foreach ($dataToUpdate as $key => $value) {
                $updates[] = "$key = :$key";
            }

            $sql = "UPDATE $tableName SET " . implode(", ", $updates) . " WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            foreach ($dataToUpdate as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $status = $stmt->execute();

            if ($status) {
                $this->conn->commit();
                return true;
            } else {
                $this->conn->rollBack();
                return false;
            }
        } catch (PDOException $e) {
            $this->conn->rollBack();

            $mess = $e->getMessage();
            $line = $e->getFile();
            $file = $e->getLine();
            App::$app->loadError('database', ['message' => $mess, 'line' => $line, 'file' => $file]);
            die();
        }
    }



    public function create($tableName, $dataToInsert)
    {
        try {
            $sql = "INSERT INTO $tableName (";
            $columns = implode(", ", array_keys($dataToInsert));
            $sql .= $columns . ") VALUES (";
            $values = implode(", ", array_fill(0, count($dataToInsert), "?"));
            $sql .= $values . ")";
            $stmt = $this->conn->prepare($sql);

            $index = 1;
            foreach ($dataToInsert as $value) {
                $stmt->bindValue($index++, $value);
            }
            $status = $stmt->execute();

            if ($status) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
           
            $mess = $e->getMessage();
            $line = $e->getFile();
            $file = $e->getLine();
            App::$app->loadError('database', ['message' => $mess, 'line' => $line, 'file' => $file]);
            die();
        }
    }

    public function findAndDelete($tableName, $conditions = [])
    {
        if (empty($tableName)) {
            return false;
        }

        $this->conn->beginTransaction();

        $sql = "DELETE FROM $tableName";

        if (!empty($conditions)) {
            $whereConditions = [];
            foreach ($conditions as $key => $value) {
                $whereConditions[] = "$key = :$key";
            }
            $sql .= " WHERE " . implode(" AND ", $whereConditions);
        }

        $stmt = $this->conn->prepare($sql);
        foreach ($conditions as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $success = $stmt->execute();

        if ($success) {
            $this->conn->commit();
            return true;
        } else {
            $this->conn->rollBack();
            return false;
        }
    }


    function query($sql)
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            $mess = $e->getMessage();
            $line = $e->getFile();
            $file = $e->getLine();
            App::$app->loadError('database', ['message' => $mess, 'line' => $line, 'file' => $file]);
            die();
        }
    }

    public function lastInsertId()
    {

        return $this->conn->lastInsertId();
    }
}
