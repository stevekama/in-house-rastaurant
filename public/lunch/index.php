<?php require_once('../../init/initialization.php');
$title = "Admin || Dashboard";
require_once(PUBLIC_PATH . DS . "layouts" . DS . "header.php");  ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Java House</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>index.php">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Fast Foods</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Fast Foods Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table id="loadFoods" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Food</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Order</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="modal fade" id="newProductsModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form id="newProductsForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Products</h4>
                        <button type="button" class="close" data- dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" id="newProductsOrganizationId" class="form-control" name="organization_id" />
                        </div>

                        <div class="form-group">
                            <label for="newProductsName">Product Name</label>
                            <input type="text" id="newProductsName" class="form-control" name="product" placeholder="Enter Product Name" />
                        </div>

                        <div class="form-group">
                            <label for="newProductsDescription">Description</label>
                            <textarea name="description" id="newProductsDescription" class="form-control" placeholder="Enter Description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="newProductsStockIn">Stocks In</label>
                            <input type="text" id="newProductsStockIn" class="form-control" name="stock_in" placeholder="Enter Number of Stocks In" />
                        </div>

                        <div class="form-group">
                            <label for="newProductsCost">Cost</label>
                            <input type="text" id="newProductsCost" class="form-control" name="cost" placeholder="Enter the cost of Stocks" />
                        </div>


                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="newProductsSubmitBtn" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- settings modal -->
</section>
<!-- /.content -->

<?php require_once(PUBLIC_PATH . DS . "layouts" . DS . "footer.php"); ?>

<script>
    $(document).ready(function() {
        const type = 'LUNCH';

        find_foods();

        function find_foods() {
            var dataTable = $('#loadFoods').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url(); ?>api/food/fetch.php",
                    type: "POST",
                    data: {
                        type: type
                    }
                },
                "autoWidth": false
            });
        }

        // new tax
        $('#newProductsBtn').click(function() {
            var action = "FETCH_ORGANIZATION";
            $.ajax({
                url: "<?php echo base_url(); ?>api/organization/organization.php",
                type: "POST",
                data: {
                    action: action,
                    organization_id: organization_id
                },
                dataType: "json",
                success: function(data) {
                    $('#newProductsOrganizationId').val(data.id);
                    $('#newProductsModal').modal('show');
                }
            });

        });

        // new tax form
        $('#newProductsForm').submit(function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "<?php echo base_url(); ?>api/inventories/new_products.php",
                type: "POST",
                data: form_data,
                dataType: "json",
                beforeSend: function() {
                    $('#newProductsSubmitBtn').html("Loading...");
                },
                success: function(data) {
                    $('#newProductsSubmitBtn').html("Save");
                    if (data.message == "success") {
                        $('#newProductsForm')[0].reset();
                        $('#newProductsModal').modal('hide');
                        $('#loadProducts').DataTable().destroy();
                        find_products();
                    }
                }
            });
        });

        $(document).on('click', '.delete', function() {
            if (confirm('Are you sure..?')) {
                var category_id = $(this).attr('id');
                var action = "DELETE_CATEGORY";
                $.ajax({
                    url: "<?php echo base_url(); ?>api/expenses/categories.php",
                    type: "POST",
                    data: {
                        action: action,
                        category_id: category_id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.message == "success") {
                            $('#loadCategories').DataTable().destroy();
                            find_expenses_categories();
                        }
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>