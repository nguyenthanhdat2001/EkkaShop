<?php
class OrderModel extends BaseModel
{
    use SweetAlert;
    public function tableName()
    {
        return 'orders';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }

    function getAmountStatistical()
    {
        $sql = "SELECT
                YEAR(order_date) AS order_year,
                MONTH(order_date) AS order_month,
                COUNT(*) AS total_orders,
                SUM(total_money) AS total_amount
            FROM
                orders
            WHERE
                order_date >= DATE_SUB(NOW(), INTERVAL 12 MONTH) AND order_status_id = 4
            GROUP BY
                YEAR(order_date), MONTH(order_date)
            ORDER BY
                order_year DESC, order_month DESC";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function getAllOrderItemByUser($order_id)
    {
        $sql = "
            SELECT 
                o.id AS order_id, o.order_code, o.fullname, o.phone, o.address, o.order_date, o.order_status_id, o.total_money, o.coupon_id,
                pd.display_name AS payment_method_name,
                os.name AS order_status_name,
                oi.quantity, oi.price, oi.product_variant_id,
                av.value_name AS attribute_value,
                prd.title, prd.thumb, prd.id AS prod_id, prd.slug
            FROM 
                orders o
            INNER JOIN 
                payment p ON p.order_id = o.id
            INNER JOIN 
                payment_method pd ON pd.id = p.payment_method_id
            INNER JOIN 
                order_status os ON os.id = o.order_status_id
            INNER JOIN 
                order_item oi ON oi.order_id = o.id
            INNER JOIN 
                product_variants pv ON pv.id = oi.product_variant_id
            INNER JOIN 
                variants_value vv ON pv.id = vv.product_variant_id
            INNER JOIN 
                attribute a ON vv.attribute_id = a.id
            INNER JOIN 
                attribute_value av ON vv.attribute_value_id = av.id
            INNER JOIN 
                product prd ON prd.id = pv.prod_id
            WHERE 
                 o.id = $order_id;

        ";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    function getAllOrderByUser($user_id)
    {
        return $this->db->table('orders o')->select('o.id AS order_id, o.order_code, o.total_money, o.order_date, pd.display_name AS payment_method_name, os.name AS order_status_name, o.order_status_id')->join('payment p', 'p.order_id = o.id')->join('payment_method pd', 'pd.id = p.payment_method_id')->join('order_status os', 'os.id = o.order_status_id')->where('o.user_id', '=', $user_id)->orderBy('o.order_date')->get();
    }

    function getOneOrder($id)
    {
        return $this->db->findById($this->tableName(), $this->selectField, $id);
    }

    function countOrder()
    {
        $sql = "SELECT COUNT(*) FROM orders";
        $data = $this->db->query($sql)->fetchColumn();
        return $data;
    }


    function getAllOrder()
    {
        return $this->db->table('orders o')->select('o.id AS order_id, o.user_id, o.order_code, o.total_money, o.order_date, pd.display_name AS payment_method_name, os.name AS order_status_name, o.order_status_id, u.fullname')->join('payment p', 'p.order_id = o.id')->join('payment_method pd', 'pd.id = p.payment_method_id')->join('user u', 'o.user_id = u.id')->join('order_status os', 'os.id = o.order_status_id')->orderBy('o.order_date')->get();
    }

    function getAllOrderStatus()
    {
        return $this->db->table('order_status')->get();
    }

    function getOderItem($order_id)
    {

        return $this->db->table('order_item')->where('order_id', '=', $order_id)->get();
    }

    function addNewOrder($data)
    {
        // ->select('o.id, o.order_code, o.total_money, os.id AS order_status_id, os.name, o.order_date, pd.display_name')
        return $this->db->create($this->tableName(), $data);
    }

    function addNewOrderItem($data)
    {
        return $this->db->create('order_item', $data);
    }

    function updateOrder($id, $data)
    {
        return $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
    }
}
