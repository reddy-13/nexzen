<!DOCTYPE html>
<html>
<title>Nexzen System</title>
<?php $this->load->view("common/common_head"); ?>
<style media="print">
@media print {
    @page {
        /* margin-top: 0; */
        margin-bottom: 0;

    }

    body {
        /* padding-top: 72px; */
        padding-bottom: 72px;
    }
}
</style>

<!-- onload="window.print();" -->

<body onload="window.print();">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    if (_get_current_user_type_id($this) == 1) {
                        $school_data = $this->school_model->get_school_profile();
                    } else if (_get_current_user_type_id($this) == 2) {
                        $school_data = $this->teacher_model->get_school_teacher_user_id(_get_current_user_id($this));
                    }

                    ?>
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> <?php echo ' ' . $school_data->school_name; ?>
                        <small class="pull-right">Date: <?php echo date('Y-m-d'); ?></small>
                    </h2>
                </div><!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-xs-4">
                        <div class="card">

                            <p>
                                <b>Address : </b> <span><?php echo $student_fees[0]->student_address; ?></span><br>
                                <b>Mobile : </b> <span><?php echo $student_fees[0]->student_phone; ?></span> <br>
                                <b>Email : </b> <span><?php echo $student_fees[0]->student_email; ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table id="example2" class="example table table-bordered table-hover display">
                        <thead>
                            <tr>

                                <th style="width:50%">Fee Details</th>
                                <th>Fee Amount</th>
                                <th>Paid Amount</th>
                                <th>Due</th>
                                <th>Paid Date</th>

                            </tr>
                        </thead>
                        <?php
                        // echo "<pre>";
                        // print_r($student_fees);
                        // exit;

                        ?>
                        <tbody>
                            <?php
                            $total_fee = 0;
                            $total_paid = 0;
                            $total_due = 0;


                            foreach ($student_fees as $students) {
                            ?>
                            <tr>

                                <td><?php echo $students->title; ?></td>

                                <td><?php echo $students->fee_amount; ?></td>
                                <td><?php echo $students->pay_fee_amount; ?></td>

                                <th><?php echo $pending = $students->fee_amount - $students->pay_fee_amount;  ?>
                                </th>
                                <td><?php echo $students->pay_date; ?></td>

                            </tr>
                            <?php
                                $total_fee +=  $students->fee_amount;
                                $total_paid += $students->pay_fee_amount;
                                $total_due += $students->fee_amount - $students->pay_fee_amount;
                            } ?>
                            <tr>
                                <td><b>Total</b></td>
                                <td><i><?php echo '₹ ' . $total_fee ?></i></td>
                                <td><i><?php echo 'Due: ₹ ' . $total_paid ?> </i></td>
                                <td><b><?php echo $total_due ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.col -->
            </div><!-- /.row -->


        </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->


</body>

</html>