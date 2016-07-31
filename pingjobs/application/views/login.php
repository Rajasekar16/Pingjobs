<?php echo $header; ?>
    <!-- Begin page content -->
	<div class="container container-home home-cats">
		<div class="row">
			<div class="col-md-2 pad-ltrt-0 home-margin">
			  <h3>Jobs by Location</h3>
				<div class="box">
				  <ul>
					<?php foreach($location as $row) { ?>
						<li>
							<a href="<?php echo base_url(); ?>job/jobsearch/jobs-in-<?php echo strtolower($row['name']);?>/<?php echo $row['id'];?>">
								Jobs in <?php echo ucfirst($row['name']);?>
							</a>
						</li>
					<?php } ?>
				  </ul>
				</div>
			</div>
			<div class="col-md-6">
			</div>
			<div class="col-md-3">
			</div>
		</div>
	</div>
    <!--<div class="container container-home home-cats">
      <div class="row">
		<div class="col-md-1">
			&nbsp;
		</div>
		<div class="col-md-4 home-margin">
          <h3><center>Experience jobs</center></h3>
		</div>
		<div class="col-md-1">
			&nbsp;
		</div>
		<div class="col-md-4 home-margin">
          <h3><center>Freshers jobs</center></h3>
		</div>
		<div class="col-md-1">
			&nbsp;
		</div>
	  </div>
      <br/>
      <div class="row">
        <div class="col-md-1">&nbsp;
          <img src="images/logos.jpg" />
        </div>
        <div class="col-md-2 pad-ltrt-0 home-margin">
          <h3>Jobs by Location</h3>
            <div class="box">
              <ul>
			    <?php foreach($location as $row) { ?>
					<li><a href="<?php echo base_url(); ?>job/jobsearch/jobs-in-<?php echo strtolower($row['name']);?>/<?php echo $row['id'];?>">Jobs in <?php echo ucfirst($row['name']);?></a></li>
                <?php } ?>
              </ul>
          </div>
        </div>
        <div class="col-md-2 pad-ltrt-0 home-margin">
          <h3>Jobs by Category</h3>
          <div class="box">
            <ul>
				<?php foreach($industry as $row) { ?>
					<li><a href="<?php echo base_url(); ?>job/jobsearch/category-by-<?php echo $row['name'];?>/<?php echo $row['id'];?>"><?php echo ucfirst($row['name']);?></a></li>
                <?php } ?>
            </ul>
          </div>
        </div>
        <div class="col-md-2 pad-ltrt-0 home-margin">
          <h3>Jobs by Location</h3>
            <div class="box">
              <ul>
                <?php foreach($location as $row) { ?>
					<li><a href="<?php echo base_url(); ?>job/jobsearch/jobs-in-<?php echo strtolower($row['name']);?>/<?php echo $row['id'];?>">Jobs in <?php echo ucfirst($row['name']);?></a></li>
                <?php } ?>
              </ul>
          </div>
        </div>
        <div class="col-md-2 pad-ltrt-0 home-margin">
          <h3>Jobs by Category</h3>
          <div class="box">
            <ul>
				<?php foreach($industry as $row) { ?>
					<li><a href="<?php echo base_url(); ?>job/jobsearch/category-by-<?php echo $row['name'];?>/<?php echo $row['id'];?>"><?php echo ucfirst($row['name']);?></a></li>
                <?php } ?>
            </ul>
          </div>
        </div>
        <div class="col-md-1">&nbsp;
          <img src="images/logos.jpg" />
        </div>
      </div>
    </div>-->

<?php echo $footer; ?>
  </body>
</html>
