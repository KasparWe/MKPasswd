MKPasswd Dokumentation
======================

###Beginn

Wir begannen unser Projekt mit der Idee einer Zeittrackingsoftware, welche auf Grund von wirtschaftlichen Problemen verworfen wurden musste.

Das neue Projekt im Rahmen des Fachs Plus an der staatlichen Berufschule 1 Ansbach handelt von einem Passwortmanager, welcher auf einem eigenem System gehostet werden muss.

###Systemanforderungen

* Webserver mit mind. PHP 7.0
* MYSQL Server

###Benutze Frameworks

* mdBootstrap - modernes Bootstrap (CSS & JS)
* clipboardJS - kopieren der Passwortdaten in die Zwischablage
* Datatables - anzeigen der Passwörter in einer Liste mit Sortier- und Suchfunktion


Die Datenbank wurde von Maximilian Volk mit Hilfe von SQLite3 erstellt und besteht aus 2 Tabellen.
Eine Benutzer Tabelle bestehend aus den Feldern: Benutzername, Passwort des Benutzers und einem zufällig erstellten Key der zur Verschlüsselung benutzt wird.
Die andere Tabelle ist die Passwort Tabelle. Diese besteht aus den Feldern: Name des Service, Benutzername, Passwort und die URL des Services.
Die Passwörter werden mit Hilfe des in der Benutzertabellen gespeicherten Keys und einem zufällig generierten Initialisierungsvektor mit Hilfe des
AES-256-CTR der OpenSSL Bibliothek verschlüsselt und in der Datenbank gespeichert. Der Initialisierungsvektor wird zusammen mit dem verschlüsselten Passwort
zu einem String kombiniert. In diesem String wird :: als Seperator verwendet um bei der Entschlüsselung wieder den Initialisierungsvektor herauszuparsen.
Der Key jedes Benutzers wird beim Hinzufügen des Benutzers automatisch zufällig generiert in der Funktion setKey.
Zugriff auf die Datenbank wird mit Hilfe der SQLite3 Bibliothek von PHP umgesetzt. Mit Hilfe eines PHP Datenbank Objektes, in Zukunft nur noch PDO, genannt.
Das PDO dient der Vorbereitung eines SQL Statements um sicher zu gehen das es zu keinem Problem beim Zugriff auf die Datenbank kommt.

Das Frontend sowie einige Funktionen wurden von Kaspar Wetsch gebaut. Wir entschieden uns für als Frotendframework wür eine erweiterte Version von Bootstrap. Serverseitig wird alles von PHP gemanaged.

Der Passwortmanager selbst verfügt über ein Loginsystem, welches von lokalen Adminstratoren verwaltet werden kann.

Jegliche fortschritte können im verlinkten GitHub Reposistory nachgesehen werden. 

