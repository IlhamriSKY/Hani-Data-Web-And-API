

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
                        <h6 class="m-b-0"><small>Accept Loker</small></h6>
                        <h4 class="m-t-0 text-info"><?php echo $count->total_loker_accept; ?></h4>
                    </div>
                </div>
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0"><small>Pending Loker</small></h6>
                        <h4 class="m-t-0 text-primary"><?php echo $count->total_loker_pending; ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- End Bread crumb and right sidebar toggle -->
    

    
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-12">

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

            <div class="card">

                <div class="card-body">

                <?php if ($this->session->userdata('role') == 'admin'): ?>
                    <a href="<?php echo base_url('admin/infoloker/add') ?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Loker</a> &nbsp;
                <?php else: ?>
                    <!-- check logged user role permissions -->

                    <?php if(check_power(1)):?>
                        <a href="<?php echo base_url('admin/infoloker/add') ?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Loker</a>
                    <?php endif; ?>
                <?php endif ?>
                

                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Create</th>
                                    <th>Update</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            <?php foreach ($info_loker as $loker): ?>
                                
                                <tr>
									<td><?php echo $loker['no']; ?></td>
                                    <td><?php echo $loker['create_by']?></td>
                                    <td><?php echo $loker['text']; ?></td>
                                    <td><img class="card-img-top img-responsive" src="<?php echo base_url() ?>assets/images/loker/<?php echo $loker['image']; ?>" alt="Card image cap"></td>
                                    <td>
                                        <?php if ($loker['status'] == "accept"): ?>
                                            <div class="label label-table label-danger">Accept</div>
                                        <?php else: ?>
                                            <div class="label label-table label-success">Pending</div>
                                        <?php endif ?>
                                    </td>
									<td><?php echo my_date_show_time($loker['create_date']); ?></td>
									<td><?php echo my_date_show_time($loker['update_date']); ?></td>
                                    <td class="text-nowrap">

                                        <?php if ($this->session->userdata('role') == 'admin'): ?>
                                            <a id="delete" data-toggle="modal" data-target="#confirm_delete_<?php echo $loker['no'];?>" href="#"  data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-trash text-danger m-r-10"></i> </a>

                                            <?php if ($loker['status'] == "accept"): ?>
                                            <a href="<?php echo base_url('admin/infoloker/deactive/'.$loker['no']) ?>" data-toggle="tooltip" data-original-title="Deactive"> <i class="fa fa-close text-danger m-r-10"></i> </a>
                                            <?php else: ?>
                                                <a href="<?php echo base_url('admin/infoloker/active/'.$loker['no']) ?>" data-toggle="tooltip" data-original-title="Active"> <i class="fa fa-check text-info m-r-10"></i> </a>
                                            <?php endif ?>
                                        <?php else: ?>

                                            <!-- check logged user role permissions -->
                                            <?php if(check_power(2)):?>

                                            <?php endif; ?>
                                            <?php if(check_power(3)):?>
                                            <a id="delete" data-toggle="modal" data-target="#confirm_delete_<?php echo $loker['no'];?>" href="#"  data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-trash text-danger m-r-10"></i> </a>
                                            <?php endif; ?>

                                        <?php endif ?>
                                    </td>
                                </tr>

                            <?php endforeach ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Page Content -->

</div>



<?php foreach ($info_loker as $loker): ?>
 
<div class="modal fade" id="confirm_delete_<?php echo $loker['no'];?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       
            <div class="form-body">
                
                Are you sure want to delete? <br> <hr>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="<?php echo base_url('admin/infoloker/delete/'.$loker['no']) ?>" class="btn btn-danger"> Delete</a>
                
            </div>

      </div>


    </div>
  </div>
</div>


<?php endforeach ?>
