<?php
trait QueryBuiler
{
    public $tableName = '';
    public $where = '';
    public $operator = '';
    public $selectField = '*';
    public $limit = '';
    public $orderBy = '';
    public $innerJoin = '';
    public $leftJoin = '';

    public function table($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function where($field, $compare, $value)
    {
        if (empty($this->where)) {
            $this->operator = ' WHERE ';
        } else {
            $this->operator = ' AND ';
        }
        $this->where .= "$this->operator $field $compare '$value'";

        return $this;
    }

    function orWhere($field, $compare, $value)
    {
        if (empty($this->where)) {
            $this->operator = ' WHERE ';
        } else {
            $this->operator = ' OR ';
        }
        $this->where .= "$this->operator $field $compare '$value'";

        return $this;
    }

    function whereLike($field, $value)
    {
        if (empty($this->where)) {
            $this->operator = ' WHERE ';
        } else {
            $this->operator = ' AND ';
        }
        $this->where .= "$this->operator $field LIKE '$value'";

        return $this;
    }

    public function select($field)
    {
        $this->selectField = $field;
        return $this;
    }

    public function limit($number, $offset = 0)
    {
        $this->limit = " LIMIT $offset, $number";
        return $this;
    }

    public function orderBy($field, $type = 'DESC')
    {
        //this->db->orderBy('id', 'ASC')
        //this->db->orderBy('id DESC', 'name ASC' )
        $fieldArray = array_filter(explode(', ', $field));
        if (!empty($fieldArray) && count($fieldArray) >= 2) {
            $this->orderBy = " ORDER BY " . implode(', ', $fieldArray);
        } else {
            $this->orderBy = " ORDER BY $field $type";
        }
        return $this;
    }
    //Inner JOIN
    public function join($table, $relationship)
    {
        $this->innerJoin .= " INNER JOIN $table ON $relationship ";
        return $this;
    }

    //LEFT JOIN
    public function leftJoin($table, $relationship)
    {
        $this->innerJoin .= " LEFT JOIN $table ON $relationship ";
        return $this;
    }


    public function get()
    {
        $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->innerJoin $this->leftJoin $this->where $this->orderBy $this->limit";
        $sqlQuery = trim($sqlQuery);
        // var_dump($sqlQuery);
        $query = $this->query($sqlQuery);

        $this->resetQuery();

        if (!empty($query)) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function getOne()
    {
        $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->innerJoin $this->leftJoin $this->where $this->orderBy $this->limit";
        // var_dump($sqlQuery);

        $sqlQuery = trim($sqlQuery);
        $query = $this->query($sqlQuery);

        $this->resetQuery();

        if (!empty($query)) {
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
    function resetQuery()
    {
        //reset field
        $this->tableName = '';
        $this->where = '';
        $this->operator = '';
        $this->selectField = '*';
        $this->limit = '';
        $this->orderBy = '';
        $this->leftJoin = '';
    }
}

// how to use
// $this->db->table('product')->where('id', '=', '2')->where('idBrand' = '6')->get()
