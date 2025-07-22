# Sneaker Store API Documentation

## Base URL
```
http://localhost:8000/api
```

## Authentication
This API uses Laravel Sanctum for authentication. Include the Bearer token in the Authorization header:
```
Authorization: Bearer {your-token}
```

## API Endpoints

### Authentication

#### Register
```http
POST /api/auth/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

#### Login
```http
POST /api/auth/login
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password123"
}
```

#### Get Current User
```http
GET /api/auth/me
Authorization: Bearer {token}
```

#### Logout
```http
POST /api/auth/logout
Authorization: Bearer {token}
```

### Products (Shoes)

#### Get All Shoes
```http
GET /api/shoes?page=1&per_page=12&search=nike&brand_id=1&min_price=50&max_price=200&sort_by=price&sort_order=asc
```

#### Get Single Shoe
```http
GET /api/shoes/{id}
```

#### Search Shoes
```http
GET /api/shoes/search?keyword=jordan
```

#### Create Shoe (Admin Only)
```http
POST /api/admin/shoes
Authorization: Bearer {admin-token}
Content-Type: multipart/form-data

{
    "shoe_name": "Air Jordan 1",
    "shoe_model_id": 1,
    "price": 150.00,
    "stock_quantity": 50,
    "shoe_image": [file],
    "sizes": [7, 7.5, 8, 8.5, 9, 9.5, 10]
}
```

#### Update Shoe (Admin Only)
```http
PUT /api/admin/shoes/{id}
Authorization: Bearer {admin-token}
Content-Type: application/json

{
    "shoe_name": "Air Jordan 1 Retro",
    "price": 160.00,
    "stock_quantity": 45
}
```

#### Delete Shoe (Admin Only)
```http
DELETE /api/admin/shoes/{id}
Authorization: Bearer {admin-token}
```

### Brands

#### Get All Brands
```http
GET /api/brands
```

#### Get Single Brand
```http
GET /api/brands/{id}
```

#### Get Brand Models
```http
GET /api/brands/{id}/models
```

#### Create Brand (Admin Only)
```http
POST /api/admin/brands
Authorization: Bearer {admin-token}
Content-Type: application/json

{
    "brand_name": "Nike"
}
```

### Shopping Cart

#### Get Cart
```http
GET /api/cart
Authorization: Bearer {token}
```

#### Add to Cart
```http
POST /api/cart
Authorization: Bearer {token}
Content-Type: application/json

{
    "shoe_id": 1,
    "quantity": 2,
    "size": "9"
}
```

#### Update Cart Item
```http
PUT /api/cart/{cart_item_id}
Authorization: Bearer {token}
Content-Type: application/json

{
    "quantity": 3
}
```

#### Remove from Cart
```http
DELETE /api/cart/{cart_item_id}
Authorization: Bearer {token}
```

#### Clear Cart
```http
DELETE /api/cart
Authorization: Bearer {token}
```

#### Get Cart Count
```http
GET /api/cart/count
Authorization: Bearer {token}
```

### Orders

#### Get User Orders
```http
GET /api/orders?page=1
Authorization: Bearer {token}
```

#### Create Order (Checkout)
```http
POST /api/orders
Authorization: Bearer {token}
Content-Type: application/json

{
    "shipping_address": "123 Main St, City, State 12345",
    "phone": "+1234567890",
    "payment_method": "credit_card",
    "payment_details": {
        "card_number": "4111111111111111",
        "expiry": "12/25",
        "cvv": "123"
    }
}
```

#### Get Single Order
```http
GET /api/orders/{id}
Authorization: Bearer {token}
```

#### Cancel Order
```http
PUT /api/orders/{id}/cancel
Authorization: Bearer {token}
```

### Admin Statistics

#### Get Statistics (Admin Only)
```http
GET /api/admin/statistics
Authorization: Bearer {admin-token}
```

## Response Format

### Success Response
```json
{
    "success": true,
    "message": "Operation successful",
    "data": {
        // Response data
    }
}
```

### Error Response
```json
{
    "success": false,
    "message": "Error message",
    "errors": {
        // Validation errors (if applicable)
    }
}
```

### Pagination Response
```json
{
    "success": true,
    "data": {
        "items": [...],
        "pagination": {
            "current_page": 1,
            "last_page": 5,
            "per_page": 12,
            "total": 60,
            "from": 1,
            "to": 12
        }
    }
}
```

## Payment Methods
- `credit_card`: Credit/Debit Card (Mock)
- `paypal`: PayPal (Mock)
- `cash_on_delivery`: Cash on Delivery

## Order Status
- `pending`: Order placed, awaiting processing
- `processing`: Order being prepared
- `shipped`: Order shipped
- `delivered`: Order delivered
- `cancelled`: Order cancelled

## Payment Status
- `pending`: Payment being processed
- `completed`: Payment successful
- `failed`: Payment failed

## Error Codes
- `400`: Bad Request
- `401`: Unauthorized
- `403`: Forbidden
- `404`: Not Found
- `422`: Validation Error
- `500`: Internal Server Error
