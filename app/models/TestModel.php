<?php
class TestModel extends BaseModel
{

    function tableName()
    {
        return 'brand';
    }
    function tableField()
    {
        return '*';
    }
    function primaryKey()
    {
        return 'id';
    }

    function getAll()
    {
    }

    function getList()
    {
        return $this->db->table($this->tableName())->get();
    }
}
