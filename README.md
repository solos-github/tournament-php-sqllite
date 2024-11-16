Requirements:
Any Webserver with php and sqlite3 module, example uses XAMPP

Deutsch:
Das Miniprojekt setzt ein php voraus, welches in der php.ini das moduls sqllite3 aktiviert hat. 
Für eine Entwicklerversison und zum Testen reicht es dafür xampp zu installieren:
https://www.apachefriends.org/download.html
Nach dem das Setup ausgeführt wurde das Xampp Control Panel starten

![image](https://github.com/user-attachments/assets/19a42da0-cd09-459e-8622-ea1a2590531c)

in der Zeile Apache auf den Button "Config" klicken und die php.ini bearbeiten.
In der ini-Datei nach "extension=sqlite3" suchen und das Semikolon davor entfernen, damit die Extension nicht mehr auskommentiert ist.
Ini speichern und in der Zeile des Apache auf "Start" klicken, dadurch wird der apache-webserver gestartet.
Einfach die 3 Dateien create,resulsts und edit.php in das htpdocs-Verzeichnis des Xampp kopieren. Wenn das Verzeichnis nicht manuell geändert wurde 
müssen die Dateien nach c:\xampp\htdocs\ um im Webserver verarbeitet zu werden bei mir gehen die Dateien nach c:\xampp\htdocs\turnier(Ordner turnier anlegen).


Anschließend vom Browser nach http://localhost/turnier/create.php navigieren.
Dadurch wird automatisch die sqlite3 Datenbank angelegt:

![image](https://github.com/user-attachments/assets/19ece383-46dc-471d-9609-0f03c102c7a7)

Die Datenbank enthält Beispieldaten die man sich direkt über http://localhost/turnier/create.php ansehen kann:

![image](https://github.com/user-attachments/assets/582ab649-833e-43f6-a9f5-f90baf430e28)

Da sqlite eine filebasierte Datenbank ist, wird im verzeichnis c:\xampp\htdocs\turnier eine tournament.db angelegt, die alle daten beinhaltet.
Die Datei kann auch gelöscht und durch erneuten Aufruf der create.php neu erzeugt werden.

Das bearbeiten von den Tabellen sollte selbstverständlich sein.


Wenn der Webserver auch von anderen Geräten aus dem Netzwerk erreichbar sein, muss dafür noch die Apache-Config kurz angepasst werden.
Dafür das Xampp-Controlpanel starten und in der Zeile Apache auf Config klicken und die httpd.conf bearbeiten.

wichtig ist die Änderung auf **require all granted** im Zweig des Direcotry c:/xampp/htdocs:

<Directory "C:/xampp/htdocs">
    Options Indexes FollowSymLinks Includes ExecCGI
    Require all granted
</Directory>

Falls dort Require local steht muss dieses durch Require all granted ersetzt werden.
