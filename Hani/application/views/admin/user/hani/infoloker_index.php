

<!-- Container fluid  -->

<div class="container-fluid">
    
    <!-- Bread crumb and right sidebar toggle -->
    
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Info Loker</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Info loker</a></li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">
            
            
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0"><small>Total Lowongan Kerja</small></h6>
                        <h4 class="m-t-0 text-primary"><?php echo $count->total_loker_accept; ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- End Bread crumb and right sidebar toggle -->
    

    
    <!-- ============================================================== -->
    <!-- Start Page Content -->
	<!-- ============================================================== -->
	<?php $msg = $this->session->flashdata('msg'); ?>
	<?php if (isset($msg)): ?>
		<div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
		</div>
	<?php endif ?>

	<?php $error_msg = $this->session->flashdata('error_msg'); ?>
	<?php if (isset($error_msg)): ?>
		<div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
		</div>
	<?php endif ?>
    <!-- Row -->
    <div class="row">
        <div class="col-12">
            <div id="code1" class="collapse">
                <div class="highlight">
                    <pre>
                    <code><span class="nt">&lt;div</span> <span class="na">class=</span><span class="s">"card"</span> <span class="na">style=</span><span class="s">"width: 20rem;"</span><span class="nt">&gt;</span>
                      <span class="nt">&lt;img</span> <span class="na">class=</span><span class="s">"card-img-top"</span> <span class="na">src=</span><span class="s">"..."</span> <span class="na">alt=</span><span class="s">"Card image cap"</span><span class="nt">&gt;</span>
                      <span class="nt">&lt;div</span> <span class="na">class=</span><span class="s">"card-body"</span><span class="nt">&gt;</span>
                        <span class="nt">&lt;h4</span> <span class="na">class=</span><span class="s">"card-title"</span><span class="nt">&gt;</span>Card title<span class="nt">&lt;/h4&gt;</span>
                        <span class="nt">&lt;p</span> <span class="na">class=</span><span class="s">"card-text"</span><span class="nt">&gt;</span>Some quick example text to build on the card title and make up the bulk of the card's content.<span class="nt">&lt;/p&gt;</span>
                        <span class="nt">&lt;a</span> <span class="na">href=</span><span class="s">"#"</span> <span class="na">class=</span><span class="s">"btn btn-primary"</span><span class="nt">&gt;</span>Go somewhere<span class="nt">&lt;/a&gt;</span>
                      <span class="nt">&lt;/div&gt;</span>
                    <span class="nt">&lt;/div&gt;</span></code>
                </pre>
                </div>
            </div>
            <!-- Row -->
            <div class="row">
			<?php foreach ($info_loker as $loker): ?>
					<!-- column -->
					<div class="col-lg-3 col-md-6 img-responsive">
						<!-- Card -->
						<div class="card card-outline-primary">
							<div class="card-header">
                    			<p class="m-b-0 text-white"><?php echo my_date_show_time($loker['create_date']); ?></p></div>
								<img class="card-img-top img-responsive" src="<?php echo base_url() ?>assets/images/loker/<?php echo $loker['image']; ?>" alt="Card image cap">
							<div class="card-body">
								<h4 class="card-title"><?php echo $loker['text']; ?></h4>
								<p class="card-text"><small class="text-muted">Author - <?php echo $loker['create_by']; ?></small></p>
								<!-- <p style="text-align:right"><a  href="<?php echo $characters->url[$urls]; ?>" class="btn btn-primary">Read More</a></p> -->
							</div>
						</div>
						<!-- Card -->
					</div>
					<!-- column -->
				<?php endforeach ?>				
            </div>
            <!-- Row -->
        </div>
    </div>
    <!-- End Row -->

    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
