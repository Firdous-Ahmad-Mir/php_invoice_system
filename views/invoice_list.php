
    <?php include "header.php"; //$obj= new Myclass();  ?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">invoice Record</h6>
                            </div>
        <?php if($_SESSION['success']){ ?>

    <div class="alert alert-success">
        <strong>Success!</strong> <?php echo $_SESSION["success"];  ?>
            </div>
                <?php unset ($_SESSION["success"]); } ?>

                    <?php if($_SESSION['error']){ ?>

                    <div class="alert alert-danger">
                <strong>Error !</strong> <?php echo $_SESSION["error"];  ?>
            </div>
        <?php unset ($_SESSION["error"]); } ?>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Date</th>  
                                                <th></th>                                           
                                            
                                                
                                                
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        
                                        <?php $this->c_list();  ?>                                 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
    <?php include "footer.php"; ?>