<!DOCTYPE html>
<html>
<?php $this->load->view("common/common_head"); ?>

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
                        <a href="<?php echo site_url("student/list_student"); ?>"
                            class="btn btn-primary pull-right">List</a>
                    </div>
                    <div class="col-md-12">
                        <div class="box ">
                            <div class="box-header">
                            </div>
                            <div class="box-body ">
                                <form role="form" action="" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <!-- error msgs -->
                                        <?php
                                        echo $this->session->flashdata("message");
                                        ?>
                                        <? if (isset($error)) {
                                            echo $error;
                                        } ?>
                                        <!-- error end -->
                                        <?php
                                        $today = date('Ymd');
                                        $student_unique_no =  uniqid($today . '_');
                                        ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <h3 style="border-bottom: 1px solid black;"><strong>Student
                                                            Detail Form</strong>
                                                        <small> (Please Fill * all
                                                            Required Field)</small>
                                                    </h3>
                                                </div>

                                                <div class="col-md-12">
                                                    <!-- alerts -->
                                                    <div class="alert">
                                                        <div id="result"></div>
                                                    </div>
                                                    <!-- end alerts -->
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_name">Student full Name <span
                                                            class="red">*</span></label>
                                                    <input type="text" class="form-control" id="student_name"
                                                        name="student_name"
                                                        value="<?php if (isset($_REQUEST["student_name"])) {
                                                                                                                                                echo $_REQUEST["student_name"];
                                                                                                                                            } ?>"
                                                        placeholder="Abhishek Kumar" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_unique_no">Student Unique No <span
                                                            class="red">*</span> </label>
                                                    <input type="text" class="form-control" id="student_unique_no"
                                                        name="student_unique_no" readonly=""
                                                        value="<?php echo $student_unique_no; ?>" />
                                                    <p class="text-lowercase">Note*: This Unique No Is Auto Generated.
                                                        You Can not edit. Please
                                                        Note This Unique No for
                                                        feture use</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_roll_no">Student Roll No <span
                                                            class="red">*</span></label>
                                                    <input type="text" class="form-control" id="student_roll_no"
                                                        name="student_roll_no"
                                                        value="<?php if (isset($_REQUEST["student_roll_no"])) {
                                                                                                                                                    echo $_REQUEST["student_roll_no"];
                                                                                                                                                } ?>" />

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="punch_card_id">Student Card ID &nbsp;&nbsp;
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
                                                        <input type="text" class="form-control" id="punch_card_id"
                                                            name="punch_card_id"
                                                            value="<?php if (isset($_REQUEST["punch_card_id"])) {
                                                                                                                                                    echo $_REQUEST["punch_card_id"];
                                                                                                                                                } ?>" />
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <label for="student_birthdate">Student Birthdate <span
                                                            class="red">*</span></label>
                                                    <input type="text" class="form-control" id="student_birthdate"
                                                        name="student_birthdate" placeholder="Show Date"
                                                        data-inputmask="'alias': 'yyyy/mm/dd'" data-mask
                                                        value="<?php if (isset($_REQUEST["student_birthdate"])) {
                                                                                                                                                                                                                                echo $_REQUEST["student_birthdate"];
                                                                                                                                                                                                                            } ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_standard">Student Standard <span
                                                            class="red">*</span></label>
                                                    <select class="form-control select2" name="student_standard"
                                                        id="student_standard" style="width: 100%;">
                                                        <?php foreach ($school_standard as $standard) {
                                                        ?>
                                                        <option value="<?php echo $standard->standard_id; ?>"
                                                            <?php if (isset($_REQUEST["student_standard"]) && $_REQUEST["student_standard"] == $standard->standard_id) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>>
                                                            <?php echo $standard->standard_title; ?></option>
                                                        <?php
                                                        } ?>
                                                    </select>
                                                    <p>Note: Standard Not Available in list Please : <a
                                                            href="<?php echo site_url("standard/manage_standard"); ?>">
                                                            Add Standard</a></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_address">Student Address <span
                                                            class="red">*</span></label>
                                                    <textarea rows="2" id="student_address" name="student_address"
                                                        class="form-control"><?php if (isset($_REQUEST["student_address"])) {
                                                                                                                                            echo $_REQUEST["student_address"];
                                                                                                                                        } ?></textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="student_city">Student City <span
                                                            class="red">*</span></label>
                                                    <input type="text" class="form-control" id="student_city"
                                                        name="student_city"
                                                        value="<?php if (isset($_REQUEST["student_city"])) {
                                                                                                                                                echo $_REQUEST["student_city"];
                                                                                                                                            } ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_phone">Student Phone <span
                                                            class="red">*</span></label>
                                                    <input type="text" class="form-control" id="student_phone"
                                                        name="student_phone"
                                                        value="<?php if (isset($_REQUEST["student_phone"])) {
                                                                                                                                                echo $_REQUEST["student_phone"];
                                                                                                                                            } ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_parent_phone">Student Parent Phone </label>
                                                    <input type="text" class="form-control" id="student_parent_phone"
                                                        name="student_parent_phone" value="
                                                        <?php if (isset($_REQUEST["student_parent_phone"])) {
                                                            echo $_REQUEST["student_parent_phone"];
                                                        } ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_enr_no">Student Enrolment No </label>
                                                    <input type="text" class="form-control" id="student_enr_no"
                                                        name="student_enr_no"
                                                        value="<?php if (isset($_REQUEST["student_enr_no"])) {
                                                                                                                                                    echo $_REQUEST["student_enr_no"];
                                                                                                                                                } ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_email">Student Email </label>
                                                    <input type="email" class="form-control" id="student_email"
                                                        name="student_email"
                                                        value="<?php if (isset($_REQUEST["student_email"])) {
                                                                                                                                                echo $_REQUEST["student_email"];
                                                                                                                                            } ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_branch">Student Branch </label>
                                                    <input type="text" class="form-control" id="student_branch"
                                                        name="student_branch"
                                                        value="<?php if (isset($_REQUEST["student_branch"])) {
                                                                                                                                                    echo $_REQUEST["student_branch"];
                                                                                                                                                } ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_semester">Student Semester </label>
                                                    <input type="text" class="form-control" id="student_semester"
                                                        name="student_semester"
                                                        value="<?php if (isset($_REQUEST["student_semester"])) {
                                                                                                                                                        echo $_REQUEST["student_semester"];
                                                                                                                                                    } ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_division">Student Division</label>
                                                    <input type="text" class="form-control" id="student_division"
                                                        name="student_division"
                                                        value="<?php if (isset($_REQUEST["student_division"])) {
                                                                                                                                                        echo $_REQUEST["student_division"];
                                                                                                                                                    } ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_batch">Student Batch </label>
                                                    <input type="text" class="form-control" id="student_batch"
                                                        name="student_batch"
                                                        value="<?php if (isset($_REQUEST["student_batch"])) {
                                                                                                                                                echo $_REQUEST["student_batch"];
                                                                                                                                            } ?>" />
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="student_photo">Student Photo <span
                                                                id="img-msg"></span> </label>
                                                        <input type="file" class="form-control" id="student_photo"
                                                            onchange="validateImage()" name="student_photo" />
                                                    </div>
                                                </div>


                                                <hr>


                                                <div class="col-md-6">
                                                    <div class='form-group'>
                                                        <label for="student_username"><span
                                                                class="required_lable">Student Login User
                                                                Name</span>
                                                            <span class="red">*</span></label>

                                                        <input type="text" class="form-control" id="student_username"
                                                            name="student_username"
                                                            value="<?php if (isset($_REQUEST["student_username"])) {
                                                                                                                                                            echo $_REQUEST["student_username"];
                                                                                                                                                        } ?>" />
                                                        <p>Note *: student login user name (Must Have a Unique not
                                                            Repeated)</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="student_password"><span class="required_lable">Student
                                                            Login Password</span><span class="red">*</span></label>

                                                    <input type="password" class="form-control" id="student_password"
                                                        name="student_password"
                                                        value="<?php if (isset($_REQUEST["student_password"])) {
                                                                                                                                                            echo $_REQUEST["student_password"];
                                                                                                                                                        } ?>" />
                                                    <p>Note *: student login password </p>
                                                </div>




                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="savestudent" class="btn btn-primary">Save
                                            Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </section><!-- /.content -->
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

        $("[data-mask]").inputmask("yyyy/mm/dd", {
            "placeholder": "yyyy/mm/dd"
        });
        $(".timepicker").timepicker({
            showInputs: false
        });


    });



    $('#student_username').keyup(function() {
        var username = $('#student_username').val();
        if (username.length <= 4) {
            $('.alert').show();
            $('#student_username').closest('.form-group').removeClass('has-success');
            $('#student_username').closest('.form-group').addClass('has-error');
            $('.alert').removeClass('alert-success');
            $('.alert').addClass('alert-danger');
            $('#result').html('username must be greater than 4 character');

        } else if (username.length > 4) {
            $('.alert').hide();
            $.ajax({
                url: '<?php echo site_url('
          check_student_username '); ?>?username=' + username,
                method: 'GET',
                success: function(res) {
                    var data = JSON.parse(res);
                    if (data.status == 'success') {
                        $('#student_username').closest('.form-group').removeClass('has-error');
                        $('#student_username').closest('.form-group').addClass('has-success');
                        $('.alert').addClass('alert-success');
                        $('.alert').show();
                        $('#result').html(data.msg);
                        $('#student_username').closest('.form-group').addClass('has-success');

                        $('#student_username').focusout(function() {
                            $('.alert').hide();
                        });
                    } else if (data.status == 'error') {
                        $('#student_username').closest('.form-group').removeClass('has-success');
                        $('#student_username').closest('.form-group').addClass('has-error');
                        $('.alert').removeClass('alert-success');
                        $('.alert').addClass('alert-danger');
                        $('.alert').show();
                        $('#result').html(data.msg);
                    }
                }
            })
        }


    });
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