<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['etmsaid']==0)) {
  header('location:logout.php');
  } else{


  ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      
      <title>HOSPITAL PERSONEL OFFICIAL JOB SCHEDULING SYSTEM || View New schedule</title>
   
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
                              <h2>Schedule Details</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">
                     
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Schedule Details</h2>
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
   <th colspan="5" style="color:" >Schedule  History</th> 
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
<span class="skill" style="width:90%;">Schedule Progress<span class="info_valume"><?php  echo $row->WorkCompleted;?>%</span> </span>

   <div class="progress skill-bar ">
                                       <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="<?php  echo $row->WorkCompleted;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php  echo $row->WorkCompleted;?>%;"></div>
                                    </div></td>
   <td><?php  echo $row->UpdationDate;?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>
<?php  }  
?>



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