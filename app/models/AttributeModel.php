<?php
class AttributeModel extends BaseModel
{

    use SweetAlert;
    public function tableName()
    {
        return 'attribute';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }
    function getAllAttribute()
    {
        return $this->db->table($this->tableName())->get();
    }

    function getAllAttributeValue()
    {
        return $this->db->table('attribute_value')->get();
    }



    function getOneAttribute($id)
    {
        return $this->db->findById($this->tableName(), $this->tableField(), $id);
    }


    function addNameAttribute($data)
    {
        return $this->db->create($this->tableName(), $data);
    }



    function updateNameAttribute($id, $data)
    {
        return $this->db->findAndUpdate($this->tableName(), $data, ['id' => $id]);
    }

    function deleteNameAttribute($id)
    {
        $deleName = $this->db->findIdAndDelete($this->tableName(), $id);
        $deleValue = $this->db->findAndDelete('attribute_value', ['attribute_id' => $id]);

        if ($deleName && $deleValue) {
            return true;
        }
        return false;
    }

    function getAttributeValue($id)
    {
        return $this->db->table('attribute_value av')->select('av.id , attribute_id , a.name, av.value_name')->join('attribute a', 'av.attribute_id = a.id')->where('attribute_id', '=', $id)->orderBy('av.id')->get();
    }

    function getOneAttributeValue($id)
    {
        return $this->db->findById('attribute_value', 'id, value_name, attribute_id', $id);
    }
    function deleteAttributeValue($id)
    {
        return $this->db->findIdAndDelete('attribute_value', $id);
    }
}
