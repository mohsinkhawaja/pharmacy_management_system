<?php
$con=mysqli_connect("localhost","root","","newpharmacy");

$sqldisplay="select * from medicine";
$rec=mysqli_query($con,$sqldisplay);

if(isset($_REQUEST['iddel']))
{
    $sqldel="delete from medicine where m_id='".$_REQUEST['iddel']."'";
    if(mysqli_query($con,$sqldel))
    {
        echo "<script language='javascript1.2'>window.location='medicine_entrypoint.php?msg=Record Deleted Successfully';</script>";
    }
}
if(isset($_REQUEST['addrec']))
{
    $m_name = $_REQUEST['m_name'];
    $generic_name= $_REQUEST['generic_name'];
    $packing = $_REQUEST['packing'];
    $purchase_cost = $_REQUEST['purchase_cost'];
    $sell_cost = $_REQUEST['sell_cost'];

    $sqlinsert = "insert into medicine set m_name='".$m_name."',
    generic_name='".$generic_name."',
    packing='".$packing."',
    purchase_cost='".$purchase_cost."',
    sell_cost='".$sell_cost."'";

    
    if(mysqli_query($con, $sqlinsert))
    {
?>
<script language='javascript1.2'>window.location='medicine_entrypoint.php?msg=Record Added sucessfully';</script>";
<?php
}}
  if (isset($_REQUEST['action'])) 
{ 
  ?>
<form action="" method="post">  <! when we use get info will show in the url and it is security breach (post-info will not show in url -->
<table width="200" border="0" align="center">
<tr>
            <td nowrap="nowrap">Enter Medicine Name</td>
            <td><input name="m_name" type="text" /></td>
        </tr>
        <tr>
            <td nowrap="nowrap">Enter Medicine Generic Name</td>
            <td><input name="generic_name" type="text" /></td>
        </tr>
        <tr>
            <td nowrap="nowrap">Enter Packing</td>
            <td><input name="packing" type="text" /></td>
        </tr>
        <tr>
            <td nowrap="nowrap">Enter Purchase Cost</td>
            <td><input name="purchase_cost" type="text" /></td>
        </tr>
        <tr>
            <td nowrap="nowrap">Enter Sell Cost</td>
            <td><input name="sell_cost" type="text" /></td>
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
    $squp = "update medicine set m_name='".$_REQUEST['m_name']."', generic_name='".$_REQUEST['generic_name']."', packing='".$_REQUEST['packing']."',purchase_cost='".$_REQUEST['purchase_cost']."',sell_cost='".$_REQUEST['sell_cost']."' where m_id='".$_REQUEST['m_id']."'";


    if(mysqli_query($con,$squp))
    {
        echo "<script language='javascript1.2'>window.location='medicine_entrypoint.php?msg=Record Updated Successfully';</script>";
    }
}

if(isset($_REQUEST['idup']))
{
    $sqll="select * from medicine  where m_id='".$_REQUEST['idup']."'";
    $updisplay=mysqli_query($con,$sqll);
    $rowup=mysqli_fetch_array($updisplay);
?>
    <form id="form1" name="form1" method="post" action="medicine_entrypoint.php">
    <table width="200" border="1" align="center">
    <tr>
            <td nowrap="nowrap">ID</td>
            <td><input type="text" name="m_id" value="<?php echo $rowup['m_id']?>" readonly="readonly"/></td>
        </tr>
        <tr>
            <td nowrap="nowrap">Enter Medicine Name </td>
            <td><input type="text" name="m_name" value="<?php echo $rowup['m_name']?>" /></td>
        </tr>
        <tr>
            <td nowrap="nowrap">Enter Medicine Generic Name</td>
            <td><input type="text" name="generic_name" value="<?php echo $rowup['generic_name']?>" /></td>
        </tr>
        <tr>
            <td>Enter  Packing</td>
            <td><input type="text" name="packing" value="<?php echo $rowup['packing']?>" /></td>
        </tr>
        <tr>
            <td>Enter  Purchase Cost</td>
            <td><input type="text" name="purchase_cost" value="<?php echo $rowup['purchase_cost']?>" /></td>
        </tr>
        <tr>
            <td>Enter  Sell Cost</td>
            <td><input type="text" name="sell_cost" value="<?php echo $rowup['sell_cost']?>" /></td>
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
                            <td  style="text-align: center;"><strong><a href="medicine_entrypoint.php?action=Add" style="text-decoration: none;">ADD NEW RECORD</a></strong></td>
    <th>
</th><th>
</th><th>
</th>
<th>
</th>
  </tr>
                                <tr>
                                    <th>Medicine ID</th>
                                    <th>Medicine Name</th>
                                    <th>Medicine Generic Name</th>
                                    <th>Packing</th>
                                    <th>Purchase Cost</th>
                                    <th>Sell Cost</th>
                                    <th> Action  </th>
                                
									
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($row=mysqli_fetch_array($rec))
                            {
                            ?>
                                <tr>
                                <td><?php echo $row['m_id']?></td>
                                    <td><?php echo $row['m_name']?></td>
                                    <td><?php echo $row['generic_name']?></td>
                                    <td><?php echo $row['packing']?></td>
                                    <td><?php echo $row['purchase_cost']?></td>
                                    <td><?php echo $row['sell_cost']?></td>
        
      
		 <td><?php if(isset($row['m_id'])) echo '<a href="medicine_entrypoint.php?iddel='.$row['m_id'].'">Delete</a>'; ?></td>



		<td><?php if(isset($row['m_id'])) echo '<a href="medicine_entrypoint.php?idup='.$row['m_id'].'">Update</a>'; ?></td>
                        
		
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