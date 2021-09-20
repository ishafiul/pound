<?php
require APPROOT . '/views/inc/header.php';
require APPROOT . '/views/inc/navbar.php';
//print_r($data['user_info']);
?>

<div class="content">
    <div class="content_box">
        <br>
        <br>
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4><?php echo $data['user_detail']->fname.' '.$data['user_detail']->lname?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-header">All Purchase History </h1>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Payment id</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Product Codes</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    foreach ($data['payment_info'] as $payment){
                                        ?>
                                        <tr>

                                            <td><?php echo $payment->payment_id?></td>
                                            <td><?php echo $payment->amount?></td>
                                            <td><?php echo $payment->products_ids?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        <?php require APPROOT . '/views/inc/footer.php'; ?>
    </div>
</div>
