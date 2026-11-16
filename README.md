# LMS E-Learning HUIT

Hệ thống quản lý học tập và thi trắc nghiệm trực tuyến cho học phần Lập trình mã nguồn mở. Ứng dụng hỗ trợ biên soạn khóa học, ghi danh/thanh toán, theo dõi tiến độ, thi trực tuyến và cấp chứng chỉ PDF có mã xác thực công khai.

## Chức năng theo vai trò

- **Khách:** xem khóa học đã xuất bản, bài preview và xác thực chứng chỉ.
- **Học viên:** đăng ký, thanh toán, học bằng Fetch API, thi Livewire, xem kết quả và tải chứng chỉ.
- **Giảng viên:** CRUD nội dung, ngân hàng câu hỏi, import/export Excel, tạo đề, xem/xuất điểm.
- **Quản trị viên:** quản lý người dùng/danh mục, duyệt khóa học, xác nhận chuyển khoản và xem dashboard.

## Công nghệ và yêu cầu

PHP 8.2+ (môi trường phát triển PHP 8.5), Laravel 12, Breeze 2, Livewire 3, MySQL 8+, Tailwind CSS 3/Vite 7, DomPDF 3, Laravel Excel 4 và PHPUnit 11. Cần Composer 2, Node.js 20+ và các extension PHP Laravel/MySQL (`pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `xml`, `zip`).

## Cài đặt

```bash
git clone <repository-url> lms-elearning
cd lms-elearning
composer install
cp .env.example .env
php artisan key:generate
```

Tạo CSDL MySQL `lms_elearning`, cập nhật `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` trong `.env`, rồi chạy:

```bash
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Ứng dụng mặc định ở `http://127.0.0.1:8000`. Khi demo production đặt `APP_DEBUG=false`.

## Tài khoản demo

Mật khẩu chung: `password`.

| Vai trò | Email |
|---|---|
| Quản trị | `admin@lms.test` |
| Giảng viên | `gv1@lms.test` (ThS. Nguyễn Văn An), `gv2@lms.test` (TS. Trần Thị Bình), `gv3@lms.test` (ThS. Lê Hoàng Cường) |
| Học viên | `hv1@lms.test` (Nguyễn Minh Khoa) … `hv60@lms.test` — hv1 có sẵn luồng demo: 2 khóa có chứng chỉ, 1 khóa đã học xong chờ thi cuối khóa, 2 khóa đang học, 1 đơn chuyển khoản chờ duyệt |

`hv1@lms.test` có một khóa hoàn thành và chứng chỉ PDF, một khóa đang học và một đơn chuyển khoản chờ duyệt. Dữ liệu giảng viên có đề thi/lượt làm để xem kết quả và xuất điểm.

Thẻ mô phỏng: `4242 4242 4242 4242` thành công; `4000 0000 0000 0002` bị từ chối và đơn vẫn chờ để thử lại/chuyển khoản.

## Kiểm thử

```bash
php artisan test
php artisan test tests/Feature/E2E
```

Test dùng SQLite `:memory:` theo `phpunit.xml`. Có thể dựng lại demo bằng `php artisan migrate:fresh --seed` (lệnh xóa dữ liệu hiện có).

## Cấu trúc thư mục

```text
app/Http/Controllers/       controller theo vai trò
app/Http/Requests/          Form Request tiếng Việt
app/Livewire/               bộ lọc và màn hình thi
app/Models, app/Policies/   Eloquent và phân quyền
app/Rules, app/Services/    custom rule và nghiệp vụ
app/Imports, app/Exports/   Laravel Excel
database/                   migration, factory, seeder
resources/views/            Blade layout/component/module
routes/                     route tách theo module
tests/Feature/E2E/          kiểm thử tích hợp đầu-cuối
```

## Ánh xạ R1–R15

| Rule | File tiêu biểu |
|---|---|
| R1 MVC | `routes/*.php`, `app/Http/Controllers`, `app/Models`, `resources/views` |
| R2 Migration | `database/migrations/2026_01_01_000100_create_lms_tables.php` và migration bổ sung |
| R3 Quan hệ/fillable | `app/Models/Course.php`, `User.php`, `Exam.php` |
| R4 Factory/Seeder | `database/factories`, `database/seeders/DatabaseSeeder.php` |
| R5 N+1 | controller danh sách dùng `with`, `withCount`, `paginate` |
| R6 Resource/group | `routes/admin.php`, `routes/instructor.php` |
| R7 Blade | `resources/views/layouts`, `resources/views/components` |
| R8 Form | form Blade dùng CSRF, method spoofing, old/error |
| R9 Validation | `app/Http/Requests`, `app/Rules/YoutubeUrl.php`, `AtLeastOneCorrectOption.php` |
| R10 Middleware | `CheckRole.php`, alias trong `bootstrap/app.php` |
| R11 Auth | `routes/auth.php`, controller Breeze |
| R12 Authorization | `AppServiceProvider.php`, `app/Policies`, middleware `can:` |
| R13 An toàn | escaped Blade `{{ }}`, binding, validation, `.env.example` |
| R14 OOP/service | `PaymentGatewayInterface`, `ExamGradingService`, `CertificateService` |
| R15 Fetch/JSON | `resources/js/learn.js`, `LearnController::complete` |

Xem báo cáo đầy đủ tại [docs/BAO_CAO.md](docs/BAO_CAO.md).
