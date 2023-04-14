<?php
$delete_success = $this->session->flashdata('delete_success');
$errors = $this->session->flashdata('errors');
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
        h2{
            margin: 20px 0 0 380px;
        }
        table{
            border-collapse: collapse;
            margin: 0px auto;
            width: 400px;
        }
        table td,th{
            border: 1px solid black;
            text-align: center;
            height: 30px;
        }
        table th{
            background: lightgray;
        }
        td a{
            text-decoration: none;
            background: red;
            color: white;
            padding: 1px 5px;
            border: 2px solid black;
        }
        p.success{
            margin-top: 100px;
            color: green;
            font-size: 20px;
            text-align: center;
        }
        span{
            margin-top: 10px;
            text-align: center;
            color: red;
        }
        h3{
            margin-bottom: 5px;
            position: relative;
            left: 820px;
        }
        form{
            width: 400px;
            margin: 10px auto;
        }
        label{
            display: block;
            margin-bottom: 10px;
        }
        form input[type=submit]{
            margin-left: 140px;
            background: #296D98;
            padding: 2px 15px;
            color: white;
        }
      </style>
</head>
<body>  
    <header>
        <h1>My Store</h1>
        <a href="/">Catalog</a>
    </header>
    <h2>Check Out</h2>
    <table>
        <h3>Total: $<?= $total_price ?></h3>
        <tr>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
<?php 
    foreach($orders as $order){
?>     
        <tr>
            <td><?= $order['name'] ?></td>
            <td><?= $order['quantity'] ?></td>
            <td>$<?= $order['value'] ?></td>
            <td><a href="delete/<?= $order['id'] ?>">X</a></td>
        </tr>
<?php
    }
?>
    </table>
    <center>
        <p class="success"><?= $delete_success ?></p>
    </center>
    <h2>Billing Info</h2>
    <form action="check_out/" method="POST">
        <label>
            Name: <input type="text" name="name">
        </label>
        <label>
            Address: <input type="text" name="address">
        </label>
        <label>
            Card Number: <input type="text" name="card_number">
        </label>
        <input type="submit" value="Submit Order">
    </form>
    <span>
        <?= $errors ?>
    </span>
    <p class="success"><?= $success ?></p>
</body>
</html>