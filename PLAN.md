# PLAN — Topic 2: Learning Management & Online Quiz System (LMS E-Learning)

> Original project plan (kept for reference). Some details evolved during implementation — see README.md.

Course: Lập trình mã nguồn mở (Open Source Programming, PHP) — HUIT
Dev machine: PHP 8.5, Composer 2.10, Node 22, MySQL 9.7 (Homebrew) → enough to run the project, no Laragon needed.

---

## 0. Rules derived from the course slides (mandatory when coding)

| # | Rule | Source (slides) |
|---|------|-------|
| R1 | Laravel 12, MVC architecture: Route → Controller → Model (Eloquent) → View (Blade). No raw SQL / PDO in controllers | Lecture 6, 8 |
| R2 | The database is created **entirely with migrations**; to change the schema, **create a new migration** and never edit one that has already run | Lecture 6, 8 |
| R3 | Models declare `$fillable` and `use HasFactory`; all 3 relationship types: 1-1 (`hasOne/belongsTo`), 1-N (`hasMany/belongsTo`), N-N (`belongsToMany` + pivot table named in the singular, alphabetical order) | Lecture 8 |
| R4 | Sample data via **Factory + Seeder + Faker**; must work with `php artisan migrate:fresh --seed` | Lecture 8 |
| R5 | Avoid N+1: use `with()`, `withCount()`, `paginate()` | Lecture 8 |
| R6 | `Route::resource()` for CRUD (7 actions), **named routes** + `route()` (no hard-coded URLs), **route groups** `prefix()/name()/middleware()` | Lecture 7 |
| R7 | Blade: layouts `@extends/@section/@yield`, partials `@include`, `@stack/@push` for page-specific scripts, **Blade Components** `<x-alert>`, `<x-input>`, `<x-button>`… | Lecture 7 |
| R8 | Forms: `@csrf`, `@method('PUT'/'DELETE')`, deletes use a JS `confirm()`, `old()` + `@error` | Lectures 7, 9 |
| R9 | Validation with **Form Requests** (`rules()`, `messages()`, `attributes()` in Vietnamese) + at least 1 **Custom Rule** (`make:rule`); file upload: `mimes`, `max`, `store(...,'public')`, `storage:link` | Lecture 9 |
| R10 | Custom middleware (`CheckRole`) registered as an **alias in `bootstrap/app.php`**; `auth` placed before the authorization middleware; `throttle` for login and exam submission | Lecture 9 |
| R11 | Authentication with **Breeze (blade)**, passwords with `Hash::make` | Lecture 9 |
| R12 | Authorization: **Gate** (admin) + per-model **Policy** (ownership check), enforced in **3 layers**: Controller (`authorize`), Route (`can:`), Blade (`@can`) | Lecture 9 |
| R13 | Safety: Blade `{{ }}` (never `{!! !!}` with user input), Eloquent binding, `APP_DEBUG=false` for a production demo | Lecture 9 |
| R14 | PHP OOP: PSR-4 namespaces, interface/abstract, business logic encapsulated in **Service classes** | Chapter 2 (PDF) |
| R15 | JS/AJAX: Fetch API sending/receiving **JSON** with PHP (besides Livewire) | JS & PHP interaction, Chapter 2 |

---

## 1. Functional scope

### Roles
- **Admin**: manages users and categories, approves/hides courses, views statistics, confirms payments.
- **Instructor**: creates course → section → lesson (video/document), question bank, exams, views and exports scores.
- **Student**: browses/searches courses, enrolls (free / paid), studies lessons, tracks progress, takes exams, receives a PDF certificate.
- **Guest**: views categories, course details, preview lessons, and the certificate verification page.

### Modules
| ID | Module | Technical highlights |
|----|--------|-------------------|
| M1 | Auth & authorization | Breeze, `role` column, `role:` middleware, `admin` Gate, Policies |
| M2 | Categories & Courses | Resource controller, thumbnail upload, slug, publish/draft, search + filter + paginate |
| M3 | Sections & Lessons | Upload video (mp4) / documents (pdf, docx) or YouTube link (Custom Rule), ordering |
| M4 | Enrollment & Payment | Free → active immediately; Paid → order + **mock payment gateway** (interface `PaymentGateway` + `MockPaymentGateway`) / admin confirms bank transfer |
| M5 | Learning & Progress | Learning page with lesson list, mark complete via **Fetch API (JSON)** after finishing a video, progress percentage bar |
| M6 | Question bank | CRUD for single-answer / multiple-answer questions, difficulty; **Excel import/export** (maatwebsite/excel) + template file |
| M7 | Exams | Pick questions from the bank or randomly by difficulty, time limit, pass score, max attempts (0 = unlimited), question shuffling, optional open/close time window, anti-cheat settings |
| M8 | Taking exams (Livewire) | Countdown timer, autosave answers, switch questions without reload, **auto-submit on timeout**, server-side deadline check (capped at the exam closing time), **automatic grading**, browser-level anti-cheat (tab/window switch logging, copy/paste blocking, auto-submit and flag after too many violations; flagged attempts are graded normally) |
| M9 | Results & Score reports | Attempt history, answer review, **Excel score export** per exam |
| M10 | PDF certificates | After 100% of lessons + passing the final exam → generate a certificate (**barryvdh/laravel-dompdf**), unique certificate code, public verification page `/certificates/verify/{code}` |
| M11 | Dashboard | Role-based statistics (courses, students, revenue, pass rate) |

---

## 2. Database design (Migrations)

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
lesson_user  (progress — N-N pivot User–Lesson)(user_id, lesson_id, completed_at)
questions(id, course_id, created_by→users, content, type[single|multiple], difficulty[easy|medium|hard], explanation)
options(id, question_id cascade, content, is_correct)
exams(id, course_id, title, description, duration_minutes, pass_score, max_attempts,
      shuffle_questions, is_final, status, starts_at?, ends_at?, anti_cheat_enabled, max_violations, timestamps)
exam_question (pivot N-N Exam–Question)(exam_id, question_id, points, position)
exam_attempts(id, exam_id, user_id, started_at, expires_at, submitted_at, score, correct_count, total, passed, status,
               violation_count, flagged_at?)
exam_attempt_violations(id, exam_attempt_id→exam_attempts cascade, type[tab_hidden|window_blur], occurred_at)
attempt_answers(id, exam_attempt_id, question_id, selected_option_ids json, is_correct)
certificates(id, user_id, course_id, code unique, issued_at, file_path)   -- unique(user_id, course_id)
```

Relationships illustrating all 3 types per Lecture 8:
- **1-1**: `Course hasOne finalExam()` (the final exam, `is_final = true`) ↔ `Exam belongsTo Course`.
- **1-N**: Category→Courses, Course→Sections→Lessons, Question→Options, Exam→Attempts.
- **N-N**: User↔Course (`course_user`), User↔Lesson (`lesson_user`), Exam↔Question (`exam_question`).

Seeder: 1 admin, 3 instructors, 20 students, 6 categories, ~12 courses (mix of free and paid), each with 3–4 sections × 3–5 lessons, 30 questions per course, 1–2 exams per course, plus sample enrollments, progress, and attempts. Fixed demo accounts (`admin@lms.test / password`, …).

---

## 3. Code architecture

```
app/
  Http/Controllers/{Admin,Instructor,Student}/...   Resource controllers
  Http/Requests/...                                 Form Requests (Vietnamese)
  Http/Middleware/CheckRole.php                     'role' alias in bootstrap/app.php
  Livewire/Exam/TakeExam.php, Livewire/Course/CourseFilter.php
  Models/...                                        $fillable, HasFactory, relations, scopes
  Policies/{Course,Lesson,Question,Exam,ExamAttempt}Policy.php
  Rules/{YoutubeUrl, AtLeastOneCorrectOption}.php
  Services/
     Payment/PaymentGatewayInterface.php, MockPaymentGateway.php   (OOP: interface + polymorphism)
     EnrollmentService, ProgressService, ExamGradingService, CertificateService
  Exports/{QuestionsExport, ExamScoresExport, QuestionTemplateExport}.php
  Imports/QuestionsImport.php                       WithHeadingRow + WithValidation
resources/views/
  layouts/{app,guest,admin}.blade.php, partials/{nav,footer,sidebar}
  components/{alert,input,button,card,badge,progress-bar,modal}.blade.php
  certificates/pdf.blade.php
routes/web.php → require admin.php, instructor.php, student.php (split into files so workers do not collide)
tests/Feature/...                                   PHPUnit for the main flows
```

UI: Tailwind (shipped with Breeze) + Alpine (shipped with Livewire). UI language: Vietnamese, `APP_LOCALE=vi`, Vietnamese validation language pack.

---

## 4. Work split between workers (after your approval)

Executed by **Sonnet** sub-agents; I (Opus) coordinate, review, and integrate.
Phase 1 runs sequentially (foundation), phase 2 runs **4 workers in parallel** on separate files/routes, phase 3 consolidates.

| Worker | Phase | Task | Owned files |
|--------|-----------|----------|-------------|
| **W1 – Foundation** | 1 (sequential) | `composer create-project` Laravel 12, install Breeze blade, Livewire 3, dompdf, maatwebsite/excel; configure MySQL + `.env` + vi locale; **all migrations, models, relationships, factories, seeders**; `role` middleware + `admin` Gate; shared layouts, partials, Blade components; `routes/*.php` skeleton + **route-name contract** | migrations, Models, factories, seeders, layouts, components, bootstrap/app.php |
| **W2 – Administration & Course content** | 2 | Admin (users, categories, course approval, order confirmation, dashboard); Instructor CRUD for Course/Section/Lesson + upload + Policies + Form Requests + `YoutubeUrl` Custom Rule | routes/admin.php, routes/instructor.php (course part), Controllers/Admin, Instructor/Course*, Lesson* |
| **W3 – Student: enrollment, payment, learning** | 2 | Home page, catalog (Livewire filter/search), course detail, free/paid enrollment + `MockPaymentGateway`, lesson page, progress via Fetch API JSON, "My courses" ("Khoá học của tôi") | routes/student.php, Controllers/Student, Services/Payment, EnrollmentService, ProgressService |
| **W4 – Question bank, Exams, Excel** | 2 | Question + option CRUD, `AtLeastOneCorrectOption` Custom Rule, Excel import/export of questions + template file, exam CRUD (manual / random selection), Excel score export | Instructor/Question*, Instructor/Exam*, Imports, Exports |
| **W5 – Online exams (Livewire) & PDF certificates** | 2 | Livewire `TakeExam` (timer, autosave, auto-submit, server-side rejection of late submissions, throttle), `ExamGradingService`, result/review page, `CertificateService` + dompdf + verification page | Livewire/Exam, ExamGradingService, CertificateService, views/exams, views/certificates |
| **W6 – Testing & Report** | 3 | Feature tests (auth, 403 authorization, enrollment, submission & grading, certificate issuing, Excel import), run `migrate:fresh --seed` + end-to-end tests, fix integration bugs, write `README.md` (setup, demo accounts) and `docs/REPORT.md` (project report outline) | tests/, README.md, docs/ |

Process: W1 finishes → I review and smoke-test → start W2–W5 in parallel → I merge/verify → W6 → handover.

---

## 5. Project report outline (docs/REPORT.md)

1. Introduction: topic, objectives, scope
2. Theoretical background: PHP OOP, Laravel 12 (MVC, Eloquent, Blade, Middleware, Auth), Livewire, DomPDF, Laravel Excel
3. Requirements analysis: actors, use cases, specification of main features
4. Design: MVC architecture, ERD, table list, exam and certificate flow diagrams, authorization
5. Implementation: directory structure, representative code (Policy, Form Request, Livewire TakeExam, Export/Import, PDF)
6. Results: screenshots by role, testing
7. Conclusion & future work (real payment gateways VNPay/MoMo, anti-cheating, video streaming)

---

## 6. Risks & mitigation
- **PHP 8.5 is new**: some packages may emit deprecation warnings → pin compatible versions on install; if that fails, use `--ignore-platform-req` or the latest dev release.
- **Breeze on Laravel 12**: the slides use Breeze, and Laravel 12 can still install `laravel/breeze` 2.x → follow the slides.
- **Large videos**: upload limit (`max:51200` KB) + YouTube link support for a lightweight demo.
- **Exam timer cheating**: the deadline is stored in `exam_attempts.expires_at` (capped at the exam closing time), the server rejects answers after it, and the client clock is never trusted.
- **Client-side anti-cheat is deterrence only**: visibility/blur events can be suppressed by a determined user and cannot detect a second device, screenshots, or faces. Mitigations: server-side debounce and limit, a tolerant default (3 violations), flagged attempts graded normally and surfaced to the instructor for review.
- **Abandoned attempts after closing**: grading is lazy, so a scheduled `exams:finalize-expired` command (plus a sweep on the results page/export) grades them; this needs `php artisan schedule:work` or a cron entry.
