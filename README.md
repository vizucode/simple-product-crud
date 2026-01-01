# Test - Full Stack Developer - Hafiz Iqbal

## 📦 Product Management CRUD Application

This is a simple CRUD (Create, Read, Update, Delete) web application for managing products.  
The application is built to demonstrate clean code structure, proper validation, basic security practices, and thoughtful UI/UX decisions.

---

## 🚀 Live Demo
🔗 **Live URL:** https://your-deployed-app-url.com  

## 📁 Repository
🔗 **GitHub/GitLab:** https://github.com/vizucode/simple-product-crud

---

## 🛠 Tech Stack
- **Backend:** Laravel
- **Frontend:** Blade / Tailwind / Livewire
- **Database:** PostgreSQL
- **Storage:** Laravel Filesystem (Local / Public Disk)

---

## 📊 Product Fields
Each product contains the following attributes:

| Field | Description |
|------|-------------|
| Product Name | Name of the product |
| Product Photo | Image of the product |
| Product Description | Detailed description of the product |
| Quantity (Qty) | Available stock |
| Price | Product price |

---

## 🔄 Application Flow
1. User lands on the **Product List** page
2. User can:
   - Add a new product
   - View product details
   - Edit an existing product
   - Delete a product
3. When creating or updating a product:
   - Form validation is applied
   - Product image is uploaded and stored securely
4. Success or error messages are displayed to guide user interaction

---

## ✅ Validation & Security Measures

### 1. Input Validation
Validation is handled using Laravel Form Request / Validator to ensure data integrity and security.

| Field | Validation Rules | Reason |
|-----|------------------|-------|
| Product Name | Required, string, max length | Prevent empty or excessively long input |
| Product Description | Required, string | Ensures product has meaningful information |
| Quantity (Qty) | Required, integer, min:0 | Prevents negative stock values |
| Price | Required, numeric, min:0 | Prevents invalid or negative pricing |
| Product Photo | Required / Nullable, image, max:2048, mimes:jpg,png,webp | Prevents large file uploads and restricts file types |

### 2. Image Upload Validation
- **Max Size:** 2MB  
- **Allowed Formats:** JPG, PNG, WEBP  

**Reasoning:**
- Prevents server overload from large files
- Reduces security risks from malicious file uploads
- Ensures consistent image formats for UI display

### 3. CSRF Protection
- Laravel CSRF tokens are enabled by default
- Prevents Cross-Site Request Forgery attacks

### 4. Mass Assignment Protection
- `$fillable` is used in the Product model
- Prevents unintended data manipulation

### 5. File Storage Handling
- Images are stored using Laravel’s filesystem
- Public access is limited to necessary directories only

---

## 🎨 UI / UX Considerations
- Clean and readable product table
- Clear form labels and validation error messages
- Image preview for better user experience
- Confirmation before delete action
- Responsive layout for better accessibility

---

## 📦 Additional Libraries
- Bootstrap / Tailwind CSS (for UI styling)
- Laravel Storage (for file upload management)

---

## 🧑‍💻 How to Run the Application Locally

```bash
# Clone repository
git clone https://github.com/vizucode/simple-product-crud

# Install dependencies
composer install
npm install && npm run dev

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env
php artisan migrate

# Create storage link
php artisan storage:link

# Run server
php artisan serve
