
# Prueba de conocimientos - Contempora

Este repositorio contiene el desarrollo generado de acuerdo a las instrucciones suministradas vía correo electrónico durante el proceso de reclutamiento.


## Sobre este proyecto

Realizado en Laravel 8. No se hizo uso de base de datos ni se instalaron paquetes adicionales.

## Referencia de la API

#### Obtener todos los usuarios

```http
  GET /usuarios
```

#### Obtener usuario por correo electrónico

```http
  GET /usuarios?email="{DIRECCIÓN DE EMAIL}"
```

#### Crear nuevo usuario

```http
  GET /usuarios?email="{DIRECCIÓN DE EMAIL}"
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `nombre` | `string` | **Requerido** |
| `email` | `string` | **Requerido** |
| `genero` | `string` | **Requerido** Valores permitidos: `"male"` o `"female"`|
| `activo` | `string` | **Requerido** Valores permitidos: `"active"` o `"inactive"`|

#### Actualizar usuario
```http
  PUT /usuarios?email="{DIRECCIÓN DE EMAIL}"
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `nombre` | `string` | **Requerido** |
| `genero` | `string` | **Requerido** Valores permitidos: `"male"` o `"female"`|
| `activo` | `string` | **Requerido** Valores permitidos: `"active"` o `"inactive"`|


## Autor

- Juan Reyes

