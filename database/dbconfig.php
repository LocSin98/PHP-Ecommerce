<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<?php
 $server_name = "localhost";
 $db_username = "root";
 $db_password = "";
 $db_name = "loc";


$connection = mysqli_connect($server_name,$db_username,$db_password);
$dbconfig = mysqli_select_db($connection,$db_name);
if($dbconfig)
{
    // echo "Cơ sở dữ liệu được hình thành";
}
else
{
    echo '
    <div class="container">
        <div class="row">
            <div class="col-md-6 mr-auto ml-auto text-center py-5 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title bg-danger text-white">Kết nối cơ sở dữ liệu không thành công!</h1>
                        <h2 class="card-title">Cơ sở dữ liệu bị lỗi!</h2>
                        <p class="card-text">Vui lòng kiểm tra hoạt động cơ sở dữ liệu của bạn.</p>
                        <a href="#" class="btn btn-primary">:(</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    ';

}

?>