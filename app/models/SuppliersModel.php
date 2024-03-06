<?php
class SuppliersModel extends BaseModel
{

    use SweetAlert;
    public function tableName()
    {
        return 'suppliers';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }
    function getAllSuppliers()
    {
        return $this->db->table($this->tableName())->orderBy('id', 'ASC')->get();
    }

    function getOneSuppliers($id)
    {
        return $this->db->table($this->tableName())->where('id', '=', $id)->getOne();
    }

    function addNewSuppliers($data)
    {
        return $this->db->create($this->tableName(), $data);
    }

    function updateSuppliers($id, $data)
    {
        return $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
    }

    function deleteSuppliers($id)
    {
        // deleteSuppliers 
        $delSuppliers = $this->db->findIdAndDelete($this->tableName(), $id);

        if ($delSuppliers) {
            return true;
        }
        return false;
    }
}
