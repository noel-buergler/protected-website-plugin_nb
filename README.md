# Schützen Sie Ihre WordPress-Website mit einem Passwort und leiten Sie Benutzer auf der Grundlage des eingegebenen Passworts auf bestimmte Seiten um
In dieser Anleitung erfahren Sie, wie Sie Ihre gesamte WordPress-Website mit einem Passwortschutz versehen und die Benutzer auf der Grundlage des eingegebenen Passworts auf bestimmte Seiten umleiten können.

## Anweisungen
1. Laden Sie die Datei **protect.php** herunter und öffnen Sie sie in einem Texteditor.<br />
2. Ersetzen Sie `password_a` und `password_b` durch die tatsächlichen Passwörter, die Sie verwenden möchten, und ersetzen Sie `https://example.com/page-a` und `https://example.com/page-b` durch die tatsächlichen URLs der Seiten, zu denen Sie umleiten möchten.
3. Zippen Sie die Datei **protect.php** und laden Sie das Plugin über **Plugins hochladen** hoch.
4. Erstellen Sie eine Seite mit Namen **Password Protect** und URL Slug **password-protect**
5. Setzen Sie diese Seite als Homepage bei WordPress
6. Testen Sie Ihre Website, um sicherzugehen, dass sie passwortgeschützt ist und die Benutzer anhand des eingegebenen Passworts auf die entsprechende Seite umleitet.

## Hinweise
Die Datei **protect.php** verwendet Cookies, um das vom Benutzer eingegebene Passwort zu speichern. Wenn der Benutzer seine Cookies löscht, muss er das Passwort erneut eingeben.
Wenn Sie die Passwörter oder die Umleitungs-URLs ändern möchten, bearbeiten Sie einfach die Datei **protect.php** und laden Sie sie erneut auf Ihren Server.