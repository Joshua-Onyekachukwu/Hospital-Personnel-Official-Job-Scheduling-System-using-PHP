<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['etmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

 $deptid=$_POST['deptid'];
 $emplist=$_POST['emplist'];
 $tpriority=$_POST['tpriority'];
 $ttitle=$_POST['ttitle'];
 $tdesc=$_POST['tdesc'];
 $tedate=$_POST['tedate'];
 $eid=$_GET['editid'];
$sql="update tblschedule set DeptID=:deptid,AssignScheduleto=:emplist,SchedulePriority=:tpriority,ScheduleTitle=:ttitle,ScheduleDescription=:tdesc,ScheduleEduedate=:tedate where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':deptid',$deptid,PDO::PARAM_STR);
$query->bindParam(':emplist',$emplist,PDO::PARAM_STR);
$query->bindParam(':tpriority',$tpriority,PDO::PARAM_STR);
$query->bindParam(':ttitle',$ttitle,PDO::PARAM_STR);
$query->bindParam(':tdesc',$tdesc,PDO::PARAM_STR);
$query->bindParam(':tedate',$tedate,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
  echo '<script>alert("schedule detail has been updated")</script>';
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>HOSPITAL PERSONEL OFFICIAL JOB SCHEDULING SYSTEM || Update schedule</title>
    
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="css/custom.css" />
      <!-- calendar file css -->
      <link rel="stylesheet" href="js/semantic.min.css" />
     
   </head>
   <body class="inner_page general_elements">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
           <?php include_once('includes/sidebar.php');?>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
               <?php include_once('includes/header.php');?>
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Update schedule</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column8 graph">
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Update schedule</h2>
                                 </div>
                              </div>
                              <div class="full progress_bar_inner">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="full">
                                          <div class="padding_infor_info">
                                             <div class="alert alert-primary" role="alert">
                                                <form method="post">
                                                   <?php
$eid=$_GET['editid'];
$sql="SELECT tblschedule.ID as tid, tblschedule.ScheduleTitle, tblschedule.DeptID,tblschedule.SchedulePriority,tblschedule.SchedulePriority,tblschedule.AssignScheduleto,tblschedule.ScheduleDescription,tblschedule.ScheduleEduedate,tblschedule.ScheduleAssigndate,tblschedule.ScheduleTitle,tbldepartment.DepartmentName,tbldepartment.ID as did,tblpersonel.EmpName,tblpersonel.EmpId from tblschedule join tbldepartment on tbldepartment.ID=tblschedule.DeptID join tblpersonel on tblpersonel.ID=tblschedule.AssignScheduleto where tblschedule.ID=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                        
                        <fieldset>
                            <div class="field">
                              <label class="label_field">Department Name</label>
                              <select type="text" name="deptid" value="" class="form-control" required='true'>
                                 <option value="<?php echo htmlentities($row->DeptID);?>"><?php echo htmlentities($row->DepartmentName);?></option>
                                  <?php 

$sql2 = "SELECT * from   tbldepartment ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row2)
{          
    ?>  
   
<option value="<?php echo htmlentities($row2->ID);?>"><?php echo htmlentities($row2->DepartmentName
    );?></option>
 <?php } ?>
                              </select>
                           </div>
                           <br>
                           <div class="field">
                              <div class="field">
                              <label class="label_field">Personel List</label>
                              <select type="text" name="emplist" value="" class="form-control" required='true'>
                                 <option value="<?php echo htmlentities($row->AssignScheduleto);?>"><?php echo htmlentities($row->EmpName);?>(<?php echo htmlentities($row->EmpId);?>)</option>
                                  <?php 

$sql2 = "SELECT * from   tblpersonel ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row3)
{          
    ?>  
   
<option value="<?php echo htmlentities($row3->ID);?>"><?php echo htmlentities($row3->EmpName
    );?>(<?php echo htmlentities($row3->EmpId
    );?>)</option>
 <?php } ?>
                              </select>
                           </div>
                           </div>
                           <br>
                          <div class="field">
                              <div class="field">
                              <label class="label_field">Schedule Priority</label>
                              <select type="text" name="tpriority" class="form-control" required='true'>
                                 <option value="<?php echo htmlentities($row->SchedulePriority);?>"><?php echo htmlentities($row->SchedulePriority);?></option>
                                 <option value="Normal">Normal</option>
                                 <option value="Medium">Medium</option>
                                 <option value="Urgent">Urgent</option>
                                 <option value="Most Urgent">Most Urgent</option>
                                
                              </select>
                           </div>
                           </div>
<br>
                           <div class="field">
                              <label class="label_field">Schedule Title</label>
                              <input type="text" name="ttitle" value="<?php echo htmlentities($row->ScheduleTitle);?>" class="form-control" required='true'>
                           </div>
                           <br>
                           <div class="field">
                              <label class="label_field">Schedule Description</label>
                              <textarea type="text" name="tdesc" value="" class="form-control" required='true'><?php echo htmlentities($row->ScheduleDescription);?></textarea>
                           </div>
                           <br>
                            <div class="field">
                              <label class="label_field">Schedule Due Date</label>
                              <input type="date" name="tedate" value="<?php echo htmlentities($row->ScheduleEduedate);?>" class="form-control" required='true'>
                           </div> <?php $cnt=$cnt+1;}} ?>
                           <br>
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <button class="main_bt" type="submit" name="submit" id="submit">Add</button>
                           </div>
                        </fieldset>
                     </form></div>
                                            
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- funcation section -->
                     
                     </div>
                  </div>
                  <!-- footer -->
                 <?php include_once('includes/footer.php');?>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
         <!-- model popup -->
    
      </div>
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script> 
      <!-- chart js -->
      <script src="js/Chart.min.js"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="js/utils.js"></script>
      <script src="js/analyser.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <!-- calendar file css -->    
      <script src="js/semantic.min.js"></script>
   </body>
</html><?php } ?>