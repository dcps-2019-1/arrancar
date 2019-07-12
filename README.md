# Guia de instalación
Es necesario realizar NPM install para descargar las dependencias necesarias para ver el proyecto desplegado correctamente,

Se debe hacer el uso de los seed, para poblar la base de datos con usuarios por defecto.
php artisan db:seed.  -->Si se va a usar un motor de BD diferente a mysql, se debe borrar de los seeders las lineas:

DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

Despues de ejecutar los seeders, se puede acceder al sistema con:

conductor: 
usuario: conductor1
password: 123456

empresa: 
usuario: empresa1
password: 123456
