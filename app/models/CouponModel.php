<?php
class CouponModel extends BaseModel
{
    public function tableName()
    {
        return 'coupon';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }

    function getAllCoupon()
    {
        return $this->db->table($this->tableName())->get();
    }

    function getOneCoupon($id)
    {
        return $this->db->findById($this->tableName(), $this->tableField(), $id);
    }

    function getOneCouponCode($couponCode)
    {
        return $this->db->table($this->tableName())->select('id, code, value, min_amount, expired, quantity, status, create_at')->where('code', '=', $couponCode)->getOne();
    }

    function addNewCoupon($data)
    {
        return $this->db->create($this->tableName(), $data);
    }
    function updateCoupon($id, $data)
    {
        return $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
    }
    function deleteCoupon($id)
    {
        return $this->db->findIdAndDelete($this->tableName(), $id);
    }
}
