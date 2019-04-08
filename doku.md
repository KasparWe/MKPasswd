MKPasswd Dokumentation
======================

Die Datenbank wurde von Maximilian Volk mit Hilfe von SQLite3 erstellt und besteht aus 2 Tabellen.
Eine Benutzer Tabelle bestehend aus den Feldern: Benutzername, Passwort des Benutzers und einem zufällig erstellten Key der zur Verschlüsselung benutzt wird.
Die andere Tabelle ist die Passwort Tabelle. Diese besteht aus den Feldern: Name des Service, Benutzername, Passwort und die URL des Services.
Die Passwörter werden mit Hilfe des in der Benutzertabellen gespeicherten Keys und einem zufällig generierten Initialisierungsvektor mit Hilfe des
AES-256-CTR der OpenSSL Bibliothek verschlüsselt und in der Datenbank gespeichert. Der Initialisierungsvektor wird zusammen mit dem verschlüsselten Passwort
zu einem String kombiniert. In diesem String wird :: als Seperator verwendet um bei der Entschlüsselung wieder den Initialisierungsvektor herauszuparsen.
Der Key jedes Benutzers wird beim Hinzufügen des Benutzers automatisch zufällig generiert in der Funktion setKey.
Zugriff auf die Datenbank wird mit Hilfe der SQLite3 Bibliothek von PHP umgesetzt. Mit Hilfe eines PHP Datenbank Objektes, in Zukunft nur noch PDO, genannt.
Das PDO dient der Vorbereitung eines SQL Statements um sicher zu gehen das es zu keinem Problem beim Zugriff auf die Datenbank kommt.
