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
                        
                            <form role="form" action="" method="post" enctype="multipart/form-data">
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
                                    <p style="border-bottom: 1px solid black;"><strong>School Detail</strong></p>
                                    </div>
                                      <div class="col-md-6">
                                        <label for="user_fullname">School Name <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="school_name" name="school_name"  value="<?php if(isset($schooldetail->school_name)) echo $schooldetail->school_name;  ?>"/>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="user_fullname">School Person Name <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="school_person_name" name="school_person_name"  value="<?php if(isset($schooldetail->school_person_name)) echo $schooldetail->school_person_name;  ?>"/>
                                    </div>
                                      <div class="col-md-6">
                                        <label for="user_fullname">School Address <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="school_address" name="school_address"  value="<?php if(isset($schooldetail->school_address)) echo $schooldetail->school_address;  ?>"/>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        
                                      
                                        <label for="user_fullname">School Machine ID <span class="red">*</span> <span style="display:none;" id="m_loader" ><img src="<?php echo $this->config->item('base_url').'/images/loader.gif'.''; ?>"  width="10" height="10"></span></label>

                                        <input type="text" class="form-control" id="punch_machine_id" name="punch_machine_id"  value="<?php if(isset($schooldetail->punch_machine_id)) echo $schooldetail->punch_machine_id;  ?>"/>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="user_fullname">City Name <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="school_city" name="school_city"  value="<?php if(isset($schooldetail->school_city)) echo $schooldetail->school_city;  ?>"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="user_fullname">State Name</label>
                                        <input type="text" class="form-control" id="school_state" name="school_state"  value="<?php if(isset($schooldetail->school_state)) echo $schooldetail->school_state;  ?>"/>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="user_fullname">Postal code or Pincode</label>
                                        <input type="text" class="form-control" id="school_postal_code" name="school_postal_code"  value="<?php if(isset($schooldetail->school_postal_code)) echo $schooldetail->school_postal_code;  ?>"/>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="user_fullname">School Phone1 <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="school_phone1" name="school_phone1"  value="<?php if(isset($schooldetail->school_phone1)) echo $schooldetail->school_phone1;  ?>"/>
                                      </div>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="user_fullname">School Phone2</label>
                                        <input type="text" class="form-control" id="school_phone2" name="school_phone2"  value="<?php if(isset($schooldetail->school_phone2)) echo $schooldetail->school_phone2;  ?>"/>
                                    </div>
                                     <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="user_fullname">School Email <span class="red">*</span> <span class="geen" id="email_msg"></span> </label>
                                        <input type="text" class="form-control" id="school_email" name="school_email"  value="<?php if(isset($schooldetail->school_email)) echo $schooldetail->school_email;  ?>"/>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <label for="user_fullname">School Fax No </label>
                                        <input type="text" class="form-control" id="school_fax" name="school_fax"  value="<?php if(isset($schooldetail->school_fax)) echo $schooldetail->school_fax;  ?>"/>
                                    </div>
                                     <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="user_fullname">School Logo  <span id="img-msg"></span></label>
                                        <input type="file" class="form-control" id="school_logo" onchange="validateImage()"  name="school_logo" />
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="user_fullname">School Facebook Page Link <span class="red">*</span></label>
                                        <input type="text" class="form-control" id="school_facebook" name="school_facebook"  value="<?php if(isset($schooldetail->school_facebook)) echo $schooldetail->school_facebook;  ?>"/>
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
