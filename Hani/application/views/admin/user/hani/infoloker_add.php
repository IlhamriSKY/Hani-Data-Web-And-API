

<!-- Container fluid  -->

<div class="container-fluid">
    
    <!-- Bread crumb and right sidebar toggle -->
    
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Info Loker</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Info Loker</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </div>
        
    </div>
    
    <!-- End Bread crumb and right sidebar toggle -->
    

    
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

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

			<div style="color: red;"><?php echo (isset($message))? $message : ""; ?></div>
            
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Add <a href="<?php echo base_url('admin/infoloker/') ?>" class="btn btn-info pull-right"><i class="fa fa-list"></i> Info Loker List </a></h4>

                </div>
                <div class="card-body">
					<div class="form-body">
                            <br>

							<?php echo form_open("admin/infoloker/add", array('enctype'=>'multipart/form-data')); ?>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Title <span class="text-danger">*</span></label>
                                        <div class="col-md-9 controls">
                                            <input type="text" name="input_deskripsi" value="<?php echo set_value('input_deskripsi'); ?>" class="form-control" required data-validation-required-message="Title is required">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">Image <span class="text-danger">*</span></label>
                                        <div class="col-md-9 controls">
                                            <input type="file" name="input_gambar" class="form-control" required data-validation-required-message="Image is required">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
							

                            <!-- CSRF token -->
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />

                            
                            <hr>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3"></label>
                                        <div class="controls">
                                            <Input type="submit" name="submit" value="Simpan Loker" class="btn btn-success">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
	<?php echo form_close(); ?>

    <!-- End Page Content -->

</div>
