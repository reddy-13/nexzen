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
            Edit Homework
            <small>Edit Homework</small>
          </h1>
           
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                <a href="<?php echo site_url("book/manage_book"); ?>" class="btn btn-primary pull-right">Homework List</a>
                </div>
                <div class="col-md-12">
                
                <div class="col-md-7">
                    <div class="box">
                        <div class="box-header">
                           <p><strong>Edit Homework (Ex. Java, Maths, etc)</strong></p>
                        </div>
                        
                        <div class="box-body">
                        
                            <form role="form" action="" method="post" enctype="multipart/form-data">
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
                                        <label for="standard">Standard <span class="red">*</span></label>
                                        <select class="form-control select2" name="standard" id="standard" style="width: 100%;">
                                            <?php foreach($school_standard as $standard){ 
                                                ?>
                                                <option value="<?php echo $standard->standard_id; ?>" <?php if($standard->standard_id == $book->book_standard){echo "selected";} ?>><?php echo $standard->standard_title; ?></option>
                                                <?php
                                            } ?>
                                        </select>
                                       
                                    </div>
                                   
                                      <div class="col-md-12">
                                        <label for="book_title">Homework Title <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="book_title" name="book_title" value="<?php echo $book->book_title; ?>"  />
                                    </div>
                                    <!--  <div class="col-md-12">
                                        <label for="book_author">Book Author <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="book_author" name="book_author" value="<?php //echo $book->book_author; ?>" />
                                    </div> -->
                                    <div class="col-md-12">
                                        <label for="book_description">Homework Description <span class="red">*</span></label>
                                       <textarea rows="5" id="book_description" name="book_description" class="form-control" > <?php echo $book->book_description; ?> </textarea>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                            <label for="thumbnail">ThumbNail Image <span class="red">*</span></label>                                            
                                            <input type="file" class="form-control" id="thumbnail" name="thumbnail"  /> (File should be Image Only) 
                                        </div>
                                        <div class="form-group">
                                         <?php 
                                              if($book->book_thumb!=""){
                                            $img = $this->config->item('base_url')."uploads/book_image/".$book->book_thumb; 
                                            ?><img src="<?php echo $img; ?>" style="height: 80px; width: 80px;"/> 
                                        </div> <?php } ?>
                                   </div> 
                                    <div class="col-md-12">
                                       <div class="form-group">
                                            <label for="uploadfile">Select PDF Homework File <span class="red">*</span></label>                                            
                                           <input type="file" class="form-control" id="uploadfile" name="uploadfile"  /> (File should be PDF Only)
                                            
                                        </div>
                                        <div class="form-group">
                                            <?php echo $book->book_file; ?> 
                                        </div>
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
    <!-- InputMask -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/input-mask/jquery.inputmask.js"); ?>"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/input-mask/jquery.inputmask.date.extensions.js"); ?>"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/input-mask/jquery.inputmask.extensions.js"); ?>"></script>
    <!-- bootstrap time picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/daterangepicker/daterangepicker.js"); ?>"></script>
   
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/timepicker/bootstrap-timepicker.min.js"); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/dataTables.bootstrap.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/demo.js"); ?>"></script>
    <script>
      $(function () {
        
         $("[data-mask]").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
        $(".timepicker").timepicker({
          showInputs: false
        });
        
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
  <script>
    $(function(){
       $(".select2").select2();
    });
    </script>
    
  </body>
</html>
