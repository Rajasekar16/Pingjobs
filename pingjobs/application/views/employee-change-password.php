<?php echo $header; ?>
    <!-- Begin page content -->
    <div class="container container-home signup-forms">
      <div class="row">
        <div class="col-md-2">
          <img src="images/logos.jpg" />
        </div>
        <div class="col-md-10 box">
          <h2 class="light page-header">Change Password</h2>
            <form class="form-horizontal" method="post" action="/employee/save_password">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <div class="col-md-6">
                  <!-- Text input-->
                  <div class="form-group required">
                    <label class="col-md-5 control-label " for="email">Password</label>  
                    <div class="col-md-7">
                        <input id="password" name="password" type="password" onblura="verify_employer_email(this, this.value)" placeholder="Enter Email Address" class="form-control input-md" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-5 control-label " for="email"></label>  
                    <div class="col-md-7">                    
                      <button type="submit" id="" name="reset" class="btn btn-primary">Save</button>
                    </div>
                  </div>
              </div>
            </form>
        </div>        
      </div>
    </div>
<?php echo $footer; ?>
  </body>
</html>
