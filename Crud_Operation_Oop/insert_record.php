<?php
include 'config.php'; 
include_once 'details.php'; 

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];  
    $marital_status = $_POST['marital_status'];
    $gender = $_POST['gender'];
    $hobbies = implode(',', $_POST['hobbies']);  

    $profile_pic = $_FILES['profile_pic'];
    $profile_pic_name = $profile_pic['name'];
    $profile_pic_tmp_name = $profile_pic['tmp_name'];
    $profile_pic_error = $profile_pic['error'];
    $profile_pic_path = '';

    if ($profile_pic_error === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/profile_pics/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $profile_pic_path = $upload_dir . basename($profile_pic_name);
        move_uploaded_file($profile_pic_tmp_name, $profile_pic_path);
    } else {
        echo "Failed to upload profile picture: " . $profile_pic_error;
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $database = new Database();
    $insert_result = $database->insert('users', [
        'name' => $name, 
        'email' => $email,  
        'password' => $hashed_password,
        'address' => $address, 
        'phone' => $phone, 
        'dob' => $dob, 
        'marital_status' => $marital_status, 
        'gender' => $gender,
        'hobbies' => $hobbies,
        'profile_pic' => $profile_pic_path
    ]);
    
    if ($insert_result) {
        header('Location: display_record.php');
    } else {
        header('Location: index.php');
    }

    $result_messages = $database->getResult();
    print_r($result_messages);

    unset($database);
}
?>
