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
                    Notifications
                    <small>Send</small>
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">

                    <div class="">

                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <p><strong>Send Notification</strong></p>
                                </div>
                                <div class="box-body">

                                    <form role="form" action="" method="post" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <?php
                                            echo $this->session->flashdata("message");
                                            ?>
                                            <? if (isset($error)) {
                                                echo $error;
                                            } ?>
                                            <div class="form-group">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label for="standard">Standard <span
                                                                class="red">*</span></label>
                                                        <select class="form-control" name="standard" id="standard"
                                                            style="width: 100%;">
                                                            <option value="0">Send to All</option>
                                                            <?php foreach ($school_standard as $standard) {
                                                            ?>
                                                            <option value="<?php echo $standard->standard_id; ?>"
                                                                data-standardid="<?php echo $standard->standard_id; ?>">
                                                                <?php echo $standard->standard_title; ?></option>
                                                            <?php
                                                            } ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="fee_title">Select Student <span
                                                                class="red">*</span></label>
                                                        <select class="text-input form-control" id="student_id"
                                                            name="student_id">
                                                            <option value="0">Send to All</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr />
                                                    </div>
                                                    <div class="col-md-12">


                                                        <div class="form-group">
                                                            <label for="noti_title">Title <span
                                                                    class="red">*</span></label>

                                                            <input type="text" class="form-control" id="noti_title"
                                                                name="noti_title" placeholder="Title*" required="">
                                                        </div>
                                                        <div class="form-group">
                                                            <span>Notification Banner :</span>
                                                            <input type="file" class="form-control" name="noti_image"
                                                                placeholder="Attachment Image">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="noti_description">Message <span
                                                                    class="red">*</span></label>
                                                            <textarea class="textarea" id="noti_description"
                                                                name="noti_description" placeholder="Message*"
                                                                required=""
                                                                style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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

        <?php $this->load->view("admin/common/common_footer"); ?>


        <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
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
    $("#standard").change(function() {
        $('#student_id').html("");
        var standard_id = $(this).val();

        $.ajax({
                method: "POST",
                url: '<?php echo site_url("fee/student_json"); ?>',
                data: {
                    standard_id: standard_id
                }
            })
            .done(function(data) {
                $('#student_id').append("<option value='0'>Send to All</option>");
                $.each(data, function(index, element) {
                    $('#student_id').append("<option value='" + element.student_id + "'>" + element
                        .student_user_name + "</option>");
                });

            });
    });
    </script>


    <script>
    $(function() {
        $(".select2").select2();
    });
    </script>

</body>

</html>