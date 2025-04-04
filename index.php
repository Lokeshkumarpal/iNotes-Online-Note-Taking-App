<?php
// connect to the database
$inserted = false;
$title_alert = false;
$desc_alert = false;

$server = "localhost";
$username = "root";
$password = "";
$database = "notes";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die("There is error during connect due to " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];

    if (trim($title) == '' or $title == ' ') {
        $title_alert = true;
    } elseif (trim($desc) == ' ' or $desc == '') {
        $desc_alert = true;
    } else {
        $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$desc')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // echo "Notes inserted successfully";
            $inserted = true;
        } else {
            echo "There is an error during insertion. error--->" . mysqli_error($conn);
        }
    }
}

// Check if ID is set in the URL
if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];

    // SQL query to delete the record
    $sql = "DELETE FROM `notes` WHERE `notes`.`sno` = '$id'";
    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>iNotes</title>
</head>

<body class="bg-faded">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">iNotes - Create Your Notes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_us.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Contact_us.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    if ($inserted == true) {
        echo '<div class="alert alert-success" role="success">
                New note has been inserted successfully
            </div>';
    }
    ?>
    <div class="container my-4">
        <h3>Add a Note</h3>
        <form method="post" action="index.php">
            <div class="mb-3">
                <label for="title" class="form-label" aria-placeholder="write title here...">Note Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
                <?php
                if ($title_alert) {
                    echo '<p class="text-warning">This field is required</p>';
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Note Description</label>
                <textarea name="description" class="form-control" id="desc" rows="3"
                    placeholder="Describe your note here..."></textarea>
                <?php
                if ($desc_alert) {
                    echo '<p class="text-warning">This field is required</p>';
                }
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Add note</button>
        </form>
    </div>
    <div class="container">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno += 1;
                    echo '<tr>
                        <th scope="row">' . $sno . '</th>
                        <td>' . $row['title'] . '</td>
                        <td>' . $row['description'] . "</td>
                        <td>
                        '<a href='update.php?updateId={$row['sno']}' class='btn btn-warning btn-sm' onclick='return'>Edit</a>
                            '<a href='index.php? deleteId={$row['sno']}' class='btn btn-danger btn-sm' onclick='return'>Delete</a>
                        </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>';
    </div>

    <footer class="bg-dark text-light text-center py-3">
        <p class="mb-0">© 2025 iNotes. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
</body>

</html>