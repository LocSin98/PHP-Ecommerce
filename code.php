<?php
include('security.php');

$connection = mysqli_connect("localhost","root","","loc");

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $image = $_POST['image'];
    $usertype = $_POST['usertype'];
        if($password === $cpassword)
    {
        $query = "INSERT INTO register (username,email,password,image,usertype) VALUES('$username','$email','$password','$image','$usertype')";
        $query_run = mysqli_query($connection, $query);
        
        if($query_run)
        {
            //echo "Saved";
            $_SESSION['success'] = "Hồ sơ quản trị viên đã được thêm";
            header('Location: register.php');
        }
        else
        {
            $_SESSION['status'] = "Hồ sơ quản trị viên KHÔNG được thêm";
            header('Location: register.php');
        } 
    }
    else
    {
        $_SESSION['status'] = "Mật khẩu và xác nhận mật khẩu không khớp";
        header('Location: register.php');
    }  
}


if(isset($_POST['aboutbtn']))
{
    $title = $_POST['title'];
    $sub = $_POST['sub'];
    $description = $_POST['description'];
    $links = $_POST['links'];

        $query = "INSERT INTO about (title,sub,description,links) VALUES('$title',' $sub','$description','$links')";
        $query_run = mysqli_query($connection, $query);
        
        if($query_run)
        {
            //echo "Saved";
            $_SESSION['success'] = "Hồ sơ quản trị viên đã được thêm";
            header('Location:about.php');
        }
        else
        {
            $_SESSION['status'] = "Hồ sơ quản trị viên KHÔNG được thêm";
            header('Location: about.php');
        } 
}

if(isset($_POST['facultiesbtn']))
{
    $faculty_name = $_POST['faculty_name'];
    $faculty_code = $_POST['faculty_code'];
    $Designation = $_POST['Designation'];
    $Description = $_POST['Description'];
    $Image = $_POST['Image'];

        $query = "INSERT INTO faculties (faculty_name,faculty_code,Designation,Description,Image) VALUES('$faculty_name',' $faculty_code','$Designation','$Description','$Image')";
        $query_run = mysqli_query($connection, $query);
        
        if($query_run)
        {
            //echo "Saved";
            $_SESSION['success'] = "Hồ sơ quản trị viên đã được thêm";
            header('Location:faculties.php');
        }
        else
        {
            $_SESSION['status'] = "Hồ sơ quản trị viên KHÔNG được thêm";
            header('Location: faculties.php');
        } 
}
 


if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $image = $_POST['edit_image'];
    $usertypeupdate = $_POST['update_usertype'];

    $query = "UPDATE register SET username='$username', email='$email', password='$password', image='$image', usertype='$usertypeupdate' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Dữ liệu của bạn đã được cập nhật";
        header('Location: register.php');
    }
    else
    {
        $_SESSION['status'] = "Dữ liệu của bạn KHÔNG được cập nhật";
        header('Location: register.php');
    }
}
/*--cập nhật trang about--*/
if(isset($_POST['updateabout']))
{
    $id = $_POST['edit_idd'];
    $title = $_POST['edit_title'];
    $sub = $_POST['edit_sub'];
    $description = $_POST['edit_description'];
    $links = $_POST['edit_links'];

    $query = "UPDATE about SET title='$title', sub='$sub', description='$description', links='$links' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Dữ liệu của bạn đã được cập nhật";
        header('Location: about.php');
    }
    else
    {
        $_SESSION['status'] = "Dữ liệu của bạn KHÔNG được cập nhật";
        header('Location: about.php');
    }
}
/*---- cập nhật Khoa */
if(isset($_POST['updatefaculties']))
{
    $id = $_POST['edit_idd'];
    $faculty_name = $_POST['edit_title'];
    $faculty_code = $_POST['edit_sub'];
    $Designation = $_POST['edit_description'];
    $Description = $_POST['edit_links'];
    $Image = $_POST['edit_image'];

    $query = "UPDATE faculties SET faculty_name='$faculty_name', faculty_code='$faculty_code', Designation='$Designation', Description='$Description', Image='$Image' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Dữ liệu của bạn đã được cập nhật";
        header('Location: faculties.php');
    }
    else
    {
        $_SESSION['status'] = "Dữ liệu của bạn KHÔNG được cập nhật";
        header('Location: faculties.php');
    }
}
/*--Xoá trang register--*/
if(isset($_POST['id']))
{
    $id = $_POST['id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "Dữ liệu của bạn đã được xoá";
        header("Location: register.php");
    }
    else
    {
        $_SESSION['status'] = "Dữ liệu của bạn KHÔNG bị xoá";
        header('Location: register.php');

    }
}
/*--Xoá trang about--*/
if(isset($_POST['id']))
{
    $id = $_POST['id'];

    $query = "DELETE FROM about WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "Dữ liệu của bạn đã được xoá";
        header("Location: register.php");
    }
    else
    {
        $_SESSION['status'] = "Dữ liệu của bạn KHÔNG bị xoá";
        header('Location: register.php');

    }
}

if(isset($_POST['id']))
{
    $id = $_POST['id'];

    $query = "DELETE FROM faculties WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "Dữ liệu của bạn đã được xoá";
        header("Location: faculties.php");
    }
    else
    {
        $_SESSION['status'] = "Dữ liệu của bạn KHÔNG bị xoá";
        header('Location: faculties.php');

    }
}





if(isset($_POST['login_btn']))
{
    $email_login = $_POST['emaill'];
    $password_login = $_POST['passwordd'];

    $query = "SELECT * FROM register WHERE email='$email_login' AND password = '$password_login' ";
    $query_run = mysqli_query($connection, $query);

    if(mysqli_fetch_array($query_run))
    {
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
    }
    else
    {
        $_SESSION['status'] = 'Email id / Password Is Invalid';
        header('Location: login.php'); 

    }
}


?>