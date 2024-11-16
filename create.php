<?php
// Datenbank erstellen oder öffnen
$db = new SQLite3('tournament.db');

// Verbindung checken
if (!$db) {
    die("Failed to connect to SQLite: " . $db->lastErrorMsg());
}

// 1. spiele tabelle anlegen
$db->exec("CREATE TABLE IF NOT EXISTS spiele (
    id INTEGER PRIMARY KEY,
    gruppenphase VARCHAR(50),
    ergebnis VARCHAR(50)
)");

// 2. platzierungstabelle anlegen
$db->exec("CREATE TABLE IF NOT EXISTS platzierung (
    platz VARCHAR(10),
    spieler VARCHAR(50),
    spiele VARCHAR(50),
    punkte VARCHAR(10)
)");

// Insert sample data into 'spiele' table
$db->exec("INSERT INTO spiele (id, gruppenphase, ergebnis) VALUES
    (1, 'Gruppenphase A', '2-1'),
    (2, 'Gruppenphase A', '1-1'),
    (3, 'Gruppenphase B', '3-0'),
    (4, 'Gruppenphase B', '0-2'),
    (5, 'Gruppenphase C', '1-0'),
    (6, 'Gruppenphase C', '2-2'),
    (7, 'Gruppenphase D', '0-0'),
    (8, 'Gruppenphase D', '4-1'),
    (9, 'Gruppenphase E', '3-3'),
    (10, 'Gruppenphase E', '2-1'),
    (11, 'Gruppenphase F', '1-4')
");

// Insert sample data into 'platzierung' table
$db->exec("INSERT INTO platzierung (platz, spieler, spiele, punkte) VALUES
    ('1', 'Mario', '1', '10'),
    ('2', 'Luigi', '2', '8'),
    ('3', 'Peach', '3', '6'),
    ('4', 'Toad', '4', '5'),
    ('5', 'Bowser', '5', '3')
");

// Fetch and display data from 'spiele' table
echo "<h3>Spiele Table</h3>";
$results = $db->query("SELECT * FROM spiele");
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    echo "ID: {$row['id']} | Gruppenphase: {$row['gruppenphase']} | Ergebnis: {$row['ergebnis']}<br>";
}

echo "<hr>";

// Fetch and display data from 'platzierung' table
echo "<h3>Platzierung Table</h3>";
$results = $db->query("SELECT * FROM platzierung");
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    echo "Platz: {$row['platz']} | Spieler: {$row['spieler']} | Spiele: {$row['spiele']} | Punkte: {$row['punkte']}<br>";
}

// Close the database connection
$db->close();
?>
