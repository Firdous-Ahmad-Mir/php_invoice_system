
<?php include "header.php";  $rec= trim($_GET['p']); $dat= trim($_GET['dat']);  ?>
       <!-- DataTales Example -->
       <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">invoice Record</h6>
                            <!--button onclick="window.print();">Click me</button-->
                            <button onclick="printDiv('pdfDocument')" class="btn btn-info"><i class="fa fa-print"></i></button>
                            <a href="invoice.php?id=delete&p=<?php echo $rec; ?>&dat=<?php echo $dat; ?>" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                       
                        
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
                            
                
                        <div class="card-body" id="pdfDocument">
                            <div class="table-responsive">
                                                          

                                     <?php

                                     

                                     $this->c_record($rec,$dat); 

                                      ?> 

                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->



            <!-- Logout Modal-->
    <div class="modal fade" id="UpdateAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
        <form class="user" action="invoice.php?id=update_address" method="post" enctype="multipart/form-data">
                          
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Addres</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                <?php $this->updatemodal($rec);  ?>  
                </div>
                <div class="modal-footer">
                <input type="hidden"  name ="date" value="<?php echo $dat; ?>"  required="required">
              
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button value="submit" name="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
        </div>
    </div>
        <!-- Logout Modal-->
       








   



                <script>
                    function myfun(){
                       var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } 
                    }
                    function myfuntw(){
                       var x = document.getElementById("myDIV");
  if (x.style.display === "block") {
    x.style.display = "none";
  }  
                }

                <?php
                
                $stringtwo = "select * from `products` where c_id='$rec'";
   $resulttwo=  mysqli_query($this->con, $stringtwo);
 

                
                while($row_two=mysqli_fetch_array($resulttwo)){?>
                
  function myfunrow<?php echo $row_two['p_id']; ?>(){
                       var x = document.getElementById("myrow<?php echo $row_two['p_id']; ?>");
  if (x.style.display === "none") {
    x.style.display = "block";
  } 
                    }
                    function myfuntwrow<?php echo $row_two['p_id']; ?>(){
                       var x = document.getElementById("myrow<?php echo $row_two['p_id']; ?>");
  if (x.style.display === "block") {
    x.style.display = "none";
  }                }

<?php } ?>



               function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<?php include "footer.php"; ?>