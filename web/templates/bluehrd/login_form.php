<form method="POST" class="form">
    <section class="jumbotron text-center jumbotron-slider">
      <div class="center-wrapper">
        <div class="center-wrapper-inner">


          <div class="cover-container">
            <div class="inner">
              <div class="cover">
                <div class="row">
                  <div class="col-md-6 col-md-push-3">
                    <h2 class="sr-only">Dashboard</h2>
                    <div class="well well-lg">
                      <div class="logo">
                        <img src="<?php echo template_img(); ?>/logo.png" class="img-responsive" alt="">
                      </div>
                      <div class="form-group form-group-lg">
                        <label class="control-label" for="username">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php if(isset($sess_login['username'])){ echo $sess_login['username']; } ?>" autofocus required>
                      </div>
                      <div class="form-group form-group-lg">
                        <label class="control-label" for="password">Password</label>
                        <input type="password" class="form-control" name="password" value="<?php if(isset($sess_login['pass'])){ echo $sess_login['pass']; } ?>" required>
                      </div>
                      <div class="form-group form-group-btn">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                              <div class="checkbox">
                                <?php if(isset($sess_login['remember_me']) && $sess_login['remember_me'] == "1"): ?>"
                                <input type="checkbox" id="optinosCheckbox1" name="remember_me" value="1" checked>
                                <?php else: ?>
                                <input type="checkbox" id="optinosCheckbox1" name="remember_me" value="1">
                                <?php endif; ?>
                                <label for="optinosCheckbox1">
                                  Ingat saya
                                </label>
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6 text-right">
                              <input type="submit" class="btn btn-primary" name="submit" type="button" value="Masuk">    
                            </div>
                          </div>
                      </div>
                    <?php if( isset($error) ) { ?> <p class="text-danger text-center"><i class="fa fa-exclamation-triangle"></i> Check your username or email and password.</p> <?php } ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</form>
