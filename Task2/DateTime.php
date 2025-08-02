<?php
date_default_timezone_set('Africa/Cairo');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cairo Date & Time</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            text-align: center; 
            padding: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
        }
        .time { font-size: 3em; color: #fff; margin: 20px 0; }
        .date { font-size: 1.8em; color: #f0f0f0; margin: 10px 0; }
        .info { background: rgba(255,255,255,0.1); padding: 20px; border-radius: 10px; margin: 20px 0; }
        a { color: #fff; text-decoration: none; padding: 10px 20px; background: rgba(255,255,255,0.2); border-radius: 5px; }
    </style>
    <meta http-equiv="refresh" content="1"> <!-- Auto-refresh every second -->
</head>
<body>
    <h1>🕐 Cairo Time Zone</h1>
    <div class="time"><?= date('H:i:s') ?></div>
    <div class="date"><?= date('l, F j, Y') ?></div>
    
    <div class="info">
        <p><strong>Server timezone:</strong> <?= date_default_timezone_get() ?></p>
        <p><strong>Unix timestamp:</strong> <?= time() ?></p>
        <p><strong>24-hour format:</strong> <?= date('H:i:s') ?></p>
        <p><strong>12-hour format:</strong> <?= date('h:i:s A') ?></p>
    </div>
    
    <a href="<?= $_SERVER['PHP_SELF'] ?>">Manual Refresh</a>
</body>
</html>
