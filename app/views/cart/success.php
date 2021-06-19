<?php
require APPROOT . '/views/inc/header.php';
require APPROOT . '/views/inc/navbar.php';
?>
<div class="content">
    <div class="content_box">
        <br>
        <br>
        <div class="alert alert-success" role="alert">
            Your payment has been processed successfully and you booking is confirmed. Your transaction id is : <br><i><?php echo $data['id']?></i>
        </div>
        <br>
        <br>
        <?php require APPROOT . '/views/inc/footer.php'; ?>
    </div>
</div>