# Getting started

## Technology

- **Codeigniter 4**
- **MySQL**

## Installation

Server Requirements

- `PHP >= 7.4`
- `OpenSSL PHP Extension`
- `PDO PHP Extension`
- `Mbstring PHP Extension`
- `Composer`

Install all the dependencies using composer

    composer install

Copy the env file and make the required configuration changes in the .env file

    cp env .env

Run the database migrations (**Create your MySQL database and set the database connection in .env file before migrating**)

    php spark migrate

Serving The Application

	php spark serve

You can now access the server at http://localhost:8080

## Usage

## Register

### Request

```http
POST /register data-raw
```

```json
{
    "fullname" : "Miftah Aris Setiawan",
    "phone" : "089658155683",
    "email" : "miftahariss15@gmail.com",
    "password" : "123456",
    "confpassword" : "123456"
}
```

### Response

```json
Status 200
Content-Type: application/json

{
    "code": 200,
    "message": "User Successfully registered!"
}
```

## Login

### Request

```http
POST /login data-raw
```

```json
{
    "fullname" : "Miftah Aris Setiawan",
    "phone" : "089658155683",
    "email" : "miftahariss15@gmail.com",
    "password" : "123456",
    "confpassword" : "123456"
}
```

### Response

```json
Status 200
Content-Type: application/json

{
    "code": 200,
    "message": "User Successfully login!",
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NTQ4NjM2NTcsInVpZCI6IjIiLCJlbWFpbCI6Im1pZnRhaGFyaXNzMTVAZ21haWwuY29tIn0.iJt-2VFCKZj0BmmEi-hhtCWiVZ3HVwirEjv6Jis6J1g"
    }
}
```

## CRUD POSTINGAN

#### Request

```http
GET /postingan
```

Header Authorization Bearer:
- `Authorization` **required** | **you can get the token from /login response for Authorization**

### Response

```json
Status 200
Content-Type: application/json

{
    "code": 200,
    "message": "Postingan found!",
    "data": [
        {
            "id": "5",
            "title": "Bismillah",
            "description": "ismillah",
            "post_type": {
                "jenis": "Esai",
                "post_type": "Artikel"
            },
            "user": {
                "fullname": "Miftah Aris Setiawan",
                "phone": "089658155683",
                "email": "miftahariss15@gmail.com"
            },
            "status": "1",
            "created_date": "2022-06-10 18:38:01",
            "updated_date": "2022-06-10 18:38:01"
        },
        {
            "id": "3",
            "title": "Abi",
            "description": "Bia",
            "post_type": {
                "jenis": "Opini",
                "post_type": "Artikel"
            },
            "user": {
                "fullname": "Aris Aja",
                "phone": "089658155683",
                "email": "miftahariss@gmail.com"
            },
            "status": "1",
            "created_date": "2022-06-10 18:14:30",
            "updated_date": "2022-06-10 18:35:01"
        }
    ]
}
```

### Request

```http
POST /postingan/create data-raw
```

Header Authorization Bearer:
- `Authorization` **required** | **you can get the token from /login response for Authorization**

```json
{
    "title" : "Bismillah",
    "description" : "ismillah",
    "post_type_id" : "7"
}
```

### Response

```json
Status 200
Content-Type: application/json

{
    "code": 200,
    "message": "Postingan Successfully created!"
}
```

### Request

```http
POST /postingan/update data-raw
```

Header Authorization Bearer:
- `Authorization` **required** | **you can get the token from /login response for Authorization**

```json
{
    "id" : "3",
    "title" : "Abi",
    "description" : "Bia",
    "post_type_id" : "3"
}
```

### Response

```json
Status 200
Content-Type: application/json

{
    "code": 200,
    "message": "Postingan Successfully updated!"
}
```

### Request

```http
POST /postingan/delete data-raw
```

Header Authorization Bearer:
- `Authorization` **required** | **you can get the token from /login response for Authorization**

```json
{
    "id" : "3"
}
```

### Response

```json
Status 200
Content-Type: application/json

{
    "code": 200,
    "message": "Postingan Successfully deleted!"
}
```


## CRUD POST TYPE

#### Request

```http
GET /post_type
```

Header Authorization Bearer:
- `Authorization` **required** | **you can get the token from /login response for Authorization**

### Response

```json
Status 200
Content-Type: application/json

{
    "code": 200,
    "message": "Post Type found!",
    "data": [
        {
            "id": "3",
            "jenis": "Opini",
            "post_type": "Artikel",
            "status": "1",
            "created_date": "2022-06-10 17:36:43",
            "updated_date": "2022-06-10 18:27:10"
        },
        {
            "id": "4",
            "jenis": "Cerpen",
            "post_type": "Artikel",
            "status": "1",
            "created_date": "2022-06-10 17:37:04",
            "updated_date": "2022-06-10 17:37:04"
        },
        {
            "id": "5",
            "jenis": "Idea",
            "post_type": "Idea",
            "status": "1",
            "created_date": "2022-06-10 17:37:19",
            "updated_date": "2022-06-10 17:37:19"
        },
        {
            "id": "6",
            "jenis": "Esai",
            "post_type": "Artikel",
            "status": "1",
            "created_date": "2022-06-10 17:37:38",
            "updated_date": "2022-06-10 17:37:38"
        }
    ]
}
```

### Request

```http
POST /post_type/create data-raw
```

Header Authorization Bearer:
- `Authorization` **required** | **you can get the token from /login response for Authorization**

```json
{
    "jenis" : "Esai",
    "type" : "Artikel"
}
```

### Response

```json
Status 200
Content-Type: application/json

{
    "code": 200,
    "message": "Post Type Successfully created!"
}
```

### Request

```http
POST /post_type/update data-raw
```

Header Authorization Bearer:
- `Authorization` **required** | **you can get the token from /login response for Authorization**

```json
{
    "id" : "3",
    "jenis" : "Opini",
    "type" : "Artikel"
}
```

### Response

```json
Status 200
Content-Type: application/json

{
    "code": 200,
    "message": "Post Type Successfully updated!"
}
```

### Request

```http
POST /post_type/delete data-raw
```

Header Authorization Bearer:
- `Authorization` **required** | **you can get the token from /login response for Authorization**

```json
{
    "id" : "7"
}
```

### Response

```json
Status 200
Content-Type: application/json

{
    "code": 200,
    "message": "Post Type Successfully deleted!"
}
```