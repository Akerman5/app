<?php
use LDAP\Result;
session_start();
require_once("DateBase.php");

//reg-btn
if (isset($_POST['reg-btn'])) {
    $db = new DateBase;
    if ($db->DoSQLCommand("SELECT * FROM admins WHERE email = '" . $_POST['email'] . "'")->num_rows > 0) {
        $_SESSION["checkEmail"] = "false";
        header('Location:register.php');
    } else {
        if (
            $db->DoSQLCommand("INSERT INTO admins (email,password,phone,active)
    VALUES ('" . $_POST['email'] . "','" . $_POST['password'] . "','" . $_POST['phone'] . "','0')") === TRUE
        ) {
            $_SESSION["successReg"] = "true";
            header('Location:register.php');
        }
    }
}
//end reg-btn

//add-new-category-btn
if (isset($_POST['add-new-category-btn'])) {
    $db = new DateBase;
    $result =$db->DoSQLCommand("INSERT INTO category (name,photo)
    VALUES ('" . $_POST['name'] . "','" . $_POST['photo'] . "')");
        if (
           $result  === TRUE
        ) {
           
            header('Location:allCategory.php');
        }
    
}
//end add-new-category-btn


//add-product-btn
if (isset($_POST['add-product-btn'])) {
    $db = new DateBase;
    $result =$db->DoSQLCommand("INSERT INTO product (name,price,info,category,photo)
    VALUES ('" . $_POST['name'] . "','" . $_POST['price'] . "','" . $_POST['info'] . "','" . $_POST['category'] . "','" . $_POST['photo'] . "')");
        if (
           $result  === TRUE
        ) {
           
            header('Location:Product.php');
        }
    
}
//end add-product-btn

//login-btn
if (isset($_POST['login-btn'])) {
    $db = new DateBase;
    $result = $db->DoSQLCommand("SELECT * FROM admins WHERE email = '" . $_POST['email'] . "' AND password = '" . $_POST['password'] . "' AND active = '1'");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION["adminemail"] = $row['email'];
            $_SESSION["phone"] = $row['phone'];
        }
        $_SESSION["enterCheck"] = "true";
        header('Location:index.php');
    } else {
        $_SESSION["enterCheck"] = "false";
        header('Location:login.php');
    }
}
//end login-btn

//save-edit-admin-btn
if (isset($_POST['save-edit-admin-btn'])) {
    echo "btn";
    $db = new DateBase;
    $result = $db->DoSQLCommand("UPDATE admins SET email='".$_POST['email']."',phone='".$_POST['phone']."',password='".$_POST['password']."',active='".$_POST['active']."'  WHERE id = '" . $_POST['id'] . "' ");
    if ($result=== TRUE) {
        header('Location:admins.php');
    } else {       
        header('Location:error.php');
    }
}
//end save-edit-admin-btn


//save-edit-product-btn
if (isset($_POST['save-edit-product-btn'])) {
    echo "btn";
    $db = new DateBase;
    $result = $db->DoSQLCommand("UPDATE product SET name='".$_POST['name']."',price='".$_POST['price']."',info='".$_POST['info']."',category='".$_POST['category']."',photo='".$_POST['photo']."'  WHERE id = '" . $_POST['id'] . "' ");
    if ($result=== TRUE) {
        header('Location:Product.php');
    } else {       
        header('Location:error.php');
    }
}
//end save-edit-product-btn


//save-edit-category-btn
if (isset($_POST['save-edit-category-btn'])) {
    echo "btn";
    $db = new DateBase;
    $result = $db->DoSQLCommand("UPDATE category SET name='".$_POST['name']."',photo='".$_POST['photo']."'  WHERE id = '" . $_POST['id'] . "' ");
    if ($result=== TRUE) {
        header('Location:allCategory.php');
    } else {       
        header('Location:error.php');
    }
}
//end save-edit-admin-btn


//delet-admin-btn
if (isset($_POST['delet-admin-btn'])) {
    $db = new DateBase;
    $result = $db->DoSQLCommand("DELETE FROM admins WHERE id ='".$_POST['id']."' ");
    if ($result === TRUE) {
        header('Location:admins.php');
        exit();
      } else {
        echo "Error";
      }
}
//end delet-admin-btn


//delet-product-btn
if (isset($_POST['delet-product-btn'])) {
    $db = new DateBase;
    $result = $db->DoSQLCommand("DELETE FROM product WHERE id ='".$_POST['id']."' ");
    if ($result === TRUE) {
        header('Location:Product.php');
        exit();
      } else {
        echo "Error";
      }
}
//end delet-product-btn


//delet-category-btn
if (isset($_POST['delet-category-btn'])) {
    $db = new DateBase;
    $result = $db->DoSQLCommand("DELETE FROM category WHERE id ='".$_POST['id']."' ");
    if ($result === TRUE) {
        header('Location:allCategory.php');
        exit();
      } else {
        echo "Error";
      }
}
//end delet-category-btn

//delet-category-btn
if (isset($_POST['delet-category-btn'])) {
    $db = new DateBase;
    $result = $db->DoSQLCommand("DELETE FROM category WHERE id ='".$_POST['id']."' ");
    if ($result === TRUE) {
        header('Location:allOrder.php');
        exit();
      } else {
        echo "Error";
      }
}
//end delet-category-btn


function loadAllAdmins()
{ //load all admins from date base to table in site
    $db = new DateBase;
    $result = $db->DoSQLCommand("SELECT * FROM admins");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $status = ($row["active"]==0) ? "Не активний" : "Активний";
            echo "<tr><td> 
            <div class='dropdown'>
      <form  action='editAdmins.php' method='post'>
      <input  type='hidden' name='id' value='" . $row["id"] . "'>
      <input  type='hidden' name='email' value='" . $row["email"] . "'>
      <input  type='hidden' name='password' value='" . $row["password"] . "'>
      <input  type='hidden' name='phone' value='" . $row["phone"] . "'>
      <input  type='hidden' name='active' value='" . $row["active"] . "'>
      <input  type='hidden' name='id' value='" . $row["id"] . "'>
      <button type=submit  name='edit-admin-btn' class='btn btn-sm btn-default' >
      <i class='fa fa-cog' aria-hidden='true'></i>
      </form>
      <form  action='Main.php' method='post'>
      <input  type='hidden' name='id' value='" . $row["id"] . "'>
      <button type=submit id='delet-admin-btn' name='delet-admin-btn' class='btn btn-sm btn-default'>
      <i class='fa fa-trash'></i>
      </button>
      </form>
      </div>
    <td>" . $row["email"] . "</td> 
    <td>" . $row["password"] . "</td> 
    <td>" . $row["phone"] . "</td> 
    <td>" . $status . "</td>
    </td></tr>";
        }
    }
}


function loadAllCategory()
{ //load all admins from date base to table in site
    $db = new DateBase;
    $result = $db->DoSQLCommand("SELECT * FROM category");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           
            echo "<tr><td> 
            <div class='dropdown'>
      <form  action='editCategory.php' method='post'>
      <input  type='hidden' name='id' value='" . $row["id"] . "'>
      <input  type='hidden' name='name' value='" . $row["name"] . "'>
      <input  type='hidden' name='photo' value='" . $row["photo"] . "'>
      
      <button type=submit  name='edit-category-btn' class='btn btn-sm btn-default' >
      <i class='fa fa-cog' aria-hidden='true'></i>
      </form>
      <form  action='Main.php' method='post'>
      <input  type='hidden' name='id' value='" . $row["id"] . "'>
      <button type=submit id='delet-category-btn' name='delet-category-btn' class='btn btn-sm btn-default'>
      <i class='fa fa-trash'></i>
      </button>
      </form>
      </div>
    <td>" . $row["name"] . "</td> 
    <td>" . $row["photo"] . "</td> 

  
    </td></tr>";
        }
    }
}

function loadAllOrder()
{ //load all admins from date base to table in site
    $db = new DateBase;
    $result = $db->DoSQLCommand("SELECT * FROM orders");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           
            echo "<tr><td> 
            <div class='dropdown'>
      <form  action='editOrder.php' method='post'>
      <input  type='hidden' name='id' value='" . $row["id"] . "'>
      <input  type='hidden' name='address' value='" . $row["address"] . "'>
      <input  type='hidden' name='messeg' value='" . $row["messeg"] . "'>
      <input  type='hidden' name='pib' value='" . $row["pib"] . "'>
      <input  type='hidden' name='status' value='" . $row["status"] . "'>
      <input  type='hidden' name='suma' value='" . $row["suma"] . "'>
      <input  type='hidden' name='textOrder' value='" . $row["textOrder"] . "'>
      <input  type='hidden' name='email' value='" . $row["email"] . "'>
      
      <button type=submit  name='edit-order-btn' class='btn btn-sm btn-default' >
      <i class='fa fa-cog' aria-hidden='true'></i>
      </form>
      <form  action='Main.php' method='post'>
      <input  type='hidden' name='id' value='" . $row["id"] . "'>
      <button type=submit id='delet-category-btn' name='delet-category-btn' class='btn btn-sm btn-default'>
      <i class='fa fa-trash'></i>
      </button>
      </form>
      </div>
    <td>" . $row["address"] . "</td> 
    <td>" . $row["messeg"] . "</td> 
    <td>" . $row["pib"] . "</td> 
    <td>" . $row["status"] . "</td> 
    <td>" . $row["suma"] . "</td> 
    <td>" . $row["textOrder"] . "</td> 
    <td>" . $row["email"] . "</td> 


  
    </td></tr>";
        }
    }
}

function loadCategoryInAddNewProduct()
{ //load all admins from date base to table in site
    $db = new DateBase;
    $result = $db->DoSQLCommand("SELECT * FROM category");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            echo "
            <option value='". $row["name"] ."'>". $row["name"] ."</option>
            ";
        }
    }
}

function loadCategoryInEditProduct($postValue)
{ //load all admins from date base to table in site
    $db = new DateBase;
    $result = $db->DoSQLCommand("SELECT * FROM category");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $selected = ($row["name"]==$postValue) ? "selected" : "";
            echo "
            <option value='". $row["name"] ."' ".$selected.">". $row["name"] ."</option>
            ";
        }
    }
}

function loadProduct()
{ //load all admins from date base to table in site
    $db = new DateBase;
    $result = $db->DoSQLCommand("SELECT * FROM product");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           
            echo "<tr><td> 
            <div class='dropdown'>
      <form  action='editProduct.php' method='post'>
      <input  type='hidden' name='id' value='" . $row["id"] . "'>
      <input  type='hidden' name='name' value='" . $row["name"] . "'>
      <input  type='hidden' name='price' value='" . $row["price"] . "'>
      <input  type='hidden' name='info' value='" . $row["info"] . "'>
      <input  type='hidden' name='category' value='" . $row["category"] . "'>
      <input  type='hidden' name='photo' value='" . $row["photo"] . "'>
      
      <button type=submit  name='edit-product-btn' class='btn btn-sm btn-default' >
      <i class='fa fa-cog' aria-hidden='true'></i>
      </form>
      <form  action='Main.php' method='post'>
      <input  type='hidden' name='id' value='" . $row["id"] . "'>
      <button type=submit id='delet-product-btn' name='delet-product-btn' class='btn btn-sm btn-default'>
      <i class='fa fa-trash'></i>
      </button>
      </form>
      </div>
    <td>" . $row["name"] . "</td> 
    <td>" . $row["price"] . "</td>
    <td>" . $row["info"] . "</td>
    <td>" . $row["category"] . "</td>
    <td>" . $row["photo"] . "</td> 

  
    </td></tr>";
        }
    }
}


?>