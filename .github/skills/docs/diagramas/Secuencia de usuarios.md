sequenceDiagram
    actor Admin
    participant View as Vista
    participant Controller
    participant Model
    participant DB

    Note over Admin, DB: 1. Crear Usuario
    Admin->>View: Envia formulario de registro
    View->>Controller: POST /users
    Controller->>Controller: Valida los datos
    alt Validacion Exitosa
        Controller->>Model: User create
        Model->>DB: INSERT INTO users
        DB-->>Model: Retorna nuevo registro
        Model-->>Controller: Retorna instancia
        Controller-->>View: Redirige con exito
        View-->>Admin: Muestra mensaje creado
    else Validacion Fallida
        Controller-->>View: Redirige con errores
        View-->>Admin: Muestra errores
    end

    Note over Admin, DB: 2. Leer Usuarios
    Admin->>View: Solicita ver lista
    View->>Controller: GET /users
    Controller->>Model: User all
    Model->>DB: SELECT FROM users
    DB-->>Model: Retorna registros
    Model-->>Controller: Retorna coleccion
    Controller-->>View: Renderiza vista
    View-->>Admin: Muestra la tabla

    Note over Admin, DB: 3. Actualizar Usuario
    Admin->>View: Solicita editar
    View->>Controller: GET /users/id/edit
    Controller->>Model: User find
    Model->>DB: SELECT FROM users WHERE id
    DB-->>Model: Retorna registro
    Model-->>Controller: Retorna instancia
    Controller-->>View: Muestra formulario
    View-->>Admin: Presenta datos actuales

    Admin->>View: Modifica datos y guarda
    View->>Controller: PUT /users/id
    Controller->>Controller: Valida los datos
    Controller->>Model: user update
    Model->>DB: UPDATE users
    DB-->>Model: Confirmacion
    Model-->>Controller: Retorna confirmacion
    Controller-->>View: Redirige con exito
    View-->>Admin: Muestra mensaje actualizado

    Note over Admin, DB: 4. Eliminar Usuario
    Admin->>View: Clic en Eliminar
    View->>Controller: DELETE /users/id
    Controller->>Model: User destroy
    Model->>DB: DELETE FROM users
    DB-->>Model: Confirmacion de borrado
    Model-->>Controller: Retorna confirmacion
    Controller-->>View: Redirige con exito
    View-->>Admin: Muestra mensaje eliminado
