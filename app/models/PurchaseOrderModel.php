<?php
class PurchaseOrderModel extends BaseModel
{

    use SweetAlert;
    public function tableName()
    {
        return 'purchase_orders';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }
 
    function getAllPurchaseOrder()
    {
        return $this->db->table('purchase_orders po')->select('po.id as purchase_order_id , s.*')->join('suppliers s', 'po.supplier_id = s.id')->orderBy('id', 'DESC')->get();
    }


    function sumPurchaseOrder()
    {
        $sql = "SELECT SUM(price * quantity) AS total_money FROM purchase_order_details";
        $data = $this->db->query($sql)->fetchColumn();
        return $data;
    }

    function getAllPurchaseOrderDetail($id)
    {
        return $this->db->table('purchase_orders po')->select('pod.*')->join('purchase_order_details pod', 'po.id = pod.purchase_order_id')->where('po.id', '=', $id)->orderBy('id', 'DESC')->get();
    }

    function checkPurchaseOrderExisted($name)
    {
        return $this->db->table($this->tableName())->where('name', '=', $name)->getOne();
    }

    function getOnePurchaseOrder($id)
    {
        return $this->db->table($this->tableName())->where('id', '=', $id)->getOne();
    }

    function getPurchaseOrder($idPurchaseOrder)
    {
        return $this->db->table($this->tableName())->where('supplier_id', '=', $idPurchaseOrder)->getOne();
    }

    function addNewPurchaseOrder($data)
    {
        return $this->db->create($this->tableName(), $data);
    }

    function addNewPurchaseOrderDetail($data)
    {
        return $this->db->create('purchase_order_details', $data);
    }



    function updatePurchaseOrder($id, $data)
    {
        return $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
    }

    function deletePurchaseOrder($id)
    {
        // deletePurchaseOrder 
        $delPurchaseOrder = $this->db->findIdAndDelete('brand', $id);

        //Get id product
        $dataProd = $this->db->table('product')->select('id')->where('brand_id', '=', $id)->getOne();

        if (empty($dataProd)) {
            return true;
        }
        // Delete product 
        $delProd = $this->db->findIdAndDelete('product', $dataProd['id']);

        // Delete product Image
        $delImageProd = $this->db->findAndDelete('images_product', ['prod_id' => $dataProd['id']]);

        if ($delPurchaseOrder && $delProd && $delImageProd) {
            return true;
        }
        return false;
    }
}
