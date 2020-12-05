<?php require_once('init/initialization.php');
$title = 'Java | Customer';
require_once(PUBLIC_PATH . DS . "layouts" . DS . "header.php"); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Java House</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>index.php">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Java House
                    </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>

                        <p>Fast Foods</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Breakfast</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>

                        <p>Lunch</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>My Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">My Orders</h3>
                        <div class="card-tools">
                            <a href="#" id="newOrderBtn" class="btn btn-info btn-sm">
                                <i class="fa fa-plus"></i> Make Order
                            </a>
                        </div>
                    </div>
                    <div id="loadOrders" class="card-body table-responsive p-0">
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <div class="modal fade" id="newOrderModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Large Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
<!-- /.content -->

<?php require_once(PUBLIC_PATH . DS . "layouts" . DS . "footer.php"); ?>

<script>
    $(document).ready(function() {

        $('#newOrderBtn').click(function() {
            $.ajax({
                url: "<?php echo base_url(); ?>api/orders/new_order.php",
                type: "POST",
                dataType: "json",
                success: function(data) {
                   if(data.message == 'success'){
                       var order_id = $.trim(data.order_id);
                       localStorage.setItem('order_id', order_id);
                       window.location.href = '<?php echo base_url(); ?>public/orders/view.php?order='+order_id;
                   }
                }
            });
        });
        
        find_user_orders();
        function find_user_orders() {
            var action = "FETCH_USER_ORDERS_LIMIT";
            $.ajax({
                url: "<?php echo base_url(); ?>api/orders/orders.php",
                type: "POST",
                data: {
                    action: action
                },
                dataType: "json",
                success: function(data) {
                    $('#loadOrders').html(data.orders);
                }
            });
        }

        $(document).on('click', '.view', function(){
            var order_id = $(this).attr('id');
            var action = "FETCH_ORDER";
            $.ajax({
                url: "<?php echo base_url(); ?>api/orders/orders.php",
                type: "POST",
                data: {
                    action: action,
                    order_id:order_id
                },
                dataType: "json",
                success: function(data) {
                    var order_id = $.trim(data.id);
                    localStorage.setItem('order_id', order_id);
                    window.location.href = '<?php echo base_url(); ?>public/orders/view.php?order='+order_id;
                }
            });
        })
    })
</script>