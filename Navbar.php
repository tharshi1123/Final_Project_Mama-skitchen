<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Mama's Kitchen</title>

    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Sidebar styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .sidebar {
            height: 100%;
            width: 70px; /* Collapsed width */
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgb(255, 255, 255);
            overflow-y: auto;
            box-shadow: 2px 0 5px #522258;
            padding-top: 20px;
            z-index: 1000;
            transition: width 0.3s;
        }

        .sidebar.expanded {
            width: 300px; /* Expanded width */
        }

        .sidebar img {
            display: block;
            margin: 0 auto 20px;
            width: 40px;
            height: 40px;
            transition: all 0.3s;
        }

        .sidebar.expanded img {
            width: 150px;
            height: 90px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #808080;
            padding: 15px 20px;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar.expanded a {
            justify-content: flex-start;
        }

        .sidebar a:hover {
            background-color: white;
            border-left: 4px solid #522258;
        }

        .sidebar a i {
            margin-right: 0;
            font-size: 20px;
            transition: margin-right 0.3s;
        }

        .sidebar.expanded a i {
            margin-right: 15px;
        }

        .sidebar a span {
            display: none;
            transition: opacity 0.3s;
        }

        .sidebar.expanded a span {
            display: inline;
            opacity: 1;
        }

        .toggle-button {
            position: absolute;
            top: 20px;
            right: -25px;
            background-color:white;
            border-radius: 50%;
            color: white;
            width: 25px;
            height: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="Index.php" class="active"><i class="fa fa-home"></i><span>Home</span></a>
        <a href="Signaturedishes.php"><i class="fa fa-star"></i><span>Signature Dishes</span></a>
        <a href="Appetizers.php"><i class="fa fa-cutlery"></i><span>Appetizers</span></a>
        <a href="Gallery.php"><i class="fa fa-image"></i><span>Gallery</span></a>
        <a href="Menu.php"><i class="fa fa-list"></i><span>Menu</span></a>
        <a href="DisplayPromotion.php"><i class="fa fa-tags"></i><span>Offers & Promotions</span></a>
        <a href="Query.php"><i class="fa fa-question-circle"></i><span>Query</span></a>
        <a href="Signup.php"><i class="fa fa-user-plus"></i><span>Signup</span></a>
        <a href="Calorie_form.php"><i class="fa fa-user-plus"></i><span>Recommend food</span></a>
        <div class="toggle-button" id="toggleButton"><i class="fa fa-bars"></i></div>
    </div>

    <!-- JS for Sidebar Toggle -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('toggleButton');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('expanded');
        });
    </script>
</body>

</html>
