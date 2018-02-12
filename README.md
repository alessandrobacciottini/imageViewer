# imageViewer

Link demo applicazione web:
http://imageviewer.altervista.org/            username e password di prova: ale ale 
Purtroppo su questo host gratuito non è attiva l'estensione del PHP Exif, quindi non visualizza nella tabella i metadati relativi al JPEG.

Per una demo funzionante:

INSTALLAZIONE SU LOCALE CON XAMPP

1) Copiare la cartella ImageViewer in C:\xampp\htdocs
2) Su PhpMyadmin in localhost importare il database image_viewer.sql
3) applicazione:  http://localhost/imageViewer/index.php          utente e password di prova: alessandro alessandro

Se PHP non ha estensione Exif abilitata:
1) Su Windows, abilitare php_mbstring.dll e php_exif.dll scommentando nel file php.ini. php_mbstring.dll deve essere caricata PRIMA di php_exif.dll
2) Su Linux (non testato): sudo apt-get install php7.0-mbstring && sudo apt-get install php7.0-common
Per riferimenti: http://php.net/manual/en/exif.installation.php
