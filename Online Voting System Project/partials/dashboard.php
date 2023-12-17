<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location:../');
}
$data=$_SESSION['data'];
if($_SESSION['status']==1){
    $status='<b class="text-success">Voted</b>';
}else{
    $status='<b class="text-danger">Not Voted</b>';
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System - Dashboard</title>
     <!-- Bootstrap css link -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <!-- CSS Link -->
     <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-primary text-light">
    <div class="container my-5">
    <a href="../"><button class="btn btn-dark text-light px-3">Back</button></a>
    <a href="logout.php"><button class="btn btn-dark text-light px-3">Logout</button></a>
    <h1 class="text-dark my-3">Voting System</h1>
    <div class="row my-5">
        <div class="col-md-7">
            <?php
        if(isset($_SESSION['groups'])){
            $groups=$_SESSION['groups'];
            for($i=0;$i<count($groups);$i++){
        
    ?>
            <!-- groups -->
            <div class="row">
                <div class="col-md-4">
                    <img src="../uploads/<?php echo $groups[$i]['photo']  ?>" alt="Group Image">
</div>
            <div class="col-md-8">
                <strong class="text-dark h5">Group name:</strong>
                <?php echo $groups[$i]['username'] ?><br>
                <strong class="text-dark h5">Votes:</strong>
                <?php echo $groups[$i]['votes'] ?><br>
</div>
</div>

<form action="../actions/voting.php" method="post">
    <input type="hidden" name="groupvotes" value="<?php echo $groups[$i]['votes'] ?>">
    <input type="hidden" name="groupid" value="<?php echo $groups[$i]['id'] ?>">
<?php
if($_SESSION['status']==1){
    ?>
    <button class="bg-success my-3 text-white px-3">Voted</button>
    <?php
}else{
    ?>
    <button class="bg-danger my-3 text-white px-3" type="submit">Vote</button>
    <?php
}

?>
</form>
<hr>
<?php
 }
}else{
 ?>
 <div class="container">
    <p>No groups to display</p>
</div>
<?php
}
?>
</div>
<div class="col-md-5">
    <!-- user profile -->
    <img src="../uploads/<?php echo $data['photo'];?>" alt="User Image">
    <br>
    <br>
    <strong class="text-dark h5">Name:</strong>

    <?php echo $data['username'];?><br><br>
    <strong class="text-dark h5">Mobile:</strong>
    <?php echo $data['mobile'];?><br><br>
    <strong class="text-dark h5">Status:</strong>
    <?php echo $status;?><br><br>



    </div>

    
</body>
</html>