# Hợp đồng tích hợp LMS E-Learning

Tài liệu này là hợp đồng bắt buộc cho W2–W5. Không đổi tên route, tham số binding, bảng, khóa ngoại, quan hệ công khai hoặc flash key nếu chưa phối hợp với tất cả worker.

## Quy ước chung

- Laravel 12, MVC, Eloquent; không SQL/PDO trong controller. Dùng eager loading, `withCount()` và `paginate()`.
- Chỉ sinh URL bằng `route('name', [...])`; không hard-code đường dẫn. Blade dùng `{{ }}` cho dữ liệu người dùng.
- Thông báo và validation bằng tiếng Việt. Flash key duy nhất: `success` và `error`; layout đã render `<x-flash />`.
- Form Request: `app/Http/Requests/{Admin,Instructor,Student}`. Policy: `app/Policies`. Nghiệp vụ: `app/Services`.
- Controller luôn `authorize()`; route dùng `can:` khi phù hợp; Blade dùng `@can`. Middleware `auth` luôn đứng trước `role:`.
- Resource route dùng chuẩn 7 action. Upload dùng disk `public`, validation `mimes`/`max`; JSON/fetch trả mã HTTP đúng.
- Route model binding: `{course}` dùng `Course::getRouteKeyName()` = `slug`; `{certificate}` có thể binding theo `code`, route verify dùng `{code}`; các model khác dùng id.
- W2–W5 chỉ sửa file sở hữu. Shared model/migration/component thay đổi phải được coordinator duyệt.

## Route registry

| Worker | Tên route | Method | URI |
|---|---|---|---|
| W2 | `admin.dashboard` | GET | `/admin/dashboard` |
| W2 | `admin.users.index/create/store/show/edit/update/destroy` | resource | `/admin/users` |
| W2 | `admin.categories.index/create/store/show/edit/update/destroy` | resource | `/admin/categories` |
| W2 | `admin.courses.index` | GET | `/admin/courses` |
| W2 | `admin.courses.toggle-status` | PATCH | `/admin/courses/{course}/toggle-status` |
| W2 | `admin.orders.index` | GET | `/admin/orders` |
| W2 | `admin.orders.confirm` | PATCH | `/admin/orders/{order}/confirm` |
| W2 | `instructor.dashboard` | GET | `/instructor/dashboard` |
| W2 | `instructor.courses.index/create/store/show/edit/update/destroy` | resource | `/instructor/courses` |
| W2 | `instructor.courses.sections.index/create/store` | GET/POST | `/instructor/courses/{course}/sections[/create]` |
| W2 | `instructor.courses.sections.show/edit/update/destroy` | shallow resource | `/instructor/sections/{section}` |
| W2 | `instructor.sections.lessons.index/create/store` | GET/POST | `/instructor/sections/{section}/lessons[/create]` |
| W2 | `instructor.sections.lessons.show/edit/update/destroy` | shallow resource | `/instructor/lessons/{lesson}` |
| W2 | `instructor.courses.students` | GET | `/instructor/courses/{course}/students` |
| W3 | `home` | GET | `/` |
| W3 | `courses.index` | GET | `/courses` |
| W3 | `courses.show` | GET | `/courses/{course:slug}` |
| W3 | `courses.enroll` | POST | `/courses/{course:slug}/enroll` |
| W3 | `checkout.show` | GET | `/checkout/{course:slug}` |
| W3 | `checkout.pay` | POST | `/checkout/{course:slug}/pay` |
| W3 | `student.dashboard` | GET | `/student/dashboard` |
| W3 | `student.courses` | GET | `/student/courses` |
| W3 | `learn.show` | GET | `/learn/{course:slug}/{lesson?}` |
| W3 | `lessons.complete` | POST JSON | `/lessons/{lesson}/complete` |
| W3 | `student.orders` | GET | `/student/orders` |
| W4 | `instructor.courses.questions.index/create/store` | GET/POST | `/instructor/courses/{course}/questions[/create]` |
| W4 | `instructor.courses.questions.show/edit/update/destroy` | resource | `/instructor/courses/{course}/questions/{question}` |
| W4 | `instructor.courses.questions.import` | POST | `/instructor/courses/{course}/questions/import` |
| W4 | `instructor.courses.questions.export` | GET | `/instructor/courses/{course}/questions/export` |
| W4 | `instructor.questions.template` | GET | `/instructor/questions/template` |
| W4 | `instructor.courses.exams.index/create/store` | GET/POST | `/instructor/courses/{course}/exams[/create]` |
| W4 | `instructor.courses.exams.show/edit/update/destroy` | resource | `/instructor/courses/{course}/exams/{exam}` |
| W4 | `instructor.exams.scores.export` | GET | `/instructor/exams/{exam}/scores/export` |
| W4 | `instructor.exams.results` | GET | `/instructor/exams/{exam}/results` |
| W5 | `exams.show` | GET | `/exams/{exam}` |
| W5 | `exams.start` | POST | `/exams/{exam}/start` |
| W5 | `attempts.take` | GET | `/attempts/{attempt}/take` |
| W5 | `attempts.result` | GET | `/attempts/{attempt}/result` |
| W5 | `student.attempts` | GET | `/student/attempts` |
| W5 | `certificates.index` | GET | `/student/certificates` |
| W5 | `certificates.download` | GET | `/certificates/{certificate}/download` |
| W5 | `certificates.verify` | GET (public) | `/certificates/verify/{code}` |

Nhóm route: admin dùng `prefix('admin')->name('admin.')->middleware(['auth','role:admin'])`; instructor dùng `prefix('instructor')->name('instructor.')->middleware(['auth','role:instructor,admin'])`. Student dashboard/learning/order cần `auth` (và policy/enrollment); catalog, home, certificate verify là public. Exam taking cần `auth`, policy và throttle phù hợp.

## Sở hữu file

- W1/shared: migrations, `app/Models`, factories, seeders, `bootstrap/app.php`, provider, layouts, partials, components, locale, tài liệu này.
- W2: `routes/admin.php`, phần course/section/lesson của `routes/instructor.php`, Controllers `Admin/*`, `Instructor/Course*`, `Section*`, `Lesson*`, request/policy liên quan.
- W3: `routes/student.php`, Controllers `Student/*`, Livewire filter, `Services/Payment/*`, `EnrollmentService`, `ProgressService`, view catalog/checkout/learn/student.
- W4: phần question/exam của `routes/instructor.php`, Controllers `Instructor/Question*`, `Exam*`, `Imports`, `Exports`, rule và view question/exam.
- W5: `routes/exam.php`, `app/Livewire/Exam`, `ExamGradingService`, `CertificateService`, view exam/attempt/certificate.

## Model/relationship cheat sheet

- `User`: `coursesTaught`, `enrolledCourses` (pivot status, price_paid, enrolled_at, completed_at + timestamps), `completedLessons` (completed_at), `orders`, `examAttempts`, `certificates`; `isAdmin/isInstructor/isStudent`.
- `Category`: `courses`. `Course`: `category`, `instructor`, ordered `sections`, `lessons`, `students`, `exams`, `finalExam` (hasOne where final), `questions`, `orders`, `certificates`; scopes `published/free/paid`, accessor `is_free`, binding slug.
- `Section`: `course`, ordered `lessons`. `Lesson`: `section`, `completedByUsers`.
- `Order`: `user`, `course`. `Question`: `course`, `creator`, `options`, `exams`. `Option`: `question`.
- `Exam`: `course`, `questions` (pivot points/position), `attempts`. `ExamAttempt`: `exam`, `user`, `answers`. `AttemptAnswer`: `attempt`, `question`, cast `selected_option_ids` array.
- `Certificate`: `user`, `course`, binding code.

## Shared Blade components

- `<x-alert type="success|error|warning|info">`; `<x-flash>` (không props).
- `<x-input name label? type? value?>`; `<x-textarea name label? rows?>`; `<x-select name label?>`.
- `<x-button variant="primary|secondary|danger" type="submit">`.
- `<x-card title?>`; `<x-badge variant="green|red|yellow|blue|gray">`.
- `<x-progress-bar value max=100 label?>`; `<x-empty-state title? description?>`.
- `<x-confirm-delete action label? message?>` tự thêm CSRF, DELETE và confirm.
- Layout: `<x-app-layout>` có `header`, `@stack('styles')`, `@stack('scripts')`, Livewire assets; `layouts.admin` dành cho trang quản trị/instructor dùng `@section('content')`.
