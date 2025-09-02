<?php
include_once '../commons/db_connection.php';
$dbcon = new DbConnection();

class Order
{


    public function addOrder($number, $supplier, $date, $total)
    {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO orders (order_number,supplier,date, total)
            VALUES ('$number','$supplier','$date','$total')";
        $con->query($sql) or die($con->error);
        $order_id = $con->insert_id;
        return $order_id;
    }

    public function addOrderItem($order_id, $material, $price, $qty, $amount)
    {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO order_item (order_id,material,price,qty,amount)
            VALUES ('$order_id','$material','$price','$qty','$amount')";
        $con->query($sql) or die($con->error);
        $item_id = $con->insert_id;
        return $item_id;
    }
    public function getOrderItem($order_id)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM order_item WHERE order_id = '$order_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function getAllOrders()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM orders WHERE status !=-1";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function deleteOrder($order_id)
    {
        $con = $GLOBALS["con"];
        $sql = "UPDATE orders SET status='-1' WHERE order_id='$order_id'";
        $result = $con->query($sql) or die($con->error);
    }

    public function getOrder($order_id)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM orders o,supplier s WHERE o.supplier=s.supplier_id AND order_id='$order_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function getOrderTwo($order_id)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM order_item i,material m WHERE i.material=m.material_id AND order_id='$order_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }


    public function getSuccessCount()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(order_id) as order_count FROM orders WHERE status=1;";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function getPendingCount()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(order_id) as order_count FROM orders WHERE status=0;";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function getAllSuppliers()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM supplier";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function getAllMaterials()
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM material";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function successorder($order_id)
    {
        $con = $GLOBALS["con"];
        $sql = "UPDATE orders SET status='1' WHERE order_id='$order_id'";
        $result = $con->query($sql) or die($con->error);
    }

    public function pendingorder($order_id)
    {
        $con = $GLOBALS["con"];
        $sql = "UPDATE orders SET status='0' WHERE order_id='$order_id'";
        $result = $con->query($sql) or die($con->error);
    }
    
    public function getMaterial($material_id)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM material WHERE material_id='$material_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }


}