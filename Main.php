<?php
session_start();
require_once("DateBase.php");

//reg-btn
if (isset($_POST['reg-btn'])) {
    $db = new DateBase;
    if ($db->DoSQLCommand("SELECT * FROM customer WHERE email = '" . $_POST['email'] . "'")->num_rows > 0) {
        $_SESSION["checkEmail"] = "false";
        header('Location:reg.php#email');
    } else {
        if (
            $db->DoSQLCommand("INSERT INTO customer (email,password,PIB,birthday,address)
    VALUES ('" . $_POST['email'] . "','" . $_POST['password'] . "','" . $_POST['pib'] . "','" . $_POST['birthday'] . "','" . $_POST['address'] . "')") === TRUE
        ) {
            $_SESSION["successReg"] = "true";
            header('Location:reg.php#email');
        }
    }
}
//end reg-btn

//add-to-cart-btn
if (isset($_POST['add-to-cart-btn'])) {

    $_SESSION['cart'][$_POST["id"]] = array("count" => $_POST["count"], "id" => $_POST["id"]);
    header('Location:cart.php');
}
//end add-to-cart-btn

//login-btn
if (isset($_POST['login-btn'])) {
    $db = new DateBase;
    $result = $db->DoSQLCommand("SELECT * FROM customer WHERE email = '" . $_POST['email'] . "' AND password = '" . $_POST['password'] . "'");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION["cabpib"] = $row['PIB'];
            $_SESSION["cabaddress"] = $row['address'];
            $_SESSION["cabemail"] = $row['email'];
        }
        $_SESSION["enterCheck"] = "true";
        header('Location:cabinet.php');
    } else {
        $_SESSION["enterCheck"] = "false";
        header('Location:login.php#section-feature-testimonial');
    }
}
//end login-btn


//add-new-order-btn
if (isset($_POST['add-new-order-btn'])) {
    $db = new DateBase;
    $result =$db->DoSQLCommand("INSERT INTO orders (address,messeg,pib,status,suma,textOrder,email)
    VALUES ('" . $_SESSION['cabaddress'] . "','" . $_POST['messeg'] . "','" . $_SESSION['cabpib'] . "','" . $_POST['status'] . "',
    '" . $_POST['suma'] . "','" . $_POST['order'] . "','" . $_SESSION['cabemail'] . "')");
        if (
           $result  === TRUE
        ) {
           
            header('Location:catalog.php');
        }
    
}
//end add-new-order-btn

function outCategoryInSelect()
{
    $db = new DateBase;
    $result = $db->DoSQLCommand("SELECT * FROM category");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            echo "
          <option value='?a&category=" . $row["name"] . "'>" . $row["name"] . "</option>
            ";
        }
    }
}

function outCart()
{
    $order = "";
    $allPrice = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $order .= getDateFromProductById($value['id'], "name") . " - " . $value['count'] . " шт" . ";";
            $allPrice += getDateFromProductById($value['id'], "price") * $value['count'];
            echo "
            <tr class='cart_item'>
            <td class='product-name'>
                <span>" . getDateFromProductById($value['id'], "name") . "</span> 
            </td>
            
            <td class='product-price'>
                <span class='amount'>₴ " . getDateFromProductById($value['id'], "price") . "</span> 
            </td>

            <td class='product-quantity'>
                <div class='quantity buttons_added'>
              
                    <span>" . $value['count'] . " шт.</span>
               
                </div>
            </td>
            <td>
            </td>
            </tr>
            ";
        }
        echo "<input  type='hidden'  name='order' value='$order'>";
        echo "<input  type='hidden' name='suma' value='$allPrice'>";
        echo "<input  type='hidden' name='status' value='Нове замовлення'>";
        echo "
                                               <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                               <td class='product-subtotal'>
                                                    <span class='amount'>₴ " . $allPrice . "</span> 
                                                </td>
                                                
                                               <h6>Сума ₴ " . $allPrice . "</h6>";
    }
}
function getDateFromProductById($id, $param)
{
    $db = new DateBase;
    $result = $db->DoSQLCommand("SELECT " . $param . " FROM product WHERE id = $id");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row[$param];
        }
    }
}

function outAllCategory()
{
    $db = new DateBase;
    $result = $db->DoSQLCommand("SELECT * FROM category");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            echo "
            <div class='col-lg-3 col-md-6 probootstrap-animate mb-3 fadeInUp probootstrap-animated'>
            <a href='catalog.php?a&category=" . $row["name"] . "' class='probootstrap-thumbnail'>
              <img src='assets/images/" . $row["photo"] . "' alt='Free Template by ProBootstrap.com' class='img-fluid'>
              <div class='probootstrap-text'>
                <h3>" . $row["name"] . "</h3>
              </div>
            </a>
          </div>
            
            ";
        }
    }
}


function outAllProduct($category, $sort)
{
    $db = new DateBase;
    $result = ($category != "") ? $db->DoSQLCommand("SELECT * FROM product WHERE category LIKE '" . $category . "' ORDER BY " . $sort . "") : $db->DoSQLCommand("SELECT * FROM product  ORDER BY " . $sort . "");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            echo "
            <div class='col-md-6'>
            <div class='media probootstrap-media d-flex align-items-stretch mb-4 probootstrap-animate fadeInUp probootstrap-animated'>
            
              <div class='probootstrap-media-image' style='background-image: url(assets/images/" . $row["photo"] . ")''>
              </div>
              <div class='media-body' >
                <span class='text-uppercase'></span>
                <h5 class='mb-3'>" . $row["name"] . "</h5>
                <p>Ціна " . $row["price"] . " грн</p>
                <div style='
                height: 150px;
                overflow: hidden;
                text-overflow: ellipsis;
                
                line-height: 16px;
                '>
                <p>" . str_replace("\r\n", "</br>", $row["info"]) . "</p>
                </div>
                <form action='single_product.php' method='post' class=''>

            <input  type='hidden' name='id' value='" . $row["id"] . "'>
            <input  type='hidden' name='name' value='" . $row["name"] . "'>
            <input  type='hidden' name='price' value='" . $row["price"] . "'>
            <input  type='hidden' name='info' value='" . $row["info"] . "'>
            <input  type='hidden' name='category' value='" . $row["category"] . "'>
            <input  type='hidden' name='photo' value='" . $row["photo"] . "'>
            <br>
                <button type=submit  name='edit-product-btn' class='btn btn-sm btn-default'>Більше інформації
               </form>
               </div>
             
            </div>
            </div>            
            ";
        }
    }
}

?>