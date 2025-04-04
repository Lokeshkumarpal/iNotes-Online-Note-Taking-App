<?php
// connect to the database
$server = "localhost";
$username = "root";
$password = "";
$database = "notes";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die("There is error during connect due to " . mysqli_connect_error());
}
// Fetch the note details if ID is provided
if (isset($_GET['updateId'])) {
    $id = $_GET['updateId'];
    $sql = "SELECT * FROM `notes` WHERE `sno` = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

// Update record when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `sno` = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php"); // Redirect to main page after update
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h3>Edit Note</h3>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?php echo $row['sno']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" name="title" class="form-control" id="title" value="<?php echo $row['title']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Note Description</label>
                <textarea name="description" class="form-control" id="description" rows="3"
                    required><?php echo $row['description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Note</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <footer class="bg-dark text-light text-center py-3">
        <p class="mb-0">© 2025 iNotes. All rights reserved.</p>
    </footer>
</body>

</html>