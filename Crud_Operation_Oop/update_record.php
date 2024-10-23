<?php
include 'config.php'; 
include 'details.php';

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $marital_status = $_POST['marital_status'];
    $gender = $_POST['gender'];
    $hobbies = implode(',', $_POST['hobbies']);

    // Handle file upload
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
    }

    $database = new Database();
    $update_data = [
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'phone' => $phone,
        'dob' => $dob,
        'marital_status' => $marital_status,
        'hobbies' => $hobbies,
        'gender' => $gender
    ];

    if ($profile_pic_path) {
        $update_data['profile_pic'] = $profile_pic_path;
    }

    $update_result = $database->update('users', $update_data, "id = $id");

    if($update_result) {
        header('Location: display_record.php');
    } else {
        echo "Failed to update record: ";
    }

    $result_messages = $database->getResult();
    print_r($result_messages);

    unset($database);
}
?>
