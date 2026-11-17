# LMS E-Learning Integration Contract

This document is the binding contract for W2–W5. Do not rename routes, binding parameters, tables, foreign keys, public relationships, or flash keys without coordinating with all workers.

## General conventions

- Laravel 12, MVC, Eloquent; no SQL/PDO in controllers. Use eager loading, `withCount()`, and `paginate()`.
- Generate URLs only with `route('name', [...])`; never hard-code paths. Blade uses `{{ }}` for user data.
- Messages and validation are in Vietnamese. The only flash keys are `success` and `error`; the layout already renders `<x-flash />`.
- Form Requests: `app/Http/Requests/{Admin,Instructor,Student}`. Policies: `app/Policies`. Business logic: `app/Services`.
- Controllers always call `authorize()`; routes use `can:` where appropriate; Blade uses `@can`. The `auth` middleware always comes before `role:`.
- Resource routes use the standard 7 actions. Uploads use the `public` disk with `mimes`/`max` validation; JSON/fetch endpoints return correct HTTP status codes.
- Route model binding: `{course}` uses `Course::getRouteKeyName()` = `slug`; `{certificate}` may bind by `code`, and the verify route uses `{code}`; other models use id.
- W2–W5 may only edit the files they own. Changes to shared models/migrations/components must be approved by the coordinator.

## Route registry

| Worker | Route name | Method | URI |
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

Route groups: admin uses `prefix('admin')->name('admin.')->middleware(['auth','role:admin'])`; instructor uses `prefix('instructor')->name('instructor.')->middleware(['auth','role:instructor,admin'])`. Student dashboard/learning/orders require `auth` (and policy/enrollment); catalog, home, and certificate verify are public. Exam taking requires `auth`, a policy, and appropriate throttling.

## File ownership

- W1/shared: migrations, `app/Models`, factories, seeders, `bootstrap/app.php`, providers, layouts, partials, components, locale, this document.
- W2: `routes/admin.php`, the course/section/lesson part of `routes/instructor.php`, Controllers `Admin/*`, `Instructor/Course*`, `Section*`, `Lesson*`, and related requests/policies.
- W3: `routes/student.php`, Controllers `Student/*`, Livewire filter, `Services/Payment/*`, `EnrollmentService`, `ProgressService`, catalog/checkout/learn/student views.
- W4: the question/exam part of `routes/instructor.php`, Controllers `Instructor/Question*`, `Exam*`, `Imports`, `Exports`, rules, and question/exam views.
- W5: `routes/exam.php`, `app/Livewire/Exam`, `ExamGradingService`, `CertificateService`, exam/attempt/certificate views.

## Model/relationship cheat sheet

- `User`: `coursesTaught`, `enrolledCourses` (pivot status, price_paid, enrolled_at, completed_at + timestamps), `completedLessons` (completed_at), `orders`, `examAttempts`, `certificates`; `isAdmin/isInstructor/isStudent`.
- `Category`: `courses`. `Course`: `category`, `instructor`, ordered `sections`, `lessons`, `students`, `exams`, `finalExam` (hasOne where final), `questions`, `orders`, `certificates`; scopes `published/free/paid`, accessor `is_free`, slug binding.
- `Section`: `course`, ordered `lessons`. `Lesson`: `section`, `completedByUsers`.
- `Order`: `user`, `course`. `Question`: `course`, `creator`, `options`, `exams`. `Option`: `question`.
- `Exam`: `course`, `questions` (pivot points/position), `attempts`. `ExamAttempt`: `exam`, `user`, `answers`. `AttemptAnswer`: `attempt`, `question`, `selected_option_ids` cast to array.
- `Certificate`: `user`, `course`, code binding.

## Shared Blade components

- `<x-alert type="success|error|warning|info">`; `<x-flash>` (no props).
- `<x-input name label? type? value?>`; `<x-textarea name label? rows?>`; `<x-select name label?>`.
- `<x-button variant="primary|secondary|danger" type="submit">`.
- `<x-card title?>`; `<x-badge variant="green|red|yellow|blue|gray">`.
- `<x-progress-bar value max=100 label?>`; `<x-empty-state title? description?>`.
- `<x-confirm-delete action label? message?>` adds CSRF, DELETE, and a confirm prompt automatically.
- Layouts: `<x-app-layout>` provides `header`, `@stack('styles')`, `@stack('scripts')`, and Livewire assets; `layouts.admin` is for admin/instructor pages and uses `@section('content')`.
