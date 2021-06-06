<?php
if (!isset($_SESSION['user_id'])){
    redirect('admins/login');
}
require_once 'inc/header.php';

?>


<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Product</h4>
                <div class="form-group">
                    <label for="exampleInputPassword1">Product Name</label>
                    <input type="text" name="" class="form-control" id="exampleInputPassword1" placeholder="" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Price (USD-$)</label>
                    <input type="text" name="editmobile" class="form-control" id="exampleInputPassword1" placeholder="" value="">
                </div>
                <div class="form-group">
                    <label>Short Info</label>
                    <textarea class="editor" name="long_desc"  rows="15"></textarea>
                </div>
                <div class="form-group">
                    <label>Product Details</label>
                    <textarea class="editor" name="long_desc" rows="15"></textarea>
                </div>
                <div class="form-group">
                    <label>More Info</label>
                    <textarea class="editor" name="long_desc" rows="15"></textarea>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Product</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data['products'] as $products){
                        ?>
                        <tr>

                            <th scope="row"><?php echo $products->id?></th>
                            <td><?php echo $products->product_name?></td>
                            <td><?php echo $products->cat_name?></td>
                            <td><?php echo $products->brand_name?></td>
                            <td>$<?php echo $products->price?></td>
                            <td>
                                <button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </td>


                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <hr>
                <?php
                pagination($data['total_pages'],$data['pageno']);
                ?>
            </div>
        </div>
        <br>
    </div>
</div>
    <script type="text/javascript">
        tinymce.init({
            selector: '.editor',
        });
    </script>
<?php
require_once 'inc/footer.php';
?>