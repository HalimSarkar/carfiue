<?php 
use LDAP\Result;
 
include "../config/database.php";
session_start();

if(isset($_POST['registerbtn'])){
$name = $_POST['username'];
$email= $_POST['email'];
$password = $_POST['password'];
$c_password = $_POST['c_password'];
$flag= false;

$name_regex = '/^(?! $)[a-zA-Z ]*$/';
$email_regex = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
$password_regex_upper = '/^(?=.*?[A-Z])/';
$password_regex_lower = '/^(?=.*?[a-z])/';
$password_regex_number = '/^(?=.*?[0-9])/';
$password_regex_char = '/^(?=.*?[#?!@$%^&*-])/';
$password_regex_lenght = '/^.{8,}/';

if(!$name){
    $flag= true;
    $SESSION['name_error']=" name field is required!!";
    header("location: register.php");

}else if(!preg_match($name_regex, $name)){
    $flag= true;
    $_SESSION['name_error']=" name is not accept numerical number!!";
    header("location: register.php");   

}else{
    $_SESSION['old_name']= $name; 
    header("location: register.php");

}

if(!$email){
    $flag= true;
    $_SESSION['email_error']=" email field is required!!";
    header("location: register.php");

}else if(!preg_match($email_regex, $email)){
    $flag= true;
    $_SESSION['email_error'] =" email is in_valid!!";
    header("location: register.php");   

}else{
    $_SESSION['old_email'] =$email;
    header("location: register.php");
}


if(!$password){
    $flag= true;
    $_SESSION['password_error']=" password field is required!!";
    header("location: register.php");

}elseif(!preg_match($password_regex_upper ,$password)){
    $flag= true;
    $_SESSION['password_error']=" password required at least one  upper case!!";
    header("location: register.php");
}
elseif(!preg_match($password_regex_lower ,$password)){
    $flag= true;
    $_SESSION['password_error']=" password required at least one lower case!!";
    header("location: register.php");
}
elseif(!preg_match($password_regex_number ,$password)){
    $flag= true;
    $_SESSION['password_error']=" password required at least one numerical character!!";
    header("location: register.php");
}
elseif(!preg_match($password_regex_char ,$password)){
    $flag= true;
    $_SESSION['password_error']=" password required at least  one special character!!";
    header("location: register.php");
}
elseif(!preg_match($password_regex_lenght ,$password)){
    $flag= true;
    $_SESSION['password_error']=" password required at least Minimum eight in length!!";
    header("location: register.php");
}


if(!$c_password){
    $flag= true;
    $_SESSION['c_password_error']=" password confirmation field is required!!";
    header("location: register.php");
    $_SESSION['c_password_error']=" password confirmation field is required!!";
}elseif($c_password !=$password){
    $flag= true;
    $_SESSION['c_password_error']=" password && confirmation password does't match!!";
    header("location: register.php");
}


if($flag==false){
  $encrypt= md5($password);
  $create_query = "INSERT INTO users (name, email, password) VALUES ('$name','$email','$encrypt')";
  mysqli_query($db,$create_query);
  $_SESSION["register_complete"]="registion complete!";
  $_SESSION["register_name"]="$name";
  $_SESSION["register_email"]="$email";
  header("location:signin.php"); 
} 


}

// signin page start

if(isset($_POST['signinbtn'])){


    $email= $_POST['email'];
    $password = $_POST['password'];
    $flag = false;

    $email_regex = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
    $password_regex_upper = '/^(?=.*?[A-Z])/';
    $password_regex_lower = '/^(?=.*?[a-z])/';
    $password_regex_number = '/^(?=.*?[0-9])/';
    $password_regex_char = '/^(?=.*?[#?!@$%^&*-])/';
    $password_regex_lenght = '/^.{8,}/';


    if(!$email){
        $flag= true;
        $_SESSION['email_error']=" email field is required!!";
        header("location: registesignin.php");
    
    }else if(!preg_match($email_regex, $email)){
        $flag= true;
        $_SESSION['email_error'] =" email is in_valid!!";
        header("location: signin.php");   
    
    }
    
    
    if(!$password){
        $flag= true;
        $_SESSION['password_error']=" password field is required!!";
        header("location: register.php");
    
    }elseif(!preg_match($password_regex_upper ,$password)){
        $flag= true;
        $_SESSION['password_error']=" password required at least one  upper case!!";
        header("location: signin.php");
    }
    elseif(!preg_match($password_regex_lower ,$password)){
        $flag= true;
        $_SESSION['password_error']=" password required at least one lower case!!";
        header("location: signin.php");
    }
    elseif(!preg_match($password_regex_number ,$password)){
        $flag= true;
        $_SESSION['password_error']=" password required at least one numerical character!!";
        header("location: signin.php");
    }
    elseif(!preg_match($password_regex_char ,$password)){
        $flag= true;
        $_SESSION['password_error']=" password required at least  one special character!!";
        header("location: signin.php");
    }
    elseif(!preg_match($password_regex_lenght ,$password)){
        $flag= true;
        $_SESSION['password_error']=" password required at least Minimum eight in length!!";
        header("location: signin.php");
    }
    
 if(!$flag){
$encrypt= md5($password);
 $query = "SELECT COUNT(*) AS 'validate' FROM users WHERE email='$email' AND password='$encrypt'";
 $connect = mysqli_query($db,$query);
  
 $result=mysqli_fetch_assoc($connect);

 if($result["validate"]==1) {

   $query = "SELECT * FROM users WHERE email='$email'";
   $connect = mysqli_query($db,$query);
   $author = mysqli_fetch_assoc( $connect);
   
   
   $_SESSION['author_id'] = $author["id"];
   $_SESSION['author_name'] = $author["name"];
   $_SESSION['temp_name'] = $author["name"];
   $_SESSION['author_email'] = $author["email"];

   header('location: ../backend/home/home.php');


 }else{
    $_SESSION['signin_unsuccess']= 'credential doesn match ';
    header("location: signin.php");
 }


}
// if (!$flag) {
//     $encrypt = md5($password);
//     $query = "SELECT COUNT(*) AS validate FROM users WHERE email='$email' AND password='$encrypt'";
//     $connect = mysqli_query($db, $query);
    
//     if ($connect) {
//         $result = mysqli_fetch_assoc($connect);
//         print_r($result['validate']);
//     }
// } 

}

?>