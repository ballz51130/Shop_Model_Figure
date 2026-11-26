# Shop_Model_Figure

An online shop for model figures (Gundam, anime figures and similar), written in plain PHP with MySQL. Customers browse products, place normal orders or pre-orders, pay by bank transfer and upload a payment slip, then track shipping and request returns. Administrators manage products, payments, shipping, returns and reports.

The user interface is in Thai.

## Features

### Customers

- Browse products by group, view product details and pre-order items
- Register and edit a profile, including a Thai address picker (province, district, sub-district)
- Cart: add items, change quantities, remove items
- Checkout: choose a shipping method and bank account, then upload a payment slip
- Track order status, confirm delivery and request a return with photos

### Administrators (`admin/`)

- Products, product groups and pre-order products: add, edit, delete
- Review payment slips and confirm payments
- Record EMS tracking numbers and print shipping reports as PDF (mPDF)
- Review return requests and upload refund slips
- Manage users, banks and shipping methods
- Sales reports by month, year and product

## Requirements

- PHP 7.4 with the `mysqli` and `gd` extensions. The locked mPDF version (8.0.5) does not support PHP 8.
- MySQL or MariaDB
- Apache with `.htaccess` support (`AllowOverride All`). XAMPP works out of the box.
- Composer, only if you need to reinstall `vendor/`. The dependencies are committed.

## Setup (XAMPP)

1. Copy the project into `htdocs`, for example `C:\xampp\htdocs\Shop_Model_Figure`.
2. Create a database named `market` and import your schema and data. **No SQL dump is included in this repository.** The code expects these tables:
   `user`, `product`, `productdetail`, `group_tb`, `status_tb`, `orders`, `orderdetail`, `payment_tb`, `bank_tb`, `send_tb`, `returnorder`, `returnorderdetail`, `preorder`, `province`, `amphur`, `district`.
3. Configure the database connection (see below).
4. Open `http://localhost/Shop_Model_Figure/`.

### Database connection

`conn/conn.php` reads these environment variables and falls back to XAMPP defaults:

| Variable  | Default     |
| --------- | ----------- |
| `DB_HOST` | `localhost` |
| `DB_USER` | `root`      |
| `DB_PASS` | *(empty)*   |
| `DB_NAME` | `market`    |

In production, set them in the Apache config (`SetEnv DB_PASS ...`) or the server environment. Do not use `root` with an empty password.

### Creating an administrator

Register a normal account through the site, then promote it in the database:

```sql
UPDATE user SET U_Status = 'Admin' WHERE U_UserName = 'your-username';
```

Log out and log in again. The role is read when you log in.

## Project structure

| Path | Contents |
| ---- | -------- |
| `index.php`, `Preorder.php`, `header.php` | Storefront and pre-order listing |
| `product/` | Product listing and detail pages |
| `user/` | Customer pages: registration, profile, cart, payment, order status, returns |
| `order/` | Cart and checkout actions (add, delete, confirm shipping) |
| `admin/` | Admin dashboard and pages; `insert/`, `edit/` and `del/` hold the actions |
| `login/` | Login, logout, password reset |
| `conn/conn.php` | Database connection; also loads `conn/security.php` |
| `conn/security.php` | Shared helpers: login and admin checks, upload validation, HTML escaping |
| `photo/` | Uploaded images (products, slips, users, returns) |
| `vendor/` | Composer packages (mPDF, thai-date) and front-end libraries |

## Order status flow

The `orders.O_Status` column moves through these values:

1. `ยืนยันการสั่งซื้อ`: in the cart
2. `รอการชำระ`: shipping and bank chosen, waiting for payment
3. `รอตรวจสอบ`: slip uploaded, waiting for admin review
4. `ยืนยันการชำระเงิน`: payment confirmed by admin
5. `จัดส่งแล้ว`: shipped, with an EMS number
6. `รับของแล้ว`: delivery confirmed by the customer

Returns use `รอตรวจสอบ(สินค้า)` while an admin reviews the request.

Customer actions only work for the customer's own orders, and only at the matching step. For example, quantities can only change while the order is in the cart.

## Security

How the code protects itself:

- **Access control.** Every page in `admin/` calls `require_admin()`. Customer pages call `require_login()`. Order, payment, return and profile changes are limited to the logged-in user's own records.
- **Uploads.** All uploads go through `store_uploaded_image()`. It accepts JPEG, PNG, GIF or WebP up to 5 MB, checks the file content and saves it under a random name. `photo/.htaccess` stops scripts and HTML from running in the upload folders.
- **SQL.** Request values are cast to integers or escaped before they reach a query. Use the same pattern in new code; prepared statements are better.
- **Sessions.** The session ID changes at login, and the cookie is `HttpOnly` and `SameSite=Lax`.

Known gaps, not yet fixed:

- **Password hashing.** Passwords are stored as MD5 with a fixed salt. Moving to `password_hash()` needs `user.U_Password` widened to `VARCHAR(255)` and a login change that rehashes old passwords.
- **Password reset.** `login/forgotpass.php` resets a customer's password for anyone who knows their username, phone and email. Admin accounts are excluded. A real fix needs emailed reset links.
- **CSRF.** Forms and delete links have no CSRF tokens.
- **Stored XSS.** Most pages print database values without HTML escaping. Wrap output in `e()` when you touch a page.

On a server other than Apache (nginx, IIS), add the same "no scripts in `photo/`" rule to the server config, because `.htaccess` is ignored.
