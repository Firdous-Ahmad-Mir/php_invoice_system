<?php include "header.php"; ?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Create Invoice</h1>


<div class="container">

            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                  
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-4">Address Information</h1>
                            <?php if($_SESSION['success']){ ?>

                            <div class="alert alert-success">
                                <strong>Success!</strong> Indicates a successful or positive action.
                                    </div>
                                        <?php unset ($_SESSION["success"]); } ?>

                                            <?php if($_SESSION['error']){ ?>

                                            <div class="alert alert-danger">
                                        <strong>Error !</strong> <?php echo $_SESSION["error"];  ?>
                                    </div>
                                <?php unset ($_SESSION["error"]); } ?>
                            </div>

                            <form class="user" action="invoice.php?id=insert" method="post" enctype="multipart/form-data">
                            <div id="txtHint">                           
                            <div class="form-group row">

                            <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input  type="number" class="form-control form-control-user" name="c_id" 
                                            placeholder="Coustomer Id" id="c_id" onchange="mychange()" required="required">
                                    </div>

                                 <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="name"  
                                        placeholder="Name" required="required">
                                    </div>
                              
                                    
                                </div>





                                    <div class="form-group row">
                          
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" name="pin_code"
                                            placeholder=" Pin Code" required="required">
                                    </div>
                                   
                                




                                <div class="col-sm-6">
                                    <input type="number" class="form-control form-control-user"   name="cell"
                                        placeholder="Cell Number" required="required">
                                </div>
                                </div>

                                <div class="form-group">
                                    <textarea type="number" class="form-control form-control-user"  name="address"
                                        placeholder="Address" required="required"></textarea>
                                </div>
                                            </div>
                                <div class="text-center">
                                <h1 class="h6 text-gray-900 mb-4">Product Information</h1>
                                </div>
                                <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"  name="p_name[]"
                                        placeholder="Product:" required="required">
                                </div>
                                 <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user"  name ="p_category[]"
                                        placeholder="Category:" required="required">
                                </div>
                                </div>

                                <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="number" class="form-control form-control-user"  name="p_qty[]"
                                        placeholder=" Quentity:" required="required">
                                </div>
                                <div class="col-sm-6 ">
                                   <s> <input  type="number" class="form-control form-control-user"  name="p_price[]"
                                        placeholder=" Market Price:" required="required"></s>
                                </div>
                                </div>

                                <div class="form-group row">

                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="number"class="form-control form-control-user"  name ="s_price[]"
                                        placeholder=" Selling Price:" required="required">
                                        
                                </div>

                                <div class="col-sm-6 ">
                                    <input type="date" class="form-control form-control-user"  name="date[]"
                                        placeholder="Date:" required="required">
                                </div>
                                </div>

                                <div id="product"></div>

                                <b class="btn btn-sm btn-info" onclick="add()">+</b>




                                <div class="form-group">
                                <button class="btn btn-primary btn-user btn-block" name="button"> Create</button>
                                </div>




                                
                            </form>
                            <hr>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        

           




</div>
<!-- /.container-fluid -->

</div>
<script>



function mychange(){
    var str =document.getElementById("c_id").value;  
  

if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","invoice.php?id=fatch&q="+str,true);
    xmlhttp.send();
  }

}





    

    function add(){
        $("<DIV>").load("invoice.php?id=input", function() {
      $("#product").append($(this).html());
   });	
    }
</script>
<!-- End of Main Content -->
<?php include "footer.php"; ?>