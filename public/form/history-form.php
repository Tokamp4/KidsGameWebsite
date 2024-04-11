<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game History</title>
    <link rel="stylesheet" href="../assets/css/history.css">
</head>
<body>
    <div class="container">
        <h1>Game History</h1>
        <table>
            <thead>
                <tr>
                    <th>Score Time</th>
                    <th>Player ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Result</th>
                    <th>Lives Used</th>
                </tr>
            </thead>
            <tbody>
                <?php include($_SERVER['DOCUMENT_ROOT'] . '/src/features/history.php'); ?>
            </tbody>
        </table>
    </div>
</body>
</html>
