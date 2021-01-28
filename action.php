<?php
    include 'connection.php';
    if(isset($_POST['qty']))
    {
        $qty=$_POST['qty'];
        $pid=$_POST['pid'];
        $pprice=$_POST['pprice'];
        
        $tprice=$qty*$pprice;
        
        $stmt=$con->prepare("Update cart set entered_quantity=?, total_price=? where product_code=?");
        $stmt->bind_param("iss",$qty,$tprice,$pid);
        $stmt->execute();
    }
?>