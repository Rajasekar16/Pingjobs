<?php echo $header; ?>
    <!-- Begin page content -->
    <div class="container container-home signup-forms">
      <div class="row">
        <div class="col-md-2">
          <img src="images/logos.jpg" />
        </div>
        <div class="col-md-10 box">
          <h2 class="light page-header">Reset Password</h2>
            <form class="form-horizontal" method="post"  id ="reset_password" onsubmit="return emplyee_resetpassword()"  >
              <div class="col-md-6">
               <div class="alert alert-success" style="display:none" >
              
              </div>

              <div class="alert alert-danger" style="display:none" >
              <strong>Error!</strong> The email/username and password you entered don't match .
              </div>
                                <!-- Text input-->
                  <div class="form-group required">
                  

                    <label class="col-md-5 control-label " for="email">Email</label>  
                    <div class="col-md-7">
                    <input id="employer_reset_email" name="email" type="email" onblura="verify_employer_email(this, this.value)" placeholder="Enter Email Address" class="form-control input-md" required="required">
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

  <script type="text/javascript">
    gBaseUrl = "<?php echo base_url(); ?>";  
    function emplyee_resetpassword()
    {
      if($('#employer_reset_email').val() != '')
      {
      $.ajax({
        url: gBaseUrl+'/employer/reset_password_update',
        type: 'POST',
        data:$('#reset_password').serialize(),
        dataType: 'json',
        success: function(response){
          if(response.status == 'ok')
          {             
            $('.alert-success').html(response.msg).show();
             setTimeout(function(){
              $('.alert-success').hide();
            }, 3000);
          }
          else
          {
            $('.alert-danger').html(response.msg).show();
            setTimeout(function(){
              $('.alert-danger').hide();
            }, 3000);
          }
        },
        error: function(res){
        }
      });
      return false;
    }
    }
    </script>


</html>
