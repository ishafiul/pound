<?php
require APPROOT . '/views/inc/header.php';
require APPROOT . '/views/inc/navbar.php';
?>
    <div class="content">
        <div class="content_box">
            <div class="men">
                <div class="register">
                    <form>
                        <div class="register-top-grid">
                            <h1>PERSONAL INFORMATION</h1>
                            <div>
                                <span>First Name<label>*</label></span>
                                <input type="text">
                            </div>
                            <div>
                                <span>Last Name<label>*</label></span>
                                <input type="text">
                            </div>
                            <div>
                                <span>Email Address<label>*</label></span>
                                <input type="text">
                            </div>
                            <div class="clearfix"> </div>
                            <a class="news-letter" href="#">
                                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up for Newsletter</label>
                            </a>
                        </div>
                        <div class="register-bottom-grid">
                            <h2>LOGIN INFORMATION</h2>
                            <div>
                                <span>Password<label>*</label></span>
                                <input type="text">
                            </div>
                            <div>
                                <span>Confirm Password<label>*</label></span>
                                <input type="text">
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </form>
                    <div class="clearfix"> </div>
                    <div class="register-but">
                        <form>
                            <input type="submit" value="submit">
                            <div class="clearfix"> </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php require APPROOT . '/views/inc/footer.php'; ?>
        </div>
    </div>