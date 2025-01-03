<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['etmsempid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {
    
    $vid=$_GET['viewid'];
    $status=$_POST['status'];
   $remark=$_POST['remark'];
   $workcom=$_POST['workcom'];
    $sql="insert into tblscheduletracking(SceduleID,Remark,Status,WorkCompleted) value(:vid,:remark,:status,:workcom)";
    $query=$dbh->prepare($sql);
$query->bindParam(':vid',$vid,PDO::PARAM_STR);
    $query->bindParam(':remark',$remark,PDO::PARAM_STR); 
    $query->bindParam(':status',$status,PDO::PARAM_STR); 
    $query->bindParam(':workcom',$workcom,PDO::PARAM_STR);
       $query->execute();
      $sql= "update tblschedule set Status=:status,Remark=:remark,WorkCompleted=:workcom where ID=:vid";

    $query=$dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':remark',$remark,PDO::PARAM_STR);
$query->bindParam(':workcom',$workcom,PDO::PARAM_STR);
$query->bindParam(':vid',$vid,PDO::PARAM_STR);
 $query->execute();
 echo '<script>alert("Remark has been updated")</script>';
 echo "<script>window.location.href ='all-schedule.php'</script>";
}

  ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      
      <title>HOSPITAL PERSONEL OFFICIAL JOB SCHEDULING SYSTEM || View New Schedule</title>
   
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
      <!-- fancy box js -->
      <link rel="stylesheet" href="css/jquery.fancybox.css" />
      
   </head>
   <body class="inner_page tables_page">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
          <?php include_once('includes/sidebar.php');?>
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
                              <h2> Schedule Details</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">
                     
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>View  Schedule Details</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                    <?php
                                           $vid=$_GET['viewid'];
$sql="SELECT tblschedule.ID as tid,tblschedule.ScheduleTitle,tblschedule.ScheduleDescription,tblschedule.SchedulePriority,tblschedule.ScheduleEduedate,tblschedule.Status,tblschedule.WorkCompleted,tblschedule.Remark,tblschedule.UpdationDate,tblschedule.DeptID,tblschedule.AssignScheduleto,tblschedule.ScheduleEduedate,tblschedule.ScheduleAssigndate,tbldepartment.DepartmentName,tbldepartment.ID as did,tblpersonel.EmpName,tblpersonel.EmpId from tblschedule join tbldepartment on tbldepartment.ID=tblschedule.DeptID join tblpersonel on tblpersonel.ID=tblschedule.AssignScheduleto where tblschedule.ID=:vid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':vid', $vid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?> 
                                   <table class="table table-bordered" style="color:#000">
                                    <tr>
    <th colspan="6" style="color: orange;font-weight: bold;font-size: 20px;text-align: center;">Schedule Details </th>
  </tr>
  <tr>
    <th>Schedule Title</th>
    <td><?php  echo $row->ScheduleTitle;?></td>
     <th>Schedule Priority</th>
    <td><?php  echo $row->SchedulePriority;?></td>
  </tr>
  <tr>
    <th>Schedule Description</th>
    <td colspan="3"><?php  echo $row->ScheduleDescription;?></td>
 </tr>
 <tr>
     <th>Schedule Assign Date</th>
    <td colspan="3"><?php  echo $row->ScheduleAssigndate;?></td>
  </tr>

 <tr>
     <th>Schedule Finish Date</th>
    <td colspan="3"><?php  echo $row->ScheduleEduedate;?></td>
  </tr>

  <tr>
     
         <th>Personel Final Remark</th>
    <?php if($row->Status==""){ ?>

                     <td  colspan="4"><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  
  <td colspan="4"><?php  echo htmlentities($row->Remark);?>
                  </td>
  </tr>

  <tr>
   
    <th>Schedule Final Status</th>
   <td colspan="3"> <?php  $status=$row->Status;
    
if($row->Status=="Inprogress")
{
  echo "In Progress";
}

if($row->Status=="Completed")
{
 echo "Completed";
}


if($row->Status=="")
{
  echo "Not Response Yet";
}


     ;?></td>

                  <?php } ?>  

  </tr>

  <?php $cnt=$cnt+1;}} ?>
</table>

<?php 
$vid=$_GET['viewid']; 
   if($status!=""){
$ret="select tblscheduletracking.Remark,tblscheduletracking.Status,tblscheduletracking.UpdationDate,tblscheduletracking.WorkCompleted,tblscheduletracking.SceduleID from tblscheduletracking where tblscheduletracking.SceduleID =:vid";
$query = $dbh -> prepare($ret);
$query-> bindParam(':vid', $vid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
 ?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="color: #000;border-collapse: collapse; border-spacing: 0; width: 100%;">
  <tr align="center">
   <th colspan="5" style="color:" >schedule  History</th> 
  </tr>
  <tr>
    <th>#</th>
<th>Remark</th>
<th>Status</th>
<th>Schedule Progress</th>
<th>Time</th>
</tr>
<?php  
foreach($results as $row)
{               ?>
<tr>
  <td><?php echo $cnt;?></td>
 <td><?php  echo $row->Remark;?></td> 
  <td><?php  echo $row->Status;
?></td> 
<td>
<span class="skill" style="width:90%;">schedule Progress<span class="info_valume"><?php  echo $row->WorkCompleted;?>%</span> </span>

   <div class="progress skill-bar ">
                                       <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="<?php  echo $row->WorkCompleted;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php  echo $row->WorkCompleted;?>%;"></div>
                                    </div></td>
   <td><?php  echo $row->UpdationDate;?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>
<?php  }  
?>


<?php 

if ($status=="" || $status=="Inprogress"){
?> 
<p align="center"  style="padding-top: 20px">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Take Action</button></p>  

<?php } ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content" style="width:150%">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Take Action</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">
                                <form method="post" name="submit">
     <tr>
    <th width="300">Remark :</th>
    <td>
    <textarea name="remark" placeholder="Remark" rows="12" cols="14" class="form-control wd-650" required="true"></textarea></td>
  </tr> 
   <tr>
    <th>Work Completion(in percentage) :</th>
    <td>
    <input name="workcom" placeholder="Work Completion in percentage (Eg: 20)" pattern="[0-9]+" title="only numbers" rows="12" cols="14" class="form-control wd-450" required="true"></td>
  </tr> 
  <tr>
    <th>Status :</th>
    <td>
   <select name="status" class="form-control wd-450" required="true" >
     <option value="Inprogress" selected="true">Inprogress</option>
     <option value="Completed">Completed</option>
   </select></td>
  </tr>
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="submit" name="submit" class="btn btn-primary">Update</button>
  </form>
</div>
</div>
</div>
</div> 
                                 </div>
                              </div>
                           </div>
                        </div>
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
      <!-- fancy box js -->
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/jquery.fancybox.min.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <!-- calendar file css -->    
      <script src="js/semantic.min.js"></script>
   </body>
</html><?php } ?>