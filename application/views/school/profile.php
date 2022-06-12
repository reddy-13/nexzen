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
            School Profile
            <small>Manage Profile</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> School</a></li>
            <li class="active">School Profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
              
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                           
                        </div>
                        <div class="box-body">
                        <?php
                                $attributes = ['role' => 'form', 'class' => 'form']; 
                                echo form_open_multipart('',$attributes);
                                ?>
                            <!-- <form role="form" action="" method="post" enctype="multipart/form-data"> -->
                              <div class="box-body">
                              <?php 
                                  if($message = $this->session->flashdata("message")){
                                    echo $message;
                                }
                                ?>
                                <?php if(isset($error)){
                                    echo $error;
                                } ?>


                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-12">
                                    <p style="border-bottom: 1px solid black;"><strong>School Detail</strong></p>
                                    </div>
                                      <div class="col-md-6">
                                        <label for="user_fullname">School Name <span class="red">*</span></label>
                                       <?php
                                               
                                                echo form_input(['name' => 'school_name',
                                                        'class' => 'form-control',
                                                        'id' => 'school_name',
                                                        'placeholder' => 'Shool Name',
                                                        'value' => set_value('school_name',$schooldetail->school_name)]);
                                            ?>
                                            <?php echo form_error('school_name', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="user_fullname">School Person Name <span class="red">*</span></label>
                                        <?php
                                               
                                                echo form_input(['name' => 'school_person_name',
                                                        'class' => 'form-control',
                                                        'id' => 'school_person_name',
                                                        'placeholder' => 'School Person Name',
                                                        'value' => set_value('school_person_name',$schooldetail->school_person_name)]);
                                            ?>
                                            <?php echo form_error('school_person_name', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                    </div>
                                      <div class="col-md-6">
                                        <label for="user_fullname">School Address <span class="red">*</span></label>
                                        <?php
                                               
                                                echo form_input(['name' => 'school_address',
                                                        'class' => 'form-control',
                                                        'id' => 'school_address',
                                                        'placeholder' => 'Student Address',
                                                        'value' => set_value('school_address', $schooldetail->school_address)]);
                                            ?>
                                            <?php echo form_error('school_address', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        
                                      
                                        <label for="user_fullname">School Machine ID <span class="red">*</span> <span style="display:none;" id="m_loader" ><img src="<?php echo $this->config->item('base_url').'/images/loader.gif'.''; ?>"  width="10" height="10"></span></label>

                                        <?php
                                               
                                                echo form_input(['name' => 'punch_machine_id',
                                                        'class' => 'form-control',
                                                        'id' => 'punch_machine_id',
                                                        'placeholder' => 'School Machine ID',
                                                        'value' => set_value('punch_machine_id',$schooldetail->punch_machine_id)]);
                                            ?>
                                            <?php echo form_error('punch_machine_id', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="user_fullname">City Name <span class="red">*</span></label>
                                        <?php
                                               
                                                echo form_input(['name' => 'school_city',
                                                        'class' => 'form-control',
                                                        'id' => 'school_city',
                                                        'placeholder' => 'City',
                                                        'value' => set_value('school_city',$schooldetail->school_city)]);
                                            ?>
                                            <?php echo form_error('school_city', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="user_fullname">State Name</label>
                                        <?php
                                               
                                                echo form_input(['name' => 'school_state',
                                                        'class' => 'form-control',
                                                        'id' => 'school_state',
                                                        'placeholder' => 'State',
                                                        'value' => set_value('school_state',$schooldetail->school_state)]);
                                            ?>
                                            <?php echo form_error('school_state', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="user_fullname">Postal code or Pincode</label>
                                        <?php
                                               
                                                echo form_input(['name' => 'school_postal_code',
                                                        'class' => 'form-control',
                                                        'id' => 'school_postal_code',
                                                        'placeholder' => 'PIN',
                                                        'value' => set_value('school_postal_code',$schooldetail->school_postal_code)]);
                                            ?>
                                            <?php echo form_error('school_postal_code', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="user_fullname">Primary Mobile number <span class="red">*</span></label>
                                       <?php
                                               
                                                echo form_input(['name' => 'school_phone1',
                                                        'class' => 'form-control',
                                                        'id' => 'school_phone1',
                                                        'placeholder' => 'Primary Phone',
                                                        'value' => set_value('school_phone1',$schooldetail->school_phone1)]);
                                            ?>
                                            <?php echo form_error('school_phone1', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                      </div>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="user_fullname">Secondary Mobile number</label>
                                        <?php
                                               
                                                echo form_input(['name' => 'school_phone2',
                                                        'class' => 'form-control',
                                                        'id' => 'school_phone2',
                                                        'placeholder' => 'Secondary Phone',
                                                        'value' => set_value('school_phone2',$schooldetail->school_phone2)]);
                                            ?>
                                            <?php echo form_error('school_phone2', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                    </div>
                                     <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="user_fullname">School Email <span class="red">*</span> <span class="geen" id="email_msg"></span> </label>
                                        <?php
                                               
                                                echo form_input(['name' => 'school_email',
                                                        'class' => 'form-control',
                                                        'id' => 'school_email',
                                                        'placeholder' => 'Email',
                                                        'value' => set_value('school_email',$schooldetail->school_email)]);
                                            ?>
                                            <?php echo form_error('school_email', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="user_fullname">School Fax No </label>
                                        <?php
                                               
                                                echo form_input(['name' => 'school_fax',
                                                        'class' => 'form-control',
                                                        'id' => 'school_fax',
                                                        'placeholder' => 'School Fax no',
                                                        'value' => set_value('school_fax',$schooldetail->school_fax)]);
                                            ?>
                                            <?php echo form_error('school_fax', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                    </div>
                                     <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="user_fullname">School Logo  <span id="img-msg"></span></label>
                                        <input type="file" class="form-control" id="school_logo" onchange="validateImage()"  name="school_logo" />
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="user_fullname">School Facebook Page Link </label>
                                        <?php
                                               
                                                echo form_input(['name' => 'school_facebook',
                                                        'class' => 'form-control',
                                                        'id' => 'school_facebook',
                                                        'placeholder' => 'Facebook link',
                                                        'value' => set_value('school_facebook',$schooldetail->school_facebook)]);
                                            ?>
                                            <?php echo form_error('school_facebook', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                    </div>
                                    <?php if(isset($schooldetail->school_logo) && $schooldetail->school_logo!=""){ ?>
                                     <div class="col-md-6">
                                        <label for="user_fullname">Your School Logo </label>
                                      <?php
                                            $img = $this->config->item('base_url')."/uploads/profile/".$schooldetail->school_logo; ?>                                 
                                            <img src="<?php echo $img; ?>"  style="height: 50px; width: 50px; margin-top: 10px;"/>
                                    </div>
                                    <?php } ?>
                                    
                                    
                                    
                                    </div>
                                </div>
                              
                              </div><!-- /.box-body -->
            
                              <div class="box-footer">
                                <button type="submit" name="saveprofile" class="btn btn-primary">Update Profile</button>
                              </div>
                            </form>
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
          "info": true,
          "autoWidth": false
        });

      });
    </script>
    <script>
      // $(function(){
      //   $('#m_loader').hide();
      // });

    $(function(){
       $(".select2").select2();
    });

    // for chaking machine id 
    $("#school_email").keyup(function(){
      var regexp = /^[a-zA-Z0-9._]+@[a-zA-Z0-9._]+\.[a-zA-Z]{2,4}$/;
      if(regexp.test($('#school_email').val())){
        var school_email = $('#school_email').val()
        $('#school_email').closest('.form-group').removeClass('has-error');
        $.ajax({
                url: '<?php echo site_url("check/check_school_email"); ?>',
                method:'POST',
                data: {school_email:school_email},
                beforeSend: function () {
                  $('#e_loader').show();
                },
                success:function(res) {
                  if(res.status == 1){
                    $('#school_email').closest('.form-group').removeClass('has-error');
                      $('#school_email').closest('.form-group').addClass('has-success');
                      $('#email_msg').html(res.msg);
                  }else if(res.status == 0 ){
                    $('#email_msg').html(res.msg);
                    $('#school_email').closest('.form-group').addClass('has-error');

                  }
                },
                complete:function(){
                  $('#e_loader').hide();
                }
              });
        }else
        { 
            $('#email_msg').html('<p>Invalid email</p>');
            $('#school_email').closest('.form-group').addClass('has-error'); 
        }
    })
// // end of email id checking .....



//validating phone1 number
          $("#school_phone1").keyup(function(){
            var regexp = /^[0-9]{10}$/;
            if(regexp.test($('#school_phone1').val())){
              $('#school_phone1').closest('.form-group').removeClass('has-error');
              $('#school_phone1').closest('.form-group').addClass('has-success');
            }else
            { 
              $('#school_phone1').closest('.form-group').addClass('has-error'); 
            }
          })

          // end of phone 11 chekcing

    // checking for punch machine id id

      $('#punch_machine_id').keyup(function() {
            var machine_id = $('#punch_machine_id').val();
            if(machine_id > 0 ){
              $.ajax({
                url: '<?php echo site_url("check/check_machine_id"); ?>',
                method:'POST',
                data: {punch_machine_id:machine_id},
                beforeSend: function () {
                  $('#m_loader').show();
                },
                success:function(res) {
                  if(res.status == 1){
                      $('#punch_machine_id').closest('.form-group').addClass('has-success');
                  }else if(res.status == 0 ){
                    $('#punch_machine_id').closest('.form-group').addClass('has-error');
                  }
                },
                complete:function(){
                  $('#m_loader').hide();
                }
              });
            }else if(machine_id == 0 ){
              $('#punch_machine_id').closest('.form-group').removeClass('has-error');
              $('#punch_machine_id').closest('.form-group').removeClass('has-success');
            }
      })
    </script>
    <script type="text/javascript">
function validateImage() {
    var formData = new FormData();
 
    var file = document.getElementById("school_logo").files[0];
 
    formData.append("Filedata", file);
    var t = file.type.split('/').pop().toLowerCase();
    if (t != "jpeg" && t != "jpg" && t != "png") {
      $('#img-msg').html('<p>Please select a valid image file JPG, JPEG or PNG </p>');
      $('#school_logo').closest('.form-group').addClass('has-error');
      $('#school_logo').closest('.form-group').removeClass('has-success');
        // alert('Please select a valid image file');
        document.getElementById("school_logo").value = '';
        return false;
    }
    if (file.size > 1024000) {
        // alert('Max Upload size is 1MB only');
      $('#img-msg').html('<p>Max Upload size is 1MB only</p>');
      $('#school_logo').closest('.form-group').addClass('has-error');
      $('#school_logo').closest('.form-group').removeClass('has-success');
        document.getElementById("school_logo").value = '';
        return false;
    }
      $('#school_logo').closest('.form-group').removeClass('has-error');
      $('#school_logo').closest('.form-group').addClass('has-success');
    return true;
}
</script>
  </body>
</html>
