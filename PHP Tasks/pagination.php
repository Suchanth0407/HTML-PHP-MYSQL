<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"  crossorigin="anonymous">
    <?php
    include("config.php");

    $row_per_page = 4;
    $row = 0;

    // Previous Button
    if(isset($_POST['prev'])){
        $row = $_POST['row'];
        $row -= $row_per_page;
        if( $row < 0 ){
            $row = 0;
        }
    }

    // Next Button
    if(isset($_POST['next'])){
        $row = $_POST['row'];
        $count = $_POST['count'];

        $val = $row + $row_per_page;
        if( $val < $count ){
            $row = $val;
        }
    }

    // Generate sorting url for table header
    function sortorder($field){
        $sorturl = "?order_by=".$field."&sort=";
        $sorttype = "asc";
        if(isset($_GET['order_by']) && $_GET['order_by'] == $field){
            if(isset($_GET['sort']) && $_GET['sort'] == "asc"){
                $sorttype = "asc";
            }
        }
        $sorturl .= $sorttype;
        return $sorturl;
    }
    ?>
</head>
<body>
    <h1><center> Pagination and Sorting</h1></center>
<div style="width: 40%; margin: 0 auto; text-align: center;">
<div class="container my-10"></div>
    <table class="table table-striped">
        <thead class="table-info">
            <th>Product_id</th>
            <th><a href="/" class="sort">Product_name</a></th>
            <th><a href="/" class="sort">Price</a></th>
            <th><a href="/" class="sort">Purchase_Date</a></th>
        
        <?php
        $sql = "SELECT COUNT(*) AS cntrows FROM `product`";
        $result =  mysqli_query($con,$sql);
        $fetchresult = mysqli_fetch_array($result);
        $count = $fetchresult['cntrows'];
        $orderby = " ORDER BY product_id desc ";
        if(isset($_GET['order_by']) && isset($_GET['sort'])){
            $orderby = ' order by '.$_GET['order_by'].' '.$_GET['sort'];
        }
        $sql = "SELECT * FROM `product`".$orderby." limit $row,".$row_per_page;
        $result = mysqli_query($con,$sql);
        $product_id = $row + 1;
        while($fetch = mysqli_fetch_array($result)){
            $name= $fetch['name'];
            $price = $fetch['price'];
            $date = $fetch['date'];
            ?>
            <tr>
                <td align='center'><?php echo $product_id; ?></td>
                <td align='center'><?php echo $name; ?></td>
                <td align='center'><?php echo $price; ?></td>
                <td align='center'><?php echo $date; ?></td>
            </tr>
            <?php
            $product_id ++;
        }
        ?>
    </table>
    <form method="post" action="">
            <input type="hidden" name="row" value="<?php echo $row; ?>">
            <input type="hidden" name="count" value="<?php echo $count; ?>">
            <input type="submit" class="btn-primary" name="prev" value="Previous">
            <input type="submit" class="btn-primary" name="next" value="Next">
    </form>
</div>
</body>
</html>