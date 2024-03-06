<?php
class WishlistModel extends BaseModel
{

    function tableName()
    {
        return 'wishlist';
    }
    function tableField()
    {
        return '*';
    }
    function primaryKey()
    {
        return 'id';
    }

    function getWishlistId($user_id)
    {

        $data = $this->db->table($this->tableName())->where('user_id', '=', $user_id)->getOne();
        if (empty($data)) {
            $this->db->create($this->tableName(), ['user_id' => $user_id]);
            $data = $this->db->table($this->tableName())->where('user_id', '=', $user_id)->getOne();
        }
        return $data;
    }

    function getOneWishlistItemProdVariant($id, $wishlist_id)
    {
        $dataWishlistItem = $this->db->table('wishlist_item')->where('product_variant_id', '=', $id)->where('wishlist_id', '=', $wishlist_id)->getOne();
        if (!empty($dataWishlistItem)) {
            return $dataWishlistItem;
        }
        return null;
    }

    function addNewWishlistItem($data)
    {
        return $this->db->create('wishlist_item', $data);
    }
    function getAllWishlist($idUser)
    {
        $sql = "SELECT
        w.id AS wishlist_id,
        wi.id AS wishlist_item_id,
        p.id AS product_id,
        p.title,
        p.slug,
        p.thumb,
        p.totalRatings,
        pv.price,
        pv.discount,
        pv.id AS product_variant_id,
        av.value_name AS attribute_value
        FROM wishlist w
        INNER JOIN wishlist_item wi ON w.id = wi.wishlist_id
        INNER JOIN product_variants pv ON pv.id = wi.product_variant_id
        INNER JOIN variants_value vv ON pv.id = vv.product_variant_id
        INNER JOIN attribute a ON vv.attribute_id = a.id
        INNER JOIN attribute_value av ON vv.attribute_value_id = av.id
        INNER JOIN product p ON p.id = pv.prod_id
        WHERE w.user_id = $idUser;
        ";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function deleteWishlistItemApi($id)
    {
        return $this->db->findIdAndDelete('wishlist_item', $id);
    }
}
