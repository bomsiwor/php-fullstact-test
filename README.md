# **My Client API**

Repository ini digunakan untuk technnical assesment pada PT ASI ASIA sebagai fullstack developer.

## **Fitur Utama**

- **CRUD My Client** (Create, Read, Update, Delete).
- **Penyimpanan Gambar di AWS S3** untuk `client_logo`.
- **Cache data di Redis** berdasarkan `slug`, untuk mempercepat akses.
- **Auto-refresh cache saat data diperbarui atau dihapus**.

## **Teknologi**

- **Laravel**
- **PostgreSQL**
- **Redis**
- **AWS S3**

## Postman

Repository ini menyertakan postman collection untuk testing API.
[Postman Collection download here](/PT ASI.postman_collection.json)

---

## **Setup Project**

1. **Clone Repository & Install Dependencies**

    ```sh
    git clone https://github.com/bomsiwor/php-fullstact-test <nama folder mu yg keren>
    cd <nama folder mu yang keren>
    composer install
    ```

2. **Set `.env`**

    - **Database:**

        ```env
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1
        DB_PORT=5432
        DB_DATABASE=my_client_db
        DB_USERNAME=your_username
        DB_PASSWORD=your_password
        ```

    - **Redis:**

        ```env
        CACHE_DRIVER=redis
        REDIS_HOST=127.0.0.1
        REDIS_PASSWORD=null
        REDIS_PORT=6379
        ```

    - **AWS S3:**

        ```env
        FILESYSTEM_DISK=s3
        AWS_ACCESS_KEY_ID=your_access_key
        AWS_SECRET_ACCESS_KEY=your_secret_key
        AWS_DEFAULT_REGION=us-east-1
        AWS_BUCKET=your_s3_bucket
        AWS_URL=https://your-bucket.s3.amazonaws.com
        ```

3. **Run Migration**

    ```sh
    php artisan migrate
    ```

4. **Jalan Server**

    ```sh
    php artisan serve
    ```

---

## **Endpoint API**

### 1. Get list My Client

**`GET /api/clients`**

### **2. Create My Client**

**`POST /api/clients`**  
**Body (JSON)**

```json
{
    "name": "Example Client",
    "slug": "example-client",
    "is_project": "1",
    "self_capture": "1",
    "client_prefix": "EXCL",
    "client_logo": "https://example.com/logo.jpg",
    "address": "123 Example Street",
    "phone_number": "+628123456789",
    "city": "Jakarta"
}
```

---

### **3. Get My Client by Slug**

## **`GET /api/clients/{slug}`**

### **4. Update My Client**

**`PUT /api/clients/{slug}`**  
Body same as create

---

### **5. Delete My Client**

**`DELETE /api/clients/{slug}`**  
Implement soft delete.

## **Testing API**

Gunakan **Postman** atau `cURL` untuk menguji endpoint dengan JSON yang diberikan.
