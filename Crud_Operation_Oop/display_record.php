<?php
include_once 'config.php'; 
include_once 'details.php'; 

$database = new Database(); 
$db = $database->getConnection(); 

$details = new Details($db);
?>

<!DOCTYPE html>
<html>
<head>
<title>display_page</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- <link href="./css/display.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">   
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

<style>

    /* General Styling */
body {
  font-family: 'Arial', sans-serif;
  background-color: #f0f0f0;
  margin: 0;
  padding: 0;
}
.header {
  background-color: #803D3B;
  padding-left: 70%; /* Increased padding on the left and right */
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.navbar {
  display: flex;
   gap: 30px;  /*Adds space between the navigation links */
}

.navbar a {
  text-decoration: none;
  color: white;
  padding: 5px;
  /* padding-left: 20%; */
  font-size: 1.1rem;
 
}

.navbar a:hover {
  border-bottom: 1px solid #ffc400;
}

.log-btn {
  background-color: #ffc400;
  color: white;
  border: none;
  padding: 10px 10px; /* Increase button padding */
  border-radius: 5px;
  cursor: pointer;
  font-size: 1rem;
}

.log-btn:hover {
  background-color: #ffb100;
}

/* Main Container */
.bg {
  background-color: white;
  max-width: 98%;
  margin: 40px auto;
  padding: 20px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

h3 {
  color: #803D3B;
  font-size: 1.5rem;
  margin-bottom: 20px;
}

/* Table Styling */
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
  border-radius: 8px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

table thead {
  background-color: #2c3e50;
  color: white;
}

table th, table td {
  padding: 10px;
  text-align: center;
  border: 1px solid #ddd;
}

table tbody tr {
  background-color: #f9f9f9;
  transition: background-color 0.3s;
}

table tbody tr:hover {
  background-color: #f0f0f0;
}

table img {
  border-radius: 5px;
}

.fa-edit, .fa-trash {
  color: white;
}

.btn-sm {
  margin: 0 5px;
}

.btn-primary {
  background-color: #3572EF;
  border-color: #3572EF;
}

.btn-danger {
  background-color: #E74C3C;
  border-color: #E74C3C;
}

/* Responsive Design */
@media (max-width: 768px) {
  .bg {
      padding: 10px;
  }

  table th, table td {
      padding: 8px;
  }

  .log-btn {
      padding: 8px 10px;
      font-size: 0.9rem;
  }

  h3 {
      font-size: 1.3rem;
  }
}

</style>
</head>

<body>
<header class="header">
        <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="display_record.php" >About Us</a>
               <a href="index.php"><button type="submit" name="submit" class="log-btn">+ Add New User</button></a>         
            </nav>
</header>
    <div class="bg">
        <center>
            <h3>Manage User</h3>
            <table class="table table-dark table-striped">
           
    <thead style="color:#3572EF;">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>DOB</th>
            <th>Marital Status</th>
            <th>Gender</th>
            <th>Hobbies</th>
            <th>Profile Picture</th>
            <th style="text-align:center;">Operation</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $stmt = $details->read(); 

        if ($stmt->num_rows > 0) {
            while ($row = $stmt->fetch_assoc()) {
                echo "<tr>
                    <td>" .($row['name']) . "</td>
                    <td>" .($row['email']) . "</td>
                    <td>" .($row['address']) . "</td>
                    <td>" .($row['phone']) . "</td>
                    <td>" .($row['dob']) . "</td>
                    <td>" .($row['marital_status']) . "</td>
                    <td>" .($row['gender']) . "</td>
                    <td>" .($row['hobbies']) . "</td>";
                
                if (!empty($row['profile_pic'])) {
                    echo "<td><img src='" .($row['profile_pic']) . "' alt='Profile Picture' style='width:60px;height:55px;'/></td>";
                } else {
                    echo "<td>No picture available</td>";
                }
                
                echo "<td style='text-align:center;'>
                    <a href='edit_profile.php?id=" .($row['id']) . "&name=" .($row['name']) . "&email=" .($row['email']) . "&address=" .($row['address']) . "&phone=" .($row['phone']) . "&dob=" .($row['dob']) . "&gender=" .($row['gender']) . "&marital_status=" .($row['marital_status']) . "&hobbies=" .($row['hobbies']) . "&profile_pic=" .($row['profile_pic']) . "' class='btn btn-primary btn-sm'><i class='fa fa-edit'></i></a>
                    <a href='delete_record.php?id=" .($row['id']) . "' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>
                </td>
                </tr>";           
            }
        } else {
            echo "<tr><td colspan='10'>No records found.</td></tr>";
        }
        ?>
    </tbody>
</table>
        </center>
    </div>
</body>
</html>
