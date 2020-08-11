## API Math - Distancia entre 2 puntos
Facundo Igua - Full Stack Web Developer

https://www.linkedin.com/in/facundoiguadeveloper/
##
## Particularidades
*El guardado de los puntos se realiza en memoria.

*La ejecución y pruebas del código se pueden realizar con cualquier cliente API-REST o similares (Insomnia/Postman) enviando los datos del request en un multipart-form mediante el método POST. 
##
## Ejecución del código
1 - Dentro de la carpeta raíz ejecutar la instalación de dependencias utilizando Composer

`composer install -vv
`

2 - También Dentro de la carpeta raíz ejecutar una instancia de servidor de PHP

###### `php -S localhost:80 -t public`
##
## Endpoints

[`'/puntos'`] => form: `{}`

(Retorna todos los puntos guardados)
##
[`'/puntos/crear'`] => form: `{'x': (_float_), 'y': (_float_)}`

(Crea un nuevo punto a partir de las coordenadas de X e Y)
##
[`'/puntos/modificar'`] => form: `{'id': (_string_), 'x': (_float_), 'y': (_float_)}`

(Modifica un punto existente a partir del ID generado por el programa y actualizando los valores de X e Y)
##
[`'/puntos/borrar'`] => form: `{'id': (_string_)}`

(Borra un punto existente a partir del ID generado por el programa)
##
[`'/puntos/ubicacion'`] => form: `{'id': (_string_)}`

(Obtiene las coordenadas de un punto existente a partir del ID generado por el programa)
##
[`'/puntos/cercanos'`] => form: `{'id': (_string_), 'cantidad': (_int_)}`

(Obtiene los puntos ordenados por cercanía hacia el punto requerido a partir del ID generado por el programa, con posibilidad de ingresar cantidad de puntos cercanos obtenidos)
##
