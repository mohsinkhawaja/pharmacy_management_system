<?php
$con=mysqli_connect("localhost","root","","newpharmacy");

$sqldisplay="select * from customers";
$rec=mysqli_query($con,$sqldisplay);

if(isset($_REQUEST['iddel']))
{
    $sqldel="delete from customers where c_id='".$_REQUEST['iddel']."'";
    if(mysqli_query($con,$sqldel))
    {
        echo "<script language='javascript1.2'>window.location='index.php?msg=Record Deleted Successfully';</script>";
    }
}
if(isset($_REQUEST['addrec']))
{
    $c_name = $_REQUEST['c_name'];
    $c_address= $_REQUEST['c_address'];
    $c_phone = $_REQUEST['c_phone'];
    $doc_name = $_REQUEST['doc_name'];
    $doc_address = $_REQUEST['doc_address'];

    $sqlinsert = "insert into  customers set c_name='".$c_name."',
    c_address='".$c_address."',
    c_phone='".$c_phone."',
    doc_name='".$doc_name."',
    doc_address='".$doc_address."'";

    
    if(mysqli_query($con, $sqlinsert))
    {
?>
<script language='javascript1.2'>window.location='index.php?msg=Record Added sucessfully';</script>";
<?php
}}
  if (isset($_REQUEST['action'])) 
{ 
  ?>
<form action="" method="post">  <! when we use get info will show in the url and it is security breach (post-info will not show in url -->
<table width="200" border="0" align="center">
  <tr>
    <td nowrap="nowrap">Enter Customer Name</td>
   <td> <input name="c_name" type="text" /></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Enter Customer address </td>
     <td> <input name="c_address" type="text" /></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Enter Customer Phone </td>
   <td> <input name="c_phone" type="text" /></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Enter Doctor Name </td>
   <td> <input name="doc_name" type="text" /></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Enter Doctor Address </td>
   <td> <input name="doc_address" type="text" /></td>
  </tr>
  <tr>
  <td nowrap="nowrap">  </td>
  <td><input name="addrec" type="submit" value="Add Record"/></td></tr>
</table>
</form>
<br>
<?php
}
?>

<?php
if(isset($_REQUEST['update']))
{
    $squp = "update customers set c_name='".$_REQUEST['c_name']."', c_address='".$_REQUEST['c_address']."', c_phone='".$_REQUEST['c_phone']."',doc_name='".$_REQUEST['doc_name']."',doc_address='".$_REQUEST['doc_address']."' where c_id='".$_REQUEST['c_id']."'";

    if(mysqli_query($con,$squp))
    {
        echo "<script language='javascript1.2'>window.location='index.php?msg=Record Updated Successfully';</script>";
    }
}

if(isset($_REQUEST['idup']))
{
    $sqll="select * from customers  where c_id='".$_REQUEST['idup']."'";
    $updisplay=mysqli_query($con,$sqll);
    $rowup=mysqli_fetch_array($updisplay);
?>
    <form id="form1" name="form1" method="post" action="index.php">
    <table width="200" border="1" align="center">
        <tr>
            <td nowrap="nowrap">ID</td>
            <td><input type="text" name="c_id" value="<?php echo $rowup['c_id']?>" readonly="readonly"/></td>
        </tr>
        <tr>
            <td nowrap="nowrap">Enter Customer Name </td>
            <td><input type="text" name="c_name" value="<?php echo $rowup['c_name']?>" /></td>
        </tr>
        <tr>
            <td nowrap="nowrap">Enter Customer Address</td>
            <td><input type="text" name="c_address" value="<?php echo $rowup['c_address']?>" /></td>
        </tr>
        <tr>
            <td>Enter  Customer Phone</td>
            <td><input type="text" name="c_phone" value="<?php echo $rowup['c_phone']?>" /></td>
        </tr>
        <tr>
            <td nowrap="nowrap">Enter Doctor Name </td>
            <td><input type="text" name="doc_name" value="<?php echo $rowup['doc_name']?>" /></td>
        </tr>
        <tr>
            <td nowrap="nowrap">Enter Doctor Address </td>
            <td><input type="text" name="doc_address" value="<?php echo $rowup['doc_address']?>" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><label><input type="submit" name="update" value="Update Record" /></label></td>
        </tr>
    </table>
    </form>
<?php
}
?>


<section id="main-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
							<tr >
<th>
</th>
<th>
</th><th>
</th>
                            <td  style="text-align: center;"><strong><a href="index.php?action=Add" style="text-decoration: none;">ADD NEW RECORD</a></strong></td>
    <th>
</th><th>
</th><th>
</th>
<th>
</th>
  </tr>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Customer Name </th>
                                    <th>Customer Address</th>
                                    <th>Customer Phone</th>
                                    <th>Doctor Name</th>
                                    <th>Doctor Address</th>
                                    <th> Action  </th>
                                
									
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($row=mysqli_fetch_array($rec))
                            {
                            ?>
                                <tr>
                 <td><?php echo $row['c_id']?></td>
                <td><?php echo $row['c_name']?></td>
              <td><?php echo $row['c_address']?></td>
             <td><?php echo $row['c_phone']?></td>
             <td><?php echo $row['doc_name']?></td>
             <td><?php echo $row['doc_address']?></td>
        
      
		 <td><?php if(isset($row['c_id'])) echo '<a href="index.php?iddel='.$row['c_id'].'">Delete</a>'; ?></td>



		<td><?php if(isset($row['c_id'])) echo '<a href="index.php?idup='.$row['c_id'].'">Update</a>'; ?></td>
                        
		
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="footer">
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
</section>