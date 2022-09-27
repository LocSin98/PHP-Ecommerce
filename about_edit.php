<?php
include('security.php');

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">

<!-- DataTales Example 1 -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> Sửa Khoa </h6>
    </div>

  <!-- DataTales Example 2 -->
    <div class="card-body">
    <?php
    $connection = mysqli_connect("localhost","root","","loc");
    if(isset($_POST['edit_btnn']))
    {
        $id = $_POST['edit_idd'];
        $query = "SELECT * FROM about WHERE id = '$id' ";
        $query_run = mysqli_query($connection, $query);
        foreach($query_run as $row)
        {
         ?>
            <form action="code.php" method="post">
                <input type="hidden" name = "edit_idd" value = "<?php echo $row['id'] ?>">
                <div class="form-group">
                <label>Họ và tên </label>
                <input type="text" name="edit_title" class="form-control" value = "<?php echo $row['title'] ?>" placeholder="Enter Title">
            </div>
            <div class="form-group">
                <label>Mã số Sinh viên </label>
                <input type="text" name="edit_sub" class="form-control" value = "<?php echo $row['sub'] ?>" placeholder="Enter Sub Title">
            </div>
            <div class="form-group">
                <label>Điểm </label>
                <input type="text" name="edit_description" class="form-control" value = "<?php echo $row['description'] ?>" placeholder="Enter Description">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="edit_links" class="form-control" value = "<?php echo $row['links'] ?>" placeholder="Enter Links">
            </div>

                 <div class="modal-footer">
                    <a href="about.php" class = "btn btn-danger">Huỷ bỏ</a>
                    <button type="submit"  name="updateabout" class="btn btn-primary">Lưu</button>
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