*******************
TEST
*******************

*******************
Para instalar la aplicacion 

1 - Debes de tener cualquier ambiente LAMP previamente instalado en tu ordenador 

2 - Clona el repositorio dentro de tu ambiente LAMP 

3 - Modifica el archivo .env conforme a tus datos 

4 - Corre las migraciones  

	Dentro de un command line, dirigete a la carpeta base del proyecto y corre el siguiente comando 
	
	<b>php index.php migrate</b>
	
	el mensaje "Migrated Successfully" indica que todo corrio bien y las tablas fueron creadas correctamente
	
5 - Happy testing

*******************


*******************
API - CALLS

AUTHORS
GET
get all book
/api/authors/

get single book
/api/authors/1

POST
create book
/api/authors/

PUT 
update a book
/api/authors/1

DELETE 
delete a book
/api/authors/1



BOOKS
GET
get all book
/api/books/

get single book
/api/books/1

POST
create book
/api/books/

PUT 
update a book
/api/books/1

DELETE 
delete a book
/api/books/1



GENDERS
GET
get all book
/api/genders/

get single book
/api/genders/1

POST
create book
/api/genders/

PUT 
update a book
/api/genders/1

DELETE 
delete a book
/api/genders/1
*******************