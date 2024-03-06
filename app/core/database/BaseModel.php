<?php
abstract class BaseModel extends Database
{
    protected $db;
    function __construct()
    {
        $this->db = new Database();
    }

    // Kế thừ phải có
    abstract function tableName();
    abstract function tableField();
    abstract function primaryKey();

    //Lấy tất cả bản ghi
    public function find()
    {
        $tableName = $this->tableName();
        $tableField = $this->tableField();
        $primaryKey = $this->primaryKey();

        if (empty($tableField)) {
            $tableField = '*';
        }
        $sql = "SELECT $tableField FROM $tableName ORDER BY $primaryKey DESC";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    //Lấy một bản ghi
    public function findOne($id)
    {
        $tableName = $this->tableName();
        $tableField = $this->tableField();
        $primaryKey = $this->primaryKey();

        if (empty($tableField)) {
            $tableField = '*';
        }
        $sql = "SELECT $tableField FROM $tableName WHERE $primaryKey = $id";
        $query = $this->db->query($sql);
        if (!empty($query)) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
}
