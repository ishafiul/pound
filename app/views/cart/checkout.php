<?php
require APPROOT . '/views/inc/header.php';
require APPROOT . '/views/inc/navbar.php';
//print_r($data['user_info']);
?>
<div class="content">
    <div class="content_box">

        <?php
        if(empty($data['cart'])){

            ?>
            <div class="men cart">
                <h1>It appears that your cart is currently empty!</h1>
                <h2>You can continue browsing <a href="<?php echo URLROOT; ?>">here</a>.</h2>
            </div>
            <?php
        }
        else{
        ?>
        <br>
        <br>
       <div class="row">
           <div class="col-md-6">

               <div class="register-top-grid">
                   <h1>Shipping Address </h1>
                   <div>
                       <span>First Name<label>*</label></span>
                       <input type="text" name="fname" value="<?php if (!empty($data['user_info'])){ echo $data['user_info'][0]->fname;}?>">
                   </div>
                   <div>
                       <span>Last Name<label>*</label></span>
                       <input type="text" name="l_name" value="<?php if (!empty($data['user_info'])){ echo $data['user_info'][0]->lname;}?>">
                   </div>
                   <div>
                       <span>Email Address<label>*</label></span>
                       <input type="email" name="mail" value="<?php if (!empty($data['user_info'])){ echo $data['user_info'][0]->email;}?>">
                   </div>
                   <div>
                       <span>Phone Number<label>*</label></span>
                       <input type="text" name="phone" value="<?php if (!empty($data['user_info'])){ echo $data['user_info'][0]->phone;}?>">

                   </div>
                   <div>
                       <span>Zip Code<label>*</label></span>
                       <input type="text" name="zip" value="<?php if (!empty($data['user_info'])){ echo $data['user_info'][0]->zip;}?>">
                   </div>
                   <div>
                       <span>Address<label>*</label></span>
                       <input type="text" name="address" value="<?php if (!empty($data['user_info'])){ echo $data['user_info'][0]->address;}?>">
                   </div>
                   <div class="clearfix"> </div>
                   <a class="news-letter" href="#">
                   </a>
               </div>
           </div>
           <div class="col-md-6">
               <br>
               <table class="table">
                   <thead>

                   <tr>
                       <th scope="col">Image</th>
                       <th scope="col">Name</th>
                       <th scope="col">Price</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php
                   $totalPrice = 0;
                   foreach ($data['cart'] as $cart){
                       ?>
                       <tr>
                           <td><img src="http://localhost/pound/img/product/47847228_pic2.png" alt="" width="100px"></td>
                           <td><?php echo $cart->product_name?></td>
                           <td>$<?php echo $cart->price?></td>
                       </tr>
                       <?php
                       $totalPrice += intval($cart->price);
                   }
                   ?>

                   </tbody>
               </table>
               <div>
                   <h2>Total: $<?php echo $totalPrice?></h2>
                   <button type="button" class="btn btn-danger">Pay Now!</button>
               </div>


           </div>
           </div>

       </div>
    <br>
    <br>
    <br>
    <?php
    }
    ?>
    <?php require APPROOT . '/views/inc/footer.php'; ?>
</div>
</div>
<style>
    .card {
        border: 1px solid #DFDFDF;
        border-radius: 3px;
        padding: 5px;
    }

    /* On mouse-over, add a deeper shadow */

    /* Add some padding inside the card container */
    .card .container {
        padding: 2px 16px;
    }
</style>