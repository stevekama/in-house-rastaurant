<?php require_once('../../init/initialization.php');
$title = 'Java | Customer';
require_once(PUBLIC_PATH . DS . "layouts" . DS . "header.php");
$back_url = base_url() . 'public/orders/index.php';
if (!$_GET['order']) {
    redirect_to($back_url);
}
$order_id = htmlentities($_GET['order']);
$orders = new Orders();
$current_order = $orders->find_by_id($order_id);
if (!$current_order) {
    redirect_to($back_url);
}

$d = new DateTime();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Java House</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php">Home</a></li>
                    <li class="breadcrumb-item active">Order</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fa fa-globe"></i> Java House.
                                <small class="float-right">Date: <?php echo htmlentities($d->format('Y-m-d')) ?></small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>Java House.</strong><br>
                                Phone: (804) 123-5432<br>
                                Email: info@javahouse.com
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>John Doe</strong><br>
                                Phone: (555) 539-1037<br>
                                Email: john.doe@example.com
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>New Order</b><br>
                            <br>
                            <b>Order ID:</b> <?php echo htmlentities($current_order['id']); ?><br>
                            <b>Payment Due:</b> <?php echo htmlentities($d->format('Y-m-d')); ?>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Product</th>
                                        <th>Serial #</th>
                                        <th>Description</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Call of Duty</td>
                                        <td>455-981-221</td>
                                        <td>El snort testosterone trophy driving gloves handsome</td>
                                        <td>$64.50</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Need for Speed IV</td>
                                        <td>247-925-726</td>
                                        <td>Wes Anderson umami biodiesel</td>
                                        <td>$50.00</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Monsters DVD</td>
                                        <td>735-845-642</td>
                                        <td>Terry Richardson helvetica tousled street art master</td>
                                        <td>$10.70</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Grown Ups Blue Ray</td>
                                        <td>422-568-642</td>
                                        <td>Tousled lomo letterpress</td>
                                        <td>$25.99</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">
                            <p class="lead">Payment Status:</p>

                            <h2 id="orderPaymentStatus" class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                <?php echo htmlentities($current_order['payment_status']); ?>
                            </h2>
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead">Amount Due <?php echo htmlentities($d->format('Y-m-d')) ?></p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Total:</th>
                                        <td>KSHS<?php echo htmlentities($current_order['amount']);  ?></td>
                                    </tr>
                                    <tr>
                                        <th>Paid:</th>
                                        <td>KSHS<?php echo htmlentities($current_order['paid']);  ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">

                            <button type="button" class="btn btn-info float-right"><i class="fa fa-plus"></i>
                                Add Food
                            </button>
                            <?php if ($current_order['payment_status'] == 'BALANCE') { ?>
                                <button type="button" class="btn btn-success float-right"><i class="fa fa-credit-card"></i> Submit
                                    Submit Payment
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php require_once(PUBLIC_PATH . DS . "layouts" . DS . "footer.php"); ?>