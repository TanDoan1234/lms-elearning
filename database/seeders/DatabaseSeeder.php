<?php

namespace Database\Seeders;

use App\Models\AttemptAnswer;
use App\Models\Category;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\Lesson;
use App\Models\Option;
use App\Models\Order;
use App\Models\Question;
use App\Models\Section;
use App\Models\User;
use App\Services\CertificateService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // The seeder renders ~24 certificate PDFs with dompdf in one process, which needs more than the default 128M.
        ini_set('memory_limit', '1G');
        Storage::disk('public')->deleteDirectory('certificates');
        fake()->unique(true);
        $admin = User::factory()->create(['name' => 'Quản trị viên', 'email' => 'admin@lms.test', 'role' => 'admin']);
        $instructorNames = ['ThS. Nguyễn Văn An', 'TS. Trần Thị Bình', 'ThS. Lê Hoàng Cường'];
        $instructors = collect($instructorNames)->map(fn ($name, $i) => User::factory()->create(['name' => $name, 'email' => 'gv'.($i + 1).'@lms.test', 'role' => 'instructor']));
        $studentNames = ['Nguyễn Minh Khoa', 'Trần Ngọc Mai', 'Lê Hoàng Nam', 'Phạm Thu Hà', 'Võ Gia Huy', 'Đặng Khánh Linh', 'Bùi Đức Anh', 'Đỗ Mỹ Duyên', 'Nguyễn Hải Đăng', 'Trần Thanh Trúc', 'Lê Minh Quân', 'Phạm Bảo Ngọc', 'Võ Quốc Bảo', 'Đặng Thùy Trang', 'Bùi Anh Tuấn', 'Đỗ Ngọc Hân', 'Nguyễn Thành Công', 'Trần Phương Thảo', 'Lê Nhật Minh', 'Phạm Gia Linh'];
        mt_srand(2026);
        fake()->seed(2026);
        $studentNames = array_merge($studentNames, $this->extraStudentNames(40));
        $students = collect($studentNames)->map(fn ($name, $i) => User::factory()->create(['name' => $name, 'email' => 'hv'.($i + 1).'@lms.test', 'role' => 'student', 'created_at' => now()->subDays(mt_rand(5, 200))]));
        $courseData = [];
        $categoryNames = ['Lập trình Web', 'Cơ sở dữ liệu', 'Khoa học dữ liệu', 'Mạng máy tính', 'An toàn thông tin', 'Phát triển phần mềm'];
        $categories = collect($categoryNames)->map(fn ($name) => Category::create(['name' => $name, 'slug' => str()->slug($name), 'description' => "Các khóa học về $name"]));
        $categoryIds = $categories->pluck('id', 'name');
        $questionBanks = require database_path('seeders/data/questions.php');
        foreach ($this->courseDefinitions() as $i => $definition) {
            $title = $definition['title'];
            $course = Course::create(['instructor_id' => $instructors[$i % 3]->id, 'category_id' => $categoryIds[$definition['category']], 'title' => $title, 'slug' => str()->slug($title), 'short_description' => $definition['summary'], 'description' => $definition['description'], 'price' => $i % 3 === 0 ? 0 : ($i % 2 === 0 ? 399000 : 599000), 'level' => $i % 4 === 0 ? 'intermediate' : 'beginner', 'status' => $i < 10 ? 'published' : 'draft']);
            $lessons = collect();
            foreach ($definition['curriculum'] as $sectionIndex => $sectionData) {
                $section = Section::create(['course_id' => $course->id, 'title' => $sectionData['title'], 'position' => $sectionIndex + 1]);
                foreach ($sectionData['lessons'] as $lessonIndex => $lessonTitle) {
                    $lessons->push(Lesson::create(['section_id' => $section->id, 'title' => $lessonTitle, 'type' => 'video', 'video_url' => $this->videoUrlFor($title, $sectionIndex * 4 + $lessonIndex), 'content' => "Trong bài học này, sinh viên tìm hiểu $lessonTitle, thực hành theo ví dụ minh họa và hoàn thành bài tập ứng dụng cho chủ đề $title.", 'duration_minutes' => 12 + (($sectionIndex * 4 + $lessonIndex) % 5) * 4, 'position' => $lessonIndex + 1, 'is_preview' => $sectionIndex === 0 && $lessonIndex === 0]));
                }
            }
            $questions = collect();
            $questionBank = collect($questionBanks[$title] ?? []);
            if ($questionBank->count() < 30) {
                throw new \RuntimeException("Ngân hàng câu hỏi của {$title} phải có ít nhất 30 câu.");
            }
            foreach ($questionBank->take(30) as $row) {
                $question = Question::create([
                    'course_id' => $course->id,
                    'created_by' => $course->instructor_id,
                    'content' => $row['q'],
                    'type' => $row['type'],
                    'difficulty' => $row['difficulty'],
                    'explanation' => $row['explanation'],
                ]);
                $shuffledOptions = $row['options'];
                for ($optionIndex = count($shuffledOptions) - 1; $optionIndex > 0; $optionIndex--) {
                    $swapIndex = mt_rand(0, $optionIndex);
                    [$shuffledOptions[$optionIndex], $shuffledOptions[$swapIndex]] = [$shuffledOptions[$swapIndex], $shuffledOptions[$optionIndex]];
                }
                foreach ($shuffledOptions as [$option, $isCorrect]) {
                    Option::create(['question_id' => $question->id, 'content' => $option, 'is_correct' => $isCorrect]);
                }
                $questions->push($question);
            }
            $exam = Exam::create(['course_id' => $course->id, 'title' => 'Bài thi cuối khóa', 'description' => 'Đánh giá kiến thức toàn khóa', 'duration_minutes' => 30, 'pass_score' => 60, 'max_attempts' => 3, 'shuffle_questions' => true, 'is_final' => true, 'status' => 'published']);
            $exam->questions()->attach($questions->take(20)->mapWithKeys(fn ($q, $p) => [$q->id => ['points' => 0.5, 'position' => $p + 1]]));
            if ($i % 2 === 0) {
                $quiz = Exam::create(['course_id' => $course->id, 'title' => 'Bài kiểm tra giữa khóa', 'duration_minutes' => 15, 'pass_score' => 60, 'max_attempts' => 2, 'shuffle_questions' => true, 'is_final' => false, 'status' => 'published']);
                $quiz->questions()->attach($questions->skip(20)->mapWithKeys(fn ($q, $p) => [$q->id => ['points' => 1, 'position' => $p + 1]]));
            }
            $courseData[] = ['course' => $course, 'lessons' => $lessons, 'exam' => $exam, 'quiz' => $quiz ?? null];
            unset($quiz);
        }

        $demoStudent = $students->first();
        $this->seedDemoStudent($demoStudent, collect($courseData));
        $this->seedActivity($students->slice(1)->values(), collect($courseData)->filter(fn ($d) => $d['course']->status === 'published')->values(), $demoStudent);

        $this->command?->newLine();
        $this->command?->info('Tài khoản demo (mật khẩu: password):');
        $this->command?->line('  Admin: admin@lms.test');
        $this->command?->line('  Giảng viên: gv1@lms.test, gv2@lms.test, gv3@lms.test');
        $this->command?->line('  Học viên: hv1@lms.test ... hv60@lms.test (hv1 có sẵn luồng demo đầy đủ)');
    }

    private function courseDefinitions(): array
    {
        $rows = [
            ['Laravel 12 từ cơ bản đến dự án', 'Lập trình Web', ['Giới thiệu và môi trường Laravel 12', ['Cài đặt PHP, Composer và Laravel', 'Cấu trúc thư mục dự án', 'Cấu hình môi trường và cơ sở dữ liệu', 'Tạo ứng dụng Laravel đầu tiên']], ['Routing, Blade và Controller', ['Định nghĩa route có tên', 'Xây dựng Resource Controller', 'Blade Layout và Component', 'Form, CSRF và Validation']], ['Eloquent và dự án thực tế', ['Migration và Seeder', 'Model và quan hệ Eloquent', 'Authentication và Policy', 'Hoàn thiện dự án quản lý khóa học']]],
            ['PHP hiện đại và lập trình hướng đối tượng', 'Lập trình Web', ['Nền tảng PHP hiện đại', ['Cú pháp PHP 8 và kiểu dữ liệu', 'Hàm, mảng và xử lý chuỗi', 'Request, Session và Cookie', 'Xử lý lỗi và ngoại lệ']], ['Lập trình hướng đối tượng', ['Class, Object và Constructor', 'Kế thừa và tính đa hình', 'Interface và Abstract Class', 'Trait, Namespace và PSR-4']], ['Ứng dụng PHP an toàn', ['PDO và Prepared Statement', 'Validation dữ liệu đầu vào', 'Mã hóa mật khẩu với Hash', 'Tổ chức ứng dụng PHP theo MVC']]],
            ['JavaScript cho ứng dụng Web', 'Lập trình Web', ['JavaScript nền tảng', ['Biến, kiểu dữ liệu và toán tử', 'Hàm và phạm vi biến', 'Array, Object và phương thức', 'Module JavaScript hiện đại']], ['DOM và tương tác', ['Truy vấn và thay đổi DOM', 'Xử lý sự kiện người dùng', 'Validation biểu mẫu phía client', 'Xây dựng component tương tác']], ['Lập trình bất đồng bộ', ['Promise và async await', 'Fetch API và JSON', 'Xử lý lỗi khi gọi API', 'Dự án giao diện khóa học']]],
            ['Thiết kế cơ sở dữ liệu MySQL', 'Cơ sở dữ liệu', ['Mô hình dữ liệu quan hệ', ['Thực thể, thuộc tính và khóa', 'Sơ đồ ERD', 'Chuyển ERD sang lược đồ quan hệ', 'Ràng buộc toàn vẹn']], ['SQL và chuẩn hóa', ['Truy vấn SELECT cơ bản', 'JOIN và truy vấn tổng hợp', 'Chuẩn hóa đến dạng chuẩn 3', 'Index và tối ưu truy vấn']], ['Quản trị MySQL', ['Transaction và khóa dữ liệu', 'View, Procedure và Trigger', 'Phân quyền người dùng MySQL', 'Sao lưu và khôi phục dữ liệu']]],
            ['Git và quy trình làm việc nhóm', 'Phát triển phần mềm', ['Quản lý phiên bản với Git', ['Khởi tạo repository và commit', 'Branch và chiến lược phân nhánh', 'Merge và giải quyết xung đột', 'Làm việc với remote repository']], ['Cộng tác nhóm', ['Pull Request và Code Review', 'Git Flow trong dự án', 'Quy ước commit message', 'Quản lý issue và release']], ['Tích hợp liên tục', ['GitHub Actions căn bản', 'Kiểm tra tự động khi push', 'Quản lý secret an toàn', 'Phát hành phiên bản ứng dụng']]],
            ['REST API với Laravel', 'Lập trình Web', ['Thiết kế RESTful API', ['Tài nguyên và HTTP Method', 'Status Code và JSON Response', 'API Resource trong Laravel', 'Versioning và tài liệu API']], ['Xác thực và bảo mật API', ['Laravel Sanctum', 'Policy cho API endpoint', 'Validation và xử lý lỗi', 'Rate Limiting']], ['Xây dựng API hoàn chỉnh', ['CRUD khóa học qua API', 'Phân trang, lọc và sắp xếp', 'Feature Test cho API', 'Triển khai và giám sát API']]],
            ['Nhập môn khoa học dữ liệu', 'Khoa học dữ liệu', ['Quy trình khoa học dữ liệu', ['Xác định bài toán dữ liệu', 'Thu thập và mô tả dữ liệu', 'Làm sạch dữ liệu', 'Khám phá dữ liệu EDA']], ['Thống kê ứng dụng', ['Đại lượng thống kê mô tả', 'Phân phối xác suất', 'Tương quan và hồi quy', 'Kiểm định giả thuyết']], ['Trực quan và mô hình', ['Biểu đồ với Matplotlib', 'Dashboard dữ liệu', 'Mô hình dự báo cơ bản', 'Đánh giá kết quả mô hình']]],
            ['Python ứng dụng cho sinh viên', 'Khoa học dữ liệu', ['Python căn bản', ['Cài đặt Python và môi trường ảo', 'Biến, cấu trúc điều khiển', 'Hàm và module', 'List, Tuple và Dictionary']], ['Lập trình Python thực hành', ['Đọc ghi tệp', 'Class và Object trong Python', 'Xử lý ngoại lệ', 'Kiểm thử với pytest']], ['Ứng dụng dữ liệu', ['NumPy căn bản', 'Phân tích dữ liệu với Pandas', 'Trực quan với Matplotlib', 'Dự án phân tích dữ liệu sinh viên']]],
            ['An toàn ứng dụng Web', 'An toàn thông tin', ['Nền tảng bảo mật Web', ['Mô hình CIA và quản lý rủi ro', 'HTTP, Cookie và Session an toàn', 'OWASP Top 10', 'Thiết lập môi trường kiểm thử']], ['Lỗ hổng phổ biến', ['Phòng chống SQL Injection', 'Phòng chống XSS', 'CSRF và SameSite Cookie', 'Kiểm soát truy cập']], ['Phát triển phần mềm an toàn', ['Hash và mã hóa dữ liệu', 'Quản lý secret', 'Ghi log và giám sát', 'Kiểm thử bảo mật ứng dụng']]],
            ['Mạng máy tính căn bản', 'Mạng máy tính', ['Mô hình mạng', ['Mô hình OSI và TCP/IP', 'Thiết bị và môi trường truyền', 'Ethernet và địa chỉ MAC', 'Đóng gói dữ liệu']], ['Địa chỉ và định tuyến', ['IPv4 và Subnetting', 'IPv6 căn bản', 'Routing tĩnh', 'NAT và DHCP']], ['Dịch vụ mạng', ['DNS và HTTP', 'TCP và UDP', 'Cấu hình mạng cục bộ', 'Chẩn đoán sự cố mạng']]],
            ['Kiểm thử phần mềm thực chiến', 'Phát triển phần mềm', ['Nền tảng kiểm thử', ['Vai trò của kiểm thử phần mềm', 'Test Level và Test Type', 'Thiết kế Test Case', 'Quản lý lỗi phần mềm']], ['Kiểm thử tự động', ['Unit Test', 'Feature và Integration Test', 'Mock, Stub và Fake', 'Đo độ bao phủ kiểm thử']], ['Quy trình chất lượng', ['Test Driven Development', 'Kiểm thử trong CI', 'Performance Test căn bản', 'Lập báo cáo kiểm thử']]],
            ['Docker cho lập trình viên', 'Phát triển phần mềm', ['Container căn bản', ['Cài đặt Docker', 'Image và Container', 'Volume và Network', 'Dockerfile']], ['Đóng gói ứng dụng', ['Container hóa PHP Laravel', 'Container MySQL', 'Docker Compose', 'Biến môi trường và secret']], ['Vận hành container', ['Health Check và Log', 'Tối ưu kích thước image', 'Registry và version image', 'Triển khai ứng dụng nhiều container']]],
        ];

        return collect($rows)->map(function (array $row): array {
            $title = $row[0];
            $category = $row[1];
            $sections = array_slice($row, 2);

            return [
                'title' => $title,
                'category' => $category,
                'summary' => "Học $title qua bài giảng tiếng Việt và bài tập thực hành.",
                'description' => "Khóa học $title được thiết kế cho sinh viên công nghệ thông tin, đi từ kiến thức nền tảng đến bài tập ứng dụng và dự án cuối khóa.",
                'curriculum' => collect($sections)->map(fn (array $section) => ['title' => $section[0], 'lessons' => $section[1]])->all(),
            ];
        })->all();
    }

    /** Real, on-topic YouTube videos (embeddability verified via oEmbed). */
    private function videoUrlFor(string $courseTitle, int $index): string
    {
        $pools = [
            'Laravel 12 từ cơ bản đến dự án' => ['buBaqIhuY2M', 'K0RXArBqVQo', 'iSsFV9hmxDk', '3yyGHLouHOI', 'vUcvixmurAo'],
            'PHP hiện đại và lập trình hướng đối tượng' => ['gLjfSg8SyFI', '6j1UBv240ac', 'uUlLAfN3rJc', 'yrFr5PMdk2A'],
            'JavaScript cho ứng dụng Web' => ['5fb2aPlgoys', 'NO5kUNxGIu0'],
            'Thiết kế cơ sở dữ liệu MySQL' => ['oPV2sjMG53U', 'Dlx8_LJ3rek', '-C2olg3SfvU', '1eUn6lsZ7c4', 'MiAl2mQ718s'],
            'Git và quy trình làm việc nhóm' => ['mAFoROnOfHs', 'KmOKQS9u-90', 'd_Qzg7uPIM8'],
            'REST API với Laravel' => ['WVNiiov53CE', '_iuxZygxz98', 'YGqCZjdgJJk'],
            'Nhập môn khoa học dữ liệu' => ['JC3urnvKanI', 'u8ABLLK3-z0', '7eh4d6sabA0'],
            'Python ứng dụng cho sinh viên' => ['K5KVEU3aaeQ'],
            'An toàn ứng dụng Web' => ['Ia6c-xXr0ec', 'f_rq9YMfxBE', '7ZDPKqR2mwk'],
            'Mạng máy tính căn bản' => ['VwN91x5i25g', 'm8eNwVel5xI', 'H7-NR3Q3BeI', 'bj-Yfakjllc'],
            'Kiểm thử phần mềm thực chiến' => ['u6QfIXgjwGQ', 'jydYq7oAtD8'],
            'Docker cho lập trình viên' => ['pTFZFxd4hOI', 'pg19Z8LL06w', 'DQdB7wFEygo'],
        ];
        $pool = $pools[$courseTitle] ?? ['fQbBPa0ADvs'];

        return 'https://www.youtube.com/watch?v='.$pool[$index % count($pool)];
    }

    /** Fixed demo flow for hv1: 2 certified courses, 1 finished course without a passed final exam, courses in progress and 1 pending order. */
    private function seedDemoStudent(User $student, \Illuminate\Support\Collection $courseData): void
    {
        $published = $courseData->filter(fn ($d) => $d['course']->status === 'published')->values();
        $free = $published->filter(fn ($d) => (float) $d['course']->price === 0.0)->values();
        $paid = $published->filter(fn ($d) => (float) $d['course']->price > 0)->values();
        $plan = [
            [$free[0], 'certified', 60], [$paid[0], 'certified', 35], [$paid[1], 'needs_exam', 20],
            [$paid[2], 'progress', 12], [$free[1] ?? $paid[4], 'progress', 6],
        ];
        foreach ($plan as [$data, $state, $daysAgo]) {
            $course = $data['course'];
            $enrolledAt = now()->subDays($daysAgo);
            $this->enroll($student, $course, $enrolledAt);
            $lessons = $data['lessons'];
            $done = $state === 'progress' ? $lessons->take((int) round($lessons->count() * ($daysAgo > 10 ? 0.25 : 0.5))) : $lessons;
            $this->completeLessons($student, $done, $enrolledAt);
            if ($state === 'progress' && $data['quiz']) {
                $this->createAttempt($data['quiz'], $student, 70, $enrolledAt->copy()->addDays(3));
            }
            if ($state !== 'progress') {
                $student->enrolledCourses()->updateExistingPivot($course->id, ['completed_at' => $enrolledAt->copy()->addDays(10)]);
                $this->createAttempt($data['exam'], $student, 45, $enrolledAt->copy()->addDays(11));
                if ($state === 'certified') {
                    $this->createAttempt($data['exam'], $student, $daysAgo > 40 ? 90 : 75, $enrolledAt->copy()->addDays(12));
                    app(CertificateService::class)->issueIfEligible($student, $course);
                    gc_collect_cycles();
                }
            }
        }
        $pending = $paid[3];
        $student->enrolledCourses()->syncWithoutDetaching([$pending['course']->id => ['status' => 'pending', 'price_paid' => $pending['course']->price]]);
        Order::create(['user_id' => $student->id, 'course_id' => $pending['course']->id, 'code' => 'ORD-DEMO-HV1', 'amount' => $pending['course']->price, 'method' => 'bank_transfer', 'status' => 'pending']);
    }

    /** Generates 6 months of activity: growing enrollments, orders, lesson progress, exam attempts and certificates. */
    private function seedActivity(\Illuminate\Support\Collection $students, \Illuminate\Support\Collection $courseData, User $demoStudent): void
    {
        $orderSeq = 1;
        $certificatesLeft = 22;
        foreach ($courseData as $ci => $data) {
            $course = $data['course'];
            $popularity = [24, 21, 18, 16, 14, 13, 11, 10, 9, 8][$ci] ?? 8;
            foreach ($students->shuffle()->take($popularity) as $student) {
                // Skew enrollment dates towards today so the monthly chart shows growth.
                $enrolledAt = now()->subDays((int) round(175 * (1 - sqrt(mt_rand() / mt_getrandmax()))))->setTime(mt_rand(7, 22), mt_rand(0, 59));
                $paid = (float) $course->price > 0;
                if ($paid) {
                    $roll = mt_rand(1, 100);
                    $status = $roll <= 4 ? 'failed' : ($roll <= 9 && $enrolledAt->gt(now()->subDays(20)) ? 'pending' : 'paid');
                    Order::create(['user_id' => $student->id, 'course_id' => $course->id, 'code' => 'ORD-'.$enrolledAt->format('Ymd').'-'.str_pad((string) $orderSeq++, 4, '0', STR_PAD_LEFT), 'amount' => $course->price, 'method' => mt_rand(1, 10) <= 7 ? 'card' : 'bank_transfer', 'status' => $status, 'paid_at' => $status === 'paid' ? $enrolledAt : null, 'created_at' => $enrolledAt, 'updated_at' => $enrolledAt]);
                    if ($status === 'failed') {
                        continue;
                    }
                    if ($status === 'pending') {
                        $student->enrolledCourses()->attach($course->id, ['status' => 'pending', 'price_paid' => $course->price, 'created_at' => $enrolledAt, 'updated_at' => $enrolledAt]);

                        continue;
                    }
                }
                $this->enroll($student, $course, $enrolledAt);
                $lessons = $data['lessons'];
                $ageDays = $enrolledAt->diffInDays(now());
                $finish = $ageDays > 30 && mt_rand(1, 100) <= 30 && $certificatesLeft > 0;
                $ratio = $finish ? 1 : min(0.95, max(0.08, $ageDays / 120 + mt_rand(0, 30) / 100));
                $this->completeLessons($student, $lessons->take(max(1, (int) round($lessons->count() * $ratio))), $enrolledAt);
                if ($data['quiz'] && $ratio >= 0.5) {
                    $this->createAttempt($data['quiz'], $student, mt_rand(35, 100), $enrolledAt->copy()->addDays(mt_rand(3, 15)));
                }
                if ($finish) {
                    $student->enrolledCourses()->updateExistingPivot($course->id, ['completed_at' => $enrolledAt->copy()->addDays(mt_rand(14, 25))]);
                    $score = mt_rand(30, 100);
                    $at = $enrolledAt->copy()->addDays(mt_rand(16, 28));
                    $this->createAttempt($data['exam'], $student, $score, $at);
                    if ($score < 60 && mt_rand(1, 100) <= 70) {
                        $score = mt_rand(60, 98);
                        $this->createAttempt($data['exam'], $student, $score, $at->copy()->addDays(2));
                    }
                    if ($score >= 60 && app(CertificateService::class)->issueIfEligible($student, $course)) {
                        $certificatesLeft--;
                        gc_collect_cycles();
                    }
                }
            }
        }
    }

    private function enroll(User $student, Course $course, $enrolledAt): void
    {
        $student->enrolledCourses()->syncWithoutDetaching([$course->id => ['status' => 'active', 'price_paid' => $course->price, 'enrolled_at' => $enrolledAt, 'created_at' => $enrolledAt, 'updated_at' => $enrolledAt]]);
    }

    private function completeLessons(User $student, $lessons, $from): void
    {
        $days = max(1, (int) $from->diffInDays(now()));
        foreach ($lessons->values() as $n => $lesson) {
            $student->completedLessons()->syncWithoutDetaching([$lesson->id => ['completed_at' => $from->copy()->addDays(min($days, $n))->addMinutes(mt_rand(5, 600))]]);
        }
    }

    /** Creates a submitted attempt whose per-question answers match the given score (percentage). */
    private function createAttempt(Exam $exam, User $student, int $score, $at): ExamAttempt
    {
        $questions = $exam->questions()->with('options')->orderBy('exam_question.position')->get();
        $total = $questions->count();
        $correctCount = (int) round($total * $score / 100);
        $points = $questions->sum('pivot.points') ?: 1;
        $earned = $questions->take($correctCount)->sum('pivot.points');
        $finalScore = round($earned * 100 / $points, 2);
        $started = $at->copy()->subMinutes(mt_rand(8, max(9, $exam->duration_minutes - 1)));
        $attempt = ExamAttempt::create([
            'exam_id' => $exam->id, 'user_id' => $student->id, 'started_at' => $started,
            'expires_at' => $started->copy()->addMinutes($exam->duration_minutes), 'submitted_at' => $at,
            'score' => $finalScore, 'correct_count' => $correctCount, 'total' => $total,
            'passed' => $finalScore >= (float) $exam->pass_score, 'status' => 'submitted',
            'question_order' => $questions->pluck('id')->all(),
        ]);
        foreach ($questions as $i => $question) {
            $isCorrect = $i < $correctCount;
            $selected = $isCorrect
                ? $question->options->where('is_correct', true)->pluck('id')->values()->all()
                : [$question->options->firstWhere('is_correct', false)?->id];
            AttemptAnswer::create(['exam_attempt_id' => $attempt->id, 'question_id' => $question->id, 'selected_option_ids' => $selected, 'is_correct' => $isCorrect]);
        }

        return $attempt;
    }

    /** @return list<string> */
    private function extraStudentNames(int $count): array
    {
        $ho = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Huỳnh', 'Phan', 'Vũ', 'Võ', 'Đặng', 'Bùi', 'Đỗ', 'Hồ', 'Ngô', 'Dương', 'Lý'];
        $dem = ['Văn', 'Thị', 'Minh', 'Ngọc', 'Hoàng', 'Thanh', 'Quốc', 'Gia', 'Bảo', 'Khánh', 'Thu', 'Đức', 'Anh', 'Hữu', 'Phương', 'Tuấn'];
        $ten = ['An', 'Bình', 'Châu', 'Dũng', 'Giang', 'Hiếu', 'Hòa', 'Khôi', 'Lan', 'Long', 'My', 'Nhi', 'Phúc', 'Quỳnh', 'Sơn', 'Tâm', 'Thảo', 'Trí', 'Uyên', 'Vy', 'Yến', 'Tú', 'Hưng', 'Nhung'];

        return collect(range(0, $count - 1))->map(fn ($i) => $ho[($i * 7) % 16].' '.$dem[($i * 5 + 3) % 16].' '.$ten[($i * 11 + 1) % 24])->all();
    }
}
