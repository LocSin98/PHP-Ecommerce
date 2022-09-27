<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include('security.php');

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm dữ liệu quản trị viên</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Mã Khoa </label>
                <input type="text" name="faculty_name" class="form-control" placeholder="Enter Tên Khoa">
            </div>
            <div class="form-group">
                <label> Tên Khoa </label>
                <input type="text" name="faculty_code" class="form-control" placeholder="Enter Mã Khoa">
            </div>
            <div class="form-group">
                <label>Designation</label>
                <input type="text" name="Designation" class="form-control" placeholder="Enter Designation">
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="text" name="Description" class="form-control" placeholder="Confirm Description">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="Image" class="form-control" placeholder="Enter">
            </div>
            <input type="hidden" name="usertype" value="admin">
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" name="facultiesbtn" class="btn btn-primary">Lưu</button>
        </div>
      </form>

    </div>
  </div>
</div>




<div class="container-fluid">

    <!-- DataTales Example 1 -->
    <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh Sách Khoa
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
            ADD
            </button>
    </h6>
  </div>

  <!-- DataTales Example 2 -->
    <div class="card-body">
  <?php
  if(isset($_SESSION['success']) && $_SESSION['success'] !='') {
    echo '<h2 class="bg-primary text-white"> '.$_SESSION['success'].' </h2>';
    unset($_SESSION['success']);
  }
  if(isset($_SESSION['status']) && $_SESSION['status'] !='') {
    echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
    unset($_SESSION['status']);
  }
  ?>

    <div class="table-responsive">
    <?php
    
    $query = "SELECT * FROM faculties";
    $query_run = mysqli_query($connection, $query); 
    ?>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <th> ID </th>
            <th> Mã Khoa </th>
            <th> Tên Khoa </th> </th>
            <th> Designation </th>
            <th> Description </th>
            <th> Image </th>
            <th> Sửa </th>
            <th> Xoá</th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($query_run) > 0)
        {
          while($row = mysqli_fetch_assoc($query_run))
          {
            ?>
             <tr>
            <td> <?php echo $row['id']; ?></td>
            <td> <?php echo $row['faculty_name']; ?></td>
            <td> <?php echo $row['faculty_code']; ?></td>
            <td> <?php echo $row['Designation']; ?></td>
            <td> <?php echo $row['Description']; ?></td>
            <td> <?php echo $row['Image']; ?></td>
            <td>
              <form action= "faculties_edit.php" method= "post">
              <input type= "hidden" name= "edit_id" value="<?php echo $row['id']; ?>">
              <button type = "submit" name = "edit_btn" class= "btn btn-success">Sửa</button>
              </form>
            </td>
            <td>
              <form action= "code.php" method= "post">
                <input type= "hidden" name= "delete_id" class="delete_id_value" value="<?php echo $row['id']; ?>">
                <a href="javascript:void(0)" class="delete_btn_ajax btn btn-danger">Xoá</a>
                <!-- <button type = 'submit' name="delete_btn" class="btn btn-danger">Xoá</button> -->
              </form>
            </td>
              
            </tr>

            <?php
          }
        }
        else
        {
          echo 'No Record Found';

        }
        ?>
        </tbody>
      </table>

    </div>
    <script>
               $(document).ready(function () {
              $('.delete_btn_ajax').click(function (e) { 
                e.preventDefault();
                
                var deleteid = $(this).closest("td").find('.delete_id_value').val();
                // console.log(deleteid);

                swal({
                    title: "Bạn có chắc không?",
                    text: "Sau khi xóa, bạn sẽ không thể khôi phục tệp này!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                      $.ajax({
                          type: "POST",
                          url: "./code.php",
                          data: {
                              "id": 1,
                              "id": deleteid,
                          },
                          success: function (response) {
                             swal("Dữ liệu đã được Xóa thành công!", {
                                 icon:"success",

                             }).then((result) => {
                                 location.reload();
                             });
                          }
                      });
                   
                  }
                });                
            });
                            
             });

          </script>


    </div>
    <!-- /.container-fluid -->
</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>