<?php
// Set the content type to HTML
header("Content-Type: text/html; charset=UTF-8");

// Connect to the SQLite database
try {
    $db = new SQLite3('tournament.db');
} catch (Exception $e) {
    die("Failed to connect to the database: " . $e->getMessage());
}

// Handle updates for 'spiele' table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_spiele'])) {
    $id = $_POST['id'];
    $gruppenphase = $_POST['gruppenphase'];
    $ergebnis = $_POST['ergebnis'];

    $stmt = $db->prepare("UPDATE spiele SET gruppenphase = ?, ergebnis = ? WHERE id = ?");
    $stmt->bindValue(1, $gruppenphase);
    $stmt->bindValue(2, $ergebnis);
    $stmt->bindValue(3, $id);
    $stmt->execute();
}

// Handle updates for 'platzierung' table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_platzierung'])) {
    $platz = $_POST['platz'];
    $spieler = $_POST['spieler'];
    $spiele = $_POST['spiele'];
    $punkte = $_POST['punkte'];

    $stmt = $db->prepare("UPDATE platzierung SET spieler = ?, spiele = ?, punkte = ? WHERE platz = ?");
    $stmt->bindValue(1, $spieler);
    $stmt->bindValue(2, $spiele);
    $stmt->bindValue(3, $punkte);
    $stmt->bindValue(4, $platz);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnier bearbeiten</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
            text-align: center;
        }
        /* Top Menu Styling */
        .menu {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            padding: 10px;
            border-radius: 5px;
        }
        .menu a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 0 15px;
            font-size: 16px;
        }
        .menu a:hover {
            background-color: #555;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #666;
        }
        th, td {
            padding: 8px; /* Reduced padding for smaller font */
            border: 1px solid #666;
            font-size: 14px; /* Reduced font size */
        }
        th {
            background-color: #333;
        }
        tr:nth-child(even) {
            background-color: #222;
        }
        input[type="text"], input[type="number"] {
            width: 80%;
            padding: 5px;
            background-color: #444;
            color: white;
            border: 1px solid #666;
            font-size: 14px; /* Reduced font size */
        }
        input[type="submit"] {
            background-color: #555;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            font-size: 14px; /* Reduced font size */
        }
        input[type="submit"]:hover {
            background-color: #777;
        }
    </style>
</head>
<body>

<!-- Menu Section -->
<div class="menu">
    <a href="results.php">Ergebnisse</a>
    <a href="edit.php">Bearbeiten</a>
    <!-- <a href="another-page.php">Andere Seite</a> --> <!-- Add any other links as needed -->
</div>

<h2>Spiele bearbeiten</h2>
<form method="post">
    <table>
        <tr>
            <th>Spiel</th>
            <th>Gruppenphase</th>
            <th>Ergebnis</th>
            <th>Ändern</th> <!-- Changed 'Action' to 'Ändern' -->
        </tr>
        <?php
        // Fetch data from 'spiele' table
        $results = $db->query("SELECT * FROM spiele");
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            echo "<tr>
                <form method='post'>
                    <td>{$row['id']}<input type='hidden' name='id' value='{$row['id']}'></td>
                    <td><input type='text' name='gruppenphase' value='{$row['gruppenphase']}'></td>
                    <td><input type='text' name='ergebnis' value='{$row['ergebnis']}'></td>
                    <td><input type='submit' name='update_spiele' value='Ändern'></td> <!-- Changed to 'Ändern' -->
                </form>
              </tr>";
        }
        ?>
    </table>
</form>

<h2>Platzierung bearbeiten</h2>
<form method="post">
    <table>
        <tr>
            <th>Platz</th>
            <th>Spieler</th>
            <th>Spiele</th>
            <th>Punkte</th>
            <th>Ändern</th> <!-- Changed 'Action' to 'Ändern' -->
        </tr>
        <?php
        // Fetch data from 'platzierung' table
        $results = $db->query("SELECT * FROM platzierung");
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            echo "<tr>
                <form method='post'>
                    <td>{$row['platz']}<input type='hidden' name='platz' value='{$row['platz']}'></td>
                    <td><input type='text' name='spieler' value='{$row['spieler']}'></td>
                    <td><input type='text' name='spiele' value='{$row['spiele']}'></td>
                    <td><input type='number' name='punkte' value='{$row['punkte']}'></td>
                    <td><input type='submit' name='update_platzierung' value='Ändern'></td> <!-- Changed to 'Ändern' -->
                </form>
              </tr>";
        }
        ?>
    </table>
</form>

<?php
// Close the database connection
$db->close();
?>
</body>
</html>
