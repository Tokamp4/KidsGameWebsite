<?php
require_once 'Database.php';

$database = new Database();
$db = $database->getConnection();

$query = 'SELECT scoreTime, id, fName, lName, result, livesUsed FROM history';
$stmt = $db->prepare($query);

if($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>'.htmlspecialchars($row['scoreTime']).'</td>';
        echo '<td>'.htmlspecialchars($row['id']).'</td>';
        echo '<td>'.htmlspecialchars($row['fName']).'</td>';
        echo '<td>'.htmlspecialchars($row['lName']).'</td>';
        echo '<td>'.htmlspecialchars($row['result']).'</td>';
        echo '<td>'.htmlspecialchars($row['livesUsed']).'</td>';
        echo '</tr>';
    }
} else {
    echo "<tr><td colspan='6'>No history found.</td></tr>";
}
?>
