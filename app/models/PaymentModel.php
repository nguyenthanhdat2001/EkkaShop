<?php
class PaymentModel extends BaseModel
{
    use SweetAlert;
    public function tableName()
    {
        return 'payment';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }
    function getAllPaymentMethod()
    {
        return $this->db->table('payment_method')->where('status', '=', 1)->get();
    }
    function addNewPayment($data)
    {
        return $this->db->create($this->tableName(), $data);
    }

    function addNewPaymentTransactions($data)
    {
        return $this->db->create('payment_transactions', $data);
    }

    function getAllPaymentMethodAd()
    {
        return $this->db->table('payment_method')->get();
    }

    function addNewPaymentMethod($data)
    {
        return $this->db->create('payment_method', $data);
    }
    function updatePaymentMethod($id, $data)
    {
        return $this->db->findByIdAndUpdate('payment_method', $id, $data);
    }
    function getOnePaymentMethod($id)
    {
        return $this->db->findById('payment_method', '*', $id);
    }
}
