# 📎 Laravel URL Shortener – Documentation

This project is a simple URL shortener built using **Laravel 12**, **Bootstrap 5**, and **Blade**. It allows users to shorten long URLs and redirect using short codes.

---

## 🛠 Features

- Shorten any valid URL
- Auto-generate unique short codes
- Redirect to the original URL via short code
- UI built with Bootstrap 5
- Copy short URL to clipboard
- Validation and error handling

---

## 🧱 Database Schema

### Migration: `short_urls` Table

```php
Schema::create('short_urls', function (Blueprint $table) {
    $table->id();
    $table->string('original_url');
    $table->string('short_url')->unique();
    $table->timestamps();
});
```

---

## 🔗 API Routes

### `POST /shorten`

**Description**: Accepts a long URL and returns a shortened version.

**Controller**: `UrlShortenerController@createShortUrl`

**Request Payload**:
```json
{
  "original_url": "https://example.com/some/very/long/url"
}
```

**Success Response**:
```json
{
  "status": true,
  "data": {
    "original_url": "https://example.com/some/very/long/url",
    "short_url": "http://127.0.0.1:8000/abc123"
  }
}
```

**Validation Errors**:
```json
{
  "status": false,
  "errors": {
    "original_url": ["The original url field is required."]
  }
}
```

---

### `GET /{short_url}`

**Description**: Redirects to the original URL based on the short code.

**Controller**: `UrlShortenerController@redirectToOriginalUrl`

**Example**:
```
GET /abc123 → Redirects to https://example.com/some/very/long/url
```

---

### `GET /`

**Description**: Displays the homepage form for submitting URLs.

**Controller**: `UrlShortenerController@home`

**Returns**: A Blade view with Bootstrap-based form.

---

## 🖥 Frontend Features (Blade)

- Input field for long URL
- Submit button to shorten URL
- Displays original and short URLs on success
- Copy button (using JavaScript + Bootstrap Icons)

---

## 📋 Copy to Clipboard

A "Copy" button is shown next to the generated short URL.

```js
function copyToClipboard() {
    const shortUrl = document.getElementById('shortUrl').href;
    navigator.clipboard.writeText(shortUrl).then(function() {
        alert("Short URL copied to clipboard!");
    });
}
```

---

## 🧪 Testing

You can test the API using Postman:

### Post to Shorten
```
POST http://127.0.0.1:8000/shorten
Body: raw JSON
{
    "original_url": "https://example.com"
}
```

### Visit the Short URL
Open `http://127.0.0.1:8000/abc123` in browser to test redirection.

---

## 🧑‍💻 Developer

**Made by**: Jahid Hasan  
**Stack**: Laravel 12, Blade, Bootstrap 5, JavaScript

## License

This project is open-sourced under the [MIT license](LICENSE).

© 2025 Jahid Hasan. All rights reserved.
