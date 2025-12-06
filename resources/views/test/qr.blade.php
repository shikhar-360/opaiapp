<!DOCTYPE html>
<html>
<head>
    <title>QR Code</title>
</head>
<body>
    <h1>QR Code Displayed via Base64 URI</h1>
    <!-- Use the variable name we defined in the controller -->
    <img src="{{ $base64Uri }}" alt="QR Code">
</body>
</html>