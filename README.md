# Backend for Hospital Patient Management System

Backend for Hospital Patient Management System

## About

This is a simple REST API for Hospital Patient Management System. This API is built using Phalcon Framework.
With this API, you can:

- Get all patients data
- Create new data patient
- Edit data patient
- Get detail data patient by id
- Delete data patient by id

## Requirements

- PHP >= 7.4
- Phalcon >= 4.0.4 (https://phalcon.io/en-us/download)

## Setup

- Clone this repository
- Make sure Phalcon Framework is installed on the machine (https://phalcon.io/en-us/download)
- Create database and import the database schema from `createDB.sql`
- Configure the database connection in `app/config/config.php` (if necessary)
- Run the server using the command `phalcon serve`

## Endpoints

List of Available Endpoints:

- `GET /patients`
- `POST /patients`
- `PUT /patients/:id`
- `GET /patients/:id`
- `DELETE /patients/:id`

### GET /users

#### Description

- Get all patients data

#### Response

_200 - OK_

```json
{
    "status": {
        "code": 200,
        "response": "success",
        "message": "Example of success get data"
    },
    "result": [
            {
                "id": Integer,
                "nik": String,
                "name": String,
                "sex": String,
                "religion": String,
                "phone": String,
                "address": String
                }
            ]
}

```

### POST /users

#### Description

- Create new data patient

#### Request

- Body

  ```json
    {
    "nik" : String,
    "name" : String,
    "sex": String (One of: "Male", "Female", "Other"),
    "religion" : String,
    "phone" : String,
    "address" : String
    }
  ```

- Headers

  ```json
  {
    "Accept": "application/json",
    "Content-Type": "application/json"
  }
  ```

#### Response

_200 - OK_

```json
{
    "status": {
        "code": 200,
        "response": "success",
        "message": "Example of success created data"
    },
    "result": {
            "id": Integer,
            "nik": String,
            "name": String,
            "sex": String,
            "religion": String,
            "phone": String,
            "address": String
            }
}
```

_400 - Bad Request (Invalid Sex Value)_

```json
{
  "status": {
    "code": 400,
    "response": "Bad Request",
    "message": "Invalid value for the 'sex' field. Allowed values are: Male, Female, Other."
  }
}
```

_409 - Conflict (Duplicate NIK)_

```json
{
  "status": {
    "code": 409,
    "response": "Conflict",
    "message": "A patient with the same NIK already exists."
  }
}
```

_409 - Conflict_

```json
{
  "status": {
    "code": 409,
    "response": "Conflict",
    "message": "Example of error conflict create data"
  }
}
```

### PUT /users/:id

#### Description

- Edit data patient

#### Request

- Params

  ```json
    {
    "id" : Integer
    }
  ```

- Body

  ```json
    {
    "nik" : String,
    "name" : String,
    "sex": String (One of: "Male", "Female", "Other"),
    "religion" : String,
    "phone" : String,
    "address" : String
    }
  ```

- Headers

  ```json
  {
    "Accept": "application/json",
    "Content-Type": "application/json"
  }
  ```

#### Response

_200 - OK_

```json
{
    "status": {
        "code": 200,
        "response": "success",
        "message": "Example of success update data"
    },
    "result": {
            "id": Integer,
            "nik": String,
            "name": String,
            "sex": String,
            "religion": String,
            "phone": String,
            "address": String
            }
}
```

_400 - Bad Request (Invalid Sex Value)_

```json
{
  "status": {
    "code": 400,
    "response": "Bad Request",
    "message": "Invalid value for the 'sex' field. Allowed values are: Male, Female, Other."
  }
}
```

_409 - Conflict_

```json
{
  "status": {
    "code": 409,
    "response": "Conflict",
    "message": "Example of error conflict create data"
  }
}
```

_404 - Not Found (Patient Not Found)_

```json
{
  "status": {
    "code": 404,
    "response": "Not Found",
    "message": "Example of error data not found"
  }
}
```

### GET /users/:id

#### Description

- Get detail data patient by id

#### Request

- Params

  ```json
    {
    "id" : Integer
    }

  ```

- Headers

  ```json
  {
    "Accept": "application/json",
    "Content-Type": "application/json"
  }
  ```

#### Response

_200 - OK_

```json
{
    "status": {
        "code": 200,
        "response": "success",
        "message": "Example of success get detail data"
    },
    "result": {
            "id": Integer,
            "nik": String,
            "name": String,
            "sex": String,
            "religion": String,
            "phone": String,
            "address": String
            }
}
```

_409 - Conflict_

```json
{
  "status": {
    "code": 409,
    "response": "Conflict",
    "message": "Example of error conflict delete data"
  }
}
```

_404 - Not Found (Patient Not Found)_

```json
{
  "status": {
    "code": 404,
    "response": "Not Found",
    "message": "Example of error data not found"
  }
}
```

### DELETE /users/:id

#### Description

- Delete data patient by id

#### Request

- Headers
  ```json
  {
    "Accept": "application/json",
    "Content-Type": "application/json"
  }
  ```
- Params
  ```json
  {
    "id" : Integer
  }
  ```

#### Response

_200 - OK_

```json
{
  "status": {
    "code": 204,
    "response": "success",
    "message": "Example of success delete data"
  }
}
```

_404 - Not Found (Patient Not Found)_

```json
{
  "status": {
    "code": 404,
    "response": "Not Found",
    "message": "Example of error data not found"
  }
}
```
