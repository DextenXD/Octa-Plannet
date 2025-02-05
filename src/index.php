<?php
// Capture client details
$ip_address = $_SERVER['REMOTE_ADDR'];
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$timestamp = date('Y-m-d H:i:s');
$request_url = $_SERVER['REQUEST_URI'];

// Validate IP address
if (!filter_var($ip_address, FILTER_VALIDATE_IP)) {
    die("Invalid IP address");
}

// Log to a file (optional)
$log_entry = "IP: $ip_address | Time: $timestamp | URL: $request_url | User Agent: $user_agent" . PHP_EOL;
file_put_contents('access.log', $log_entry, FILE_APPEND | LOCK_EX);

// Send data to a webhook
$webhook_url = 'https://webhook.site/34aaf62f-729d-4ddc-9f19-1c8c36f21e70'; // Replace with your webhook URL
$data = [
    'ip' => $ip_address,
    'user_agent' => $user_agent,
    'timestamp' => $timestamp,
    'url' => $request_url,
    'additional_info' => 'Visit logged from index.php'
];
$payload = json_encode($data);

$ch = curl_init($webhook_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload)
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    error_log('cURL error: ' . curl_error($ch));
} else {
    error_log("Webhook response code: $http_code");
    error_log("Webhook response: $response");
}

curl_close($ch);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Octa Plannet | Home</title>
    <link rel="stylesheet" href="/src/css/style.css" />
    <link rel="shortcut icon" href="/src/img/favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  
  </head>
  <body>
    <header>
      <p class="Title">Octa Plannet</p>
      <h1 class="home-botton">Home</h1>
      <a class="Clothing" href="/src/clothing.html">Clothing</a>
      <a class="Contact" href="/src/contact.html">Contact</a>
      <hr class="Nav-bar"/>
    </header>

    <div class="images">
      <img class="pic2" src="/src/img/pic2.jpg" alt="Picture 2 of clothing"/>
      <img class="pic3" src="/src/img/pic3.jpg" alt="Picture 3 of clothing"/>
      <img class="pic4" src="/src/img/pic4.jpg" alt="Picture 4 of clothing"/>
      <img class="pic1" src="/src/img/pic1.jpeg" alt="Picture 1 of clothing"/>
    </div>

    <div id="shopNow-div" class="shopNow-div">
      <a class="shopNow" href="/src/clothing.html">SHOP NOW!</a>
    </div>

    <footer>
      <hr class="footer-bar" />
      <a class="contact-footer" href="/src/contact.html">Contact Us</a>
      <h2>Sign up for news letter!!</h2>
      <img
        class="svg"
        src="/src/svg/instagram-svgrepo-com.svg"
        alt="Instagram"
      />
      <img class="svg2" src=Octa-Plannet"/src/svg/tiktok-svgrepo-com.svg" alt="TikTok" />
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="Octa-Plannet/src/JavaScript/main.js"></script>
  </body>
</html>
  