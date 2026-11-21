# LMS E-Learning HUIT

An online learning management and quiz system built for the "Lập trình mã nguồn mở" (Open Source Programming) course at HUIT. The application supports course authoring, enrollment and payment, progress tracking, online exams, and PDF certificates with a publicly verifiable code.

## Features by role

- **Guest:** browse published courses, preview lessons, and verify certificates.
- **Student:** register, pay, learn with the Fetch API (progress tracking), take Livewire exams, review results, and download certificates.
- **Instructor:** CRUD for course content, question bank, Excel import/export, exam builder (optional open/close time window and browser-level anti-cheat settings), view/export scores including recorded violations.
- **Exam window and anti-cheat:** an exam can have `starts_at`/`ends_at`; attempts are capped at the closing time and auto-submitted when it passes. With anti-cheat enabled, tab/window switches are logged (debounced), copy/paste/context menu are blocked on the question area, and exceeding `max_violations` auto-submits and flags the attempt, which is still graded normally on the saved answers. This is a deterrence layer only: it cannot stop a second device, screenshots, or face/webcam checks. `max_attempts = 0` means unlimited attempts.
- **Admin:** manage users and categories, approve courses, confirm bank transfers, and view dashboards.

## Tech stack and requirements

PHP 8.2+ (the development machine runs PHP 8.5), Laravel 12, Breeze 2 (Blade), Livewire 3, MySQL 8+, Tailwind CSS 3 / Vite 7, DomPDF 3 (`barryvdh/laravel-dompdf`), Laravel Excel 4 (`maatwebsite/excel`), and PHPUnit 11. Requires Composer 2, Node.js 20+, and the usual Laravel/MySQL PHP extensions (`pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `xml`, `zip`).

## Setup

```bash
git clone <repository-url> lms-elearning
cd lms-elearning
composer install
cp .env.example .env
php artisan key:generate
```

Create a MySQL database named `lms_elearning`, update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`, then run:

```bash
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

To auto-submit abandoned attempts after an exam closes, run the scheduler in another terminal (`php artisan schedule:work`, or a `schedule:run` cron entry). It runs `php artisan exams:finalize-expired` every minute; the instructor results page and score export also sweep expired attempts on demand.

The app runs at `http://127.0.0.1:8000` by default. Set `APP_DEBUG=false` for a production-style demo.

## Demo accounts

Shared password: `password`.

| Role | Email |
|---|---|
| Admin | `admin@lms.test` |
| Instructor | `gv1@lms.test` (ThS. Nguyễn Văn An), `gv2@lms.test` (TS. Trần Thị Bình), `gv3@lms.test` (ThS. Lê Hoàng Cường) |
| Student | `hv1@lms.test` (Nguyễn Minh Khoa) … `hv60@lms.test` |

`hv1@lms.test` has a prepared demo flow: 2 courses with certificates, 1 course finished but the final exam not yet passed, 2 courses in progress, and 1 pending bank-transfer order. Instructor accounts have exams and attempts so you can view results and export scores.

Mock payment: card `4242 4242 4242 4242` succeeds; `4000 0000 0000 0002` is declined and the order stays pending so you can retry or pay by bank transfer. Bank transfer orders are confirmed by an admin.

## Testing

```bash
php artisan test
php artisan test tests/Feature/E2E
```

The suite currently has 89 passing tests (383 assertions). Tests use SQLite `:memory:` as configured in `phpunit.xml`. To rebuild the demo data, run `php artisan migrate:fresh --seed` (this deletes existing data).

## Directory structure

```text
app/Http/Controllers/       controllers grouped by role
app/Http/Requests/          Form Requests (Vietnamese messages)
app/Livewire/               course filter and exam-taking screen
app/Models, app/Policies/   Eloquent models and authorization
app/Rules, app/Services/    custom rules and business logic
app/Imports, app/Exports/   Laravel Excel
database/                   migrations, factories, seeders
resources/views/            Blade layouts, components, modules
routes/                     routes split by module
tests/Feature/E2E/          end-to-end integration tests
```

## Course rules (R1–R15) to code

| Rule | Representative files |
|---|---|
| R1 MVC | `routes/*.php`, `app/Http/Controllers`, `app/Models`, `resources/views` |
| R2 Migrations | `database/migrations/2026_01_01_000100_create_lms_tables.php` and follow-up migrations |
| R3 Relationships/fillable | `app/Models/Course.php`, `User.php`, `Exam.php` |
| R4 Factory/Seeder | `database/factories`, `database/seeders/DatabaseSeeder.php` |
| R5 N+1 | list controllers use `with`, `withCount`, `paginate` |
| R6 Resource/group | `routes/admin.php`, `routes/instructor.php` |
| R7 Blade | `resources/views/layouts`, `resources/views/components` |
| R8 Forms | Blade forms use CSRF, method spoofing, old input/errors |
| R9 Validation | `app/Http/Requests`, `app/Rules/YoutubeUrl.php`, `AtLeastOneCorrectOption.php` |
| R10 Middleware | `CheckRole.php`, alias in `bootstrap/app.php` |
| R11 Auth | `routes/auth.php`, Breeze controllers |
| R12 Authorization | `AppServiceProvider.php`, `app/Policies`, `can:` middleware |
| R13 Safety | escaped Blade `{{ }}`, query binding, validation, `.env.example` |
| R14 OOP/service | `PaymentGatewayInterface`, `ExamGradingService`, `CertificateService` |
| R15 Fetch/JSON | `resources/js/learn.js`, `LearnController::complete` |

## Notes

- The `slide/` folder (course slides) is git-ignored and not part of the repository.
- The full project report (in Vietnamese, for the lecturer) is at [docs/BAO_CAO.md](docs/BAO_CAO.md). Screenshots are in `docs/images/`.
