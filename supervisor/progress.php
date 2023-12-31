<?php 
include "../config/database.php" ;
session_start();
if(isset($_SESSION['userid'])){
    $user_id = $_SESSION['userid'];
  $sql = "SELECT * FROM supervisor WHERE username = '$user_id'";
  $result = mysqli_query($conn,$sql);
  $output = mysqli_fetch_all($result,MYSQLI_ASSOC); 
  $user_details = $output[0];
  $user_name = $user_details['username'];
  $sql2 = "SELECT * FROM supervisor WHERE username = '$user_name'";
  $result2 = mysqli_query($conn,$sql2);
  $output2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
  if($output && $output2){
    $user_details = $output[0];
    $user_id = $user_details['id'];
    $user_name = $user_details['username'];
  }else{
    header("Location:/logbook/" );
  }
 
}
else{
    header("Location:/logbook/" );
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>E-logbook</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Electronic-Logbook</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link" href="./">home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="progress.php">progress chart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">logout</a>
                    </li>
            </li>
        </ul>
      </div>
  </div>
</nav>
<section>
<div class="container-fluid">
<?php
$sql = "SELECT * FROM progress INNER JOIN students on progress.stud_id = students.uid";
$result = mysqli_query($conn,$sql);
$output = mysqli_fetch_all($result,MYSQLI_ASSOC); 
 $sum = 0;

?>
  
<table class="table table-light">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">student</th>
      <th scope="col">matric no</th>
      <th scope="col">week</th>
      <th scope="col">week ending</th>
      <th scope="col">monday</th>
      <th scope="col">tuesday</th>
      <th scope="col">wednesday</th>
      <th scope="col">thursday</th>
      <th scope="col">friday</th>
      <th scope="col">saturday</th>
      <th scope="col">status</th>
      <th scope="col">attachment</th>
      <th scope="col">approve</th>
      <th scope="col">decline</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($output as $data): ?>
    <tr>
        <?php $sum++ ?>
      <th scope="row"><?php echo $sum ?></th>
      <td> <?php echo $data['username']?></td>
      <td> <?php echo $data['studentid']?></td>
      <td> <?php echo $data['week']?></td>
      <td> <?php echo $data['week_end']?></td>
      <td> <?php echo $data['mon']?></td>
      <td> <?php echo $data['tue']?></td>
      <td> <?php echo $data['wed']?></td>
      <td> <?php echo $data['thur']?></td>
      <td> <?php echo $data['fri']?></td>
      <td> <?php echo $data['sat']?></td>
      <td> <?php echo $data['status']?></td>
      <td> <a href="<?php echo $data['imgsrc']?>" class="btn btn-info" download>Download</a></td>
      <td><a href="approve.php?id=<?php echo $data['uid']?>" class="btn btn-success">approve</a></td>
      <td><a href="decline.php?id=<?php echo $data['uid']?>" class="btn btn-danger">decline</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
</section>


<footer class="text-center mt-5">
  Copyright &copy; 2023
</footer>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script>
    var navBtn = document.getElementById("navBtn")
    var dropdownToggle = document.getElementById("dropdown")
    navBtn.onclick = ()=>{
        dropdownToggle.classList.toggle("show")
    }
    
</script>
</body>
</html>