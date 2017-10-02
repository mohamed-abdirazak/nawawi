<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
    header('location: login.php');
}
// header("location: guestlist.php");
?>

<?php
$host ="localhost";
$user = "root";
$pswd = "";
$db = "simpledata";
$id="";
$studentname="";
$gender="";
$mothername="";
$guardianname="";
$guardiantell="";
$guardianoccupation="";
$pob="";
$address="";
$dob="";
$phone="";
$level="";
$classname="";
$section="";
$branch="";
$nationality="";
$registrationdate="";
$image="";


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//$conn = mysqli_connect($host,$user,$pswd,$db);//(MySQLi Procedural)
$conn = new mysqli($host,$user,$pswd,$db);//(MySQLi Object-oriented)

$data =array();
function getData()
{

$data[0] =$_POST['id'];
$data[1] =$_POST['studentname'];
$data[2] =$_POST['gender'];
$data[3] =$_POST['mothername'];
$data[4] =$_POST['guardianname'];
$data[5] =$_POST['guardiantell'];
$data[6] =$_POST['guardianoccupation'];
$data[7] =$_POST['pob'];
$data[8] =$_POST['address'];
$data[9] =$_POST['dob'];
$data[10] =$_POST['phone'];
$data[11] =$_POST['level'];
$data[12] =$_POST['classname'];
$data[13] =$_POST['section'];
$data[14] =$_POST['branch'];
$data[15] =$_POST['nationality'];
$data[16] =$_POST['registrationdate'];
$data[17] =$_POST['image'];


return $data;
}

if (isset($_POST['searchid'])) {
    $info = getData();
    $sql = "SELECT *FROM registration WHERE ID= '$info[0]'";
    $search_result =mysqli_query($conn,$sql);
if (mysqli_num_rows($search_result)){
 while ($rows=mysqli_fetch_array($search_result)) {

$id=$rows['ID'];
$studentname=$rows['studentname'];
$gender=$rows['gender'];
$mothername=$rows['mothername'];
$guardianname=$rows['guardianname'];
$guardiantell=$rows['guardiantell'];
$guardianoccupation=$rows['guardianoccupation'];
$pob=$rows['pob'];
$address=$rows['address'];
$dob=$rows['dob'];
$phone=$rows['phone'];
$level=$rows['level'];
$classname=$rows['classname'];
$section=$rows['section'];
$branch=$rows['branch'];
$nationality=$rows['nationality'];
$registrationdate=$rows['registrationdate'];
$image=$rows['image'];
}
}
}

// Update Command
// sql to delete a record
if (isset($_POST['update'])) {
      $info = getData();
$sql = "UPDATE registration SET studentname='$info[1]',gender='$info[2]',mothername='$info[3]',guardianname='$info[4]',guardiantell='$info[5]',guardianoccupation='$info[6]',pob='$info[7]',address='$info[8]',dob='$info[9]',phone='$info[10]',level='$info[11]',classname='$info[12]'
,section='$info[13]',branch='$info[14]',nationality='$info[15]',registrationdate='$info[16]',image='$info[17]'WHERE ID='$info[0]'";
if ($conn->query($sql)===TRUE) {
    header('location:data.php');
}

}


if(isset($_GET['Delete'])){
    $sql = "SELECT * FROM registration ";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $id=$row['ID'];
    //$idDelete = $_GET['idDelete'];
    $sql = "DELETE FROM registration WHERE  ID='$id'";
    if($conn->query($sql)===TRUE) {
        header("location: data.php");
    }
    else { ?>
        <script>
            alert("failed to delete");
            window.location.href='searchs.php';
        </script>
        <?php
        echo "failed to delete";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>
    <script src="jquery-3.2.1.js"></script>
    <!-- Bootstrap -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.min.js"></script>
    <style>
th{
	  background:black;
	  color:white;
	  text-align:center;}</style>

  </head>
  <body>



  
<?php

    $conn = new mysqli("localhost", "root", "", "simpledata");
    if(isset($_POST["query"]))
    {
        $search = mysqli_real_escape_string($conn, $_POST["query"]);
        $query = "
  
  
       SELECT * FROM registration 
        WHERE studentname LIKE '%".$search."%'
      
        ";
    }
    else
    {
        $query = " SELECT * FROM registration ORDER BY ID ";
    }
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    { ?>
        <div class="table-responsive">
            <table class="table table-striped table-condensed table-hover table-bordered">
                <tr>
                <th>ID</th>
					<th>Student name</th>
					<th>Gender</th>
					<th>Mother name</th>
					<th>Guardian name</th>
          <th>Gardian relation</th>
                    <th>Guardian tell</th>
					<th>Guardian occupation</th>
					<th>POB</th>
					<th>Address</th>
					<th>DOB</th>
                    <th>Phone</th>
					<th>Level</th>
					<th>Class name</th>
					<th>Section</th>
					<th>Branch</th>
                    <th>Nationality</th>
					<th>Registration date</th>
					<th>Image</th>
				    <th>Edit </th>
					<th>Delete</th>    
                </tr>       
        <?php
            while($row = mysqli_fetch_array($result)){ ?>
                <tr>
                    <td><?php echo $row['ID'] ?></td>
					<td><?php echo $row['studentname'] ?></td>
					<td><?php echo $row['gender'] ?></td>
                    <td><?php echo $row['mothername'] ?></td>
					<td><?php echo $row['guardianname'] ?></td>
          	<td><?php echo $row['guardianrelation'] ?></td>
					<td><?php echo $row['guardiantell'] ?></td>
                    <td><?php echo $row['guardianoccupation'] ?></td>
					<td><?php echo $row['pob'] ?></td>
					<td><?php echo $row['address'] ?></td>
                    <td><?php echo $row['dob'] ?></td>
					<td><?php echo $row['phone'] ?></td>
					<td><?php echo $row['level'] ?></td>
                     <td><?php echo $row['classname'] ?></td>
					<td><?php echo $row['section'] ?></td>
					<td><?php echo $row['branch'] ?></td>
                     <td><?php echo $row['nationality'] ?></td>
					<td><?php echo $row['registrationdate'] ?></td>
					<td><?php echo $row['image'] ?></td>
                    <td>
<button type="submit" class="btn btn-xm btn-success" data-toggle="modal" data-target="#edit-<?php echo $row['ID']; ?>">Edit</button>

<div class="modal fade" id="edit-<?php echo $row['ID']; ?>" role="dialog">
    <div class="modal-dialog modal-header-primary">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Modify </h4>
            </div>
            <div class="modal-body">
  <form class="form-group" method="POST" >
    <input type="hidden" name="id" id="#edit-<?php echo $row['ID']; ?>" class="form-control" value="<?php echo $row['id']; ?>">
  <div class="form-group">
    <label for="text">ID:</label>&nbsp;&nbsp;&nbsp;
    <input type="text" style="width:100px;"class="form-control" placeholder="StudentID" value="<?php echo $row['ID']; ?>" id="#edit-<?php echo $row['ID']; ?>" name="id"> 
  </div> 
  <div class="form-inline">
    <label>Student name: </label>
    <input type="text" class="form-control"  style="width:315px;" value="<?php echo $row['studentname']; ?>" id="#edit-<?php echo $row['ID']; ?>" placeholder="Student name" name="studentname">
  </div> 
<p>

  <div class="form-inline">
    <label for="text"> Mother name :  </label>
    <input type="text" class="form-control"  value="<?php echo $row['mothername']; ?>" id="#edit-<?php echo $row['ID']; ?>"name="mothername" placeholder="Mother name">
  </div><p>

 
  <div class="form-inline">
    <label>Guardian name:  </label>
    <input type="text" class="form-control" value="<?php echo $row['guardianname']; ?>" id="#edit-<?php echo $row['ID']; ?>"style="width:315px;"name="guardianname" placeholder="Guardian name">
  </div><p>


  
   <div class="form-inline">
    <label for="text">Guardian relation : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <select style="width:315px ; height:33px;"name="guardianrelation"  value="<?php echo $row['guardianrelation']; ?>" id="#edit-<?php echo $row['ID']; ?>">
  <option style="font-size:15px;font-family:verdana;" >Mother</option>
  <option style="font-size:15px;font-family:verdana;" >Father</option>
  <option style="font-size:15px;font-family:verdana;" >sister</option>
  <option style="font-size:15px;font-family:verdana;" >Aunt</option>
  <option style="font-size:15px;font-family:verdana;" >brother</option>
  <option style="font-size:15px;font-family:verdana;">grand Father</option>
  <option style="font-size:15px;font-family:verdana;" >grand Mother</option>
  <option style="font-size:15px;font-family:verdana;">Ancle</option>
  <option style="font-size:15px;font-family:verdana;">relative</option>
  
</select>

   </div><p>
   
   <div class="form-inline">
    <label for="text">Guardian Tell:  </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" class="form-control"  value="<?php echo $row['guardiantell']; ?>" id="#edit-<?php echo $row['ID']; ?>" style="width:315px ; height:33px;"
    name="guardiantell" placeholder="Guardian phone NO:"size="15px">
  </div> <p>

<div class="form-inline">
    <label for="text">Guardian occupation:  </label> &nbsp;
    <input type="text" class="form-control" value="<?php echo $row['guardianoccupation']; ?>" id="#edit-<?php echo $row['ID']; ?>"  style="width:315px ; height:33px;"
    name="guardianoccupation" placeholder="Guardian Occupation">
  </div> <p>

  <div class="form-inline">
    <label for="text">Place Of Brith:  </label> &nbsp;
    <input type="text"style="width:338px ; height:33px;"  class="form-control"  value="<?php echo $row['pob']; ?>" id="#edit-<?php echo $row['ID']; ?>" name="pob"size="15px" placeholder="place Of Brith" >
  </div><p>
   <div class="form-inline">
    <label for="text">Date Of Brith :  </label> &nbsp;&nbsp; 
    <input type="date" class="form-control" value="<?php echo $row['ID']; ?>" id="#edit-<?php echo $row['dob']; ?>" style="width:338px ; height:33px;"  name="dob" placeholder="Date Of Birth" >
  </div> <p>

   <div class="form-inline">
    <label for="text">Gender : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <select style="width:350px ; height:33px;" name="gender" id="gender">
  <option style="font-size:15px;font-family:verdana;" >Male</option>
  <option style="font-size:15px;font-family:verdana;" >Female</option>
</select>
  </div> <p>
 <div class="form-inline">
    <label>Nationality :  </label> &nbsp;&nbsp;&nbsp;
    <input type="text" class="form-control" style="width:350px ; height:33px;"  value="<?php echo $row['nationality']; ?>" id="#edit-<?php echo $row['ID']; ?>" name="nationality"placeholder="nationality">
  </div><p>

  <div class="form-inline">
    <label for="text">Address :  </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" class="form-control"style="width:350px ; height:33px;"   value="<?php echo $row['address']; ?>" id="#edit-<?php echo $row['ID']; ?>" name="address" placeholder="Address" >
  </div> 
<p>
  
   <div class="form-inline">
    <label for="text">Phone NO:  </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" class="form-control" style="width:350px ; height:33px;"  value="<?php echo $row['phone']; ?>" id="#edit-<?php echo $row['ID']; ?>"name="phone" placeholder="Student phone number">
  </div><p>

   <div class="form-group">&nbsp;&nbsp;
    <label>Level : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <select   style="width:350px ; height:33px;" name="level"  value="<?php echo $row['level']; ?>" id="#edit-<?php echo $row['ID']; ?>">
  <option >Kindergartner</option>
  <option >Primary</option>
  <option>Secondary</option>
  
</select>
  </div>
   <div class="form-group">
    <label for="text">Class name : </label>&nbsp;&nbsp;
  <select style="width:350px ; height:33px;" name="classname"  value="<?php echo $row['classname']; ?>" id="#edit-<?php echo $row['ID']; ?>">
  <option >Kindergartner</option>
  <option >Grade One</option>
  <option >Grade Two</option>
  <option >Grade Three</option>
  <option >Grade Four</option>
  <option>Grade Five</option>
  <option >Grade Six</option>
  <option>Grade Seven</option>
  <option>Grade Eight</option>
  <option>Form One</option>
  <option>Form Two</option>
  <option>Form Three</option>
  <option>Form Four</option>
  
</select>
  </div> 


   <div class="form-group">&nbsp;&nbsp;
    <label for="text">Section : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <select style="width:350px ; height:33px;" name="section"  value="<?php echo $row['section']; ?>" id="#edit-<?php echo $row['ID']; ?>">
  <option>A</option>
   <option>B</option>
    <option>C</option>
     <option>D</option>
      <option>E</option>
       <option>F</option>
        <option>G</option>
         <option>H</option>
          <option>I</option>
           <option>J</option>
            <option>K</option>
             <option>L</option>
              <option>M</option>
               <option>N</option>
                <option>O</option>
                 <option>P</option>
                  <option>Q</option>
                   <option>R</option>
                    <option>S</option>
                     <option>T</option>
                      <option>V</option>
                       <option>U</option>
                        <option>W</option>
                         <option>X</option>
                          <option>Y</option>
                           <option>Z</option>
                       
            
  
  
</select>
  </div> 
 
<div class="form-group">&nbsp;&nbsp;
    <label for="text">Branch : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <select  style="width:350px ; height:33px;" name="branch"  value="<?php echo $row['branch']; ?>" id="#edit-<?php echo $row['ID']; ?>">
  <option>Nawawi</option>
  <option>Ridwaan</option>
  <option>Raxmana</option>
  
</select>
</div>


<div class="form-inline">
    <label for="text">Register Date :  </label>
    <input type="date" class="form-control"  style="width:350px ; height:33px;"  value="<?php echo $row['registrationdate']; ?>" id="#edit-<?php echo $row['ID']; ?>" name="registrationdate" >
  </div>
  <label class="btn btn-success btn-file">
    Browse... <input type="file" value="<?php echo $row['image']; ?>" style="display: none;" onchange="readURL(this);" name="image" style="width:140px ; height:32px;">
     <img id="blah" src="#" alt="your image" /></label><br><br>
            </div>
            
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form method="POST">
        <button type="submit" class="btn btn-success" name="update" id="#edit-<?php echo $row['ID']; ?>">Update</button></form>
      </div>
      </form>
 </div>
   </div>
  </div>
  </div>
   
   </td>
					 <form class="form-group" > 
					<td>
            <a href="?idDelete=<?php echo $row['ID'] ?>">
            <button name="Delete" type="submit" class="btn btn-danger">
              <i class="fa fa-trash fa-lg"></i> 
            Delete</button></a>
                      
          </td></form>
                  
                </tr> <?php 
            }
    }
else{
 echo 'Data Not Found';}
echo "</table></div>";
?>















  </body>
</html>