<?php

$submitted = false;

$server = "localhost";
$username = "root";
$password = "";
$database = "notes";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die("There is error during connect due to " . mysqli_connect_error());
}

if (isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["message"])) {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $sql = "INSERT INTO `feedback` (`name`, `phone`, `email`, `message`) VALUES ('$name', '$phone', '$email', '$message')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $submitted = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - iNotes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">iNotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about_us.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact_us.php">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contact Us Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="fw-bold">Contact Us</h1>
                <p class="lead text-muted">We'd love to hear from you! Get in touch with us.</p>
                <hr>
                <p class="text-justify">
                    If you have any questions, suggestions, or need assistance with <strong>iNotes</strong>, feel free
                    to reach out.
                    Our team is always here to help!
                </p>

                <h3 class="mt-4"> Get in Touch</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> Email: <strong>support@inotes.com</strong></li>
                    <li class="list-group-item"> Address: 123 Note Street, Digital City, xxxx</li>
                    <li class="list-group-item"> Phone: +1 234 567 xxx</li>
                </ul>

                <?php if (!$submitted) {
                    echo '<div>
                <h3 class="mt-4"> Send Us a Message</h3>
                <form class="text-start mt-3" method="POST" action="contact_us.php">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" name = "name" class="form-control" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Your Phone</label>
                        <input type="phone" name="phone" class="form-control" id="phone" placeholder="Enter your phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea name="message" class="form-control" id="message" rows="4" placeholder="Type your message here"
                            required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
                </div>';
                } else {
                    echo '<div class="alert alert-success" role="success">
                ThankYou! For Your Message. Your Message is Important to us.
            </div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light text-center py-3">
        <p class="mb-0">© 2025 iNotes. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>