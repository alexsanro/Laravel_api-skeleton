# Api-skelleton

Es un "template" para desarrollar APIs rápidamente. Sólo contiene un controlador para registrar, logear y obtener los usuarios haciendo uso de la librearía PASSPORT de Laravel. Junto con un archivo Jenksinfile para su CI, Tests

Este proyecto es fácilmente montable por lo que si necesitamos montar una estructura base de API solo es necesario descargar el proyecto y arrancarlo teniendo los requisitos descriptos abajo.

## Requisitos

- Visual Studio Code (Recomendado). 
- Docker.
- Docker plugin para Visual Studio Code.
- Remote containers plugin para Vscode.

## Montaje

Descargamos el proyecto:

```
git clone git@github.com:alexsanro/Laravel_api-skeleton.git
```

Abrimos Vscode, seleccionamos el proyecto, clicamos en el icono abajo a la izquierda en verde(><) > Reopen in container. Esto montará los dockers dentro de la carpeta **.devcontainer** y prepará el entorno de desarrollo. 

Una vez montados los contenedores procedemos a montar el proyecto. Todos estos comandos es necesario lanzarlos dentro del contenedor Docker para que funcione, desde la terminal de VScode que se genera.

### Dependencias:

```
gradle composerInstall
```

### Generación archivo .env:

```
gradle generateEnvFile
```

### Generar base de datos: 

- Por defecto:
    - User: root
    - password: 1234
    - dabase: api_database

```
gradle migrateDatabase
```

### Generar el token de PASSPORT

```
gradle passportToken
```

## Testing API

Levantamos el servidor: 

```
gradle serverStart
```

The api can now be accessed at

```
http://localhost:8000
```

Request headers

| **Required** 	| **Key**       | **Value**         |
|----------	|------------------	|------------------	|
| Yes      	| Accept     	    | application/json 	|
| Yes      	| Content-Type     	| application/json 	|
| Yes      	| X-Requested-With 	| XMLHttpRequest   	|
| Optional 	| Authorization    	| Bearer *Token*    |
