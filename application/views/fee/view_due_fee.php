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
                    Student
                    <small>Manage Student</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
                    <li class="active">List Student</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="POST">

                            <div class="col-md-8">
                                <div class="col-md-3">
                                    <select class="form-control" name="standard" id="standard" style="width: 100%;">

                                        <option value="0">Select Standard</option>

                                        <?php foreach ($school_standard as $standard) {

                                        ?>

                                        <option value="<?php echo $standard->standard_id; ?>"
                                            data-standardid="<?php echo $standard->standard_id; ?>">
                                            <?php echo $standard->standard_title; ?></option>

                                        <?php

                                        } ?>

                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <select class="text-input form-control" id="fee_types" name="fee_types">
                                        <option value="0">Select Fees Type</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <button class="btn btn-primary">GET</button>
                            </div>
                            <div class="col-md-2">
                                <a href="<?php echo site_url("student/list_due"); ?>"
                                    class="btn btn-primary pull-right">Clear Filter</a>
                            </div>


                            <!-- <div class="col-md-6"> -->
                            <!-- <div class="col-md-4"> -->
                            <!-- <a href="<?php //echo site_url("student/student_excel_download"); 
                                            ?>" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Download Excel</a> -->
                            <!-- </div>   -->
                            <!-- <div class="col-md-4"> -->

                            <!-- <a href="<?php //echo site_url("student/student_print"); 
                                            ?>" class="btn btn-primary "><i class="fa fa-print"></i> Print</a> -->
                            <!-- </div> -->
                            <!-- <a href="<?php //echo site_url("student/add_student"); 
                                            ?>" class="btn btn-primary pull-right">Add</a> -->
                            <!-- </div>  -->

                        </form>
                    </div>

                    <div class="col-md-12">
                        <div class="box">
                            <?php
                            if (_get_current_user_type_id($this) == 1) {
                                $teacher_data = $this->school_model->get_school_profile();
                            } else if (_get_current_user_type_id($this) == 2) {
                                $teacher_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));
                            }
                            ?>


                            <div class="box-header">

                                <table id="example2" class="example table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Standard</th>
                                            <th>Fees Name</th>
                                            <th>Fees Amount</th>
                                            <th>Pay Fees Amount</th>
                                            <th>Pending Amount </th>
                                            <!-- <th>Pay Date</th>                        -->
                                        </tr>
                                    </thead>
                                    <tbody>

                                        # code...

                                        <?php
                                        $total_fee = 0;
                                        $total_paid = 0;
                                        $total_due = 0;

                                        if (isset($due)) {

                                            foreach ($due as $students) {

                                        ?>
                                        <tr>
                                            <form method="post">
                                                <td><?php echo $students->student_name; ?></td>
                                                <td><?php echo $students->standard_title; ?></td>
                                                <td><?php echo $students->fee_title; ?></td>
                                                <td><?php echo $students->fee_amount; ?></td>
                                                <td><?php echo $students->pay_amount; ?></td>

                                                <th><?php echo $pending = $students->fee_amount - $students->pay_amount;  ?>
                                                </th>
                                                <!-- <td><?php //echo $students->pay_date; 
                                                                    ?></td>   -->
                                            </form>
                                        </tr>
                                        <?php
                                                $total_fee +=  $students->fee_amount;
                                                $total_paid += $students->pay_amount;
                                                $total_due += $students->fee_amount - $students->pay_amount;
                                            } //end loop 
                                        } // end if
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php if (isset($due)) : ?>

                        <div class="row">

                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-teal">
                                    <div class="inner">
                                        <h3> <?php


                                                    // $teacher_data = $this->school_model->get_school_profile();
                                                    // print_r($teacher_data);
                                                    // if($teacher_data){
                                                    //   $q = $this->db->query("select sum(pay_fee_amount) as total_paid_amount from student_fees where school_id='".$teacher_data->school_id."'");
                                                    //                 $event =  $q->result();
                                                    //                 //echo "<pre>";
                                                    //                echo '<i class="fas fa-rupee-sign"></i> '.$event[0]->total_paid_amount;
                                                    // }else{
                                                    //   echo 0;
                                                    // }
                                                    echo $total_fee;

                                                    ?></h3>
                                        <p>Total Fee </p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-rupee-sign"></i>
                                        <!-- <i class="ion ion-calendar"></i> -->
                                    </div>


                                </div>
                            </div> <!-- ./col -->
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-fuchsia">
                                    <div class="inner">
                                        <h3>
                                            <?php

                                                echo $total_paid;
                                                ?>

                                        </h3>
                                        <p>Total fee paid</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-rupee-sign"></i>
                                    </div>
                                    <?php // echo anchor('student/add_student', 'Add Student <i class="fa fa-arrow-circle-right"></i>', 'class="small-box-footer"'); 
                                        ?>
                                </div>
                            </div><!-- ./col -->

                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3>
                                            <?php

                                                echo $total_due;
                                                ?>

                                        </h3>
                                        <p>Total due fee</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-rupee-sign"></i>
                                    </div>
                                    <?php // echo anchor('student/add_student', 'Add Student <i class="fa fa-arrow-circle-right"></i>', 'class="small-box-footer"'); 
                                        ?>
                                </div>
                            </div>



                        </div>

                        <?php endif ?>
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

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "order": [
                [0, "desc"]
            ],
            "info": true,
            "autoWidth": false


        });

        $("body").on("change", ".tgl_checkbox", function() {
            var table = $(this).data("table");
            var status = $(this).data("status");
            var id = $(this).data("id");
            var id_field = $(this).data("idfield");
            var bin = 0;
            if ($(this).is(':checked')) {
                bin = 1;
            }
            $.ajax({
                    method: "POST",
                    url: "<?php echo site_url("student/change_status"); ?>",
                    data: {
                        table: table,
                        status: status,
                        id: id,
                        id_field: id_field,
                        on_off: bin
                    }
                })
                .done(function(msg) {
                    //alert(msg);
                });
        });
    });


    table.buttons().container()
        .appendTo($('.col-sm-6:eq(0)', table.table().container()));
    </script>
    <script>
    $(function() {
        $(".select2").select2();
    });
    </script>
    <!--   <script>
function get_url_segment(){
    
var get_array = Array();
var query = window.location.search.substring(1).split("&");

for (var i = 0, max = query.length; i < max; i++)
{
    if (query[i] === "") // check for trailing & with no param
        continue;

    var param = query[i].split("=");
    
    get_array[decodeURIComponent(param[0])] = decodeURIComponent(param[1] || "");
}
return get_array;
}
function choose_standard_type() {
    var url_segment = get_url_segment();
    
    var val = document.getElementById("standard_type").value;
    url_segment.standard = val;
    var join_url =join_url_segment(url_segment);
    window.location = "<?php echo site_url("student/list_due"); ?>?"+join_url;
}

function join_url_segment(g_array){
    
     var temp_array = Array();
     var i =0;
    Object.keys(g_array).forEach(function (key) {
        //alert(g_array[key]);
        temp_array[i] = key+"="+g_array[key];
        i++;
    });
    
    return temp_array.join("&");
}

</script>  -->




    <!-- select students -->


    <!-- end students -->
    <script>
    $("#standard").change(function() {

        $('#fee_types').html("");

        var fee_types = $(this).val();



        $.ajax({

                method: "POST",

                url: '<?php echo site_url("fee/free_type_json"); ?>',



                data: {
                    fee_types: fee_types
                }

            })

            .done(function(data) {

                $('#fee_types').append("<option>Select Fees Type</option>");

                $.each(data, function(index, element) {

                    $('#fee_types').append("<option value='" + element.id + "'>" + element.title +
                        "</option>");



                });



            });

    });
    </script>

</body>

</html>