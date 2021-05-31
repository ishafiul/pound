<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>Create An Account</h2>
        <p>Please fill out this form to register with us</p>
        <form action="<?php /*echo URLROOT; */?>/users/register" method="post">
          <div class="form-group">
            <label for="name">Name: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php /*echo (!empty($data['name_err'])) ? 'is-invalid' : ''; */?>" value="<?php /*echo $data['name']; */?>">
            <span class="invalid-feedback"><?php /*echo $data['name_err']; */?></span>
          </div>
            <div class="form-group">
                <label for="username">Name: <sup>*</sup></label>
                <input type="text" name="username" class="form-control form-control-lg <?php /*echo (!empty($data['username_err'])) ? 'is-invalid' : ''; */?>" value="<?php /*echo $data['username']; */?>">
                <span class="invalid-feedback"><?php /*echo $data['username_err']; */?></span>
            </div>
          <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg <?php /*echo (!empty($data['email_err'])) ? 'is-invalid' : ''; */?>" value="<?php /*echo $data['email']; */?>">
            <span class="invalid-feedback"><?php /*echo $data['email_err']; */?></span>
          </div>
          <div class="form-group">
            <label for="password">Password: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php /*echo (!empty($data['password_err'])) ? 'is-invalid' : ''; */?>" value="<?php /*echo $data['password']; */?>">
            <span class="invalid-feedback"><?php /*echo $data['password_err']; */?></span>
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirm Password: <sup>*</sup></label>
            <input type="password" name="confirm_password" class="form-control form-control-lg <?php /*echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; */?>" value="<?php /*echo $data['confirm_password']; */?>">
            <span class="invalid-feedback"><?php /*echo $data['confirm_password_err']; */?></span>
          </div>

          <div class="row">
            <div class="col">
              <input type="submit" value="Register" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php /*echo URLROOT; */?>/users/login" class="btn btn-light btn-block">Have an account? Login</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>-->
<div class="wrap">
    <div class="container">
        <div class="content">
            <?php require APPROOT . '/views/inc/navbar.php'; ?>
            <div class="content_box">
                <div class="men">
                    <div class="register">
                        <form action="<?php echo URLROOT;?>/users/register" method="post">
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
    </div>
</div>