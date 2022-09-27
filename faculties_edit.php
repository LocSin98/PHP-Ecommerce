<?php
include('security.php');

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">

<!-- DataTales Example 1 -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> Sửa Hồ sơ Quản trị viên </h6>
    </div>

  <!-- DataTales Example 2 -->
    <div class="card-body">
    <?php
    $connection = mysqli_connect("localhost","root","","loc");
    if(isset($_POST['edit_btn']))
    {
        $id = $_POST['edit_id'];
        $query = "SELECT * FROM faculties WHERE id = '$id' ";
        $query_run = mysqli_query($connection, $query);
        foreach($query_run as $row)
        {
         ?>
            <form action="code.php" method="post">
                <input type="hidden" name = "edit_idd" value = "<?php echo $row['id'] ?>">
                <div class="form-group">
                <label> Mã Khoa </label>
                <input type="text" name="edit_title" class="form-control" value = "<?php echo $row['faculty_name'] ?>" placeholder="Enter Tên Khoa">
            </div>
            <div class="form-group">
                <label> Tên Khoa </label>
                <input type="text" name="edit_sub" class="form-control" value = "<?php echo $row['faculty_code'] ?>" placeholder="Enter Mã Khoa">
            </div>
            <div class="form-group">
                <label> Designation </label>
                <input type="text" name="edit_description" class="form-control" value = "<?php echo $row['Designation'] ?>" placeholder="Enter Designation">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="edit_links" class="form-control" value = "<?php echo $row['Description'] ?>" placeholder="Enter Description">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="edit_image" class="form-control" value = "<?php echo $row['Image'] ?>" placeholder="Enter Image">
            </div>

                 <div class="modal-footer">
                    <a href="faculties.php" class = "btn btn-danger">Huỷ bỏ</a>
                    <button type="submit"  name="updatefaculties" class="btn btn-primary">Lưu</button>
                 </div>
            </form>
        
        <?php
        }
    }
    ?>
  
    </div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>