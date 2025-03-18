<?php
// Start session
session_start();

// Check if user is an admin or staff
$is_admin = isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Mama's Kitchen</title>
    <style>
        /* Sidebar general styles */
        .sidebar {
            height: 100vh;
            width: 40px; /* Sidebar width (collapsed) */
            position: fixed;
            top: 0;
            left:15px;
            background-color:white;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
            transition: width 0.3s;
        }

        .sidebar.expanded {
            width: 150px; /* Expanded sidebar width */
        }

        .sidebar a {
            color: grey;
            text-decoration: none;
            width: 100%;
            padding: 10px 10px;
            display: flex;
            align-items: center;
            font-size:10px;
            justify-content: left;
            transition: background 0.3s;
            position: relative;
        }

        .sidebar a .description {
            opacity: 0;
            visibility: hidden;
            white-space: nowrap;
            margin-left: 15px;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .sidebar.expanded a .description {
            opacity: 1;
            visibility: visible;
        }

        .sidebar a i {
            font-size: 10px;
        
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #522258;
            border-radius: 4px;
        }

        .sidebar .btn {
            margin: 5px 5px;
            width: 120px; 
            height:40px;
              background-color: #522258;
              font-size: 10px;
              /* Adjust button width */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .sidebar.expanded {
                width: 200px;
            }
        }

        .toggle-btn {
            position: absolute;
            top: 5px;
            right: -20px;
            background-color: #522258;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            z-index: 1001;
        }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <button class="toggle-btn" onclick="toggleSidebar()">&#9776;</button>
        <a href="AdminPage.php" class="active">
            <i class="fas fa-home"></i>
            <span class="description">Home</span>
        </a>
        <a href="AdminOrderDashboard\OrderList.php">
            <i class="fas fa-list"></i>
            <span class="description">Orders</span>
        </a>
        <a href="AdminOrderDashboard\Accepted_orders.php">
            <i class="fas fa-check"></i>
            <span class="description">Accepted Orders</span>
        </a>
        <a href="Users\Users.php">
            <i class="fas fa-users"></i>
            <span class="description">Customers</span>
        </a>
        <a href="AdminPromotionDashboard\Promotions.php">
            <i class="fas fa-tags"></i>
            <span class="description">Promotions</span>
        </a>
        <a href="AdminQueryDashboard\AdminQueryList.php">
            <i class="fas fa-question-circle"></i>
            <span class="description">Queries</span>
        </a>
        <a href="AdminQueryDashboard\RepliedQuery.php">
            <i class="fas fa-reply"></i>
            <span class="description">Query Replies</span>
        </a>

       <?php if ($is_admin): ?>
            <a href="Adminuser_dashboard.php">
                <i class="fas fa-user-shield"></i>
                <span class="description">Admin Users</span>
            </a>
            <form action="AdminPromotionDashboard\CreateOffer.php" method="post">
                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-plus"></i> Create Promotions</button>
            </form>
            <form action="CreateAdminUsers.php" method="post">
                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-user-plus"></i> Create Admin User</button>
            </form>
        <?php else: ?>
            <a href="#" class="disabled">
                <i class="fas fa-user-shield"></i>
                <span class="description">Admin Users (Admin Only)</span>
            </a>
            <button class="btn btn-secondary btn-block" disabled><i class="fas fa-plus"></i> Create Promotions</button>
            <button class="btn btn-secondary btn-block" disabled><i class="fas fa-user-plus"></i> Create Admin User</button>
        <?php endif; ?> 

        <a href="Signup.php">
            <i class="fas fa-sign-in-alt"></i>
            <span class="description">Sign Up</span>
        </a>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('expanded');
        }
    </script>
</body>

</html>
