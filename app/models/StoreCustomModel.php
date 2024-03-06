<?php
class StoreCustomModel extends BaseModel
{

    function tableName()
    {
        return 'store_custom';
    }
    function tableField()
    {
        return '*';
    }
    function primaryKey()
    {
        return 'id';
    }

    function getAllStoreCustom()
    {
        return $this->db->table($this->tableName())->getOne();
    }

    function getAllBanner()
    {
        return $this->db->table('banner')->get();
    }

    function updateStoreCustom($id, $data)
    {
        return $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
    }

    function addNewBanner($data)
    {
        return $this->db->create('banner', $data);
    }

    function updateBanner($id, $data)
    {
        return $this->db->findByIdAndUpdate('banner', $id, $data);
    }

    function deleteBanner($id)
    {
        return $this->db->findIdAndDelete('banner', $id);
    }
}
