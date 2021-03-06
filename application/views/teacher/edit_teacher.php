
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
            Update Teacher
            <small>Manage Teacher</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Teacher</a></li>
            <li class="active">Update Teacher</li>
          </ol>
        </section>
        <?php 
            // echo "<pre>";
            // print_r($teacher);
            // exit;
         ?>

        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                <a href="<?php echo site_url("teacher/id_card"); ?>" class="btn btn-primary ">Generate ID</a>
                <a href="<?php echo site_url("teacher/list_teacher"); ?>" class="btn btn-primary pull-right">List</a>
                </div>
                <div class="col-md-12">
                     
                            <form role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="box">
                        <div class="box-header">
                           
                        </div>
                        <div class="box-body">
                        
                            
                              <div class="box-body">
                              <?php 
                                echo $this->session->flashdata("message");
                               ?>
                                <? if(isset($error)){
                            echo $error;
                        } ?>
                        
                                
                        
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-12">
                                    <p style="border-bottom: 1px solid black;"><strong>Teacher Detail</strong> (Please Fill * all Required Field)</p>
                                    </div>
                                   <h4 class="box-title">General Information</h4>
                                   <div class="form-group">                                  
                

                                    
                                   
                                      <div class="col-md-6">
                                        <label for="teacher_name">Teacher Name <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="teacher_name" name="teacher_name" value="<?php echo $teacher->teacher_name; ?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="teacher_birthdate">Teacher Birthdate <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="teacher_birthdate" name="teacher_birthdate" placeholder="Show Date" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask value="<?php echo $teacher->teacher_birthdate; ?>">
                                    </div>
                                     <div class="col-md-6">
                                     <label>Gender :</label>
                                      <div class="radio">
                                        <label>
                                          <input type="radio" <?php if($teacher->gender=="male"){echo "checked";} ?> value="male" id="" name="gender" />
                                          Male
                                        </label>
                                        <label>
                                          <input type="radio" <?php if($teacher->gender=="female"){echo "checked";} ?>  value="female" id="" name="gender" />
                                          FeMale
                                        </label>
                                      </div>
                                       
                                    </div>
                                    <div class="col-md-6">
                                     <label>Marital Status</label>
                                      <div class="radio">
                                        <label>
                                          <input type="radio" <?php if($teacher->maritalstatus=="single"){echo "checked";} ?>  value="single" id="" name="maritalstatus" />
                                          Single
                                        </label>
                                        <label>
                                          <input type="radio" <?php if($teacher->maritalstatus=="married"){echo "checked";} ?> value="married" id="" name="maritalstatus" />
                                          Married
                                        </label>
                                      </div>
                                       
                                    </div>
                                     <div class="col-md-6">
                                    <label for="teacher_blood_group">Blood Group</label>
                                        <input type="text" class="form-control" id="teacher_blood_group"
                                        name="teacher_blood_group"
                                        placeholder="e.g B+"
                                        value="<?php if (isset($teacher->teacher_blood_group)) {
                                          echo $teacher->teacher_blood_group;
                                      } ?>" />
                                  </div>
                                 
                                     <div class="col-md-6">
                                        <label for="teacher_address">Teacher Address <span class="red">*</span></label>
                                       <textarea rows="2" id="teacher_address" name="teacher_address" class="form-control"><?php echo $teacher->teacher_address; ?></textarea>
                                    </div>
                                    
                                     <div class="col-md-6">
                                        <label for="teacher_phone">Teacher Phone  <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="teacher_phone" name="teacher_phone" value="<?php echo $teacher->teacher_phone; ?>"/>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="teacher_email">Teacher Email  </label>
                                        <input type="email" class="form-control" id="teacher_email" name="teacher_email" placeholder="teachet@gmail.com" value="<?php echo $teacher->teacher_email; ?>"/>
                                    </div>
                                    
                                 
                                     <div class="col-md-6">
                                        <label for="teacher_photo">Teacher Photo </label>
                                        <input type="file" class="form-control" id="teacher_photo" name="teacher_photo" />
                                    </div>
                                <?php if(isset($teacher->teacher_image) && $teacher->teacher_image!=""){ ?>
                                     <div class="col-md-12" >
                                        <label for="" class="pull-right">Teacher Photo </label>
                                      <?php
                                            $img = $this->config->item('base_url')."uploads/teacherphoto/".$teacher->teacher_image; ?>                                 
                                            <img src="<?php echo $img; ?>" style="height: 50px; width: 50px; margin-top: 10px;" class="pull-right"/>
                                    </div>
                                    <?php } ?>
                                    
                                    
                                    </div>
                                </div>
                              
                              </div><!-- /.box-body -->
              
                        </div>
                    </div>
                     <div class="box">
                        <div class="box-header">
                           
                        </div>
                        <div class="box-body">
                           
                              <div class="box-body">
                        
                                 <div class="form-group">
                                    <div class="row">
                                   
                                   <h4 class="box-title">Education Information</h4>
                                    
                               
                                     <div class="col-md-6">
                                        <label for="teacher_exp">Teaching Experience  </label>
                                        <input type="text" class="form-control" id="teacher_exp" name="teacher_exp" placeholder="Ex. 1 year 6 month, 6 month, 4 year, ect" value="<?php echo $teacher->teacher_exp; ?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="teacher_education">Teacher Education  <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="teacher_education" name="teacher_education" placeholder="Ex. M.A., B.Ed, Phd, P.T.C, Etc" value="<?php echo $teacher->teacher_education; ?>"/>
                                    </div>
                                  
                                    <div class="col-md-6">
                                        <label for="teacher_notes">Extra Notes </label>
                                       <textarea rows="2" id="teacher_notes" name="teacher_notes" placeholder="extra activity, extra archivement, award, etc" class="form-control"><?php echo $teacher->teacher_notes; ?></textarea>
                                    </div>
                                      <div class="col-md-12">
                                      <label for="teacher_detail">Teacher Detail <span class="red">*</span> </label>
                                      <br /><label>Note <span class="red">*</span>: Teacher Standard, Teacher Subject, Teacher All Detail, Etc</label>
                                         <textarea id="editor1" name="editor1" rows="10" cols="80" >
                                          <?php echo $teacher->teacher_detail; ?>
                                        </textarea>
                                    </div>
                                    
                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                            <div class="col-md-6">
                                                <label for="teacher">Update Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" value="<?php echo $password;?>">
                                            </div>
                                        </div>
                                </div>

                              
                              </div><!-- /.box-body -->
            
                              <div class="box-footer">
                                <button type="submit" name="saveteacher" class="btn btn-primary">Save Data</button>
                              </div>
                            </form>
                        </div>
                    </div>
             
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <?php  $this->load->view("admin/common/common_footer"); ?>  

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

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
<script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/ckeditor/ckeditor.js"); ?>"></script>
    <script>
    $(function(){
       $(".select2").select2();
    });
    </script>
    
     <script>
      $(function () {
        
         $("[data-mask]").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
        $(".timepicker").timepicker({
          showInputs: false
        });
    
      });
    </script>
         <script>
      $(function () {
       
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script> 
  </body>
</html>
