
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: auto;
    padding: 0; 
    
    justify-content: center;
    align-items: center;
    height: 100vh;
}

h2 {
    color: #333;
    text-align: center;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    margin-left:500px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
    color: #555;
}

input[type="text"],
input[type="password"],
input[type="email"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

input:focus,
select:focus {
    border-color: #4CAF50;
    outline: none;
}


        </style>
</head>
<body>
    <h2>Add New Admin User</h2>
    <form action="add_adminuser.php" method="POST">
        <label for="username">User name:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="userRole">User role:</label><br>
    <select id="userRole" name="userRole" required>
        <option value="">--Select a role--</option>
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
    </select><br><br>

    <label for="password">Password:</label><br>
    <input id="password" name="password" required></input><br><br>

    <label for="email">email:</label><br>
    <input id="email" name="email" required></input><br><br>

        <input type="submit" value="Add admin user">
    </form>
</body>
</html>
