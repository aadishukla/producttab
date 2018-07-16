<?php


    if(isset($_POST['usr'])){
        var_dump($_POST['usr']);
    }

   if(isset($_POST['usr']['up']) && isset($_POST['usr']['id'])){
       $sql="UPDATE user SET name='".$_POST['usr']['name']."',pno='".$_POST['usr']['pno']."' WHERE id='".$_POST['usr']['id']."'";
       $res=update(connection(),$sql);
   }

function connection(){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $conn = mysqli_connect($servername, $username,$password,"a");
    if (!$conn) {
     die("Connection failed: " . mysqli_error());
    }
    return $conn;
}

function insert($conn, $q){
    return mysqli_query($conn,$q);   
}

function getresult($conn,$q){
    $res=mysqli_query($conn,$q);
    while($row=mysqli_fetch_assoc($res)){
        $data[]=$row;
    }
    return $data;
}
function delete($conn,$q){
    return mysqli_query($conn,$q);    
}
function update($conn,$q){
    return mysqli_query($conn,$q);    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
  
  <?php echo (isset($res))?"Success":"Fail"; ?>
  
   <h1>User Data</h1>
    <table class="table table-condensed">
        <thead>
          <tr>
            <th>Sr.No.</th>
            <th>Name</th>
            <th>Phone Nuber</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
<?php         
  $con= connection();       
  $selectres=getresult($con,"select * from user");
            foreach($selectres as $res): ?>
            <tr>
            <td><?php echo $res['id']; ?></td>
            <td><?php echo $res['name']; ?></td>
            <td><?php echo $res['pno']; ?></td>
            <td>
                <a class="btn btn-info btn-md text-center" data-toggle="modal" data-target="#mod<?php echo $res['id']; ?>" 
                     id="<?php echo $res['id']; ?>">
                  <span class="glyphicon glyphicon-edit" ></span> Edit
                </a>
               
                <a href="#" class="btn btn-danger btn-md">
                  <span class="glyphicon glyphicon-edit"></span>Delete
                </a>
   
  <div class="modal fade" id="mod<?php echo $res['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Edit "<?php echo $res['name']; ?>" </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
         <form action="crud.php" method="POST" name="edit">
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <label for="name">Name</label>                  
                    <input type="text" name="usr[name]" id="lname" class="form-control" value="<?php echo $res['name']; ?>">

                </div>

                <div class="md-form mb-4">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <label  for="pno">Phone No</label>
                    <input type="number" name="usr[pno]" id="pno" class="form-control" value="<?php echo $res['pno']; ?>">
                </div>
                <input type="hidden" name="usr[id]" value="<?php echo $res['id']; ?>">
                <input type="hidden" name="usr[up]" value="<?php echo $res['id']; ?>">

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <input type="submit" class="btn btn-default" name="subedit" value="ADD">
            </div>
            </form>
        </div>
    </div>
</div>


   </td>
        </tr>
            <?php endforeach; ?>
        
        </tbody>
        
    </table>
    
  </div>   
  

</body>
</html>