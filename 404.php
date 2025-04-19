<?php include __DIR__ . "/config.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>404 Not Found</title>
  <link rel="stylesheet" href="<?= STYLE_PATH ?>">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: var(--snow);
      color: black;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 20px;
    }

    h1 {
      font-size: 5rem;
      font-weight: bold;
      color: var(--iris);
      margin-bottom: 10px;
    }

    p {
      font-size: 1.5rem;
      margin-bottom: 30px;
    }

    a {
      text-decoration: none;
      background-color: var(--earth-yellow);
      color: black;
      padding: 12px 24px;
      border-radius: 6px;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    a:hover {
      background-color: var(--tiffany-blue);
      color: black;
    }
  </style>
</head>
<body>
  <h1>404</h1>
  <p>Oops! The page you are looking for doesn't exist.</p>
  <a href="<?= BASE_URL ?>">Back to Home</a>
</body>
</html>
