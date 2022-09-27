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
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control" placeholder="Enter ">
            </div>
            <input type="hidden" name="usertype" value="admin">
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Lưu</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example 1 -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Hồ sơ quản trị viên
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
            Thêm hồ sơ quản trị viên
            </button>
    </h6>
  </div>

  <!-- DataTales Example 2 -->
<div class="card-body">

    <div class="table-responsive">
    <?php
    
    $query = "SELECT * FROM register";
    $query_run = mysqli_query($connection, $query); 
    ?>

      <table class="table table-bordered" id="datatableid" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Uername</th> </th>
            <th> Email </th>
            <th> Password </th>
            <th> Image </th>
            <th> UserType </th>
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
            <td> <?php echo $row['username']; ?></td>
            <td> <?php echo $row['email']; ?></td>
            <td> <?php echo $row['password']; ?></td>
            <td> <?php echo '<img src="upload/'.$row['image'].'" width="100px;" height="100px;" alt="Image"'?></td>
            <td> <?php echo $row['usertype']; ?></td>
            <td>
              <form action= "register_edit.php" method= "post">
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

<script>
$(document).ready(function() {
    $('#datatableid').DataTable(
      {
        "pagingType": "full_numbers",
        "lengthMenu":[
        [10,25,50,-1],
        [10,25,50,"All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Tìm kiếm...",
          
        }

      });
});
</script>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
