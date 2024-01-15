<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include necessary CSS and JavaScript files -->

    <!-- Include the Razorpay JavaScript SDK -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <!-- Display the error message -->
    <div>Error Message: <?php echo $error_message; ?></div>

    <!-- Display the verification attributes -->
    <pre>Verification Attributes: <?php print_r($verification_attributes); ?></pre>
</body>
</html>
