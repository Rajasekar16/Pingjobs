<?php echo $header; ?>
    <!-- Begin page content -->
    <!-- Tag select reference http://timschlechter.github.io/bootstrap-tagsinput/examples/ -->
       <header class="ping-header">
       <div class="ping-search-fprm container">
         <div class="form-group">
         <div class="col-md-1 pad-ltrt-2">
            </div>
            <div class="col-md-3 pad-ltrt-2">
              <input id="textinput" name="textinput" type="text" placeholder="Enter Key Skills
              " class="form-control input-md">              
            </div>
            <div class="col-md-1 pad-ltrt-2">
              <select id="selectbasic" name="selectbasic" class="form-control">
                <option value="1">Location</option>
                <option value="2">Option two</option>
              </select>
            </div>
            <div class="col-md-1 pad-ltrt-2">
              <select id="selectbasic" name="selectbasic" class="form-control">
                <option value="1">Experience</option>
                <option value="2">Option two</option>
              </select>
            </div>
            
            <div class="col-md-1 pad-ltrt-2">
            <a class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Search</a>
            </div>
          </div>
       </div>
      </header>
    <div class="container container-home signup-forms">
      <div class="row">
        <div class="col-md-2">
          <img src="images/logos.jpg" />
        </div>
        <div class="col-md-10 box">
          <h2 class="light page-header">Post Job</h2>


            <form class="form-horizontal">
              <div class="col-md-6">
                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">Job title/ Description</label>  
                    <div class="col-md-8">
                    <input id="textinput" name="textinput" type="text" data-role="tagsinput" placeholder="Enter Job Description" class="form-control input-md" required="">
                      
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">Job Description</label>  
                    <div class="col-md-8">
                    <textarea class="form-control input-md" placeholder="Enter Job Description" id="textarea" name="textarea"></textarea>
                      
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="keyskills">Key Skills</label>  
                    <div class="col-md-8">
                    <input id="keyskills" name="textinput" type="text" data-role="tagsinput" placeholder="Key Skills" class="form-control input-md" required="">
                    </div>
                  </div>

                  <!-- Select Basic -->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="selectbasic">Job Industry</label>
                    <div class="col-md-8">
                      <select id="selectbasic" name="selectbasic" class="form-control">
                        <option value="1">Select Industry</option>
                        <option value="2">Option two</option>
                      </select>
                    </div>
                  </div>

                  <!-- Select Basic -->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="selectbasic">Functional</label>
                    <div class="col-md-8">
                      <select id="selectbasic" name="selectbasic" class="form-control">
                        <option value="1">Select Functional</option>
                        <option value="2">Option two</option>
                      </select>
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">Experience</label>  
                    <div class="col-md-3">
                    <input id="textinput" name="textinput" type="text" placeholder="Min Exp" class="form-control input-md" required="">
                    </div>
                    <label class="col-md-2 control-label" for="textinput">To</label>
                    <div class="col-md-3">
                    <input id="textinput" name="textinput" type="text" placeholder="Max Exp" class="form-control input-md" required="">
                    </div>
                  </div>

              </div>

              <div class="col-md-6">

                <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">Salary</label>  
                    <div class="col-md-3">
                    <input id="textinput" name="textinput" type="text" placeholder="Min Anual" class="form-control input-md" required="">
                    </div>
                    <label class="col-md-2 control-label" for="textinput">To</label>
                    <div class="col-md-3">
                    <input id="textinput" name="textinput" type="text" placeholder="Max Anual" class="form-control input-md" required="">
                    </div>
                  </div>

                 <div class="form-group">
                    <label class="col-md-4 control-label" for="radios">No of Postitions</label>
                    <div class="col-md-8"> 
                      <input id="textinput" name="textinput" type="text" placeholder="No of Postitions" class="form-control input-md" required="">
                    </div>
                  </div>

                  <!-- Select Basic -->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="selectbasic">Gender Preference</label>
                    <div class="col-md-8">
                      <select id="selectbasic" name="selectbasic" class="form-control">
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                        <option value="2">Any</option>
                      </select>
                    </div>
                  </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="textinput">Job Location/ State</label>  
                  <div class="col-md-8">
                    <select id="selectbasic" name="selectbasic" class="form-control">
                      <option value="1">Select State</option>
                      <option value="2">Option two</option>
                    </select>
                  </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="selectbasic">Country</label>
                  <div class="col-md-8">
                    <select id="selectbasic" name="selectbasic" class="form-control">
                      <option value="1">Select Country</option>
                      <option value="2">Option two</option>
                    </select>
                  </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="selectbasic">No of Employers</label>
                  <div class="col-md-8">
                    <select id="selectbasic" name="selectbasic" class="form-control">
                      <option value="1">Select Size</option>
                      <option value="2">5 - 10</option>
                      <option value="2">10 - 25</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-12">
                  <div>
                    <div class="col-md-2"></div>  
                    <input type="checkbox" name="terms" id="terms" value="2"> We agree to the <a>Terms of Use</a> & <a>Privacy Policy</a>
                  </div>
              </div>

              </div>

              <div class="clearfix"></div>
              <div class="form-group">
                <div class="col-md-12 text-center">
                  <button id="button1id" name="button1id" class="btn btn-default">Cancel</button>
                  <button id="button2id" name="button2id" class="btn btn-primary">Post Job</button>
                </div>
              </div>
            </form>



        </div>
        
      </div>
    </div>

<?php echo $footer; ?>
<script type="text/javascript">
$(document).ready(function(){

  $('#keyskills').tagsinput({
    maxTags: 5
  });

});

</script>

  </body>
</html>
