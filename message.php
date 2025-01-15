<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Travela - Message</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- ...existing head content... -->
</head>
<body>
    <!-- ...existing body content... -->
    <div class="container-fluid booking py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <?php
                    if ($_GET['status'] == 'success') {
                        echo "<div class='alert alert-success'>Your booking details have been received. We will contact you soon.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>There was an error processing your payment. Please try again.</div>";
                    }
                    ?>
                    <script>
                        setTimeout(function() {
                            window.location.href = 'index.html';
                        }, 5000);
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!-- ...existing body content... -->
</body>
</html>
