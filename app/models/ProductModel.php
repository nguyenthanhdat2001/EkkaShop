<?php
class ProductModel extends BaseModel
{

    use SweetAlert;
    private $idUser;

    public function tableName()
    {
        return 'product';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }


    function getProdRecently()
    {
        return $this->db->table($this->tableName())->select('id, title, slug , thumb, price, totalRatings, quantity, discount, totalUserRatings')->where('status', '=', 1)->orderBy('view')->limit(8)->get();
    }

    function getProdByCate($cate_id)
    {
        return $this->db->table($this->tableName())->select('id, title, slug , thumb, price, totalRatings, quantity, discount, totalUserRatings')->where('status', '=', 1)->orderBy('view')->where('cate_id', '=', $cate_id)->limit(8)->get();
    }

    function getProdMostSold()
    {
        return $this->db->table($this->tableName())->select('id, title, slug , thumb, price, totalRatings, quantity, discount, totalUserRatings ')->where('status', '=', 1)->orderBy('sold')->limit(10)->get();
    }

    function getProdNewDate()
    {
        return $this->db->table($this->tableName())->select('id, title, slug , thumb, price, totalRatings, quantity, discount, totalUserRatings ')->where('status', '=', 1)->orderBy('create_at')->limit(4)->get();
    }

    function getOneProd($id)
    {
        return $this->db->findById($this->tableName(), $this->tableField(),  $id);
    }

    function getAllProdImages($id)
    {
        return $this->db->table('images_product')->where('prod_id', '=', $id)->get();
    }

    function getImageProd($id)
    {
        return $this->db->table('images_product')->where('prod_id', '=', $id)->get();
    }
    function getVariantProd($id)
    {

        $sql = "SELECT attr.name,  attr.value
            FROM product_attribute attrPro
            JOIN attribute attr ON attrPro.attribute_id = attr.id
            WHERE attrPro.prod_id = $id";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getProductStock()
    {
        $sql = "SELECT pv.quantity, pv.price, p.id AS prod_id
            FROM product_variants pv
            JOIN product p ON pv.prod_id = p.id
            ";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getProductPrice($id)
    {
        $sql = "SELECT pv.price, p.id AS prod_id
            FROM product_variants pv
            JOIN product p ON pv.prod_id = p.id
            WHERE p.id = $id ";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    function getOneProdVariantApi($variantId)
    {
        return $this->db->findById('product_variants', '*', $variantId);
    }

    function countProduct()
    {
        $data = $this->db->table($this->tableName())->select('COUNT(*) AS countProduct')->getOne();
        return $data;
    }

    function getAllProduct()
    {
        $data = $this->db->table($this->tableName())->orderBy('id')->get();
        return $data;
    }

    function getAllProductOrderBySold()
    {
        $data = $this->db->table($this->tableName())->select('id, slug, thumb, title, create_At, price, sold, quantity')->orderBy('sold')->limit(4)->get();
        return $data;
    }

    function addNewProduct($data)
    {
        $success = $this->db->create($this->tableName(), $data);
        if ($success) {
            return $this->db->lastInsertId();
        }
        return null;
    }

    function updateProduct($id, $data)
    {
        return $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
    }

    function deleteImageProduct($id)
    {
        return $this->db->findIdAndDelete('images_product', $id);
    }
    function deleteProductVariant($id)
    {
        $delProductVariant = $this->db->findIdAndDelete('product_variants', $id);
        $delProductVariantValue = $this->db->findAndDelete('variants_value', ['product_variant_id' => $id]);

        if ($delProductVariant && $delProductVariantValue) {
            return true;
        }
        return false;
    }

    function getAllProdVariants($id)
    {
        $sql = "SELECT pv.id, pv.price, pv.quantity, pv.discount, p.title, a.id AS attribute_id, a.display_name, av.value_name AS attribute_value
        FROM product_variants pv
        JOIN variants_value vv ON pv.id = vv.product_variant_id
        JOIN attribute a ON vv.attribute_id = a.id
        JOIN attribute_value av ON vv.attribute_value_id = av.id
        JOIN product p ON pv.prod_id = p.id
        WHERE pv.prod_id = $id ORDER BY pv.id ASC
        ";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getAllVariants()
    {
        $sql = "SELECT pv.id, pv.price, pv.quantity, pv.discount, p.title, a.id AS attribute_id, a.display_name, av.value_name AS attribute_value
        FROM product_variants pv
        JOIN variants_value vv ON pv.id = vv.product_variant_id
        JOIN attribute a ON vv.attribute_id = a.id
        JOIN attribute_value av ON vv.attribute_value_id = av.id
        JOIN product p ON pv.prod_id = p.id
        ORDER BY pv.id ASC
        ";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getOneProdVariant($variantId)
    {

        $sql = "SELECT pv.id AS product_variant_id, p.id AS prod_id, pv.quantity as variant_quantity, p.quantity AS product_quantity, p.sold
        FROM product_variants pv
        JOIN product p ON pv.prod_id = p.id
        WHERE pv.id = $variantId
        ";
        $data = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $data;
    }


    function updateProductVariant($id, $data)
    {
        return $this->db->findByIdAndUpdate('product_variants', $id, $data);
    }

    function deleteProduct($id)
    {
        $deleteProd = $this->db->findIdAndDelete($this->tableName(), $id);
        $dataProdVariants = $this->db->table('product_variants')->select('id')->where('prod_id', '=', $id)->get();

        $deleteProdVariant = $this->db->findAndDelete('product_variants', ['prod_id' => $id]);
        $deleteProdImages = $this->db->findAndDelete('images_product', ['prod_id' => $id]);

        if (!empty($dataProdVariants)) {
            foreach ($dataProdVariants as $item) {
                $deleteProdVariantValue = $this->db->findAndDelete('variants_value', ['product_variant_id' => $item['id']]);
                if (!$deleteProdVariantValue) {
                    return false;
                }
            }
        }

        if (!$deleteProd || !$deleteProdVariant || !$deleteProdImages) {
            return false;
        }

        return true;
    }



    function getAllRatings($prod_id)
    {
        return $this->db->table('ratings r')->select('r.id, r.create_at, p.title, r.status , r.star, r.comment, u.fullname, u.avatar ')->join('user u', 'r.user_id = u.id')->join('product p', 'p.id = r.prod_id')->where('r.prod_id', '=', $prod_id)->get();
    }
    function getAllRatingDashboard()
    {
        return $this->db->table('ratings r')->select('r.id, r.create_at, p.title, r.status , r.star, r.comment, u.fullname, u.avatar ')->join('user u', 'r.user_id = u.id')->join('product p', 'p.id = r.prod_id')->limit(4)->get();
    }

    function getAllRatingsProd($prod_id)
    {
        return $this->db->table('ratings r')->select('r.id, r.create_at, r.star, r.comment, u.fullname, u.avatar ')->join('user u', 'r.user_id = u.id')->where('r.prod_id', '=', $prod_id)->where('r.status', '=', 1)->get();
    }


    function getOneRating($id)
    {
        return $this->db->findById('ratings', 'status', $id);
    }

    function addRatingProd($data)
    {
        return $this->db->create('ratings', $data);
    }

    function getOneRaingProd($prod_id, $user_id)
    {
        return $this->db->table('ratings')->where('prod_id', '=', $prod_id)->where('user_id', '=', $user_id)->getOne();
    }
    function updateRatingProd($id, $data)
    {
        return $this->db->findByIdAndUpdate('ratings', $id, $data);
    }
}
