<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Unika News</h3>
        </div>
        <div class="col-md-7 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <!-- <div class="">
                    <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
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
				<?php
					$url = 'https://haniapi.mooo.com/unikanews'; // path to your JSON file
					$data = file_get_contents($url); // put the contents of the file into a variable
					$characters = json_decode($data); // decode the JSON feed
				?>
				<?php foreach ($characters->url as $urls => $index): ?>
					<!-- column -->
					<div class="col-lg-3 col-md-6 img-responsive">
						<!-- Card -->
						<div class="card card-outline-primary">
							<div class="card-header">
                    			<p class="m-b-0 text-white"><?php echo $characters->date[$urls]; ?></p></div>
								<img class="card-img-top img-responsive" src="<?php echo base_url() ?>assets/images/lowongan/unikanews/<?php echo $characters->images[$urls]; ?>" alt="Card image cap">
							<div class="card-body">
								<h4 class="card-title"><?php echo $characters->judul[$urls]; ?></h4>
								<p class="card-text"><small class="text-muted"><?php echo $characters->desc[$urls]; ?></small></p>
								<p style="text-align:right"><a  href="<?php echo $characters->url[$urls]; ?>" class="btn btn-primary">Read More</a></p>
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
