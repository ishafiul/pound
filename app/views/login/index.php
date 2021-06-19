<?php
require APPROOT . '/views/inc/header.php';
require APPROOT . '/views/inc/navbar.php';
?>
        <div class="content">
            <div class="content_box">
                <div class="men">
                    <div class="account-in">
                        <h2>Account</h2>
                        <div class="col-md-7 account-top">
                            <form>
                                <div>
                                    <span>Email*</span>
                                    <input type="text">
                                </div>
                                <div>
                                    <span class="pass">Password*</span>
                                    <input type="password">
                                </div>
                                <input type="submit" value="Login">
                            </form>
                        </div>
                        <div class="col-md-5 left-account ">
                            <a href="single.html"><img class="img-responsive " src="images/s4.jpg" alt=""></a>
                            <div class="five-in">
                                <h1>25% </h1><span>discount</span>
                            </div>
                            <a href="register.html" class="create">Create an account</a>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>