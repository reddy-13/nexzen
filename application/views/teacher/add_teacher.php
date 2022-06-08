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
                <h1>
                    Add Teacher
                    <small>Manage Teacher</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Teacher</a></li>
                    <li class="active">Add Teacher</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo site_url("teacher/list_teacher"); ?>"
                            class="btn btn-primary pull-right">List</a>
                        </div>
                        <div class="col-md-12">
                            <form role="form" action="" method="post" enctype="multipart/form-data">
                                <div class="box mt-1">
                                    <div class="box-header">
                                    </div>

                                    <div class="box-body">
                                        <?php
                                        if($message = $this->session->flashdata("message")){
                                            echo $message;
                                        }
                                        ?>
                                        <?php

                                        if (isset($error) && strlen($error) > 0) {

                                            ?>
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="alert alert-danger">
                                                        <div id="result"><?php echo $error;?></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php

                                        } ?>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <p style="border-bottom: 1px solid black;"><strong>Teacher
                                                    Detail</strong> (Please Fill * all Required Field)</p>

                                                    <?php

                                                    $id  = $this->teacher_model->get_school_teacher_by_id(9);

                                                    ?>
                                                    <br>


                                                    <h4 class="box-title">Teacher Credentials</h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">


                                                        <label for="teacher_name">Username <span
                                                            class="red">*</span></label>
                                                            <input type="text" class="form-control" id="teacher_username"
                                                            name="username">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label for="teacher_name">Password<span class="red">*</span></label>
                                                        <input type="password" class="form-control" id="password"
                                                        name="password">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="box">
                                        <div class="box-header">

                                        </div>
                                        <div class="box-body">


                                            <div class="box-body">




                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <h4 class="box-title">General Information</h4>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="teacher_name">Teacher Name <span
                                                                class="red">*</span></label>
                                                                <input type="text" class="form-control" id="teacher_name"
                                                                name="teacher_name"
                                                                value="<?php if (isset($_REQUEST["teacher_name"])) {
                                                                  echo $_REQUEST["teacher_name"];
                                                              } ?>" />
                                                          </div>
                                                          <div class="col-md-6">
                                                            <label for="teacher_birthdate">Teacher Birthdate <span
                                                                class="red">*</span></label>
                                                                <input type="date" class="form-control" id="teacher_birthdate"
                                                                name="teacher_birthdate" placeholder="Show Date"

                                                                value="<?php if (isset($_REQUEST["teacher_birthdate"])) {
                                                                    echo $_REQUEST["teacher_birthdate"];
                                                                } ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Gender :</label>
                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio" checked="" value="male" id=""
                                                                        name="gender" />
                                                                        Male
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" value="female" id="" name="gender" />
                                                                        FeMale
                                                                    </label>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Marital Status</label>
                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio" checked="" value="single" id=""
                                                                        name="maritalstatus" />
                                                                        Single
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" value="married" id=""
                                                                        name="maritalstatus" />
                                                                        Married
                                                                    </label>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                            <label for="teacher_blood_group">Blood Group</label>
                                                                <input type="text" class="form-control" id="teacher_blood_group"
                                                                name="teacher_blood_group"
                                                                placeholder="e.g B+">
                                                                value="<?php if (isset($_REQUEST["teacher_blood_group"])) {
                                                                  echo $_REQUEST["teacher_blood_group"];
                                                              } ?>" />
                                                          </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="teacher_address">Teacher Address <span
                                                                        class="red">*</span></label>
                                                                        <textarea rows="2" id="teacher_address" name="teacher_address"
                                                                        class="form-control"><?php if (isset($_REQUEST["teacher_address"])) {
                                                                          echo $_REQUEST["teacher_address"];
                                                                      } ?></textarea>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="teacher_phone">Teacher Phone <span
                                                                        class="red">*</span></label>
                                                                        <input type="text" class="form-control" id="teacher_phone"
                                                                        name="teacher_phone"
                                                                        value="<?php if (isset($_REQUEST["teacher_phone"])) {
                                                                          echo $_REQUEST["teacher_phone"];
                                                                      } ?>" />
                                                                  </div>
                                                              </div>
                                                              <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="teacher_email">Teacher Email <smapn id="email_msg">
                                                                    </smapn> </label>
                                                                    <input type="email" class="form-control" id="teacher_email"
                                                                    name="teacher_email" placeholder="teachet@gmail.com"
                                                                    value="<?php if (isset($_REQUEST["teacher_email"])) {
                                                                      echo $_REQUEST["teacher_email"];
                                                                  } ?>" />
                                                              </div>
                                                          </div>


                                                          <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="teacher_photo">Teacher Photo <span
                                                                    id="img-msg"></span></label>
                                                                    <input type="file" class="form-control"
                                                                    onchange="validateImage()" id="teacher_photo"
                                                                    name="teacher_photo" />
                                                                </div>
                                                            </div>



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
                                                                <label for="teacher_exp">Teaching Experience </label>
                                                                <input type="text" class="form-control" id="teacher_exp"
                                                                name="teacher_exp"
                                                                placeholder="Ex. 1 year 6 month, 6 month, 4 year, ect"
                                                                value="<?php if (isset($_REQUEST["teacher_exp"])) {
                                                                  echo $_REQUEST["teacher_exp"];
                                                              } ?>" />
                                                          </div>
                                                          <div class="col-md-6">
                                                            <label for="teacher_education">Teacher Education <span
                                                                class="red">*</span></label>
                                                                <input type="text" class="form-control" id="teacher_education"
                                                                name="teacher_education"
                                                                placeholder="Ex. M.A., B.Ed, Phd, P.T.C, Etc"
                                                                value="<?php if (isset($_REQUEST["teacher_education"])) {
                                                                  echo $_REQUEST["teacher_education"];
                                                              } ?>" />
                                                          </div>

                                                          <div class="col-md-6">
                                                            <label for="teacher_notes">Extra Notes </label>
                                                            <textarea rows="2" id="teacher_notes" name="teacher_notes"
                                                            placeholder="extra activity, extra archivement, award, etc"
                                                            class="form-control"><?php if (isset($_REQUEST["teacher_notes"])) {
                                                                echo $_REQUEST["teacher_notes"];
                                                            } ?></textarea>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="teacher_detail">Teacher Detail <span
                                                                class="red">*</span> </label>
                                                                <br /><label>Note <span class="red">*</span>: Teacher Standard,
                                                                Teacher Subject, Teacher All Detail, Etc</label>
                                                                <textarea id="editor1" name="editor1" rows="10" cols="80">
                                                                  <?php if (isset($_REQUEST["editor1"])) {
                                                                    echo $_REQUEST["editor1"];
                                                                } ?>  
                                                            </textarea>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div><!-- /.box-body -->

                                            <div class="box-footer">
                                                <button type="submit" name="saveteacher" class="btn btn-primary">Save
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
<script src="<?php echo base_url($this->config->item("theme_admin") . "/plugins/ckeditor/ckeditor.js"); ?>">
</script>
<script>
    $(function() {

        // $("[data-mask]").inputmask("dd/mm/yyyy", {
        //     "placeholder": "dd/mm/yyyy/"
        // });
        $(".timepicker").timepicker({
            showInputs: false
        });


    });
</script>
<script>
    $(function() {

        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script>

<script type="text/javascript">
    $('#teacher_username').keyup(function() {
        var username = $('#teacher_username').val();
        if (username.length <= 4) {
            $('.alert').show();
            $('#teacher_username').closest('.form-group').removeClass('has-success');
            $('#teacher_username').closest('.form-group').addClass('has-error');
            $('.alert').removeClass('alert-success');
            $('.alert').addClass('alert-danger');
            $('#result').html('username must be greater than 4 character');

        } else if (username.length > 4) {
            $('.alert').hide();
            $.ajax({
                url: '<?php echo site_url('check-teacher-username'); ?>?username=' + username,
                method: 'GET',
                success: function(res) {
                    var data = JSON.parse(res);
                    if (data.status == 'success') {
                        $('#teacher_username').closest('.form-group').removeClass('has-error');
                        $('#teacher_username').closest('.form-group').addClass('has-success');
                        $('.alert').addClass('alert-success');
                        $('.alert').show();
                        $('#result').html(data.msg);
                        $('#teacher_username').closest('.form-group').addClass('has-success');


                    } else if (data.status == 'error') {
                        $('#teacher_username').closest('.form-group').removeClass('has-success');
                        $('#teacher_username').closest('.form-group').addClass('has-error');
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
    })

    //  satrting of teacher email id checking
    $("#teacher_email").keyup(function() {
        var regexp = /^[a-zA-Z0-9._]+@[a-zA-Z0-9._]+\.[a-zA-Z]{2,4}$/;
        if (regexp.test($('#teacher_email').val())) {
            var teacher_email = $('#teacher_email').val()

            $.ajax({
                url: '<?php echo site_url("check/check_teacher_email"); ?>',
                method: 'POST',
                data: {
                    teacher_email: teacher_email
                },
                beforeSend: function() {
                    $('#e_loader').show();
                },
                success: function(res) {
                    if (res.status == 1) {
                        $('#teacher_email').closest('.form-group').removeClass('has-error');
                        $('#teacher_email').closest('.form-group').addClass('has-success');
                        $('#email_msg').html(res.msg);
                    } else if (res.status == 0) {
                        $('#email_msg').html(res.msg);
                        $('#teacher_email').closest('.form-group').addClass('has-error');

                    }
                },
                complete: function() {
                    $('#e_loader').hide();
                }
            });
        } else {
            $('#email_msg').html('<p>Invalid email</p>');
            $('#school_email').closest('.form-group').addClass('has-error');
        }
    })
    // // end of email id checking .....



    //validating phone1 number
    $("#teacher_phone").keyup(function() {
        var regexp = /^[0-9]{10}$/;
        if (regexp.test($('#teacher_phone').val())) {
            $('#teacher_phone').closest('.form-group').removeClass('has-error');
            $('#teacher_phone').closest('.form-group').addClass('has-success');
        } else {
            $('#teacher_phone').closest('.form-group').addClass('has-error');
        }
    })

    // end of phone 11 chekcing

    // // checking for punch machine id id
</script>
<script type="text/javascript">
    function validateImage() {
        var formData = new FormData();

        var file = document.getElementById("teacher_photo").files[0];

        formData.append("Filedata", file);
        var t = file.type.split('/').pop().toLowerCase();
        if (t != "jpeg" && t != "jpg" && t != "png") {
            $('#img-msg').html('<p>Please select a valid image file JPG, JPEG or PNG </p>');
            $('#teacher_photo').closest('.form-group').addClass('has-error');
            $('#teacher_photo').closest('.form-group').removeClass('has-success');
            // alert('Please select a valid image file');
            document.getElementById("teacher_photo").value = '';
            return false;
        }
        if (file.size > 1024000) {
            // alert('Max Upload size is 1MB only');
            $('#img-msg').html('<p>Max Upload size is 1MB only</p>');
            $('#teacher_photo').closest('.form-group').addClass('has-error');
            $('#teacher_photo').closest('.form-group').removeClass('has-success');
            document.getElementById("teacher_photo").value = '';
            return false;
        }
        $('#img-msg').html('<p>OK </p>');
        $('#teacher_photo').closest('.form-group').removeClass('has-error');
        $('#teacher_photo').closest('.form-group').addClass('has-success');
        return true;
    }
</script>
</body>

</html>