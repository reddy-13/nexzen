<!DOCTYPE html>
<html>
 <?php  $this->load->view("common/common_head"); ?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php  $this->load->view("admin/common/common_header"); ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php  $this->load->view("admin/common/common_sidebar"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Standard
            <small>Manage Standard</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Standard</a></li>
            <li class="active">Manage Standard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
               
                <div class="col-md-12">
                
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header">
                           <p><strong>Add Standard (Ex. 1, 2, 8-A, 11-Arts H.K.G, L.K.G, etc)</strong></p>
                        </div>
                        <div class="box-body">
                        
                            <form role="form" action="" method="post">
                              <div class="box-body">
                              <?php 
                                echo $this->session->flashdata("message");
                               ?>
                                <?php if(isset($error)){
                            echo $error;
                        } ?>
                                <div class="form-group">
                                    <div class="row">
                                   
                                      <div class="col-md-12">
                                        <label for="user_fullname">Standard Name <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="standard_title" name="standard_title" placeholder="Ex. 1, 2, L.K.G, etc" />
                                      </div>
                                   
                                    </div>
                                </div>
                             
                              </div><!-- /.box-body -->
            
                              <div class="box-footer">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                              </div>
                            </form>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-8">
                    <div class="box">
                <div class="box-header">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Standard Name</th>
                        <th>Devoir.tn Link</th>
                        <th width="80">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php foreach($standard as $standardlist){
                    ?>
                    <tr>
                        
                        <td><?php echo $standardlist->standard_id; ?></td>
                        <td><?php echo $standardlist->standard_title; ?></td>
                        <td><?php echo $standardlist->standard_devoir; ?></td>
                        <td>
                            <a href="<?php echo site_url("standard/edit_standard/".$standardlist->standard_id); ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo site_url("standard/delete_standard/".$standardlist->standard_id); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    <?php
                } ?>
                    </tbody>
                </table>
            </div>
        </div>
                    </div>
                </div>
               
                
            </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <?php  $this->load->view("admin/common/common_footer"); ?>  

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/jQuery/jQuery-2.1.4.min.js"); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/bootstrap/js/bootstrap.min.js"); ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/select2/select2.full.min.js"); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/dataTables.bootstrap.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/demo.js"); ?>"></script>
    <script>
      $(function () {
        
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "order": [[ 0, "desc" ]],
          "info": true,
          "autoWidth": false
        });

      });
    </script>
 
    
  </body>
</html>
