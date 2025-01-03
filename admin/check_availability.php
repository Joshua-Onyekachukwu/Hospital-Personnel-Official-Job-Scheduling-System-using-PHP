<?php
require_once("includes/dbconnection.php");


//code check Empid
if(!empty($_POST["empid"])) {
$empid=$_POST["empid"];
$sql ="SELECT empid FROM tblpersonel WHERE EmpId=:empid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':empid', $empid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
 
if($query -> rowCount() > 0)
echo "<span style='color:red'> Personel ID already assign to another personel.</span>";
else
 echo "<span style='color:green'> Personel ID avaialble for registration.</span>";
 
}

//code check Email
if(!empty($_POST["empemail"])) {
$empemail=$_POST["empemail"];
$sql ="SELECT EmpEmail FROM tblpersonel WHERE EmpEmail=:empemail";
$query= $dbh -> prepare($sql);
$query-> bindParam(':empemail', $empemail, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
 
if($query -> rowCount() > 0)
echo "<span style='color:red'> Email id already registered with another personel.</span>";
else
 echo "<span style='color:green'> Email Id avaialble for registration.</span>";
 
}

//code check mobile
if(!empty($_POST["empcontno"])) {
$empcontno=$_POST["empcontno"];
$sql ="SELECT EmpContactNumber FROM tblpersonel WHERE EmpContactNumber=:empcontno";
$query= $dbh -> prepare($sql);
$query-> bindParam(':empcontno', $empcontno, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
 
if($query -> rowCount() > 0)
echo "<span style='color:red'> Contact Number already registered with another personel.</span>";
else
 echo "<span style='color:green'> Contact Number avaialble for registration.</span>";
 
}