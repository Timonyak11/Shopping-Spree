<?php
$error = $this->session->flashdata('error');
$success = $this->session->flashdata('success');
?><!DOCTYPE html>
<html>
<head>
      <title>Shopping Spree</title>
      <style>
        *{
            /* outline: 1px dotted red; */
            margin: 0px;
            padding: 0px;
        }
        header{
            width: 98%;
            padding: 1%;
            background: #DDDDDD;
        }
        header h1{
            display: inline-block;
            margin-left: 40px;
            font-weight: lighter;
        }
        header a{
            display: inline-block;
            vertical-align: top;
            margin-left: 1040px;
            font-size: 31px;
        }
        form{
            display: inline-block;
            margin: 50px 0 0 185px;
            width: 201px;
        }
        form p{
            display: inline-block;
            vertical-align: top;
            width: 96px;
            padding: 1px 0;
            font-size: 20px;
            font-weight: bold;
            margin-left: 1px;
        }
        form p.value{
            text-align: right;
        }
        form img{
            border: 1px solid black;
        }
        form input[type=number]{
            width: 90px;
        }
        form input[type=submit]{
            margin-left: 13px;
            width: 90px;
        }
        .error{
            margin-top: 100px;
            color: red;
            font-size: 20px;
        }
        .success{
            margin-top: 100px;
            color: green;
            font-size: 20px;
        }
      </style>
</head>
<body>  
    <header>
        <h1>My Store</h1>
        <a href="store/cartpage">Cart(<?= $orders ?>)</a>
    </header>
<?php 
    foreach($items as $item){
?>
    <form action="store/add_to_cart" method="POST">
        <img src="assets/images/<?= $item['img_name'] ?>" alt="T-shirt image" height="200px" width="200px">
        <p><?= $item['name'] ?></p>
        <p class="value">$<?= $item['value'] ?></p>
        <input type="number" value="1" name="quantity">
        <input type="hidden" value="<?= $item['id'] ?>" name="item_id">
        <input type="submit" value="Buy">
    </form>
<?php
    }
    if(!empty($error)){
?>
    <center>
        <p class="error"><?= $error ?></p>
    </center>
<?php
    }
    if(!empty($success)){
?>
    <center>
        <p class="success"><?= $success ?></p>
    </center>
<?php
    }
?>

</body>
</html>