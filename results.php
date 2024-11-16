<?php
// Set the content type to HTML
header("Content-Type: text/html; charset=UTF-8");

try {
    // Connect to the SQLite database
    $db = new SQLite3('tournament.db');
} catch (Exception $e) {
    die("Failed to connect to the database: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ergebnis</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
            text-align: center;
        }
        /* Navigation menu styles */
        nav {
            text-align: center;
            margin-bottom: 20px;
        }
        nav a {
            color: white;
            background-color: #333;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            margin: 0 10px;
        }
        nav a:hover {
            background-color: #777;
        }
        table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #666;
        }
        th, td {
            padding: 10px;
            border: 1px solid #666;
        }
        th {
            background-color: #333;
        }
        tr:nth-child(even) {
            background-color: #222;
        }
    </style>
</head>
<body>

<!-- Navigation Menu -->
<nav>
    <a href="results.php">Ergebnisse</a>
    <a href="edit.php">Bearbeiten</a>
</nav>

<h2>Spiele</h2>
<table>
    <tr>
        <th>Spiel</th>
        <th>Gruppenphase</th>
        <th>Ergebnis</th>
    </tr>
    <?php
    // Fetch data from 'spiele' table
    $results = $db->query("SELECT * FROM spiele");
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['gruppenphase']}</td>
                <td>{$row['ergebnis']}</td>
              </tr>";
    }
    ?>
</table>

<h2>Platzierung</h2>
<table>
    <tr>
        <th>Platz</th>
        <th>Spieler</th>
        <th>Spiele</th>
        <th>Punkte</th>
    </tr>
    <?php
    // Fetch data from 'platzierung' table
    $results = $db->query("SELECT * FROM platzierung");
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>
                <td>{$row['platz']}</td>
                <td>{$row['spieler']}</td>
                <td>{$row['spiele']}</td>
                <td>{$row['punkte']}</td>
              </tr>";
    }
    ?>
</table>

<?php
// Close the database connection
$db->close();
?>

</body>
</html>
