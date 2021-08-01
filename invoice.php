                <?php
                class database{

                    private $host = "localhost"; // your host name  
                    private $username = "root"; // your user name  
                    private $password = ""; // your password  
                    private $db = "new_database"; // your database name  
                    public $con;
                    public $error;
                    public function __construct()
                    {
                    session_start();
                    $this->con = mysqli_connect("$this->host", "$this->username", "$this->password", "$this->db");
                    if(!$this->con)
                    {
                    echo 'Database Connection Error' . mysqli_connect_error($this->con);
                    }
                    }
                    public function c_list(){
                    $stringw  = "select * from `invice` order by c_id desc";
                    $dal=mysqli_query($this->con, $stringw);
                    while($row=mysqli_fetch_array($dal)){ 
                    $cid=$row['c_id'];
                    $string  = "select * from `products` where c_id='$cid' group by  date desc";
                    if(mysqli_query($this->con, $string))
                    {
                $result=  mysqli_query($this->con, $string);
                $i=0;
                while($rw=mysqli_fetch_array($result)){ $i++;
                    echo "<tr>
                    <td>".$i."</td>
                    <td>".$rw['c_id']."</td>
                    <td>".$row['name']."</td>
                    <td>".$rw['date']."</td>
                    <td><a href='invoice.php?id=coustomer&p=".$rw['c_id']."&dat=".$rw['date']."' class='btn btn-info'><i class='fa text-white'>+</i></a></td>
                        </tr>";
                }
                    
                }
                else
                {
                echo mysqli_error($this->con);

                }
                }

                }

                public function insrt($data, $table_name,$page)
                {
                $string  = "INSERT INTO `".$table_name."` (`";
                $string .= implode("`,`", array_keys($data)) ."`) VALUES ('";
                $string .=  implode("','", array_values($data)) ."')";
                if(mysqli_query($this->con, $string))
                {
                
                    $_SESSION['success']='Updated Successfully';
               
                 
                }
                else
                {
                
               
                     
                        $_SESSION['success']= mysqli_error($this->con);
                      
                } 
            
              
            }
                public function db_up_address($data,$table_name, $cid, $dat,$pid){
                    $string  = "UPDATE `".$table_name."`  SET  ";
                    $cunt=count($data);
                    $i=1;
                foreach($data as $del =>$vel){
                    $string .= "`".$del."`='".$vel."'";
                if($i < $cunt){
                    $string .= ", ";
                }

                $i++; }
                if($table_name=="products"){
                    $string .= " WHERE `p_id`='$pid'";
                }else{
                $string .= " WHERE `c_id`='$cid'";
                }
                    if(mysqli_query($this->con, $string))
                    {
                    $_SESSION['success']='Update successfully';
                    header("Location: invoice.php?id=coustomer&p=$cid&dat=$dat");        
                    }
                    else
                    {
                    $_SESSION['error']= mysqli_error($this->con);
                    header("Location: invoice.php?id=coustomer&p=$cid&dat=$dat");   
                    } }
                public function fatch(){
                    $rec=$_GET['q'];
                    $string  = "select * from `invice` where c_id='$rec'";
                    $result=  mysqli_query($this->con, $string);
                    $moult=mysqli_num_rows($result);
                    if($moult>0){
                
                    while($rw=mysqli_fetch_array($result)){ $i++;
                echo ' <table class="table table-condensed">
                <tr><td colspan="2"><div class="alert alert-success">customer Record Already Exists</div></td></tr>
                
                <tr><td>Name:</td><td>'.$rw['name'].'</td></tr>
                <tr><td>C ID:</td><td>'.$rw['c_id'].'</td></tr>
                <tr><td>Phone:</td><td>'.$rw['cell'].'</td></tr>
                <tr><td>Pin-Code:</td><td>'.$rw['pin_code'].'</td></tr>
                <tr><td>Address:</td><td>'.$rw['address'].'</td></tr>
                <input type="hidden" name="existed" value="existed"   required="required">
                <input type="hidden" name="c_id" value="'.$rw['c_id'].'"   required="required">
                </table>';
                }}else{
                    echo ' <div class="form-group row">

                    <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" value='.$rec.' name="c_id" 
                                    placeholder="Coustomer Id" required="required">
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
                        </div>';
                }
                    
                
                }



                public function c_record($rec,$dat)
                {
                    $string  = "select * from `invice` where c_id='$rec' group by c_id";
                    $stringtwo = "select * from `products` where c_id='$rec' && date='$dat' ";
                if(mysqli_query($this->con, $string))
                {
                


                $result=  mysqli_query($this->con, $string);
                $resulttwo=  mysqli_query($this->con, $stringtwo);
                



                $value ='<div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="invoice-title">
                            <span><span>C ID: '.$_GET['p'].'</span><span style="float:right;">Date:'.$dat.'</span></span>
                            <center><h2> Company Name</h2></center>
                        </div>
                        ';
                while($rw=mysqli_fetch_array($result)){ $i++;
                        $value .='<table class="table" id="dataTable" width="100%" cellspacing="0" onmouseover="myfun()" onmouseout="myfuntw()">
                        <tr><td>
                        <div class="row">
                            <div class="col-xs-12" >
                            <button id="myDIV" class="btn btn-circle btn-sm btn-info" style="display:none;" data-toggle="modal" data-target="#UpdateAddress" ><i class="fa fa-plus"></i></button>
                                <address >
                                <strong >Billed To:</strong>
                                    '.$rw['name'].'<br>
                                    '.$rw['cell'].'<br>
                                    '.nl2br($rw['address']).'<br>
                                    '.$rw['pin_code'].'
                                </address>
                            </div>
                            </td>

                            <td>
                            <div class="col-xs-6 text-left">
                                <address>
                                <strong>Office: </strong>Noida sector 53 C Block <br> Building
                                No 297 4th Floor, near <br>Kanchanjunga Market,
                                Uttar Pradesh 20130
                                </address>
                            </div>
                        </div>
                        </td>
                        </tr>
                        </table>
                    
                    </div>
                </div>';
                }
                $value .='<div class="row" >
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" ><strong>Order summary</strong></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed" >
                                        <thead>
                                            <tr>
                                                <td><strong>Item</strong></td>
                                                <td class="text-center"><strong>Price</strong></td>
                                                <td class="text-center"><strong>Discount</strong></td>
                                                <td class="text-center"><strong>Quantity</strong></td>
                                                <td class="text-right"><strong>Totals</strong></td>
                                            </tr>
                                        </thead>
                                        
                                                
                                        <tbody>';


                                        while($row_two=mysqli_fetch_array($resulttwo)){                           
                                        $value .='<tr onmouseover="myfunrow'.$row_two['p_id'].'()" onmouseout="myfuntwrow'.$row_two['p_id'].'()" >
                                        <td style="display:none;" id="myrow'.$row_two['p_id'].'"> 
                                        <button class="btn btn-circle btn-sm btn-info" data-toggle="modal" data-target="#Updateprod'.$row_two['p_id'].'" ><i class="fa fa-plus"></i></button>
                                        <a href="invoice.php?id=delete&p='.$row_two['p_id'].'&page=products&vl='.$row_two['c_id'].'&p_id='.$row_two['p_id'].'&dat='.$row_two['date'].'" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>

                                                <td>'.$row_two['p_name'].'</td>
                                                <td class="text-center">&#8377;'.$row_two['s_price'].'</td>
                                                <td class="text-center">&#8377;'.($row_two['p_price']-$row_two['s_price']).'</td>
                                                <td class="text-center">'.$row_two['p_qty'].'</td>
                                                <td class="text-right">&#8377; '.$row_two['p_qty'] * $row_two['s_price'].'</td>
                                            </tr>';
                                            $total =$total + ($row_two['p_qty'] * $row_two['s_price']);

                                            $value .='<div class="modal fade" id="Updateprod'.$row_two['p_id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <form class="user" action="invoice.php?id=update_pro" method="post" enctype="multipart/form-data">
                                                            
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Addres</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                    <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control form-control-user" value="'.$row_two['p_name'].'" name="p_name[]"
                                                            placeholder="Product:" required="required">
                                                            <input type="hidden"  value="'.$row_two['c_id'].'" name="c_id" required="required">
                                                    </div>
                                                    <div class="col-sm-6">
                                                            <input type="text" class="form-control form-control-user"  value="'.$row_two['p_category'].'"  name ="p_category[]"
                                                            placeholder="Category:" required="required">
                                                    </div>
                                                    </div>
                    
                                                    <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input  type="number" class="form-control form-control-user"  value="'.$row_two['p_qty'].'"  name="p_qty[]"
                                                            placeholder=" Quentity:" required="required">
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                    <s> <input type="text" class="form-control form-control-user" value="'.$row_two['p_price'].'"  name="p_price[]"
                                                            placeholder=" Market Price:" required="required"></s>
                                                    </div>
                                                    </div>
                    
                                                    <div class="form-group row">
                    
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input  type="number" class="form-control form-control-user" value="'.$row_two['s_price'].'"  name ="s_price[]"
                                                            placeholder=" Selling Price:" required="required">
                                                            
                                                    </div>
                    
                                                    <div class="col-sm-6 ">
                                                        <input type="date" class="form-control form-control-user" value="'.$row_two['date'].'"  name="date[]"
                                                            placeholder="Date:" required="required">
                                                    </div>
                                                    </div>
                    
                                                    
                    
                    
                    
                    
                                                    
                                                    </div>
                                                    <div class="modal-footer">
                                                    <input type="hidden"  name ="dat" value="'.$row_two['date'].'"   required="required">
                                                    <input type="hidden"  name ="p_id" value="'.$row_two['p_id'].'"   required="required">
                            
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <button value="submit" name="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>';                    
                                        }

                                    
                                        $value .='<tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                                <td class="thick-line text-right"> &#8377;'.$total.'</td>
                                            </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>';
                echo $value;










                    
                }
                else
                {
                

                echo mysqli_error($this->con);

                }
                }


                }



                class Myclass extends database
                {
                
                public function home()
                {
                include "views/inser_data.php";
                }
                public function invoice()
                {
                include "views/invoice_list.php";

                }

                public function coustomer()
                {
                    include "views/coustomer.php";

                }
                function insert()
                {
                    if(isset($_POST['button'])){
                    
                        $arrayName = array(
                        
                            'name' => $_POST["name"], 
                            'c_id' => $_POST["c_id"], 
                            'pin_code' => $_POST["pin_code"], 
                            'cell' => $_POST["cell"], 
                            'address' => $_POST["address"]
                    );
                        

                    $cnt = count($_POST['p_name']);
                    for($i=0; $i < $cnt; $i++){
                    $arrayproduct = array(
                        'c_id' => $_POST["c_id"],
                        'p_name' => $_POST["p_name"][$i], 
                        'p_category' => $_POST["p_category"][$i], 
                        'p_qty' => $_POST["p_qty"][$i], 
                        'p_price' => $_POST["p_price"][$i],
                        's_price' => $_POST["s_price"][$i],
                        'date' => $_POST["date"][$i]
                    );
                    $tabletwo ="products";
                    $this->insrt($arrayproduct,$tabletwo,'existed');
                       
                    if(! $_POST['existed']){

                
                    
                    
                        $table ="invice";
                        $pro='invoice';
                       
                        if($i==0){
                        
                        $this->insrt($arrayName,$table, $pro);
                            }
                }
               
                    }
                    return $this->home();
                }
                }
                public function input(){
                    ?>                          <hr>
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
                                                    <input  type="number" class="form-control form-control-user"  name="p_qty[]"
                                                        placeholder=" Quentity:" required="required">
                                                </div>
                                                <div class="col-sm-6 ">
                                                <s> <input  type="number" class="form-control form-control-user"  name="p_price[]"
                                                        placeholder=" Market Price:" required="required"></s>
                                                </div>
                                                </div>

                                                <div class="form-group row">

                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input  type="number" class="form-control form-control-user"  name ="s_price[]"
                                                        placeholder=" Selling Price:" required="required">
                                                        
                                                </div>

                                                <div class="col-sm-6 ">
                                                    <input type="dae" class="form-control form-control-user"  name="date[]"
                                                        placeholder="Date:" value="<?php echo date("Y-m-d");  ?>" required="required">
                                                </div>
                                                </div>
                    <?php
                }
                public function updatemodal($cid){

                    

                    $string  = "select * from `invice` where c_id='$cid' group by c_id";
                    //$stringtwo = "select * from `products` where c_id='$rec'";

                $result=  mysqli_query($this->con, $string);
                //$resulttwo=  mysqli_query($this->con, $stringtwo);
                

                while($row=mysqli_fetch_array($result)){






                ?>
                                                    
                                            <div class="form-group row">

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control form-control-user" value="<?php echo $cid; ?>" name="c_id" 
                                                            placeholder="Coustomer Id" required="required" readonly>
                                                    </div>

                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-user" name="name"  
                                                        placeholder="Name" value="<?php echo $row['name']; ?>" required="required">
                                                    </div>
                                            
                                                    
                                                </div>





                                                    <div class="form-group row">
                                        
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="number" class="form-control form-control-user" name="pin_code"
                                                            placeholder=" Pin Code" required="required" value="<?php echo $row['pin_code']; ?>">
                                                    </div>
                                                
                                                




                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control form-control-user"   name="cell"
                                                        placeholder="Cell Number" required="required" value="<?php echo $row['cell']; ?>">
                                                </div>
                                                </div>

                                                <div class="form-group">
                                                    <textarea type="number" class="form-control form-control-user"  name="address"
                                                        placeholder="Address" required="required"><?php echo $row['address']; ?></textarea>
                                                </div>
                                            
                                                
                                                <?php

                }





                }

                public function updatemodalprod($cid){

                    

                    $string  = "select * from `invice` where c_id='$cid' group by c_id";
                    //$stringtwo = "select * from `products` where c_id='$rec'";

                $result=  mysqli_query($this->con, $string);
                //$resulttwo=  mysqli_query($this->con, $stringtwo);
                

                while($row=mysqli_fetch_array($result)){






                ?>
                                                    
                                            <div class="form-group row">

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control form-control-user" value="<?php echo $cid; ?>" name="c_id" 
                                                            placeholder="Coustomer Id" required="required" >
                                                    </div>

                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-user" name="name"  
                                                        placeholder="Name" value="<?php echo $row['name']; ?>" required="required">
                                                    </div>
                                            
                                                    
                                                </div>





                                                    <div class="form-group row">
                                        
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="number" class="form-control form-control-user" name="pin_code"
                                                            placeholder=" Pin Code" required="required" value="<?php echo $row['pin_code']; ?>">
                                                    </div>
                                                
                                                




                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control form-control-user"   name="cell"
                                                        placeholder="Cell Number" required="required" value="<?php echo $row['cell']; ?>">
                                                </div>
                                                </div>

                                                <div class="form-group">
                                                    <textarea type="number" class="form-control form-control-user"  name="address"
                                                        placeholder="Address" required="required"><?php echo $row['address']; ?></textarea>
                                                </div>
                                            
                                                
                                                <?php

                }





                }
                public function update_address(){
                    if(isset($_POST['submit'])){
                    

                        $arrayName = array(
                        
                            'name' => $_POST["name"], 
                            'c_id' => $_POST["c_id"], 
                            'pin_code' => $_POST["pin_code"], 
                            'cell' => $_POST["cell"], 
                            'address' => $_POST["address"]
                    );

                    $table ="invice";
                        $pro=$_POST["c_id"];
                        $dat =$_POST["date"];
                        $this->db_up_address($arrayName,$table, $pro,$dat,'');
                        
                    }
                }
                public function update_pro(){
                    if(isset($_POST['submit'])){
                    

                        $arrayName = array(
                        
                            'p_name' => $_POST["p_name"][0], 
                            'p_category' => $_POST["p_category"][0], 
                            'p_qty' => $_POST["p_qty"][0], 
                            'p_price' => $_POST["p_price"][0], 
                            's_price' => $_POST["s_price"][0],
                            'date' => $_POST["date"][0]
                    );

                    $table ="products";
                    $pid=$_POST["p_id"];
                    
                        $pro=$_POST["c_id"];
                        $dat =$_POST["dat"];
                        $this->db_up_address($arrayName,$table, $pro,$dat,$pid);
                        
                    }
                }

                public function delete(){
                    
                    $table=$_GET['page'];
                    $pid=$_GET['p'];
                    $cid=$_GET['vl'];
                    $dat=$_GET['dat'];
                    if($table=='products'){
                        $p_id=$_GET['p_id'];
                    $query="DELETE FROM `".$table."` WHERE `p_id`='".$p_id."'";
                    if(mysqli_query($this->con, $query))
                    {
                    $_SESSION['success']='Deleted Successfuly';
                    header("Location: invoice.php?id=coustomer&p=$cid&dat=$dat");
                        
                    }
                    else
                    {

                    $_SESSION['error']= mysqli_error($this->con);
                    header("Location: invoice.php?id=coustomer&p=$cid&dat=$dat");
                // print_r($string);
                        
                
                    } }else{
                    //////////////////////////////////////
                    $query="DELETE FROM `invice` WHERE `c_id`='".$pid."'";
                    $querynew="DELETE FROM `products` WHERE `c_id`='".$pid."'";
                    if(mysqli_query($this->con, $query) && mysqli_query($this->con, $querynew))
                    {
                    $_SESSION['success']='Deleted Successfully';
                    header("Location: invoice.php?id=invoice");
                        
                    }
                    else
                    {

                    $_SESSION['error']= mysqli_error($this->con);
                    header("Location: invoice.php?id=invoice");
                
                        
                
                    }
                    ////////////////////////////////////// 
                    }
                    
                }

                }
                $obj = new MyClass;
                $ids =$_GET['id'];
                if($ids){
                    $obj->$ids();
                }else{
                    $obj->home();
                }
                ?>