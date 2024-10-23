<?php

include_once "config.php";
include_once "details.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $database = new Database();
    $db = $database->getConnection();

    $details = new Details($db);
    $details->id = $id;

    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "No record found!";
        exit();
    }

    $row = $result->fetch_assoc();

    $name = $row['name'];
    $email = $row['email'];
    $address = $row['address'];
    $phone = $row['phone'];
    $dob = $row['dob'];
    $marital_status = $row['marital_status'];
    $gender = $row['gender'];
    $hobbies = explode(',', $row['hobbies']);
    $profile_pic = $row['profile_pic'];
} else {
    echo "No ID provided!";
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <!-- <link href="./css/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>

        /* General Page Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    color: #333;
}

header {
    background-color: #803D3B;
    padding: 20px;
}

.navbar {
    display: flex;
    justify-content: space-around;
    list-style: none;
    margin: 0;
    padding: 0;
}

.navbar a {
    text-decoration: none;
    color: white;
    padding: 10px 20px;
    font-size: 1.1rem;
}

.navbar a:hover {
    border-bottom: 3px solid #ffc400;
}

.container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h2 {
    color: #803D3B;
    text-align: center;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.main {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.child {
    width: 100%;
}

.data {
    display: flex;
    justify-content: space-between;
}

.left, .right {
    width: 45%;
}

input, select {
    width: 90%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* File Upload Styling */
input[type="file"] {
    background-color: #f4f4f4;
    padding: 10px;
}

input[type="submit"], input[type="button"] {
    padding: 10px 20px;
    background-color: #803D3B;
    border: none;
    color: white;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover, input[type="button"]:hover {
    background-color: #a45a56;
}

.btns {
    text-align: center;
    margin-top: 20px;
}

/* Back Button Styling */
.back-button {
    text-decoration: none;
    padding: 8px 16px;
    background-color: #803D3B;
    color: white;
    border-radius: 4px;
    margin-bottom: 10px;
}

.back-button:hover {
    background-color: #a45a56;
}
/* Gender Section */
.gender {
    display: flex;
    align-items: center;
    margin-top: 15px;
}

.gender label {
    margin-right: 10px;
    /* font-weight: bold; */
}

.gender input[type="radio"] {
    margin-right: 5px;
}

.gender label[for="female"] {
    margin-left: 15px;
}

/* Hobbies Section */
.hobbies {
    display: flex;
    align-items: center;
    /* margin-top: 15px; */
}

/* .hobbies label {
    margin-right: 10px;
    /* font-weight: bold; 
} */

/* .hobbies input[type="checkbox"] {
    margin-right: 10px;
    
} */

@media (max-width: 768px) {
    .hobbies div {
        width: 100%; 
    }
}


@media (max-width: 768px) {
    .data {
        flex-direction: column;
    }
    
    .left, .right {
        width: 100%;
    }

    .hobbies {
        grid-template-columns: 1fr; 
    }
}

    </style>
</head>
<body>

<header class="header">
    <nav class="navbar">
        <a href="#home" style="border-bottom:3px solid #ffc400;font-size: 1.1rem;color:white;">Home</a>
        <a href="display_record.php">About Us</a>
    </nav>
</header>
<div class="container">
     
    <form method="post" action="update_record.php" enctype="multipart/form-data">

    <div class="main">
         
        <div class="child">
        <a href="display_record.php" class="back-button">Back</a> 
            <h2 >Update</h2>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="data">
                <div class="left">
                    <input type="text" placeholder="Name" class="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                    <input type="email" placeholder="Email" class="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    <input type="text" placeholder="Address" class="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
                    <input type="tel" id="phone" name="phone" placeholder="Mobile number" maxlength="10" class="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
                    <div class="gender">
                        <label>Gender:-</label>
                        <input type="radio" name="gender" value="male" id="male" <?php echo ($gender == 'male') ? 'checked' : ''; ?> >
                        <label for="male">Male</label><br><br>
                        <input type="radio" name="gender" value="female" id="female" <?php echo ($gender == 'female') ? 'checked' : ''; ?>>
                        <label for="female">Female</label>
                    </div>
                </div>

                <div class="right">
                    <input type="datetime-local" id="dob" name="dob" placeholder="Date of Birth" class="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
                    <input type="file" id="profile_pic" name="profile_pic" class="profile_pic" <?php echo ($profile_pic) ? '' : 'required'; ?>>
                    <select name="marital_status" id="marital_status" class="marital_status" required>
                        <option value="">Select Marital Status</option>
                        <option value="single" <?php echo ($marital_status == 'single') ? 'selected' : ''; ?>>Single</option>
                        <option value="married" <?php echo ($marital_status == 'married') ? 'selected' : ''; ?>>Married</option>
                        <option value="divorced" <?php echo ($marital_status == 'divorced') ? 'selected' : ''; ?>>Divorced</option>
                    </select>
                    
                   
                    <div class="hobbies">
                        <label style="margin-top:-20%;">Hobbies:-</label>
                        <input type="checkbox" name="hobbies[]" value="Reading" id="hobby1" <?php echo (in_array('Reading', $hobbies)) ? 'checked' : ''; ?>>
                        <label for="hobby1">Reading</label>
                        <input type="checkbox"  name="hobbies[]" value="Traveling" id="hobby2" <?php echo (in_array('Traveling', $hobbies)) ? 'checked' : ''; ?> >
                        <label for="hobby2" >Traveling</label>
                        <input type="checkbox" style="margin-top:25%; margin-left:-40%;" name="hobbies[]" value="Cooking" id="hobby3" <?php echo (in_array('Cooking', $hobbies)) ? 'checked' : ''; ?>>
                        <label for="hobby3" style="margin-top:22%;" >Cooking</label>
                        <input type="checkbox" style="margin-top:25%;" name="hobbies[]" value="Dancing" id="hobby4"  <?php echo (in_array('Cooking', $hobbies)) ? 'checked' : ''; ?>>
                        <label for="hobby4" style="margin-top:22%;">Dancing</label>
                    </div>
                </div>
            </div>

            <div class="btns">
                <input type="submit" class="btn" name="submit" value="Update">
                <a href="display_record.php"><input type="button" class="btn" name="cancel" value="Cancel"></a>
            </div>
        </div>
    </div>
    </form>
</div>
</body>
</html>
