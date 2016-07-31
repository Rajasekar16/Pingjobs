<?php echo $header; ?>
    <!-- Begin page content -->
    <div class="container container-home signup-forms">
      <div class="row">
        <div class="col-md-2">
          <img src="images/logos.jpg" />
        </div>
        <div class="col-md-10 box">
          <h2 class="light page-header">Reset Password</h2>
            <form class="form-horizontal" method="post" action="/employee/reset_password">
            <?php if($this->session->flashdata('msg')){ ?>               
        <?php echo $this->session->flashdata("msg"); ?>     
  <?php } ?>

              <div class="col-md-6">        

                  <!-- Text input-->
                  <div class="form-group required">
                    <label class="col-md-5 control-label " for="email">Email</label>  
                    <div class="col-md-7">
                    <input id="email" name="email" type="email" onblura="verify_employer_email(this, this.value)" placeholder="Enter Email Address" class="form-control input-md" required="required">
                    <div id="verify_email" class="errorBox" ></div>
                    <input type="hidden" id="email_available_flag" value="0" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-5 control-label " for="email"></label>  
                    <div class="col-md-7">                    
                      <button type="submit" id="" name="reset" class="btn btn-primary">Submit</button>
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
