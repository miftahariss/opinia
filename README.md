# Getting started

## Technology

- **Laravel**
- **MySQL**

## Installation

Server Requirements

- `PHP >= 7.2`
- `OpenSSL PHP Extension`
- `PDO PHP Extension`
- `Mbstring PHP Extension`
- `Composer`

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Run the database migrations (**Create your MySQL database and set the database connection in .env file before migrating**)

    php artisan migrate

Serving The Application

	php -S localhost:8000 -t public

You can now access the server at http://localhost:8000

## Usage

## Register

### Request

```http
POST /register form-data
```

Attribute:
- `nik` **required** | **integer**
- `name` **required** | **string**
- `gender` **required** | **string**
- `phone` **required** | **integer**
- `birthday` **required** | **string**
- `address` **required** | **string**
- `salary` **required** | **integer**
- `email` **required** | **string**
- `password` **required** | **string**
- `image` **required** | **file** (choose option "file" in postman)

### Response

```json
Status 200
Content-Type: application/json

{
    "code": "200",
    "message": "User Miftah Aris Setiawan (12345678) successfully registered!"
}
```

## Login

### Request

```http
POST /login form-data
```

Attribute:
- `email` **required** | **string**
- `password` **required** | **string**

### Response

```json
Status 200
Content-Type: application/json

{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmYW1pbHltYXJ0LWp3dCIsInN1YiI6MiwiaWF0IjoxNTk0NzU0MDUyLCJleHAiOjE1OTQ3NTc2NTJ9.2aP2Ihatktp70CBxa4IZRwHmyhH2U_aTLFunnGejdI4"
}
```

## Employee List

#### Request

```http
GET /users
```

Params:
- `token` **required** | **you can get the token from /login response**

### Response

```json
Status 200
Content-Type: application/json

[
    {
        "nik": 444444,
        "name": "Emma Setyaningrum",
        "gender": "female",
        "phone": "2233232",
        "birthday": "1992-05-20",
        "address": "parung",
        "salary": 3000000,
        "email": "emmasetyaningrum20@gmail.com",
        "image": "http://localhost:8000/image_user/H5kiBOj6R52LOIN8rSeuLIKG5FRYjsAkm2.jpg"
    },
    {
        "nik": 12345678,
        "name": "Miftah Aris Setiawan",
        "gender": "male",
        "phone": "089658155683",
        "birthday": "1991-06-15",
        "address": "pamulang",
        "salary": 2500000,
        "email": "miftahariss15@gmail.com",
        "image": "http://localhost:8000/image_user/0XQeYBbWvxZZH0HlJ5vs2A5QUHppf0LmNP.jpg"
    }
]
```

## Absen

### Request

```http
POST /absen form-data
```

Params:
- `token` **required** | **you can get the token from /login response**

Attribute:
- `type` (e.g. "in", "out") **required** | **string**
- `latitude` **required** | **string**
- `longitude` **required** | **string**

### Response with type `in`

```json
Status 200
Content-Type: application/json

{
    "code": "200",
    "message": "User Miftah Aris Setiawan (12345678) successfully in",
    "date": "2020-07-15",
    "time": "02:14:43",
    "coordinates": {
        "latitude": "-6.3095902",
        "longitude": "106.7336749",
        "place": "Home, 1, Jalan Kavling Keuangan, Tangerang Selatan, Kedaung, Pamulang, Banten, 15411, Indonesia",
        "country": "Indonesia"
    }
}
```

### Response with type `out`

```json
Status 200
Content-Type: application/json

{
    "code": "200",
    "message": "User Miftah Aris Setiawan (12345678) successfully out",
    "date": "2020-07-15",
    "time": "02:42:01",
    "coordinates": {
        "latitude": "-6.2038167",
        "longitude": "106.8031553",
        "place": "FamilyMart, Jalan Pejompongan V, RW 05, Daerah Khusus Ibukota Jakarta, Bendungan Hilir, Tanah Abang, Jakarta Pusat, 17431, Indonesia",
        "country": "Indonesia"
    }
}
```