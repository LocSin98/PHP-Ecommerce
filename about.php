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
                <label>Họ và tên </label>
                <input type="text" name="title" class="form-control" placeholder="Enter họ và tên">
            </div>
            <div class="form-group">
                <label>Mã số Sinh viên </label>
                <input type="text" name="sub" class="form-control" placeholder="Enter Mã số Sinh viên">
            </div>
            <div class="form-group">
                <label>Điểm </label>
                <input type="text" name="description" class="form-control" placeholder="Enter Điểm">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="links" class="form-control" placeholder="Enter Email">
            </div>

        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" name="aboutbtn" class="btn btn-primary">Lưu</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

    <!-- DataTales Example 1 -->
    <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">About US
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
    
    $query = "SELECT * FROM about";
    $query_run = mysqli_query($connection, $query); 
    ?>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Họ và Tên </th> </th>
            <th> Mã Số Sinh Viên </th>
            <th> Điểm </th>
            <th> Liên Hệ </th>
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
            <td> <?php echo $row['title']; ?></td>
            <td> <?php echo $row['sub']; ?></td>
            <td> <?php echo $row['description']; ?></td>
            <td> <?php echo $row['links']; ?></td>
            <td>
              <form action= "about_edit.php" method= "post">
              <input type= "hidden" name= "edit_idd" value="<?php echo $row['id']; ?>">
              <button type = "submit" name = "edit_btnn" class= "btn btn-success">Sửa</button>
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
