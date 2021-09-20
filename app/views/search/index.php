<?php
require APPROOT . '/views/inc/header.php';
require APPROOT . '/views/inc/navbar.php';
?>
<div class="content">
    <div class="content_box">

        <br>
        <br>
        <h4>Search Result</h4>
        <table class="table">
            <thead>

            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
           
            foreach ($data['result'] as $result){
            ?>
            <tr>
                <td><img src="<?php echo URLROOT; ?>/img/product/<?php echo $result->product_base_img?>" alt="" width="100px"></td>
                <td><?php echo $result->product_name?></td>
                <td>$<?php echo $result->price?></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $result->id?>">
                    <a href="<?php echo URLROOT; ?>/product/<?php echo $result->url?>"  class="btn btn-success"><i class="fas fa-external-link-alt"></i> View Details</a>
                </td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
<?php require APPROOT . '/views/inc/footer.php'; ?>
</div>
</div>

