<!DOCTYPE html>
<html>
<?php $this->load->view("common/common_head"); ?>

<style>


    .row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-top: calc(-1 * var(--bs-gutter-y));
    margin-right: calc(-.5 * var(--bs-gutter-x));
    margin-left: calc(-.5 * var(--bs-gutter-x));
}

.mt-4 {
    margin-top: 10px !important;
}
.form-label {
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
    color: #7b8ab8;

}
h4{
    color: #7b8ab8;
}  
.form-control {
    display: block;
    width: 100%;
    padding: 1rem 1.5rem;
    font-size: 2rem;
    font-weight: 400;
    line-height: 1.5;
    color: #7b8ab8;
    background-color: #f0f5fa;
    background-clip: padding-box;
    border: 0 solid #bed1e6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    box-shadow: inset 2px 2px 8px rgb(55 94 148 / 30%), inset -3px -2px 5px rgb(255 255 255 / 80%);
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    height: 5rem;
}

input, button, select, optgroup, textarea {
    margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;

}

</style>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php $this->load->view("admin/common/common_header"); ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php $this->load->view("admin/common/common_sidebar"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Add Student<small>Manage Student</small></h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
                    <li class="active">Add Student</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                  <div class="col-md-12">
                    <a href="<?php echo site_url("student/list_student"); ?>" class="btn btn-primary pull-right">List</a>
                </div>
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="col-md-12 mb-5 text-center">
                                            <h3  style="border-bottom: 0.5px solid lightgray;"><strong>Student Detail</strong> <small>(Please Fill * all Required Field)</small></h3>
                                        </div>
                        </div>
                        <div class="box-body">

                           
                                <?php
                                $attributes = ['role' => 'form', 'class' => 'form']; 
                                echo form_open_multipart('',$attributes);
                                ?>
                                <div class="box-body">
                                  <?php 
                                  if($message = $this->session->flashdata("message")){
                                    echo $message;
                                }
                                ?>
                                <?php if(isset($error)){
                                    echo $error;
                                } ?>


                                <?php 
                                $today= date('Ymd');
                                $student_unique_no =  uniqid($today.'_');
                                ?>
                               
                               
                                    <div class="row ">
                                        
                                        <div class="col-md-4">
                                            <h4>Student Id</h4>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="col-md-12 ">
                                            <label class="form-label mt-5"for="student_unique_no">Student Unique No <span class="red">*</span> </label>
                                            <input type="text" class="form-control" id="student_unique_no" name="student_unique_no" readonly=""  value="<?php echo $student_unique_no; ?>"/>
                                            <p>Note*: This Unique No Is Auto Generated. You Can not edit. Please Note This Unique No for feture use</p>
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <h4>Personal Details</h4>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="col-md-12">
                                            <label class="form-label mt-5"for="student_name">Student Name <span class="red">*</span></label>
                                
                                            <?php
                                               
                                                echo form_input(['name' => 'student_name',
                                                        'class' => 'form-control',
                                                        'id' => 'student_name',
                                                        'placeholder' => 'Student Name',
                                                        'value' => set_value('student_name')]);
                                            ?>
                                            <?php echo form_error('student_name', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label mt-5"for="student_name">Father's name </label>
                                
                                            <?php
                                               
                                                echo form_input(['name' => 'student_father_name',
                                                        'class' => 'form-control',
                                                        'id' => 'student_father_name',
                                                        'placeholder' => "Student Father's",
                                                        'value' => set_value('student_father_name')]);
                                            ?>
                                            <?php echo form_error('student_father_name', '<span class="text-danger"><small><b>', '</b></small></span>'); ?>
                                        </div>
                                        <div class="col-md-12">
                                        <label class="form-label mt-5"for="student_birthdate">Student Date of Birth <span class="red">*</span></label>
                                        <?php
                                             $date_input = array(
                                                'type'        => 'date',
                                                'name'        => 'student_birthdate',
                                                'id'          => 'student_birthdate',
                                                'placeholder' => 'Date of birth',
                                                'value'       => set_value('student_birthdate'),
                                                'class'       => 'form-control'
                                            );
                                            echo form_input($date_input);
                                            echo form_error('student_birthdate', '<span class="text-danger"><small><b>', '</b></small></span>');
                                        ?>

                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-5"for="studen_blood_group">Student Blood Group  <span class="red">*</span></label>
                                         <?php
                                               
                                                echo form_input(['name' => 'studen_blood_group',
                                                        'class' => 'form-control',
                                                        'id' => 'studen_blood_group',
                                                        'placeholder' => 'Student Blood Group',
                                                        'value' => set_value('studen_blood_group')]);
                                        ?>

                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-5"for="student_phone">Student Phone  <span class="red">*</span></label>
                                         <?php
                                               
                                                echo form_input(['name' => 'student_phone',
                                                        'class' => 'form-control',
                                                        'id' => 'student_phone',
                                                        'placeholder' => 'Student Phone',
                                                        'value' => set_value('student_phone')]);
                                        ?>

                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-5"for="student_parent_phone">Student Parent Phone  </label>
                                         <?php
                                               
                                            echo form_input(['name' => 'student_parent_phone',
                                                    'class' => 'form-control',
                                                    'id' => 'student_parent_phone',
                                                    'placeholder' => 'Parent Phone',
                                                    'value' => set_value('student_parent_phone')]);
                                            echo form_error('student_parent_phone', '<span class="text-danger"><small><b>', '</b></small></span>');
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-5"for="student_email">Student Email  </label>
                                        
                                         <?php
                                               
                                            echo form_input(['type' => 'email','name' => 'student_email',
                                                    'class' => 'form-control',
                                                    'id' => 'student_email',
                                                    'placeholder' => 'Student Email',
                                                    'value' => set_value('student_email')]);
                                            echo form_error('student_email', '<span class="text-danger"><small><b>', '</b></small></span>');
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-5"for="student_city">Student City <span class="red">*</span></label>
                                         <?php
                                                echo form_input(['name' => 'student_city',
                                                        'class' => 'form-control',
                                                        'id' => 'student_city',
                                                        'placeholder' => 'Student City',
                                                        'value' => set_value('student_city')]);
                                                echo form_error('student_city', '<span class="text-danger"><small><b>', '</b></small></span>');
                                         ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label mt-5"for="student_address">Student Address <span class="red">*</span></label>
                                        
                                         <?php
                                             $data_form = array(
                                                'name'        => 'student_address',
                                                'id'          => 'student_address',
                                                'placeholder' => 'Student Address',
                                                'value'       => set_value('student_address'),
                                                'rows'        => '3',
                                                'class'       => 'form-control'
                                            );
                                            echo form_textarea($data_form);

                                            echo form_error('student_address', '<span class="text-danger"><small><b>', '</b></small></span>');
                                        ?>
                                    </div>

                                    </div>
                                    <!-- personal details ends -->
                                    <hr class="hr">    

                                    <!-- Class details -->
                                        
                                    <div class="col-md-4">  
                                        <h4>Class Details</h4>


                                    </div>     
                                    <div class="col-md-8">  
                                        <div class="col-md-12">
                                        <label class="form-label mt-5"for="student_standard">Student Standard <span class="red">*</span></label>
                                        <select class="form-control select2" name="student_standard" id="student_standard" style="width: 100%;">
                                            <?php foreach($school_standard as $standard){
                                                ?>
                                                <option value="<?php echo $standard->standard_id; ?>" <?php if(isset($_REQUEST["student_standard"]) && $_REQUEST["student_standard"]==$standard->standard_id){echo "selected"; } ?>><?php echo $standard->standard_title; ?></option>
                                                <?php
                                            } ?>
                                        </select>
                                        <p>Note: Standard Not Available in list Please : <a href="<?php echo site_url("standard/manage_standard"); ?>"> Add Standard</a></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label mt-5"for="student_semester">Student Semester </label>
                                         <?php
                                               
                                            echo form_input(['name' => 'student_semester',
                                                    'class' => 'form-control',
                                                    'id' => 'student_semester',
                                                    'placeholder' => 'Student Semester',
                                                    'value' => set_value('student_semester')]);
                                            echo form_error('student_semester', '<span class="text-danger"><small><b>', '</b></small></span>');
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-5"for="student_batch">Student Batch </label>
                                         <?php
                                               
                                            echo form_input(['name' => 'student_batch',
                                                    'class' => 'form-control',
                                                    'id' => 'student_batch',
                                                    'placeholder' => 'Student Batch',
                                                    'value' => set_value('student_batch')]);
                                            echo form_error('student_batch', '<span class="text-danger"><small><b>', '</b></small></span>');
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-5"for="student_branch">Student Branch </label>
                                    
                                         <?php
                                               
                                            echo form_input(['name' => 'student_branch',
                                                    'class' => 'form-control',
                                                    'id' => 'student_branch',
                                                    'placeholder' => 'Student Branch',
                                                    'value' => set_value('student_branch')]);
                                            echo form_error('student_branch', '<span class="text-danger"><small><b>', '</b></small></span>');
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                            <label class="form-label mt-5"for="student_roll_no">Student Roll No <span class="red">*</span></label>
                                            <?php
                                               
                                                echo form_input(['name' => 'student_roll_no',
                                                        'class' => 'form-control',
                                                        'id' => 'student_roll_no',
                                                        'placeholder' => 'Student Roll number',
                                                        'value' => set_value('student_roll_no')]);
                                                echo form_error('student_roll_no', '<span class="text-danger"><small><b>', '</b></small></span>');
                                            ?>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label mt-5"for="punch_card_id">Student Card ID &nbsp;&nbsp;
                                                    <small>eg. 00000001</small> <span class="red">*</span> <span
                                                    id="card_msg"></span></label>
                                                    <?php
                                                    if (_get_current_user_type_id($this) == 1) {
                                                        $school_data = $this->school_model->get_school_profile();
                                                    } else if (_get_current_user_type_id($this) == 2) {
                                                        $school_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));
                                                    }
                                                        // print_r($school_data);
                                                    ?>
                                                    <input type="hidden" id="school_id" name="school_id"
                                                    value="<?php echo $school_data->school_id; ?>">
                                        
                                                    <?php
                                               
                                                        echo form_input(['name' => 'punch_card_id',
                                                                'class' => 'form-control',
                                                                'id' => 'punch_card_id',
                                                                'placeholder' => 'Card id',
                                                                'value' => set_value('punch_card_id')]);
                                                        echo form_error('punch_card_id', '<span class="text-danger"><small><b>', '</b></small></span>');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                        <label class="form-label mt-5"for="student_photo">Student Photo <span class="red">*</span> </label>
                                        <?php
                                            echo form_upload(['name' => 'student_photo', 'id'=>'student_photo', 'class'=> 'form-control']);
                                            echo form_error('student_photo', '<span class="text-danger"><small><b>', '</b></small></span>');
                                        ?>
                                    </div>
                                    </div>    
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer text-right">
                            <?=form_submit(['name' => 'savestudent','class' =>'btn btn-primary', 'value' => 'Save Data'])?>
                        </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>


    </div>
</section>
</div><!-- /.content-wrapper -->

<?php $this->load->view("admin/common/common_footer"); ?>


        <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
           <div class="control-sidebar-bg"></div>
       </div><!-- ./wrapper -->

       <script src="<?php echo base_url($this->config->item("theme_admin") . "/plugins/jQuery/jQuery-2.1.4.min.js"); ?>">
       </script>
       <!-- jQuery UI 1.11.4 -->
       <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
       <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
       <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url($this->config->item("theme_admin") . "/bootstrap/js/bootstrap.min.js"); ?>">
    </script>
    <!-- Select2 -->
    <script src="<?php echo base_url($this->config->item("theme_admin") . "/plugins/select2/select2.full.min.js"); ?>">
    </script>
    <!-- InputMask -->
    <script
    src="<?php echo base_url($this->config->item("theme_admin") . "/plugins/input-mask/jquery.inputmask.js"); ?>">
</script>
<script
src="<?php echo base_url($this->config->item("theme_admin") . "/plugins/input-mask/jquery.inputmask.date.extensions.js"); ?>">
</script>
<script
src="<?php echo base_url($this->config->item("theme_admin") . "/plugins/input-mask/jquery.inputmask.extensions.js"); ?>">
</script>
<!-- bootstrap time picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script
src="<?php echo base_url($this->config->item("theme_admin") . "/plugins/daterangepicker/daterangepicker.js"); ?>">
</script>

<script
src="<?php echo base_url($this->config->item("theme_admin") . "/plugins/timepicker/bootstrap-timepicker.min.js"); ?>">
</script>
<!-- DataTables -->
<script
src="<?php echo base_url($this->config->item("theme_admin") . "/plugins/datatables/jquery.dataTables.min.js"); ?>">
</script>
<script
src="<?php echo base_url($this->config->item("theme_admin") . "/plugins/datatables/dataTables.bootstrap.min.js"); ?>">
</script>
<!-- AdminLTE App -->
<script src="<?php echo base_url($this->config->item("theme_admin") . "/dist/js/app.min.js"); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url($this->config->item("theme_admin") . "/dist/js/demo.js"); ?>"></script>

<script>
    $(function() {
        $(".select2").select2();
        $(".sidebar-mini").addClass('sidebar-collapse');
    });
</script>
<script>
    $(function() {

        // $("[data-mask]").inputmask("dd/mm/yyyy", {
        //     "placeholder": "mm/dd/yyyy"
        // });
        $(".timepicker").timepicker({
            showInputs: false
        });


    });



    // $('#student_username').keyup(function() {
    //     var username = $('#student_username').val();
    //     if (username.length <= 4) {
    //         $('.alert').show();
    //         $('#student_username').closest('.form-group').removeClass('has-success');
    //         $('#student_username').closest('.form-group').addClass('has-error');
    //         $('.alert').removeClass('alert-success');
    //         $('.alert').addClass('alert-danger');
    //         $('#result').html('username must be greater than 4 character');

    //     } else if (username.length > 4) {
    //         $('.alert').hide();
    //         $.ajax({
    //             url: '<?php  // echo site_url('check_student_username '); ?>?username=' + username,
    //             method: 'GET',
    //             success: function(res) {
    //                 var data = JSON.parse(res);
    //                 if (data.status == 'success') {
    //                     $('#student_username').closest('.form-group').removeClass('has-error');
    //                     $('#student_username').closest('.form-group').addClass('has-success');
    //                     $('.alert').addClass('alert-success');
    //                     $('.alert').show();
    //                     $('#result').html(data.msg);
    //                     $('#student_username').closest('.form-group').addClass('has-success');

    //                     $('#student_username').focusout(function() {
    //                         $('.alert').hide();
    //                     });
    //                 } else if (data.status == 'error') {
    //                     $('#student_username').closest('.form-group').removeClass(
    //                         'has-success');
    //                     $('#student_username').closest('.form-group').addClass('has-error');
    //                     $('.alert').removeClass('alert-success');
    //                     $('.alert').addClass('alert-danger');
    //                     $('.alert').show();
    //                     $('#result').html(data.msg);
    //                 }
    //             }
    //         })
    //     }


    // });
    $('#teacher_username').focusout(function() {
        $('.alert').hide()
    });

    // card id and machinne id checking...
    $("#punch_card_id").keyup(function() {
        var regexp = /^[0-9]{8}$/;
        if (regexp.test($('#punch_card_id').val())) {
            var punch_card_id = $('#punch_card_id').val();
            var school_id = $('#school_id').val();

            $.ajax({
                url: '<?php echo site_url("check_student_card_id"); ?>',
                method: 'POST',
                data: {
                    punch_card_id: punch_card_id,
                    school_id: school_id
                },
                beforeSend: function() {
                    $('#e_loader').show();
                },
                success: function(res) {

                    if (res.status == 1) {

                        $('#punch_card_id').closest('.form-group').removeClass('has-error');
                        $('#punch_card_id').closest('.form-group').addClass('has-success');
                        $('#card_msg').html(res.msg);
                    } else if (res.status == 0) {
                        $('#card_msg').html(res.msg);
                        $('#punch_card_id').closest('.form-group').removeClass('has-success');
                        $('#punch_card_id').closest('.form-group').addClass('has-error');

                    }
                },
                complete: function() {
                    $('#e_loader').hide();
                }
            });
        } else {
            $('#punch_card_id').closest('.form-group').removeClass('has-success');
            $('#card_msg').html('<p>Card id must be 8 digits</p>');
            $('#school_email').closest('.form-group').addClass('has-error');
        }
    })
</script>

<script type="text/javascript">
    function validateImage() {
        var formData = new FormData();

        var file = document.getElementById("student_photo").files[0];

        formData.append("Filedata", file);
        var t = file.type.split('/').pop().toLowerCase();
        if (t != "jpeg" && t != "jpg" && t != "png") {
            $('#img-msg').html('<p>Please select a valid image file JPG, JPEG or PNG </p>');
            $('#student_photo').closest('.form-group').addClass('has-error');
            $('#student_photo').closest('.form-group').removeClass('has-success');
            // alert('Please select a valid image file');
            document.getElementById("student_photo").value = '';
            return false;
        }
        // if (file.size > 1024000) {
        //     // alert('Max Upload size is 1MB only');
        //   $('#img-msg').html('<p>Max Upload size is 1MB only</p>');
        //   $('#student_photo').closest('.form-group').addClass('has-error');
        //   $('#student_photo').closest('.form-group').removeClass('has-success');
        //     document.getElementById("student_photo").value = '';
        //     return false;
        // }
        $('#img-msg').html('<p>OK </p>');
        $('#student_photo').closest('.form-group').removeClass('has-error');
        $('#student_photo').closest('.form-group').addClass('has-success');
        return true;
    }
</script>

</body>

</html>