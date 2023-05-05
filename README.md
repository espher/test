*******************
#TEST
*******************

*******************
Para instalar la aplicacion <br>
1 - Debes de tener cualquier ambiente LAMP previamente instalado en tu ordenador <br>
2 - Clona el repositorio dentro de tu ambiente LAMP <br>
3 - Modifica el archivo .env conforme a tus datos <br>
4 - Corre las migraciones  <br>
	Dentro de un command line, dirigete a la carpeta base del proyecto y corre el siguiente comando <br>
	<b>php index.php migrate</b><br>
	el mensaje "Migrated Successfully" indica que todo corrio bien y las tablas fueron creadas correctamente<br>
5 - Happy testing<br>
*******************


*******************
##API - CALLS

<b>##AUTHORS</b> <br>
<b>GET</b><br>
get all book<br>
/api/authors/<br>

get single book<br>
/api/authors/1<br>

<b>POST</b><br>
create book<br>
/api/authors/<br>

<b>PUT</b> <br>
update a book<br>
/api/authors/1<br>

<b>DELETE</b> <br>
delete a book<br>
/api/authors/1

<br><br>

<b>##BOOKS</b><br>
<b>GET</b><br>
get all book<br>
/api/books/<br>

get single book<br>
/api/books/1<br>

<b>POST</b><br>
create book<br>
/api/books/<br>

<b>PUT</b> <br>
update a book<br>
/api/books/1<br>

<b>DELETE</b> <br>
delete a book<br>
/api/books/1<br>

<br><br>

<b>##GENDERS</b><br>
<b>GET</b><br>
get all book<br>
/api/genders/<br>

get single book<br>
/api/genders/1<br>

<b>POST</b><br>
create book<br>
/api/genders/<br>

PUT 
update a book
/api/genders/1

<b>DELETE</b> <br>
delete a book<br>
/api/genders/1<br>
*******************