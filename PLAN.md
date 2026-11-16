# PLAN — Đề tài 2: Hệ thống Quản lý Học tập & Thi trắc nghiệm trực tuyến (LMS E-Learning)

Học phần: Lập trình mã nguồn mở (PHP) — HUIT
Môi trường máy: PHP 8.5, Composer 2.10, Node 22, MySQL 9.7 (Homebrew) → đủ để chạy, không cần Laragon.

---

## 0. Rule rút ra từ slide (bắt buộc tuân theo khi code)

| # | Rule | Nguồn |
|---|------|-------|
| R1 | Laravel 12, kiến trúc MVC: Route → Controller → Model (Eloquent) → View (Blade). Không viết SQL thuần / PDO trong Controller | Bài 6, 8 |
| R2 | CSDL tạo **hoàn toàn bằng Migration**; muốn đổi cấu trúc thì **tạo migration mới**, không sửa migration đã chạy | Bài 6, 8 |
| R3 | Model khai báo `$fillable`, `use HasFactory`; quan hệ đủ 3 loại: 1-1 (`hasOne/belongsTo`), 1-N (`hasMany/belongsTo`), N-N (`belongsToMany` + bảng pivot đặt tên số ít, xếp alpha) | Bài 8 |
| R4 | Dữ liệu mẫu bằng **Factory + Seeder + Faker**; chạy được `php artisan migrate:fresh --seed` | Bài 8 |
| R5 | Chống N+1: dùng `with()`, `withCount()`, `paginate()` | Bài 8 |
| R6 | `Route::resource()` cho CRUD (7 action), **named route** + `route()` (không hard-code URL), **route group** `prefix()/name()/middleware()` | Bài 7 |
| R7 | Blade: layout `@extends/@section/@yield`, partials `@include`, `@stack/@push` cho script riêng, **Blade Components** `<x-alert>`, `<x-input>`, `<x-button>`… | Bài 7 |
| R8 | Form: `@csrf`, `@method('PUT'/'DELETE')`, xoá có `confirm()` JS, `old()` + `@error` | Bài 7, 9 |
| R9 | Validation bằng **Form Request** (`rules()`, `messages()`, `attributes()` tiếng Việt) + ít nhất 1 **Custom Rule** (`make:rule`); upload file: `mimes`, `max`, `store(...,'public')`, `storage:link` | Bài 9 |
| R10 | Middleware tự viết (`CheckRole`) đăng ký **alias trong `bootstrap/app.php`**; `auth` đặt trước middleware phân quyền; `throttle` cho login & nộp bài | Bài 9 |
| R11 | Authentication bằng **Breeze (blade)**, mật khẩu `Hash::make` | Bài 9 |
| R12 | Authorization: **Gate** (admin) + **Policy** theo model (ownership check), kiểm tra ở **3 lớp**: Controller (`authorize`), Route (`can:`), Blade (`@can`) | Bài 9 |
| R13 | An toàn: Blade `{{ }}` (không dùng `{!! !!}` với input người dùng), Eloquent binding, `APP_DEBUG=false` khi demo production | Bài 9 |
| R14 | OOP PHP: namespace PSR-4, interface/abstract, đóng gói logic nghiệp vụ vào **Service class** | Chương 2 (PDF) |
| R15 | JS/AJAX: Fetch API gửi/nhận **JSON** với PHP (ngoài Livewire) | JS & tương tác PHP, Chương 2 |

---

## 1. Phạm vi chức năng

### Vai trò
- **Admin**: quản lý người dùng, danh mục, duyệt/ẩn khoá học, xem thống kê, xác nhận thanh toán.
- **Giảng viên (instructor)**: tạo khoá học → chương (section) → bài học (video/tài liệu), ngân hàng câu hỏi, đề thi, xem & xuất điểm.
- **Học viên (student)**: xem/tìm khoá học, đăng ký (miễn phí / trả phí), học bài, theo dõi tiến độ, làm bài thi, nhận chứng chỉ PDF.
- **Khách**: xem danh mục, chi tiết khoá học, bài học preview, trang xác thực chứng chỉ.

### Module
| Mã | Module | Điểm nhấn kỹ thuật |
|----|--------|-------------------|
| M1 | Auth & phân quyền | Breeze, cột `role`, middleware `role:`, Gate `admin`, Policies |
| M2 | Danh mục & Khoá học | Resource controller, upload thumbnail, slug, publish/draft, search + filter + paginate |
| M3 | Chương & Bài học | Upload video (mp4) / tài liệu (pdf, docx) hoặc link YouTube (Custom Rule), sắp xếp thứ tự |
| M4 | Đăng ký & Thanh toán | Free → active ngay; Paid → đơn hàng + **cổng thanh toán giả lập** (interface `PaymentGateway` + `MockPaymentGateway`) / admin xác nhận chuyển khoản |
| M5 | Học & Tiến độ | Trang học có danh sách bài, đánh dấu hoàn thành qua **Fetch API (JSON)** khi xem hết video, thanh % tiến độ |
| M6 | Ngân hàng câu hỏi | CRUD câu hỏi 1 đáp án / nhiều đáp án, độ khó; **Import/Export Excel** (maatwebsite/excel) + file mẫu |
| M7 | Đề thi | Chọn câu từ ngân hàng hoặc random theo độ khó, thời gian làm bài, điểm đạt, số lần thi tối đa, trộn câu |
| M8 | Làm bài thi (Livewire) | Đồng hồ đếm ngược, lưu đáp án tự động, chuyển câu không reload, **tự nộp khi hết giờ**, deadline kiểm tra phía server, **chấm điểm tự động** |
| M9 | Kết quả & Báo cáo điểm | Lịch sử các lần thi, xem lại đáp án, **Export Excel bảng điểm** theo đề thi |
| M10 | Chứng chỉ PDF | Khi học 100% bài + đạt bài thi cuối khoá → sinh chứng chỉ (**barryvdh/laravel-dompdf**), mã chứng chỉ duy nhất, trang xác thực công khai `/certificates/verify/{code}` |
| M11 | Dashboard | Thống kê theo vai trò (số khoá, học viên, doanh thu, tỉ lệ đạt) |

---

## 2. Thiết kế CSDL (Migration)

```
users(id, name, email, password, role[admin|instructor|student], avatar, bio, timestamps)
categories(id, name, slug, description)
courses(id, instructor_id→users, category_id→categories, title, slug, short_description, description,
        thumbnail, price decimal(12,0), level, status[draft|published], timestamps)
sections(id, course_id→courses cascade, title, position)
lessons(id, section_id→sections cascade, title, type[video|document], video_path, video_url,
        document_path, content, duration_minutes, position, is_preview)
course_user  (enrollments — pivot N-N User–Course)
        (id, user_id, course_id, status[pending|active], price_paid, enrolled_at, completed_at)
orders(id, user_id, course_id, code, amount, method, status[pending|paid|failed], paid_at)
lesson_user  (tiến độ — pivot N-N User–Lesson)(user_id, lesson_id, completed_at)
questions(id, course_id, created_by→users, content, type[single|multiple], difficulty[easy|medium|hard], explanation)
options(id, question_id cascade, content, is_correct)
exams(id, course_id, title, description, duration_minutes, pass_score, max_attempts,
      shuffle_questions, is_final, status, timestamps)
exam_question (pivot N-N Exam–Question)(exam_id, question_id, points, position)
exam_attempts(id, exam_id, user_id, started_at, expires_at, submitted_at, score, correct_count, total, passed, status)
attempt_answers(id, exam_attempt_id, question_id, selected_option_ids json, is_correct)
certificates(id, user_id, course_id, code unique, issued_at, file_path)   -- unique(user_id, course_id)
```

Quan hệ minh hoạ đủ 3 loại theo Bài 8:
- **1-1**: `Course hasOne finalExam()` (đề thi cuối khoá, `is_final = true`) ↔ `Exam belongsTo Course`.
- **1-N**: Category→Courses, Course→Sections→Lessons, Question→Options, Exam→Attempts.
- **N-N**: User↔Course (`course_user`), User↔Lesson (`lesson_user`), Exam↔Question (`exam_question`).

Seeder: 1 admin, 3 giảng viên, 20 học viên, 6 danh mục, ~12 khoá học (vừa free vừa paid), mỗi khoá 3–4 chương × 3–5 bài, 30 câu hỏi/khoá, 1–2 đề thi/khoá, một số enrollment + tiến độ + lượt thi mẫu. Tài khoản demo cố định (`admin@lms.test / password`, …).

---

## 3. Kiến trúc mã nguồn

```
app/
  Http/Controllers/{Admin,Instructor,Student}/...   Resource controllers
  Http/Requests/...                                 Form Request (tiếng Việt)
  Http/Middleware/CheckRole.php                     alias 'role' trong bootstrap/app.php
  Livewire/Exam/TakeExam.php, Livewire/Course/CourseFilter.php
  Models/...                                        $fillable, HasFactory, relations, scopes
  Policies/{Course,Lesson,Question,Exam,ExamAttempt}Policy.php
  Rules/{YoutubeUrl, AtLeastOneCorrectOption}.php
  Services/
     Payment/PaymentGatewayInterface.php, MockPaymentGateway.php   (OOP: interface + đa hình)
     EnrollmentService, ProgressService, ExamGradingService, CertificateService
  Exports/{QuestionsExport, ExamScoresExport, QuestionTemplateExport}.php
  Imports/QuestionsImport.php                       WithHeadingRow + WithValidation
resources/views/
  layouts/{app,guest,admin}.blade.php, partials/{nav,footer,sidebar}
  components/{alert,input,button,card,badge,progress-bar,modal}.blade.php
  certificates/pdf.blade.php
routes/web.php → require admin.php, instructor.php, student.php (tách file để các worker không đụng nhau)
tests/Feature/...                                   PHPUnit cho luồng chính
```

UI: Tailwind (đi kèm Breeze) + Alpine (đi kèm Livewire). Ngôn ngữ giao diện: tiếng Việt, `APP_LOCALE=vi`, gói lang validation tiếng Việt.

---

## 4. Chia việc cho worker (sau khi bạn duyệt)

Thực thi bằng sub-agent model **Sonnet**, mình (Opus) điều phối + review + tích hợp.
Giai đoạn 1 chạy tuần tự (nền móng), giai đoạn 2 chạy **song song 4 worker** trên các file/route tách biệt, giai đoạn 3 tổng hợp.

| Worker | Giai đoạn | Nhiệm vụ | File sở hữu |
|--------|-----------|----------|-------------|
| **W1 – Foundation** | 1 (tuần tự) | `composer create-project` Laravel 12, cài Breeze blade, Livewire 3, dompdf, maatwebsite/excel; cấu hình MySQL + `.env` + locale vi; **toàn bộ migration, model, quan hệ, factory, seeder**; middleware `role` + Gate `admin`; layout, partials, Blade components dùng chung; khung `routes/*.php` + **hợp đồng tên route** | migrations, Models, factories, seeders, layouts, components, bootstrap/app.php |
| **W2 – Quản trị & Nội dung khoá học** | 2 | Admin (users, categories, duyệt khoá, xác nhận đơn, dashboard); Giảng viên CRUD Course/Section/Lesson + upload + Policies + Form Request + Custom Rule `YoutubeUrl` | routes/admin.php, routes/instructor.php (phần course), Controllers/Admin, Instructor/Course*, Lesson* |
| **W3 – Học viên: đăng ký, thanh toán, học** | 2 | Trang chủ, catalog (Livewire filter/search), chi tiết khoá, đăng ký free/paid + `MockPaymentGateway`, trang học bài, tiến độ qua Fetch API JSON, "Khoá học của tôi" | routes/student.php, Controllers/Student, Services/Payment, EnrollmentService, ProgressService |
| **W4 – Ngân hàng câu hỏi, Đề thi, Excel** | 2 | CRUD câu hỏi + options, Custom Rule `AtLeastOneCorrectOption`, Import/Export Excel câu hỏi + file mẫu, CRUD đề thi (chọn tay / random), Export bảng điểm Excel | Instructor/Question*, Instructor/Exam*, Imports, Exports |
| **W5 – Thi trực tuyến (Livewire) & Chứng chỉ PDF** | 2 | Livewire `TakeExam` (timer, autosave, auto-submit, chống nộp quá giờ phía server, throttle), `ExamGradingService`, trang kết quả/xem lại, `CertificateService` + dompdf + trang xác thực | Livewire/Exam, ExamGradingService, CertificateService, views/exams, views/certificates |
| **W6 – Kiểm thử & Báo cáo** | 3 | Feature tests (auth, phân quyền 403, đăng ký, nộp bài & chấm điểm, cấp chứng chỉ, import Excel), chạy `migrate:fresh --seed` + test end-to-end, sửa lỗi tích hợp, viết `README.md` (cài đặt, tài khoản demo) và `docs/BAO_CAO.md` (đề cương báo cáo đồ án) | tests/, README.md, docs/ |

Quy trình: W1 xong → mình review & chạy thử → khởi động W2–W5 song song → mình merge/kiểm tra → W6 → bàn giao.

---

## 5. Đề cương báo cáo đồ án (docs/BAO_CAO.md)

1. Giới thiệu đề tài, mục tiêu, phạm vi
2. Cơ sở lý thuyết: PHP OOP, Laravel 12 (MVC, Eloquent, Blade, Middleware, Auth), Livewire, DomPDF, Laravel Excel
3. Phân tích yêu cầu: tác nhân, use case, đặc tả chức năng chính
4. Thiết kế: kiến trúc MVC, ERD, danh sách bảng, sơ đồ luồng thi & cấp chứng chỉ, phân quyền
5. Cài đặt: cấu trúc thư mục, các đoạn code tiêu biểu (Policy, Form Request, Livewire TakeExam, Export/Import, PDF)
6. Kết quả: ảnh chụp màn hình theo vai trò, kiểm thử
7. Kết luận & hướng phát triển (cổng thanh toán thật VNPay/MoMo, chống gian lận, video streaming)

---

## 6. Rủi ro & cách xử lý
- **PHP 8.5 mới**: một số package có thể cảnh báo deprecation → chốt phiên bản tương thích khi cài; nếu lỗi thì dùng `--ignore-platform-req` hoặc bản dev mới nhất.
- **Breeze trên Laravel 12**: slide dùng Breeze, Laravel 12 vẫn cài được `laravel/breeze` 2.x → theo slide.
- **Video lớn**: giới hạn upload (`max:51200` KB) + hỗ trợ link YouTube để demo nhẹ.
- **Gian lận thời gian thi**: thời hạn lưu ở `exam_attempts.expires_at`, server từ chối đáp án sau hạn, không tin đồng hồ client.
