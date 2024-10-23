<?php
include('config.php');
include('details.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>insert_page</title>

<!-- <link href="./css/style.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">   
 <!-- font awesome file link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<!-- font awesome cdn link  -->
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
    padding: 5px;
}

.navbar {
    display: flex;
    justify-content: center;
    list-style: none;
    margin: 0;
    padding-left: 70%;
}

.navbar a {
    text-decoration: none;
    color: white;
    padding: 20px;
    font-size: 1.1rem;
}

.navbar a:hover {
    border-bottom: 3px solid #fff;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin-top: 40px;
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

h2 {
    color: #803D3B;
    text-align: center;
    margin-bottom: 20px;
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


label {
    margin-left: 10px;
    color: #555;
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

input[type="file"] {
    background-color: #f4f4f4;
    padding: 10px;
}

.gender {
    margin-top: 15px;
}

.gender label {
    margin-right: 10px;
}

.hobbies {
    display: grid;
    grid-template-columns: repeat(2, 1fr); 
    gap: 10px; 
    margin: 5px 0;
}

.hobbies input[type="checkbox"] {
    margin-left: 2px;
}

.hobbies label {
    margin-right: 1px;
}

@media (max-width: 768px) {
    .hobbies {
        grid-template-columns: 1fr; 
    }
}

@media (max-width: 768px) {
    .data {
        flex-direction: column;
    }
    
    .left, .right {
        width: 100%;
    }
}
</style>
</head>

<body>
<header class="header">
        <nav class="navbar">
                <a href="#home">Home</a>
                <a href="display_record.php">About Us</a>
                
        </nav>
</header>
<div class="container">
<form action="insert_record.php" method="POST" enctype="multipart/form-data">
    <div class="main">
      <div class="child">
        <h2 style="margin-top:2%;">Add User</h2><br>
          <input type="hidden" name="id">
          
          <div class="data" style="margin-top:-4%;">

          <div class="left">
          <input type="text" placeholder="Name" class="name" name="name" required>
          <input type="email" placeholder="Email" class="email" name="email" required>
          <input type="password" name="password" class="password" placeholder="Password" minlength="5" maxlength="10" required>
          <input type="text" placeholder="Address" class="address" name="address" required>
         <br>
         <div class="hobbies" required>
          <label style="margin-bottom:10%;">Hobbies :--</label><br>
          <input type="checkbox" name="hobbies[]" value="Reading" id="hobby1">
          <label for="hobby1">Reading</label>
          <input type="checkbox" name="hobbies[]" value="Traveling" id="hobby2">
          <label for="hobby2">Traveling</label><br>
          <input type="checkbox" name="hobbies[]" value="Cooking" id="hobby3">
          <label for="hobby3">Cooking</label>
          <input type="checkbox" name="hobbies[]" value="Dancing" id="hobby4">
          <label for="hobby4">Dancing</label>
          </div>  
          </div>

          <div class="right">
          <input type="datetime-local" id="dob" name="dob" class="dob" style="color:white;" required>
          <input type="file" id="profile_pic" name="profile_pic" class="profile_pic" required>
          <input type="tel" id="phone" name="phone" placeholder="Mobile number" maxlength="10" class="phone" required>
          <select name="marital_status" id="marital_status" class="marital_status" required>
              <option value="">Marital Status</option>
              <option value="single">Single</option>
              <option value="married">Married</option>
              <option value="divorced">Divorced</option>
          </select>
         <br><br>
          <div class="gender" required>
            <label> Gender :--</label><br><br>
            <input type="radio" name="gender" value="male" id="male" required>
            <label for="male">Male</label>
            <input type="radio" name="gender" value="female" id="female" style="margin-left:12px;">
            <label for="female">Female</label>
          </div>
          
          </div>
          </div>

          <div class="btns">
          <input type="submit" class="btn" name="submit" value="Save">
          <a href="display_record.php"><input type="button" class="btn" name="cancel" value="Cancel"></a>
          </div>
      </div>
    </div>
</form>

</div>
</body>
</html>