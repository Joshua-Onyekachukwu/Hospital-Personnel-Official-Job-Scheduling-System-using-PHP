<?php
require_once("includes/dbconnection.php");
if(!empty($_POST["deptid"])) 
{
$deptid=$_POST["deptid"];
$sql=$dbh->prepare("SELECT * FROM tblpersonel WHERE DepartmentID=:deptid");
$sql->execute(array(':deptid' => $deptid));	
?>
<option value="">Select personel</option>
<?php
while($row =$sql->fetch())
{
?>
<option value="<?php echo $row["ID"]; ?>"><?php echo $row["EmpName"]; ?></option>
<?php
}
}
?>