<?php
class ContactHelpModel extends BaseModel
{

    use SweetAlert;
    public function tableName()
    {
        return 'contact_help';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }
    function getAllContactHelp()
    {
        return $this->db->table($this->tableName())->orderBy('id', 'ASC')->get();
    }

    function getOneContactHelp($id)
    {
        return $this->db->table($this->tableName())->where('id', '=', $id)->getOne();
    }

    function addNewContactHelp($data)
    {
        return $this->db->create($this->tableName(), $data);
    }

    function updateContactHelp($id, $data)
    {
        return $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
    }

    function deleteContactHelp($id)
    {
        // deleteContactHelp 
        $delContactHelp = $this->db->findIdAndDelete('ContactHelp', $id);

        //Get id product
        $dataProd = $this->db->table('product')->select('id')->where('ContactHelp_id', '=', $id)->getOne();

        if (empty($dataProd)) {
            return true;
        }
        // Delete product 
        $delProd = $this->db->findIdAndDelete('product', $dataProd['id']);

        // Delete product Image
        $delImageProd = $this->db->findAndDelete('images_product', ['prod_id' => $dataProd['id']]);

        if ($delContactHelp && $delProd && $delImageProd) {
            return true;
        }
        return false;
    }
}
