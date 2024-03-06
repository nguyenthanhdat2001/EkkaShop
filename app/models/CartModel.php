<?php
class CartModel extends BaseModel
{


    public function tableName()
    {
        return 'cart';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }


    function getAllCart($idUser)
    {
        $sql = "SELECT
        c.id AS cart_id,
        c.totalPrice,
        ci.id AS cart_item_id,
        ci.quantity,
        p.id AS product_id,
        p.title,
        p.slug,
        p.thumb,
        pv.price,
        pv.id AS product_variant_id,
        av.value_name AS attribute_value
        FROM cart c
        INNER JOIN cart_item ci ON c.id = ci.cart_id
        INNER JOIN product_variants pv ON pv.id = ci.product_variant_id
        INNER JOIN variants_value vv ON pv.id = vv.product_variant_id
        INNER JOIN attribute a ON vv.attribute_id = a.id
        INNER JOIN attribute_value av ON vv.attribute_value_id = av.id
        INNER JOIN product p ON p.id = pv.prod_id
        WHERE c.user_id = $idUser;
        ";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    function getCartId($user_id)
    {

        $data = $this->db->table($this->tableName())->where('user_id', '=', $user_id)->getOne();
        if (empty($data)) {
            $this->db->create($this->tableName(), ['user_id' => $user_id, 'totalPrice' => 0]);
            $data = $this->db->table($this->tableName())->where('user_id', '=', $user_id)->getOne();
        }
        return $data;
    }

    function updateCart($id, $data)
    {
        return $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
    }

    function getOneCartItemProdVariant($id, $cart_id)
    {
        $dataCartItem = $this->db->table('cart_item')->where('product_variant_id', '=', $id)->where('cart_id', '=', $cart_id)->getOne();
        if (!empty($dataCartItem)) {
            return $dataCartItem;
        }
        return null;
    }
    function getOneCartItem($id)
    {
        $dataCartItem = $this->db->table('cart_item ci')->select('ci.quantity, ci.id, ci.cart_id, pv.price, pv.quantity AS product_variant_quantity, c.totalPrice')->join('cart c', 'c.id = ci.cart_id')->join('product_variants pv', 'ci.product_variant_id = pv.id')->where('ci.id', '=', $id)->getOne();
        if (!empty($dataCartItem)) {
            return $dataCartItem;
        }
        return null;
    }
    function addNewCartItem($data)
    {
        return $this->db->create('cart_item', $data);
    }

    function updateCartItem($id, $data)
    {
        return $this->db->findByIdAndUpdate('cart_item', $id, $data);
    }


    function deleteCartItem($id)
    {
        return $this->db->findIdAndDelete('cart_item', $id);
    }

    function deleteAllCart($id)
    {
        return $this->db->findIdAndDelete($this->tableName(), $id);
    }

    function deleteAllCartItem($cart_id)
    {
        return $this->db->findAndDelete('cart_item', ['cart_id' => $cart_id]);
    }
}
