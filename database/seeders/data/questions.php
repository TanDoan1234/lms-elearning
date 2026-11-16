<?php

/* Ngân hàng 360 câu hỏi chuyên môn với lựa chọn và lời giải được biên soạn riêng. */
return array (
  'Laravel 12 từ cơ bản đến dự án' => 
  array (
    0 => 
    array (
      'q' => 'Lệnh Artisan nào tạo Resource Controller PostController?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'php artisan make:controller PostController --resource',
          1 => true,
        ),
        1 => 
        array (
          0 => 'php artisan make:controller PostController',
          1 => false,
        ),
        2 => 
        array (
          0 => 'composer create-controller PostController',
          1 => false,
        ),
        3 => 
        array (
          0 => 'artisan controller:create PostController',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh Artisan `make:controller` với option `--resource` tạo ra một Resource Controller.',
    ),
    1 => 
    array (
      'q' => 'Phương thức Eloquent nào nạp trước quan hệ để tránh N+1?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'with()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'load()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'attach()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'detach()',
          1 => false,
        ),
      ),
      'explanation' => 'Phương thức `with()` giúp nạp trước quan hệ để tránh vấn đề N+1.',
    ),
    2 => 
    array (
      'q' => 'Directive Blade nào bảo vệ form khỏi CSRF?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => '@csrf',
          1 => true,
        ),
        1 => 
        array (
          0 => '@method()',
          1 => false,
        ),
        2 => 
        array (
          0 => '@yield()',
          1 => false,
        ),
        3 => 
        array (
          0 => '@section()',
          1 => false,
        ),
      ),
      'explanation' => 'Directive `@csrf` được sử dụng để bảo vệ form khỏi CSRF.',
    ),
    3 => 
    array (
      'q' => 'File nào khai báo route cho giao diện web mặc định?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'routes/web.php',
          1 => true,
        ),
        1 => 
        array (
          0 => 'routes/api.php',
          1 => false,
        ),
        2 => 
        array (
          0 => 'app/Http/routes.php',
          1 => false,
        ),
        3 => 
        array (
          0 => 'config/routes.php',
          1 => false,
        ),
      ),
      'explanation' => 'File `web.php` trong thư mục `routes` khai báo route cho giao diện web mặc định.',
    ),
    4 => 
    array (
      'q' => 'Hai phương thức nào thường dùng để kiểm tra quyền qua Policy?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'authorize()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'can()',
          1 => true,
        ),
        2 => 
        array (
          0 => 'check()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'verify()',
          1 => false,
        ),
      ),
      'explanation' => 'Phương thức `authorize()` và `can()` thường được sử dụng để kiểm tra quyền qua Policy.',
    ),
    5 => 
    array (
      'q' => 'Lệnh nào tạo migration mới?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'php artisan make:migration',
          1 => true,
        ),
        1 => 
        array (
          0 => 'composer create-migration',
          1 => false,
        ),
        2 => 
        array (
          0 => 'artisan migrate:create',
          1 => false,
        ),
        3 => 
        array (
          0 => 'migration:make',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh `make:migration` tạo ra một migration mới.',
    ),
    6 => 
    array (
      'q' => 'Phương thức nào định nghĩa quan hệ một-nhiều ở model cha?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'hasMany()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'belongsTo()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'oneToMany()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'manyToOne()',
          1 => false,
        ),
      ),
      'explanation' => 'Phương thức `hasMany()` định nghĩa quan hệ một-nhiều ở model cha.',
    ),
    7 => 
    array (
      'q' => 'Validation rule nào yêu cầu email duy nhất trong bảng users?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'unique:users,email',
          1 => true,
        ),
        1 => 
        array (
          0 => 'email:users',
          1 => false,
        ),
        2 => 
        array (
          0 => 'required:users',
          1 => false,
        ),
        3 => 
        array (
          0 => 'exists:users',
          1 => false,
        ),
      ),
      'explanation' => 'Validation rule `unique:users,email` yêu cầu email duy nhất trong bảng users.',
    ),
    8 => 
    array (
      'q' => 'Biến môi trường được đọc qua helper cấu hình nào trong mã ứng dụng?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'config()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'env()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'getenv()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'dotenv()',
          1 => false,
        ),
      ),
      'explanation' => 'Biến môi trường được đọc qua helper `config()` trong mã ứng dụng.',
    ),
    9 => 
    array (
      'q' => 'Hai lệnh nào thường dùng sau khi thêm migration và seeder?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'php artisan migrate',
          1 => true,
        ),
        1 => 
        array (
          0 => 'php artisan db:seed',
          1 => true,
        ),
        2 => 
        array (
          0 => 'composer install',
          1 => false,
        ),
        3 => 
        array (
          0 => 'artisan migrate:install',
          1 => false,
        ),
      ),
      'explanation' => 'Hai lệnh `migrate` và `db:seed` thường được sử dụng sau khi thêm migration và seeder.',
    ),
    10 => 
    array (
      'q' => 'Route model binding mặc định tìm model theo cột nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'id',
          1 => true,
        ),
        1 => 
        array (
          0 => 'slug',
          1 => false,
        ),
        2 => 
        array (
          0 => 'name',
          1 => false,
        ),
        3 => 
        array (
          0 => 'email',
          1 => false,
        ),
      ),
      'explanation' => 'Route model binding mặc định tìm model theo cột `id`.',
    ),
    11 => 
    array (
      'q' => 'Phương thức nào tạo phân trang Eloquent?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'paginate()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'limit()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'offset()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'take()',
          1 => false,
        ),
      ),
      'explanation' => 'Phương thức `paginate()` tạo ra phân trang Eloquent.',
    ),
    12 => 
    array (
      'q' => 'Middleware nào yêu cầu người dùng đã đăng nhập?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'auth',
          1 => true,
        ),
        1 => 
        array (
          0 => 'guest',
          1 => false,
        ),
        2 => 
        array (
          0 => 'admin',
          1 => false,
        ),
        3 => 
        array (
          0 => 'user',
          1 => false,
        ),
      ),
      'explanation' => 'Middleware `auth` yêu cầu người dùng đã đăng nhập.',
    ),
    13 => 
    array (
      'q' => 'Lệnh nào xóa cache cấu hình?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'php artisan config:clear',
          1 => true,
        ),
        1 => 
        array (
          0 => 'composer clear-cache',
          1 => false,
        ),
        2 => 
        array (
          0 => 'artisan cache:clear',
          1 => false,
        ),
        3 => 
        array (
          0 => 'config:flush',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh `config:clear` xóa cache cấu hình.',
    ),
    14 => 
    array (
      'q' => 'Hai method HTTP nào tương ứng cập nhật toàn bộ và cập nhật một phần tài nguyên?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'PUT',
          1 => true,
        ),
        1 => 
        array (
          0 => 'PATCH',
          1 => true,
        ),
        2 => 
        array (
          0 => 'POST',
          1 => false,
        ),
        3 => 
        array (
          0 => 'DELETE',
          1 => false,
        ),
      ),
      'explanation' => 'Hai method HTTP `PUT` và `PATCH` tương ứng cập nhật toàn bộ và cập nhật một phần tài nguyên.',
    ),
    15 => 
    array (
      'q' => 'Component Blade ẩn danh được đặt mặc định ở thư mục nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'resources/views/components',
          1 => true,
        ),
        1 => 
        array (
          0 => 'app/Http/Components',
          1 => false,
        ),
        2 => 
        array (
          0 => 'resources/views/partials',
          1 => false,
        ),
        3 => 
        array (
          0 => 'resources/views/layouts',
          1 => false,
        ),
      ),
      'explanation' => 'Component Blade ẩn danh được đặt mặc định ở thư mục `resources/views/components`.',
    ),
    16 => 
    array (
      'q' => 'Phương thức nào chỉ lấy bản ghi đầu tiên hoặc ném lỗi 404?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'firstOrFail()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'getFirst()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'findFirst()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'findFirstOrFail()',
          1 => false,
        ),
      ),
      'explanation' => 'Phương thức `firstOrFail()` chỉ lấy bản ghi đầu tiên hoặc ném lỗi 404.',
    ),
    17 => 
    array (
      'q' => 'Mass assignment cần khai báo thuộc tính cho phép trong biến nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => '$fillable',
          1 => true,
        ),
        1 => 
        array (
          0 => '$guarded',
          1 => false,
        ),
        2 => 
        array (
          0 => '$visible',
          1 => false,
        ),
        3 => 
        array (
          0 => '$hidden',
          1 => false,
        ),
      ),
      'explanation' => 'Mass assignment cần khai báo thuộc tính cho phép trong biến `$fillable`.',
    ),
    18 => 
    array (
      'q' => 'Phương thức query nào thêm điều kiện WHERE?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'where()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'having()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'orderBy()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'groupBy()',
          1 => false,
        ),
      ),
      'explanation' => 'Phương thức `where()` thêm điều kiện WHERE.',
    ),
    19 => 
    array (
      'q' => 'Hai facade nào thường dùng cho transaction và ghi log?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'DB',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Log',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Cache',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Queue',
          1 => false,
        ),
      ),
      'explanation' => 'Hai facade `DB` và `Log` thường dùng cho transaction và ghi log.',
    ),
    20 => 
    array (
      'q' => 'Lệnh nào tạo đồng thời model và migration?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'php artisan make:model Post -m',
          1 => true,
        ),
        1 => 
        array (
          0 => 'composer create-model Post --migration',
          1 => false,
        ),
        2 => 
        array (
          0 => 'artisan model:create Post -m',
          1 => false,
        ),
        3 => 
        array (
          0 => 'model:make Post -m',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh `make:model` với option `-m` tạo đồng thời model và migration.',
    ),
    21 => 
    array (
      'q' => 'Blade directive nào hiển thị nội dung khi người dùng đã đăng nhập?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => '@auth',
          1 => true,
        ),
        1 => 
        array (
          0 => '@guest',
          1 => false,
        ),
        2 => 
        array (
          0 => '@admin',
          1 => false,
        ),
        3 => 
        array (
          0 => '@user',
          1 => false,
        ),
      ),
      'explanation' => 'Blade directive `@auth` hiển thị nội dung khi người dùng đã đăng nhập.',
    ),
    22 => 
    array (
      'q' => 'Phương thức nào đồng bộ quan hệ many-to-many mà không xóa liên kết cũ?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'syncWithoutDetaching()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'attach()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'detach()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'sync()',
          1 => false,
        ),
      ),
      'explanation' => 'Phương thức `syncWithoutDetaching()` đồng bộ quan hệ many-to-many mà không xóa liên kết cũ.',
    ),
    23 => 
    array (
      'q' => 'Status code phù hợp sau khi tạo tài nguyên API thành công là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => '201 Created',
          1 => true,
        ),
        1 => 
        array (
          0 => '200 OK',
          1 => false,
        ),
        2 => 
        array (
          0 => '302 Found',
          1 => false,
        ),
        3 => 
        array (
          0 => '404 Not Found',
          1 => false,
        ),
      ),
      'explanation' => 'Status code `201 Created` phù hợp sau khi tạo tài nguyên API thành công.',
    ),
    24 => 
    array (
      'q' => 'Hai phương thức nào có thể eager load quan hệ trước và sau khi model đã được lấy?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'with()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'load()',
          1 => true,
        ),
        2 => 
        array (
          0 => 'attach()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'detach()',
          1 => false,
        ),
      ),
      'explanation' => 'Hai phương thức `with()` và `load()` có thể eager load quan hệ trước và sau khi model đã được lấy.',
    ),
    25 => 
    array (
      'q' => 'Lệnh nào liệt kê toàn bộ route?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'php artisan route:list',
          1 => true,
        ),
        1 => 
        array (
          0 => 'composer show',
          1 => false,
        ),
        2 => 
        array (
          0 => 'artisan list:route',
          1 => false,
        ),
        3 => 
        array (
          0 => 'show:routes',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh `route:list` liệt kê toàn bộ route.',
    ),
    26 => 
    array (
      'q' => 'Trait nào thường được model factory sử dụng?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'HasFactory',
          1 => true,
        ),
        1 => 
        array (
          0 => 'BelongsTo',
          1 => false,
        ),
        2 => 
        array (
          0 => 'ShouldAutoSize',
          1 => false,
        ),
        3 => 
        array (
          0 => 'CanMake',
          1 => false,
        ),
      ),
      'explanation' => 'Trait `HasFactory` thường được model factory sử dụng.',
    ),
    27 => 
    array (
      'q' => 'Phương thức nào chuyển collection thành mảng?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'toArray()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'toJson()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'toJSON()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'jsonSerialize()',
          1 => false,
        ),
      ),
      'explanation' => 'Phương thức `toArray()` chuyển collection thành mảng.',
    ),
    28 => 
    array (
      'q' => 'Blade directive nào kế thừa layout?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '@extends',
          1 => true,
        ),
        1 => 
        array (
          0 => '@section',
          1 => false,
        ),
        2 => 
        array (
          0 => '@yield',
          1 => false,
        ),
        3 => 
        array (
          0 => '@parent',
          1 => false,
        ),
      ),
      'explanation' => 'Blade directive `@extends` kế thừa layout.',
    ),
    29 => 
    array (
      'q' => 'Hai lệnh nào tối ưu cache khi triển khai production?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'php artisan config:cache',
          1 => true,
        ),
        1 => 
        array (
          0 => 'php artisan route:cache',
          1 => true,
        ),
        2 => 
        array (
          0 => 'composer cache-clear',
          1 => false,
        ),
        3 => 
        array (
          0 => 'artisan clear-cache',
          1 => false,
        ),
      ),
      'explanation' => 'Hai lệnh `config:cache` và `route:cache` tối ưu cache khi triển khai production.',
    ),
  ),
  'PHP hiện đại và lập trình hướng đối tượng' => 
  array (
    0 => 
    array (
      'q' => 'Từ khóa nào khai báo kiểu trả về không có giá trị?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'void',
          1 => true,
        ),
        1 => 
        array (
          0 => 'null',
          1 => false,
        ),
        2 => 
        array (
          0 => 'bool',
          1 => false,
        ),
        3 => 
        array (
          0 => 'int',
          1 => false,
        ),
      ),
      'explanation' => 'Void chỉ định hàm không trả về giá trị.',
    ),
    1 => 
    array (
      'q' => 'Toán tử nào truy cập thành viên của object?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '->',
          1 => true,
        ),
        1 => 
        array (
          0 => '()',
          1 => false,
        ),
        2 => 
        array (
          0 => '::',
          1 => false,
        ),
        3 => 
        array (
          0 => '.',
          1 => false,
        ),
      ),
      'explanation' => 'Toán tử -> được sử dụng để truy cập các thuộc tính và phương thức của một đối tượng.',
    ),
    2 => 
    array (
      'q' => 'Từ khóa nào tạo lớp kế thừa?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'extends',
          1 => true,
        ),
        1 => 
        array (
          0 => 'implements',
          1 => false,
        ),
        2 => 
        array (
          0 => 'trait',
          1 => false,
        ),
        3 => 
        array (
          0 => 'interface',
          1 => false,
        ),
      ),
      'explanation' => 'Extends được sử dụng để định nghĩa lớp con kế thừa từ lớp cha.',
    ),
    3 => 
    array (
      'q' => 'Interface được khai báo bằng từ khóa nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'interface',
          1 => true,
        ),
        1 => 
        array (
          0 => 'class',
          1 => false,
        ),
        2 => 
        array (
          0 => 'function',
          1 => false,
        ),
        3 => 
        array (
          0 => 'trait',
          1 => false,
        ),
      ),
      'explanation' => 'Interface được khai báo bằng từ khóa interface.',
    ),
    4 => 
    array (
      'q' => 'Hai cơ chế nào giúp tái sử dụng hành vi giữa các lớp?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'trait',
          1 => true,
        ),
        1 => 
        array (
          0 => 'inheritance',
          1 => true,
        ),
        2 => 
        array (
          0 => 'extends',
          1 => false,
        ),
        3 => 
        array (
          0 => 'abstract',
          1 => false,
        ),
      ),
      'explanation' => 'Trait và Interface đều hỗ trợ việc tái sử dụng mã.',
    ),
    5 => 
    array (
      'q' => 'Visibility nào chỉ cho phép truy cập trong chính lớp?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'private',
          1 => true,
        ),
        1 => 
        array (
          0 => 'protected',
          1 => false,
        ),
        2 => 
        array (
          0 => 'public',
          1 => false,
        ),
        3 => 
        array (
          0 => 'static',
          1 => false,
        ),
      ),
      'explanation' => 'Private chỉ cho phép truy cập từ chính lớp mà nó được khai báo.',
    ),
    6 => 
    array (
      'q' => 'Hàm nào kiểm tra biến có phải instance của lớp?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'instanceof',
          1 => true,
        ),
        1 => 
        array (
          0 => 'is_object()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'get_class()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'class_exists()',
          1 => false,
        ),
      ),
      'explanation' => 'Instanceof kiểm tra xem một đối tượng có thuộc về một lớp cụ thể hay không.',
    ),
    7 => 
    array (
      'q' => 'Từ khóa nào ngăn lớp bị kế thừa?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'final',
          1 => true,
        ),
        1 => 
        array (
          0 => 'abstract',
          1 => false,
        ),
        2 => 
        array (
          0 => 'interface',
          1 => false,
        ),
        3 => 
        array (
          0 => 'trait',
          1 => false,
        ),
      ),
      'explanation' => 'Final ngăn chặn một lớp hoặc phương thức được kế thừa từ các lớp con.',
    ),
    8 => 
    array (
      'q' => 'Namespace giúp giải quyết vấn đề gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Xung đột tên lớp',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tăng tốc độ thực thi',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Giảm dung lượng mã nguồn',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tăng tính bảo mật',
          1 => false,
        ),
      ),
      'explanation' => 'Namespace ngăn chặn xung đột giữa các class có cùng tên trong các không gian khác nhau.',
    ),
    9 => 
    array (
      'q' => 'Hai chuẩn PSR nào liên quan autoload và coding style phổ biến?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'PSR-4',
          1 => true,
        ),
        1 => 
        array (
          0 => 'PSR-12',
          1 => true,
        ),
        2 => 
        array (
          0 => 'PSR-0',
          1 => false,
        ),
        3 => 
        array (
          0 => 'PSR-7',
          1 => false,
        ),
      ),
      'explanation' => 'PSR-4 và PSR-12 liên quan đến autoload và chuẩn coding style.',
    ),
    10 => 
    array (
      'q' => 'Constructor hiện đại của PHP có tên gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '__construct()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'constructor()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'init()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'create()',
          1 => false,
        ),
      ),
      'explanation' => 'Constructor hiện đại trong PHP được khai báo bằng __construct().',
    ),
    11 => 
    array (
      'q' => 'Toán tử null coalescing là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => '??',
          1 => true,
        ),
        1 => 
        array (
          0 => '???',
          1 => false,
        ),
        2 => 
        array (
          0 => '||',
          1 => false,
        ),
        3 => 
        array (
          0 => '&&',
          1 => false,
        ),
      ),
      'explanation' => 'Null coalescing toán tử ?? trả về giá trị của operand bên trái nếu nó không phải là null.',
    ),
    12 => 
    array (
      'q' => 'Kiểu union được phân cách bằng ký tự nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => '|',
          1 => true,
        ),
        1 => 
        array (
          0 => ';',
          1 => false,
        ),
        2 => 
        array (
          0 => ':',
          1 => false,
        ),
        3 => 
        array (
          0 => ',',
          1 => false,
        ),
      ),
      'explanation' => 'Union type trong PHP sử dụng dấu | để phân cách các kiểu.',
    ),
    13 => 
    array (
      'q' => 'Từ khóa nào tạo anonymous function giữ biến ngoài scope?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'use',
          1 => true,
        ),
        1 => 
        array (
          0 => 'function',
          1 => false,
        ),
        2 => 
        array (
          0 => 'lambda',
          1 => false,
        ),
        3 => 
        array (
          0 => 'closure',
          1 => false,
        ),
      ),
      'explanation' => 'Use cho phép truy cập biến từ phạm vi bên ngoài trong một hàm ẩn danh.',
    ),
    14 => 
    array (
      'q' => 'Hai interface nào hỗ trợ duyệt và đếm object collection?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Iterator',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Countable',
          1 => true,
        ),
        2 => 
        array (
          0 => 'ArrayAccess',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Serializable',
          1 => false,
        ),
      ),
      'explanation' => 'Iterator và Countable là hai interface hỗ trợ việc duyệt và đếm các đối tượng trong một collection.',
    ),
    15 => 
    array (
      'q' => 'Exception được bắt bằng khối nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'catch',
          1 => true,
        ),
        1 => 
        array (
          0 => 'try',
          1 => false,
        ),
        2 => 
        array (
          0 => 'finally',
          1 => false,
        ),
        3 => 
        array (
          0 => 'throw',
          1 => false,
        ),
      ),
      'explanation' => 'Catch dùng để bắt ngoại lệ được ném từ try block.',
    ),
    16 => 
    array (
      'q' => 'Từ khóa nào ném ngoại lệ?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'throw',
          1 => true,
        ),
        1 => 
        array (
          0 => 'catch',
          1 => false,
        ),
        2 => 
        array (
          0 => 'try',
          1 => false,
        ),
        3 => 
        array (
          0 => 'finally',
          1 => false,
        ),
      ),
      'explanation' => 'Throw được sử dụng để ném một ngoại lệ.',
    ),
    17 => 
    array (
      'q' => 'Prepared statement giúp ngăn tấn công nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'SQL Injection',
          1 => true,
        ),
        1 => 
        array (
          0 => 'XSS',
          1 => false,
        ),
        2 => 
        array (
          0 => 'CSRF',
          1 => false,
        ),
        3 => 
        array (
          0 => 'DDoS',
          1 => false,
        ),
      ),
      'explanation' => 'Prepared statement giúp phòng chống SQL injection.',
    ),
    18 => 
    array (
      'q' => 'Hàm nào băm mật khẩu an toàn?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'password_hash()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'hash()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'encrypt()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'encode()',
          1 => false,
        ),
      ),
      'explanation' => 'Password_hash() là hàm được sử dụng để băm mật khẩu.',
    ),
    19 => 
    array (
      'q' => 'Hai hàm nào dùng để mã hóa và kiểm tra mật khẩu?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'password_hash()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'password_verify()',
          1 => true,
        ),
        2 => 
        array (
          0 => 'hash()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'encrypt()',
          1 => false,
        ),
      ),
      'explanation' => 'Password_hash() và password_verify() được sử dụng cho việc mã hóa và kiểm tra mật khẩu.',
    ),
    20 => 
    array (
      'q' => 'Enum được khai báo bằng từ khóa nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'enum',
          1 => true,
        ),
        1 => 
        array (
          0 => 'class',
          1 => false,
        ),
        2 => 
        array (
          0 => 'interface',
          1 => false,
        ),
        3 => 
        array (
          0 => 'trait',
          1 => false,
        ),
      ),
      'explanation' => 'Enum được khai báo bằng từ khóa enum.',
    ),
    21 => 
    array (
      'q' => 'Readonly property ngăn thao tác nào sau khởi tạo?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Gán lại giá trị',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Đọc giá trị',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Xóa giá trị',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tạo giá trị mới',
          1 => false,
        ),
      ),
      'explanation' => 'Readonly property ngăn chặn việc gán lại giá trị sau khi khởi tạo.',
    ),
    22 => 
    array (
      'q' => 'Static member được truy cập bằng toán tử nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '::',
          1 => true,
        ),
        1 => 
        array (
          0 => '->',
          1 => false,
        ),
        2 => 
        array (
          0 => '()',
          1 => false,
        ),
        3 => 
        array (
          0 => '.',
          1 => false,
        ),
      ),
      'explanation' => 'Toán tử :: được sử dụng để truy cập thuộc tính và phương thức tĩnh.',
    ),
    23 => 
    array (
      'q' => 'Abstract method có phần thân hay không?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Không có phần thân',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Có phần thân',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Tùy thuộc vào class con',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Luôn luôn có phần thân',
          1 => false,
        ),
      ),
      'explanation' => 'Abstract method không có phần thân và phải được định nghĩa trong lớp con.',
    ),
    24 => 
    array (
      'q' => 'Hai nguyên tắc SOLID nào nói về một trách nhiệm và đảo ngược phụ thuộc?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'SRP',
          1 => true,
        ),
        1 => 
        array (
          0 => 'DIP',
          1 => true,
        ),
        2 => 
        array (
          0 => 'LSP',
          1 => false,
        ),
        3 => 
        array (
          0 => 'ISP',
          1 => false,
        ),
      ),
      'explanation' => 'SRP (Single Responsibility Principle) và DIP (Dependency Inversion Principle) đều là nguyên tắc SOLID.',
    ),
    25 => 
    array (
      'q' => 'Dependency injection giúp giảm điều gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Sự phụ thuộc chặt giữa các lớp',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tốc độ thực thi',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Dung lượng mã nguồn',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Bugs',
          1 => false,
        ),
      ),
      'explanation' => 'Dependency Injection giúp giảm sự phụ thuộc chặt chẽ giữa các lớp.',
    ),
    26 => 
    array (
      'q' => 'Composer đọc khai báo dependency từ file nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'composer.json',
          1 => true,
        ),
        1 => 
        array (
          0 => 'composer.lock',
          1 => false,
        ),
        2 => 
        array (
          0 => 'package.json',
          1 => false,
        ),
        3 => 
        array (
          0 => 'requirements.txt',
          1 => false,
        ),
      ),
      'explanation' => 'Composer đọc khai báo dependency từ composer.json.',
    ),
    27 => 
    array (
      'q' => 'Lệnh Composer nào tạo lại autoload map?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'composer dump-autoload',
          1 => true,
        ),
        1 => 
        array (
          0 => 'composer install',
          1 => false,
        ),
        2 => 
        array (
          0 => 'composer update',
          1 => false,
        ),
        3 => 
        array (
          0 => 'composer require',
          1 => false,
        ),
      ),
      'explanation' => 'Composer dump-autoload được sử dụng để tạo lại map tự động.',
    ),
    28 => 
    array (
      'q' => 'Magic method nào được gọi khi object chuyển thành chuỗi?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '__toString()',
          1 => true,
        ),
        1 => 
        array (
          0 => '__tostring()',
          1 => false,
        ),
        2 => 
        array (
          0 => '__convert()',
          1 => false,
        ),
        3 => 
        array (
          0 => '__convert_to_string()',
          1 => false,
        ),
      ),
      'explanation' => '__toString() được gọi khi một đối tượng cần được chuyển đổi thành chuỗi.',
    ),
    29 => 
    array (
      'q' => 'Hai kiểu callback hợp lệ trong PHP gồm gì?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Closure',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Mảng [object, method]',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Function name',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Class name',
          1 => false,
        ),
      ),
      'explanation' => 'Callback có thể là một Closure hoặc một mảng chứa đối tượng và phương thức.',
    ),
  ),
  'JavaScript cho ứng dụng Web' => 
  array (
    0 => 
    array (
      'q' => 'Phương thức nào chọn phần tử đầu tiên khớp CSS selector?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'document.querySelectorAll()',
          1 => false,
        ),
        1 => 
        array (
          0 => 'document.querySelector()',
          1 => true,
        ),
        2 => 
        array (
          0 => 'document.getElementsByClassName()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'document.getElementsByTagName()',
          1 => false,
        ),
      ),
      'explanation' => 'querySelector() trả về phần tử đầu tiên khớp selector.',
    ),
    1 => 
    array (
      'q' => 'Từ khóa nào khai báo biến block scope có thể gán lại?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'const',
          1 => false,
        ),
        1 => 
        array (
          0 => 'let',
          1 => true,
        ),
        2 => 
        array (
          0 => 'var',
          1 => false,
        ),
        3 => 
        array (
          0 => 'function',
          1 => false,
        ),
      ),
      'explanation' => 'let cho phép khai báo biến block scope và có thể gán lại.',
    ),
    2 => 
    array (
      'q' => 'Array method nào tạo mảng mới bằng cách biến đổi từng phần tử?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'forEach()',
          1 => false,
        ),
        1 => 
        array (
          0 => 'map()',
          1 => true,
        ),
        2 => 
        array (
          0 => 'filter()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'reduce()',
          1 => false,
        ),
      ),
      'explanation' => 'map() tạo ra một mảng mới từ kết quả của việc gọi callback function cho mỗi phần tử.',
    ),
    3 => 
    array (
      'q' => 'Sự kiện nào phát sinh khi form được gửi?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'submit',
          1 => true,
        ),
        1 => 
        array (
          0 => 'load',
          1 => false,
        ),
        2 => 
        array (
          0 => 'change',
          1 => false,
        ),
        3 => 
        array (
          0 => 'focus',
          1 => false,
        ),
      ),
      'explanation' => 'submit sự kiện xảy ra khi một form bị gửi.',
    ),
    4 => 
    array (
      'q' => 'Hai phương thức nào ngăn hành vi mặc định và dừng nổi bọt sự kiện?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'preventDefault()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'stopPropagation()',
          1 => true,
        ),
        2 => 
        array (
          0 => 'addEventListener()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'removeEventListener()',
          1 => false,
        ),
      ),
      'explanation' => 'preventDefault() ngăn chặn hành vi mặc định của sự kiện, stopPropagation() ngăn chặn sự kiện lây lan.',
    ),
    5 => 
    array (
      'q' => 'Promise thành công chuyển sang trạng thái nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'pending',
          1 => false,
        ),
        1 => 
        array (
          0 => 'fulfilled',
          1 => true,
        ),
        2 => 
        array (
          0 => 'rejected',
          1 => false,
        ),
        3 => 
        array (
          0 => 'settled',
          1 => false,
        ),
      ),
      'explanation' => 'Promise fulfilled khi có kết quả thành công.',
    ),
    6 => 
    array (
      'q' => 'Từ khóa nào chờ Promise trong hàm async?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'await',
          1 => true,
        ),
        1 => 
        array (
          0 => 'async',
          1 => false,
        ),
        2 => 
        array (
          0 => 'promise()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'then()',
          1 => false,
        ),
      ),
      'explanation' => 'await dùng để chờ cho đến khi một promise được giải quyết.',
    ),
    7 => 
    array (
      'q' => 'Fetch API mặc định reject Promise khi nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Khi lỗi mạng',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Khi server trả về 404',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Khi trả về 200 OK',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Khi thành công',
          1 => false,
        ),
      ),
      'explanation' => 'fetch() reject promise khi gặp lỗi mạng.',
    ),
    8 => 
    array (
      'q' => 'Phương thức Response nào đọc JSON?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'json()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'text()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'arrayBuffer()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'blob()',
          1 => false,
        ),
      ),
      'explanation' => 'json() chuyển đổi response thành một đối tượng JavaScript.',
    ),
    9 => 
    array (
      'q' => 'Hai header thường dùng khi gửi JSON qua fetch?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Content-Type: application/json',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Accept: application/json',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Content-Type: text/plain',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Accept: text/html',
          1 => false,
        ),
      ),
      'explanation' => 'Content-Type và Accept headers được sử dụng để xác định kiểu dữ liệu.',
    ),
    10 => 
    array (
      'q' => 'Toán tử so sánh nghiêm ngặt là gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '===',
          1 => true,
        ),
        1 => 
        array (
          0 => '==',
          1 => false,
        ),
        2 => 
        array (
          0 => '!=',
          1 => false,
        ),
        3 => 
        array (
          0 => '!==',
          1 => false,
        ),
      ),
      'explanation' => '=== kiểm tra cả giá trị và kiểu dữ liệu.',
    ),
    11 => 
    array (
      'q' => 'Giá trị nào biểu thị biến đã khai báo nhưng chưa gán?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'undefined',
          1 => true,
        ),
        1 => 
        array (
          0 => 'null',
          1 => false,
        ),
        2 => 
        array (
          0 => '0',
          1 => false,
        ),
        3 => 
        array (
          0 => 'false',
          1 => false,
        ),
      ),
      'explanation' => 'undefined cho biết một biến đã được khai báo nhưng không có giá trị.',
    ),
    12 => 
    array (
      'q' => 'DOM method nào thêm class mà không ghi đè class cũ?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'classList.add()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'classList.remove()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'classList.replace()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'classList.toggle()',
          1 => false,
        ),
      ),
      'explanation' => 'classList.add() thêm một lớp vào phần tử mà không xóa lớp hiện tại.',
    ),
    13 => 
    array (
      'q' => 'Thuộc tính nào lấy nội dung text an toàn của phần tử?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'textContent',
          1 => true,
        ),
        1 => 
        array (
          0 => 'innerText',
          1 => false,
        ),
        2 => 
        array (
          0 => 'innerHTML',
          1 => false,
        ),
        3 => 
        array (
          0 => 'outerHTML',
          1 => false,
        ),
      ),
      'explanation' => 'textContent trả về hoặc đặt nội dung văn bản của một node.',
    ),
    14 => 
    array (
      'q' => 'Hai cơ chế lưu trữ trình duyệt không tự gửi lên server?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'localStorage',
          1 => true,
        ),
        1 => 
        array (
          0 => 'sessionStorage',
          1 => true,
        ),
        2 => 
        array (
          0 => 'cookie',
          1 => false,
        ),
        3 => 
        array (
          0 => 'URLSearchParams',
          1 => false,
        ),
      ),
      'explanation' => 'localStorage và sessionStorage cho phép lưu dữ liệu trên client mà không cần gửi lên server.',
    ),
    15 => 
    array (
      'q' => 'Hàm nào chạy callback sau một khoảng thời gian?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'setTimeout()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'setInterval()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'requestAnimationFrame()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Promise',
          1 => false,
        ),
      ),
      'explanation' => 'setTimeout() thực thi hàm sau một khoảng thời gian.',
    ),
    16 => 
    array (
      'q' => 'Array method nào giữ các phần tử thỏa điều kiện?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'filter()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'map()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'reduce()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'forEach()',
          1 => false,
        ),
      ),
      'explanation' => 'filter() tạo ra mảng mới từ kết quả của việc gọi callback function cho mỗi phần tử.',
    ),
    17 => 
    array (
      'q' => 'Array method nào cộng dồn thành một giá trị?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'reduce()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'map()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'filter()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'forEach()',
          1 => false,
        ),
      ),
      'explanation' => 'reduce() tích lũy kết quả từ các phần tử của mảng.',
    ),
    18 => 
    array (
      'q' => 'Cú pháp nào sao chép phần tử mảng vào mảng mới?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Spread operator (...)',
          1 => true,
        ),
        1 => 
        array (
          0 => 'concat()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'push()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'unshift()',
          1 => false,
        ),
      ),
      'explanation' => 'Spread operator (...) cho phép sao chép một mảng vào mảng khác.',
    ),
    19 => 
    array (
      'q' => 'Hai cách nào tạo request bất đồng bộ hiện đại?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'fetch()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'XMLHttpRequest',
          1 => true,
        ),
        2 => 
        array (
          0 => '$.ajax()',
          1 => false,
        ),
        3 => 
        array (
          0 => '$.get()',
          1 => false,
        ),
      ),
      'explanation' => 'fetch() và XMLHttpRequest là hai phương thức tạo request bất đồng bộ.',
    ),
    20 => 
    array (
      'q' => 'Module ES xuất giá trị bằng từ khóa nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'export',
          1 => true,
        ),
        1 => 
        array (
          0 => 'import',
          1 => false,
        ),
        2 => 
        array (
          0 => 'require()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'module.exports',
          1 => false,
        ),
      ),
      'explanation' => 'export được sử dụng để xuất giá trị từ module.',
    ),
    21 => 
    array (
      'q' => 'Optional chaining dùng toán tử nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => '?.',
          1 => true,
        ),
        1 => 
        array (
          0 => '??',
          1 => false,
        ),
        2 => 
        array (
          0 => '?.?',
          1 => false,
        ),
        3 => 
        array (
          0 => '.?',
          1 => false,
        ),
      ),
      'explanation' => '?. toán tử optional chaining cho phép truy cập an toàn vào đối tượng con.',
    ),
    22 => 
    array (
      'q' => 'Nullish coalescing chỉ fallback với hai giá trị nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'null và undefined',
          1 => true,
        ),
        1 => 
        array (
          0 => 'null và 0',
          1 => false,
        ),
        2 => 
        array (
          0 => 'undefined và 0',
          1 => false,
        ),
        3 => 
        array (
          0 => 'null và NaN',
          1 => false,
        ),
      ),
      'explanation' => 'nullish coalescing (??) chỉ hoạt động với null và undefined.',
    ),
    23 => 
    array (
      'q' => 'Sự kiện nào phù hợp để lắng nghe thay đổi giá trị input tức thời?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'input',
          1 => true,
        ),
        1 => 
        array (
          0 => 'change',
          1 => false,
        ),
        2 => 
        array (
          0 => 'blur',
          1 => false,
        ),
        3 => 
        array (
          0 => 'focus',
          1 => false,
        ),
      ),
      'explanation' => 'input sự kiện xảy ra mỗi khi có thay đổi trong input.',
    ),
    24 => 
    array (
      'q' => 'Hai thuộc tính nào xác định phần tử và giá trị form?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => true,
        ),
        1 => 
        array (
          0 => 'value',
          1 => true,
        ),
        2 => 
        array (
          0 => 'id',
          1 => false,
        ),
        3 => 
        array (
          0 => 'class',
          1 => false,
        ),
      ),
      'explanation' => 'name và value là thuộc tính quan trọng của các phần tử input.',
    ),
    25 => 
    array (
      'q' => 'MutationObserver dùng để theo dõi điều gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Thay đổi cây DOM',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Thay đổi CSS',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Thay đổi nội dung văn bản',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Thay đổi thuộc tính',
          1 => false,
        ),
      ),
      'explanation' => 'MutationObserver theo dõi thay đổi trong cây DOM.',
    ),
    26 => 
    array (
      'q' => 'AbortController dùng để làm gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Hủy fetch request',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tạo promise',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Gửi yêu cầu',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Lắng nghe sự kiện',
          1 => false,
        ),
      ),
      'explanation' => 'AbortController cho phép hủy một fetch request.',
    ),
    27 => 
    array (
      'q' => 'Promise.all thất bại khi nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Một Promise bất kỳ bị reject',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tất cả các promise đều thành công',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Không có promise nào bị reject',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tất cả các promise đều bị reject',
          1 => false,
        ),
      ),
      'explanation' => 'Promise.all thất bại khi một hoặc nhiều promise bị reject.',
    ),
    28 => 
    array (
      'q' => 'Event delegation thường gắn listener ở đâu?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Phần tử cha',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Phần tử con',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Element body',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Document',
          1 => false,
        ),
      ),
      'explanation' => 'Event delegation thường gắn listener trên phần tử cha.',
    ),
    29 => 
    array (
      'q' => 'Hai API nào giúp lập lịch animation và tác vụ rảnh?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'requestAnimationFrame()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'requestIdleCallback()',
          1 => true,
        ),
        2 => 
        array (
          0 => 'setTimeout()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'setInterval()',
          1 => false,
        ),
      ),
      'explanation' => 'requestAnimationFrame() và requestIdleCallback() cho phép lập lịch animation và tác vụ rảnh.',
    ),
  ),
  'Thiết kế cơ sở dữ liệu MySQL' => 
  array (
    0 => 
    array (
      'q' => 'Câu lệnh nào loại bỏ bản ghi trùng lặp trong kết quả?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'SELECT DISTINCT',
          1 => true,
        ),
        1 => 
        array (
          0 => 'SELECT ALL',
          1 => false,
        ),
        2 => 
        array (
          0 => 'DELETE DUPLICATE',
          1 => false,
        ),
        3 => 
        array (
          0 => 'DROP DUPLICATE',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh SELECT DISTINCT dùng để loại bỏ các bản ghi trùng lặp.',
    ),
    1 => 
    array (
      'q' => 'Khóa nào định danh duy nhất mỗi dòng?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'PRIMARY KEY',
          1 => true,
        ),
        1 => 
        array (
          0 => 'FOREIGN KEY',
          1 => false,
        ),
        2 => 
        array (
          0 => 'UNIQUE KEY',
          1 => false,
        ),
        3 => 
        array (
          0 => 'CHECK KEY',
          1 => false,
        ),
      ),
      'explanation' => 'Primary Key là khóa chính định danh duy nhất mỗi dòng trong bảng.',
    ),
    2 => 
    array (
      'q' => 'Mệnh đề nào lọc nhóm sau GROUP BY?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'HAVING',
          1 => true,
        ),
        1 => 
        array (
          0 => 'WHERE',
          1 => false,
        ),
        2 => 
        array (
          0 => 'GROUP BY',
          1 => false,
        ),
        3 => 
        array (
          0 => 'ORDER BY',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh HAVING dùng để lọc các nhóm được tạo bởi GROUP BY.',
    ),
    3 => 
    array (
      'q' => 'JOIN nào giữ toàn bộ dòng của bảng bên trái?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'LEFT JOIN',
          1 => true,
        ),
        1 => 
        array (
          0 => 'RIGHT JOIN',
          1 => false,
        ),
        2 => 
        array (
          0 => 'INNER JOIN',
          1 => false,
        ),
        3 => 
        array (
          0 => 'FULL OUTER JOIN',
          1 => false,
        ),
      ),
      'explanation' => 'Left Join giữ nguyên tất cả các dòng từ bảng bên trái, và chỉ những dòng có khớp với bảng bên phải.',
    ),
    4 => 
    array (
      'q' => 'Hai ràng buộc nào đảm bảo duy nhất và không rỗng?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'UNIQUE',
          1 => true,
        ),
        1 => 
        array (
          0 => 'NOT NULL',
          1 => true,
        ),
        2 => 
        array (
          0 => 'CHECK',
          1 => false,
        ),
        3 => 
        array (
          0 => 'DEFAULT',
          1 => false,
        ),
      ),
      'explanation' => 'Unique và Not Null là hai ràng buộc đảm bảo duy nhất và không rỗng.',
    ),
    5 => 
    array (
      'q' => 'Dạng chuẩn 1NF yêu cầu điều gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Mỗi ô chứa giá trị nguyên tử',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Không có dữ liệu lặp',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Không có dữ liệu dạng mảng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Không có dữ liệu dạng chuỗi',
          1 => false,
        ),
      ),
      'explanation' => '1NF yêu cầu mỗi cột trong bảng chỉ chứa một giá trị duy nhất.',
    ),
    6 => 
    array (
      'q' => 'Câu lệnh nào tạo index?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'CREATE INDEX',
          1 => true,
        ),
        1 => 
        array (
          0 => 'DROP INDEX',
          1 => false,
        ),
        2 => 
        array (
          0 => 'ALTER INDEX',
          1 => false,
        ),
        3 => 
        array (
          0 => 'UPDATE INDEX',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh CREATE INDEX dùng để tạo chỉ mục cho bảng.',
    ),
    7 => 
    array (
      'q' => 'Transaction thành công được xác nhận bằng lệnh nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'COMMIT',
          1 => true,
        ),
        1 => 
        array (
          0 => 'ROLLBACK',
          1 => false,
        ),
        2 => 
        array (
          0 => 'START TRANSACTION',
          1 => false,
        ),
        3 => 
        array (
          0 => 'SAVEPOINT',
          1 => false,
        ),
      ),
      'explanation' => 'Commit xác nhận và lưu giao dịch đã hoàn tất.',
    ),
    8 => 
    array (
      'q' => 'Lệnh nào hoàn tác transaction chưa commit?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'ROLLBACK',
          1 => true,
        ),
        1 => 
        array (
          0 => 'COMMIT',
          1 => false,
        ),
        2 => 
        array (
          0 => 'UNDO',
          1 => false,
        ),
        3 => 
        array (
          0 => 'REDO',
          1 => false,
        ),
      ),
      'explanation' => 'Rollback dùng để huỷ bỏ giao dịch không thành công.',
    ),
    9 => 
    array (
      'q' => 'Hai tính chất ACID nào nói về toàn vẹn giao dịch và cô lập đồng thời?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Atomicity',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Isolation',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Consistency',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Durability',
          1 => false,
        ),
      ),
      'explanation' => 'Atomicity và Isolation là hai tính chất ACID quan trọng.',
    ),
    10 => 
    array (
      'q' => 'Mệnh đề nào sắp xếp kết quả?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'ORDER BY',
          1 => true,
        ),
        1 => 
        array (
          0 => 'GROUP BY',
          1 => false,
        ),
        2 => 
        array (
          0 => 'DISTINCT',
          1 => false,
        ),
        3 => 
        array (
          0 => 'HAVING',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh ORDER BY dùng để sắp xếp kết quả theo một hoặc nhiều cột.',
    ),
    11 => 
    array (
      'q' => 'Hàm tổng hợp nào đếm dòng?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'COUNT(*)',
          1 => true,
        ),
        1 => 
        array (
          0 => 'SUM()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'AVG()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'MAX()',
          1 => false,
        ),
      ),
      'explanation' => 'Count(*) đếm số lượng hàng trong kết quả truy vấn.',
    ),
    12 => 
    array (
      'q' => 'UNION khác UNION ALL ở điểm nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'UNION loại bỏ dòng trùng',
          1 => true,
        ),
        1 => 
        array (
          0 => 'UNION ALL không loại bỏ dòng trùng',
          1 => false,
        ),
        2 => 
        array (
          0 => 'UNION chỉ hoạt động với hai bảng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'UNION ALL chỉ hoạt động với nhiều bảng',
          1 => false,
        ),
      ),
      'explanation' => 'Union loại bỏ các bản ghi trùng lặp trong kết quả.',
    ),
    13 => 
    array (
      'q' => 'Foreign key duy trì loại toàn vẹn nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Toàn vẹn tham chiếu',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Toàn vẹn dữ liệu',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Toàn vẹn khóa chính',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Toàn vẹn ngoại lệ',
          1 => false,
        ),
      ),
      'explanation' => 'Foreign key duy trì toàn vẹn tham chiếu giữa các bảng.',
    ),
    14 => 
    array (
      'q' => 'Hai kiểu index phổ biến của InnoDB là gì?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Clustered index',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Secondary index',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Hash index',
          1 => false,
        ),
        3 => 
        array (
          0 => 'B-tree index',
          1 => false,
        ),
      ),
      'explanation' => 'InnoDB sử dụng hai loại chỉ mục chính: clustered và secondary.',
    ),
    15 => 
    array (
      'q' => 'EXPLAIN dùng để làm gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Phân tích kế hoạch thực thi truy vấn',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tạo chỉ mục',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Thực thi truy vấn',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Sắp xếp kết quả',
          1 => false,
        ),
      ),
      'explanation' => 'Explain phân tích và hiển thị cách MySQL thực hiện một truy vấn.',
    ),
    16 => 
    array (
      'q' => 'Mệnh đề LIMIT dùng để làm gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Giới hạn số dòng trả về',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tạo chỉ mục',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Sắp xếp kết quả',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Lọc nhóm',
          1 => false,
        ),
      ),
      'explanation' => 'Limit giới hạn số lượng hàng được trả về từ truy vấn.',
    ),
    17 => 
    array (
      'q' => 'Chuẩn 3NF loại bỏ phụ thuộc nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Phụ thuộc bắc cầu',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Phụ thuộc hàm',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Phụ thuộc thông qua',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Phụ thuộc toàn vẹn',
          1 => false,
        ),
      ),
      'explanation' => 'Chuẩn 3NF loại bỏ phụ thuộc bắc cầu.',
    ),
    18 => 
    array (
      'q' => 'Kiểu dữ liệu nào phù hợp lưu số tiền chính xác?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'DECIMAL',
          1 => true,
        ),
        1 => 
        array (
          0 => 'FLOAT',
          1 => false,
        ),
        2 => 
        array (
          0 => 'DOUBLE',
          1 => false,
        ),
        3 => 
        array (
          0 => 'INT',
          1 => false,
        ),
      ),
      'explanation' => 'Decimal dùng để lưu trữ giá trị số tiền với độ chính xác cao.',
    ),
    19 => 
    array (
      'q' => 'Hai mức cô lập nào ngăn dirty read?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'READ COMMITTED',
          1 => true,
        ),
        1 => 
        array (
          0 => 'SERIALIZABLE',
          1 => true,
        ),
        2 => 
        array (
          0 => 'REPEATABLE READ',
          1 => false,
        ),
        3 => 
        array (
          0 => 'READ UNCOMMITTED',
          1 => false,
        ),
      ),
      'explanation' => 'Read committed và Serializable ngăn chặn dirty read.',
    ),
    20 => 
    array (
      'q' => 'View là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Bảng ảo dựa trên truy vấn',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Bảng thực tế',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Trình quản lý dữ liệu',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Chỉ mục',
          1 => false,
        ),
      ),
      'explanation' => 'View là một bảng ảo được tạo từ kết quả của một truy vấn.',
    ),
    21 => 
    array (
      'q' => 'Trigger chạy khi nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Khi sự kiện dữ liệu đã cấu hình xảy ra',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Khi truy vấn được thực thi',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Khi bảng được tạo',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Khi chỉ mục được tạo',
          1 => false,
        ),
      ),
      'explanation' => 'Trigger chạy khi một sự kiện dữ liệu đã cấu hình xảy ra.',
    ),
    22 => 
    array (
      'q' => 'ON DELETE CASCADE có tác dụng gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Xóa dòng con khi dòng cha bị xóa',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Xóa dòng cha khi dòng con bị xóa',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Chuyển đổi giá trị NULL',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tạo khóa ngoại',
          1 => false,
        ),
      ),
      'explanation' => 'On delete cascade xóa các bản ghi con khi bản ghi cha được xóa.',
    ),
    23 => 
    array (
      'q' => 'Mệnh đề WHERE được áp dụng trước hay sau GROUP BY?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Trước GROUP BY',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Sau GROUP BY',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Trong GROUP BY',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Không liên quan đến GROUP BY',
          1 => false,
        ),
      ),
      'explanation' => 'WHERE được áp dụng trước GROUP BY để lọc dữ liệu.',
    ),
    24 => 
    array (
      'q' => 'Hai hàm nào xử lý giá trị NULL?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'COALESCE()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'IFNULL()',
          1 => true,
        ),
        2 => 
        array (
          0 => 'ISNULL()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'NULLIF()',
          1 => false,
        ),
      ),
      'explanation' => 'Coalesce() và ifnull() đều xử lý giá trị NULL.',
    ),
    25 => 
    array (
      'q' => 'Composite key gồm gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Nhiều cột cùng tạo khóa',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Một cột duy nhất',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Không có cột nào',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Các bảng khác nhau',
          1 => false,
        ),
      ),
      'explanation' => 'Composite key bao gồm nhiều cột tạo thành khóa chính.',
    ),
    26 => 
    array (
      'q' => 'Deadlock xảy ra khi nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Các transaction chờ khóa lẫn nhau',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Transaction chạy quá lâu',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Dữ liệu bị hỏng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Bảng không có khóa',
          1 => false,
        ),
      ),
      'explanation' => 'Deadlock xảy ra khi hai hoặc nhiều transaction đang đợi khóa của nhau.',
    ),
    27 => 
    array (
      'q' => 'Index có thể làm chậm thao tác nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'INSERT và UPDATE',
          1 => true,
        ),
        1 => 
        array (
          0 => 'SELECT',
          1 => false,
        ),
        2 => 
        array (
          0 => 'DELETE',
          1 => false,
        ),
        3 => 
        array (
          0 => 'CREATE INDEX',
          1 => false,
        ),
      ),
      'explanation' => 'Insert và update có thể làm chậm do việc cập nhật chỉ mục.',
    ),
    28 => 
    array (
      'q' => 'Câu lệnh nào đổi cấu trúc bảng?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'ALTER TABLE',
          1 => true,
        ),
        1 => 
        array (
          0 => 'DROP TABLE',
          1 => false,
        ),
        2 => 
        array (
          0 => 'RENAME TABLE',
          1 => false,
        ),
        3 => 
        array (
          0 => 'TRUNCATE TABLE',
          1 => false,
        ),
      ),
      'explanation' => 'Alter table dùng để thay đổi cấu trúc của bảng.',
    ),
    29 => 
    array (
      'q' => 'Hai câu lệnh nào cấp và thu hồi quyền?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'GRANT',
          1 => true,
        ),
        1 => 
        array (
          0 => 'REVOKE',
          1 => true,
        ),
        2 => 
        array (
          0 => 'CREATE',
          1 => false,
        ),
        3 => 
        array (
          0 => 'DROP',
          1 => false,
        ),
      ),
      'explanation' => 'Grant và Revoke dùng để cấp và thu hồi quyền truy cập.',
    ),
  ),
  'Git và quy trình làm việc nhóm' => 
  array (
    0 => 
    array (
      'q' => 'Lệnh nào tạo commit từ thay đổi đã stage?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'git commit',
          1 => true,
        ),
        1 => 
        array (
          0 => 'git add',
          1 => false,
        ),
        2 => 
        array (
          0 => 'git push',
          1 => false,
        ),
        3 => 
        array (
          0 => 'git pull',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh git commit được sử dụng để tạo một commit từ các thay đổi đã stage.',
    ),
    1 => 
    array (
      'q' => 'Lệnh nào đưa file vào staging area?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'git add',
          1 => true,
        ),
        1 => 
        array (
          0 => 'git commit',
          1 => false,
        ),
        2 => 
        array (
          0 => 'git push',
          1 => false,
        ),
        3 => 
        array (
          0 => 'git pull',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh git add được sử dụng để đưa file vào staging area.',
    ),
    2 => 
    array (
      'q' => 'git rebase khác git merge ở điểm chính nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Rebase viết lại lịch sử tuyến tính',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Merge tạo nhánh mới',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Rebase không tạo commit mới',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Merge không cần checkout',
          1 => false,
        ),
      ),
      'explanation' => 'Git rebase viết lại lịch sử git trong một cách tuyến tính, trong khi merge tạo ra một điểm phân kỳ.',
    ),
    3 => 
    array (
      'q' => 'Lệnh nào xem lịch sử commit dạng gọn?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'git log --oneline',
          1 => true,
        ),
        1 => 
        array (
          0 => 'git status',
          1 => false,
        ),
        2 => 
        array (
          0 => 'git add',
          1 => false,
        ),
        3 => 
        array (
          0 => 'git branch',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh git log --oneline xem lịch sử commit dạng gọn.',
    ),
    4 => 
    array (
      'q' => 'Hai lệnh nào lưu tạm và khôi phục thay đổi chưa commit?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'git stash',
          1 => true,
        ),
        1 => 
        array (
          0 => 'git stash pop',
          1 => true,
        ),
        2 => 
        array (
          0 => 'git commit',
          1 => false,
        ),
        3 => 
        array (
          0 => 'git push',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh git stash và git stash pop lưu tạm và khôi phục thay đổi chưa commit.',
    ),
    5 => 
    array (
      'q' => 'Lệnh nào tạo và chuyển sang nhánh mới?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'git switch -c',
          1 => true,
        ),
        1 => 
        array (
          0 => 'git branch',
          1 => false,
        ),
        2 => 
        array (
          0 => 'git checkout',
          1 => false,
        ),
        3 => 
        array (
          0 => 'git merge',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh git switch -c tạo và chuyển sang nhánh mới.',
    ),
    6 => 
    array (
      'q' => 'Lệnh nào tải refs từ remote mà không merge?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'git fetch',
          1 => true,
        ),
        1 => 
        array (
          0 => 'git pull',
          1 => false,
        ),
        2 => 
        array (
          0 => 'git push',
          1 => false,
        ),
        3 => 
        array (
          0 => 'git commit',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh git fetch tải refs từ remote mà không merge.',
    ),
    7 => 
    array (
      'q' => 'Fast-forward merge xảy ra khi nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Nhánh đích không có commit phân kỳ',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Merge tạo nhánh mới',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Các nhánh đang trỏ tới những commit khác nhau',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Các commit không có quan hệ tổ tiên trực tiếp',
          1 => false,
        ),
      ),
      'explanation' => 'Fast-forward merge xảy ra khi nhánh đích không có commit phân kỳ.',
    ),
    8 => 
    array (
      'q' => 'Lệnh nào bỏ stage nhưng giữ thay đổi file?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'git restore --staged',
          1 => true,
        ),
        1 => 
        array (
          0 => 'git rm',
          1 => false,
        ),
        2 => 
        array (
          0 => 'git add',
          1 => false,
        ),
        3 => 
        array (
          0 => 'git commit',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh git restore --staged bỏ stage nhưng giữ thay đổi file.',
    ),
    9 => 
    array (
      'q' => 'Hai cách nào tích hợp commit từ nhánh khác?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'merge',
          1 => true,
        ),
        1 => 
        array (
          0 => 'rebase',
          1 => false,
        ),
        2 => 
        array (
          0 => 'cherry-pick',
          1 => true,
        ),
        3 => 
        array (
          0 => 'stash',
          1 => false,
        ),
      ),
      'explanation' => 'Hai cách tích hợp commit từ nhánh khác là merge và cherry-pick.',
    ),
    10 => 
    array (
      'q' => 'HEAD biểu thị gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Commit hiện đang checkout',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tên branch',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Vùng staging',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Repository từ xa',
          1 => false,
        ),
      ),
      'explanation' => 'HEAD biểu thị commit hiện đang checkout.',
    ),
    11 => 
    array (
      'q' => 'Pull Request dùng để làm gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Đề nghị review và hợp nhất thay đổi',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Đẩy mã trực tiếp lên remote',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Tự động merge các branch',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tạo branch mới',
          1 => false,
        ),
      ),
      'explanation' => 'Pull Request dùng để đề nghị review và hợp nhất thay đổi.',
    ),
    12 => 
    array (
      'q' => 'Lệnh nào gắn nhãn phiên bản vào commit?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'git tag',
          1 => true,
        ),
        1 => 
        array (
          0 => 'git branch',
          1 => false,
        ),
        2 => 
        array (
          0 => 'git merge',
          1 => false,
        ),
        3 => 
        array (
          0 => 'git push',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh git tag gắn nhãn phiên bản vào commit.',
    ),
    13 => 
    array (
      'q' => '.gitignore có tác dụng gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Bỏ theo dõi file chưa được track khớp mẫu',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tạo một branch mới',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Commit thay đổi thẳng lên repository từ xa',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Đẩy mã trực tiếp lên máy chủ',
          1 => false,
        ),
      ),
      'explanation' => '.gitignore bỏ theo dõi file chưa được track khớp mẫu.',
    ),
    14 => 
    array (
      'q' => 'Hai thông tin tối thiểu của commit tốt là gì?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Mô tả thay đổi',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tên tác giả',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Ngày tạo commit',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Lý do thay đổi',
          1 => true,
        ),
      ),
      'explanation' => 'Hai thông tin tối thiểu của commit tốt là mô tả thay đổi và lý do thay đổi.',
    ),
    15 => 
    array (
      'q' => 'Conflict marker nào phân cách hai phía xung đột?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => '=======',
          1 => true,
        ),
        1 => 
        array (
          0 => '<<<<<<<',
          1 => false,
        ),
        2 => 
        array (
          0 => '>>>>>>>',
          1 => false,
        ),
        3 => 
        array (
          0 => '|||||||',
          1 => false,
        ),
      ),
      'explanation' => '=======',
    ),
    16 => 
    array (
      'q' => 'git revert an toàn hơn reset trên nhánh chung vì sao?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Tạo commit đảo ngược mới',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Reset không tạo commit mới',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Revert không thay đổi lịch sử',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Reset giữ lại thay đổi chưa commit',
          1 => false,
        ),
      ),
      'explanation' => 'git revert an toàn hơn reset trên nhánh chung vì nó tạo commit đảo ngược mới.',
    ),
    17 => 
    array (
      'q' => 'Lệnh nào xem khác biệt chưa stage?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'git diff',
          1 => true,
        ),
        1 => 
        array (
          0 => 'git add',
          1 => false,
        ),
        2 => 
        array (
          0 => 'git commit',
          1 => false,
        ),
        3 => 
        array (
          0 => 'git push',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh git diff xem khác biệt chưa stage.',
    ),
    18 => 
    array (
      'q' => 'Squash commit nhằm mục đích gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Gộp nhiều commit thành một',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tạo branch mới',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Đẩy mã trực tiếp lên máy chủ',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tự động merge các branch',
          1 => false,
        ),
      ),
      'explanation' => 'Squash commit nhằm mục đích gộp nhiều commit thành một.',
    ),
    19 => 
    array (
      'q' => 'Hai trạng thái review phổ biến trước merge là gì?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Approved',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Rejected',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Yêu cầu chỉnh sửa',
          1 => true,
        ),
        3 => 
        array (
          0 => 'Merged',
          1 => false,
        ),
      ),
      'explanation' => 'Hai trạng thái review phổ biến trước merge là Approved và Changes requested.',
    ),
    20 => 
    array (
      'q' => 'Protected branch thường ngăn thao tác nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Force push trực tiếp',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tự động merge các branch',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Đẩy mã trực tiếp lên repository từ xa',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tạo branch mới',
          1 => false,
        ),
      ),
      'explanation' => 'Protected branch thường ngăn thao tác force push trực tiếp.',
    ),
    21 => 
    array (
      'q' => 'CI nên chạy khi nào trên Pull Request?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Mỗi lần cập nhật nhánh',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Mỗi ngày một lần',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Chỉ khi merge',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Trong lúc code review',
          1 => false,
        ),
      ),
      'explanation' => 'CI nên chạy mỗi lần cập nhật nhánh trên Pull Request.',
    ),
    22 => 
    array (
      'q' => 'Lệnh nào đổi tên nhánh hiện tại?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'git branch -m',
          1 => true,
        ),
        1 => 
        array (
          0 => 'git checkout -b',
          1 => false,
        ),
        2 => 
        array (
          0 => 'git merge',
          1 => false,
        ),
        3 => 
        array (
          0 => 'git rebase',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh git branch -m đổi tên nhánh hiện tại.',
    ),
    23 => 
    array (
      'q' => 'Remote mặc định thường có tên gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'origin',
          1 => true,
        ),
        1 => 
        array (
          0 => 'master',
          1 => false,
        ),
        2 => 
        array (
          0 => 'default',
          1 => false,
        ),
        3 => 
        array (
          0 => 'main',
          1 => false,
        ),
      ),
      'explanation' => 'Remote mặc định thường có tên là origin.',
    ),
    24 => 
    array (
      'q' => 'Hai chiến lược giúp giảm conflict là gì?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Commit nhỏ thường xuyên',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Đồng bộ nhánh sớm',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Tự động merge các branch',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Ít khi commit và mỗi lần chứa thay đổi lớn',
          1 => false,
        ),
      ),
      'explanation' => 'Hai chiến lược giúp giảm conflict là commit nhỏ thường xuyên và đồng bộ nhánh sớm.',
    ),
    25 => 
    array (
      'q' => 'git bisect dùng để làm gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Tìm commit gây lỗi bằng tìm kiếm nhị phân',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tạo branch mới',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Đẩy mã trực tiếp lên máy chủ',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tự động merge các branch',
          1 => false,
        ),
      ),
      'explanation' => 'git bisect dùng để tìm commit gây lỗi bằng cách sử dụng tìm kiếm nhị phân.',
    ),
    26 => 
    array (
      'q' => 'Lệnh nào hiển thị remote URL?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'git remote -v',
          1 => true,
        ),
        1 => 
        array (
          0 => 'git fetch',
          1 => false,
        ),
        2 => 
        array (
          0 => 'git pull',
          1 => false,
        ),
        3 => 
        array (
          0 => 'git push',
          1 => false,
        ),
      ),
      'explanation' => 'Lệnh git remote -v hiển thị remote URL.',
    ),
    27 => 
    array (
      'q' => 'Semantic Versioning gồm ba phần nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'MAJOR.MINOR.PATCH',
          1 => true,
        ),
        1 => 
        array (
          0 => 'MINOR.MAJOR.PATCH',
          1 => false,
        ),
        2 => 
        array (
          0 => 'PATCH.MINOR.MAJOR',
          1 => false,
        ),
        3 => 
        array (
          0 => 'MAJOR.PATCH.MINOR',
          1 => false,
        ),
      ),
      'explanation' => 'Semantic Versioning gồm ba phần MAJOR.MINOR.PATCH.',
    ),
    28 => 
    array (
      'q' => 'Code review nên tập trung vào điều gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Tính đúng, dễ bảo trì và rủi ro',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Chỉ kiểm tra cú pháp',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Chỉ tối ưu hiệu năng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Chỉ kiểm tra bản vá bảo mật',
          1 => false,
        ),
      ),
      'explanation' => 'Code review nên tập trung vào tính đúng, dễ bảo trì và rủi ro.',
    ),
    29 => 
    array (
      'q' => 'Hai lệnh nào thiết lập tên và email Git toàn cục?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'git config --global user.name',
          1 => true,
        ),
        1 => 
        array (
          0 => 'git config --global user.email',
          1 => true,
        ),
        2 => 
        array (
          0 => 'git push',
          1 => false,
        ),
        3 => 
        array (
          0 => 'git branch -m',
          1 => false,
        ),
      ),
      'explanation' => 'Hai lệnh git config --global user.name và git config --global user.email thiết lập tên và email Git toàn cục.',
    ),
  ),
  'REST API với Laravel' => 
  array (
    0 => 
    array (
      'q' => 'HTTP method nào thường dùng để tạo tài nguyên?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'GET',
          1 => false,
        ),
        1 => 
        array (
          0 => 'PUT',
          1 => false,
        ),
        2 => 
        array (
          0 => 'POST',
          1 => true,
        ),
        3 => 
        array (
          0 => 'PATCH',
          1 => false,
        ),
      ),
      'explanation' => 'POST được sử dụng để tạo mới một tài nguyên.',
    ),
    1 => 
    array (
      'q' => 'Status code nào biểu thị không tìm thấy tài nguyên?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '200 OK',
          1 => false,
        ),
        1 => 
        array (
          0 => '404 Not Found',
          1 => true,
        ),
        2 => 
        array (
          0 => '500 Internal Server Error',
          1 => false,
        ),
        3 => 
        array (
          0 => '301 Moved Permanently',
          1 => false,
        ),
      ),
      'explanation' => '404 Not Found cho biết tài nguyên không tồn tại.',
    ),
    2 => 
    array (
      'q' => 'Lớp nào biến model thành JSON có cấu trúc trong Laravel?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'JsonSerializable',
          1 => false,
        ),
        1 => 
        array (
          0 => 'ResourceCollection',
          1 => false,
        ),
        2 => 
        array (
          0 => 'JsonResource',
          1 => true,
        ),
        3 => 
        array (
          0 => 'Model',
          1 => false,
        ),
      ),
      'explanation' => 'JsonResource được sử dụng để chuyển đổi model thành JSON.',
    ),
    3 => 
    array (
      'q' => 'Route::apiResource bỏ qua hai action nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'create và edit',
          1 => true,
        ),
        1 => 
        array (
          0 => 'store và update',
          1 => false,
        ),
        2 => 
        array (
          0 => 'destroy và show',
          1 => false,
        ),
        3 => 
        array (
          0 => 'index và delete',
          1 => false,
        ),
      ),
      'explanation' => 'create và edit không được tạo tự động bởi apiResource.',
    ),
    4 => 
    array (
      'q' => 'Hai header nào thường dùng cho API JSON?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Accept: application/json',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Content-Type: application/json',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Authorization: Bearer token',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Cache-Control: no-cache',
          1 => false,
        ),
      ),
      'explanation' => 'Accept và Content-Type là hai header quan trọng cho giao tiếp API.',
    ),
    5 => 
    array (
      'q' => 'Sanctum phát hành token bằng phương thức nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'createToken()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'generateToken()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'issueToken()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'signToken()',
          1 => false,
        ),
      ),
      'explanation' => 'createToken() là phương thức chính để tạo token Sanctum.',
    ),
    6 => 
    array (
      'q' => 'Status code nào dùng khi validation thất bại?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => '422 Unprocessable Entity',
          1 => true,
        ),
        1 => 
        array (
          0 => '500 Internal Server Error',
          1 => false,
        ),
        2 => 
        array (
          0 => '403 Forbidden',
          1 => false,
        ),
        3 => 
        array (
          0 => '400 Bad Request',
          1 => false,
        ),
      ),
      'explanation' => '422 Unprocessable Entity cho biết validation không thành công.',
    ),
    7 => 
    array (
      'q' => 'HTTP method nào cập nhật một phần tài nguyên?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'PATCH',
          1 => true,
        ),
        1 => 
        array (
          0 => 'PUT',
          1 => false,
        ),
        2 => 
        array (
          0 => 'POST',
          1 => false,
        ),
        3 => 
        array (
          0 => 'DELETE',
          1 => false,
        ),
      ),
      'explanation' => 'PATCH được sử dụng để cập nhật một phần của tài nguyên.',
    ),
    8 => 
    array (
      'q' => 'Policy method nào thường kiểm tra quyền sửa model?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'update()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'create()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'destroy()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'view()',
          1 => false,
        ),
      ),
      'explanation' => 'update() là phương thức policy kiểm tra quyền sửa đổi một model.',
    ),
    9 => 
    array (
      'q' => 'Hai kỹ thuật nào bảo vệ API khỏi lạm dụng?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Giới hạn tần suất request',
          1 => true,
        ),
        1 => 
        array (
          0 => 'CORS',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Authentication',
          1 => true,
        ),
        3 => 
        array (
          0 => 'Caching',
          1 => false,
        ),
      ),
      'explanation' => 'Rate limiting và Authentication giúp ngăn chặn lạm dụng API.',
    ),
    10 => 
    array (
      'q' => 'API Resource collection dùng lớp nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'ResourceCollection',
          1 => true,
        ),
        1 => 
        array (
          0 => 'JsonResource',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Model',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Collection',
          1 => false,
        ),
      ),
      'explanation' => 'ResourceCollection được sử dụng để tạo tập hợp tài nguyên.',
    ),
    11 => 
    array (
      'q' => 'Phân trang Laravel trả metadata bằng phương thức nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'paginate()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'toArray()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'toJson()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'toSql()',
          1 => false,
        ),
      ),
      'explanation' => 'paginate() trả về dữ liệu phân trang cùng với metadata.',
    ),
    12 => 
    array (
      'q' => 'Status code nào phù hợp khi xóa thành công không có body?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => '204 No Content',
          1 => true,
        ),
        1 => 
        array (
          0 => '200 OK',
          1 => false,
        ),
        2 => 
        array (
          0 => '301 Moved Permanently',
          1 => false,
        ),
        3 => 
        array (
          0 => '500 Internal Server Error',
          1 => false,
        ),
      ),
      'explanation' => '204 No Content cho biết xóa thành công mà không có body.',
    ),
    13 => 
    array (
      'q' => 'Idempotent nghĩa là gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Lặp request cho cùng hiệu ứng cuối',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Request duy nhất để thay đổi trạng thái',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Tạo nhiều tài nguyên trong một request',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Xóa nhiều tài nguyên trong một request',
          1 => false,
        ),
      ),
      'explanation' => 'Idempotent nghĩa là thực hiện nhiều lần có cùng hiệu ứng như nhau.',
    ),
    14 => 
    array (
      'q' => 'Hai method HTTP nào được xem là idempotent?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'PUT',
          1 => true,
        ),
        1 => 
        array (
          0 => 'DELETE',
          1 => true,
        ),
        2 => 
        array (
          0 => 'POST',
          1 => false,
        ),
        3 => 
        array (
          0 => 'PATCH',
          1 => false,
        ),
      ),
      'explanation' => 'PUT và DELETE được coi là idempotent trong REST API.',
    ),
    15 => 
    array (
      'q' => 'Route prefix version API thường có dạng nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => '/api/v1',
          1 => true,
        ),
        1 => 
        array (
          0 => '/v1/api',
          1 => false,
        ),
        2 => 
        array (
          0 => '/version/api',
          1 => false,
        ),
        3 => 
        array (
          0 => '/api/version',
          1 => false,
        ),
      ),
      'explanation' => '/api/v1 là định dạng phổ biến cho route prefix.',
    ),
    16 => 
    array (
      'q' => 'Middleware throttle xử lý điều gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Giới hạn tần suất request',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Xác thực người dùng',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Phân trang kết quả',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Lọc dữ liệu model',
          1 => false,
        ),
      ),
      'explanation' => 'Throttle middleware giới hạn số lần request trong một khoảng thời gian.',
    ),
    17 => 
    array (
      'q' => 'Bearer token nằm trong header nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Authorization',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Content-Type',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Accept',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Cache-Control',
          1 => false,
        ),
      ),
      'explanation' => 'Bearer token được gửi qua header Authorization.',
    ),
    18 => 
    array (
      'q' => 'CORS kiểm soát điều gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Request khác origin từ trình duyệt',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Xác thực người dùng',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Phân trang kết quả',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Lọc dữ liệu model',
          1 => false,
        ),
      ),
      'explanation' => 'CORS kiểm soát các request từ nguồn khác.',
    ),
    19 => 
    array (
      'q' => 'Hai thành phần nên có trong response lỗi nhất quán?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Mã lỗi',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Thông điệp lỗi',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Dữ liệu lỗi',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Trạng thái',
          1 => false,
        ),
      ),
      'explanation' => 'Mã lỗi và thông điệp lỗi là hai thành phần quan trọng.',
    ),
    20 => 
    array (
      'q' => 'Query parameter phù hợp cho phân trang trang số là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'page',
          1 => true,
        ),
        1 => 
        array (
          0 => 'limit',
          1 => false,
        ),
        2 => 
        array (
          0 => 'offset',
          1 => false,
        ),
        3 => 
        array (
          0 => 'sort',
          1 => false,
        ),
      ),
      'explanation' => 'Page thường được sử dụng để chỉ định trang cần hiển thị.',
    ),
    21 => 
    array (
      'q' => 'N+1 trong API được giảm bằng phương thức nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'with()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'load()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'select()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'where()',
          1 => false,
        ),
      ),
      'explanation' => 'with() giúp giảm N+1 query problem.',
    ),
    22 => 
    array (
      'q' => 'Feature test gửi JSON bằng helper nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'postJson()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'putJson()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'getJson()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'patchJson()',
          1 => false,
        ),
      ),
      'explanation' => 'postJson() được sử dụng để gửi request POST với body là JSON.',
    ),
    23 => 
    array (
      'q' => 'Validation nên thực hiện bằng lớp nào để tái sử dụng?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'FormRequest',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Validator',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Rule',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Request',
          1 => false,
        ),
      ),
      'explanation' => 'FormRequest cho phép validation được tái sử dụng.',
    ),
    24 => 
    array (
      'q' => 'Hai cách tài liệu hóa REST API phổ biến là gì?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'OpenAPI',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Postman collection',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Swagger',
          1 => false,
        ),
        3 => 
        array (
          0 => 'RAML',
          1 => false,
        ),
      ),
      'explanation' => 'OpenAPI và Postman collection là hai cách phổ biến.',
    ),
    25 => 
    array (
      'q' => 'Status code 401 khác 403 thế nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '401 chưa xác thực, 403 không đủ quyền',
          1 => true,
        ),
        1 => 
        array (
          0 => '401 đã xác thực, 403 chưa xác thực',
          1 => false,
        ),
        2 => 
        array (
          0 => '401 và 403 đều cho biết không có quyền',
          1 => false,
        ),
        3 => 
        array (
          0 => '401 và 403 đều cho biết chưa xác thực',
          1 => false,
        ),
      ),
      'explanation' => '401 cho biết yêu cầu cần được xác thực trước.',
    ),
    26 => 
    array (
      'q' => 'ETag hỗ trợ cơ chế gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Conditional request và cache',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Xác thực và phân quyền',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Giới hạn tần suất request',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Thương lượng định dạng nội dung',
          1 => false,
        ),
      ),
      'explanation' => 'ETag giúp kiểm soát yêu cầu điều kiện và caching.',
    ),
    27 => 
    array (
      'q' => 'PUT thường yêu cầu payload thế nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Biểu diễn đầy đủ tài nguyên',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Một phần của tài nguyên',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Dữ liệu thay đổi nhỏ',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Thông tin xác thực',
          1 => false,
        ),
      ),
      'explanation' => 'PUT yêu cầu một biểu diễn đầy đủ của tài nguyên.',
    ),
    28 => 
    array (
      'q' => 'RateLimit header giúp client biết gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Hạn mức và số request còn lại',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Thời gian hết hạn token',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Dữ liệu phân trang',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Thông tin xác thực',
          1 => false,
        ),
      ),
      'explanation' => 'RateLimit header cho biết tần suất request được phép.',
    ),
    29 => 
    array (
      'q' => 'Hai nguyên tắc REST nào liên quan không lưu phiên và tài nguyên định danh?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Stateless',
          1 => true,
        ),
        1 => 
        array (
          0 => 'URI hướng tài nguyên',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Cache ở phía client',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Quản lý session ở máy chủ',
          1 => false,
        ),
      ),
      'explanation' => 'Stateless và Resource-oriented URI là hai nguyên tắc REST.',
    ),
  ),
  'Nhập môn khoa học dữ liệu' => 
  array (
    0 => 
    array (
      'q' => 'Thước đo trung tâm nào ít bị ảnh hưởng bởi ngoại lệ?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Trung bình',
          1 => false,
        ),
        1 => 
        array (
          0 => 'Phương sai',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Trung vị',
          1 => true,
        ),
        3 => 
        array (
          0 => 'Độ lệch chuẩn',
          1 => false,
        ),
      ),
      'explanation' => 'Trung vị không phụ thuộc vào giá trị cựcreme, nên ít bị ảnh hưởng bởi ngoại lệ.',
    ),
    1 => 
    array (
      'q' => 'Bài toán dự đoán nhãn đã biết thuộc loại học nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Học không giám sát',
          1 => false,
        ),
        1 => 
        array (
          0 => 'Học có giám sát',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Học tăng cường',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Học sâu',
          1 => false,
        ),
      ),
      'explanation' => 'Trong học máy, bài toán dự đoán nhãn đã biết thuộc loại học có giám sát.',
    ),
    2 => 
    array (
      'q' => 'Cấu trúc hai chiều có nhãn của pandas là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'DataFrame',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Series',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Panel',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Index',
          1 => false,
        ),
      ),
      'explanation' => 'DataFrame trong pandas là cấu trúc dữ liệu hai chiều có nhãn cho cả hàng và cột.',
    ),
    3 => 
    array (
      'q' => 'Đại lượng nào đo độ phân tán quanh giá trị trung bình?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Trung vị',
          1 => false,
        ),
        1 => 
        array (
          0 => 'Phương sai',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Độ lệch chuẩn',
          1 => true,
        ),
        3 => 
        array (
          0 => 'Hàm mật độ',
          1 => false,
        ),
      ),
      'explanation' => 'Phương sai và độ lệch chuẩn đều đo lường độ phân tán quanh giá trị trung bình.',
    ),
    4 => 
    array (
      'q' => 'Hai chỉ số nào phù hợp khi đánh giá lớp dương trên dữ liệu mất cân bằng?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Precision',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Recall',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Accuracy',
          1 => false,
        ),
        3 => 
        array (
          0 => 'F1-score',
          1 => false,
        ),
      ),
      'explanation' => 'Precision và Recall là hai chỉ số quan trọng khi đánh giá lớp dương trong học máy.',
    ),
    5 => 
    array (
      'q' => 'Tập test dùng để làm gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Đánh giá mô hình trên dữ liệu chưa thấy',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Huấn luyện mô hình',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Chọn đặc trưng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Giải quyết mất cân bằng',
          1 => false,
        ),
      ),
      'explanation' => 'Tập test được sử dụng để đánh giá hiệu suất của mô hình trên dữ liệu chưa từng thấy.',
    ),
    6 => 
    array (
      'q' => 'Hệ số tương quan Pearson nằm trong khoảng nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Từ 0 đến 1',
          1 => false,
        ),
        1 => 
        array (
          0 => 'Từ -1 đến 1',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Từ -100 đến 100',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Không có giới hạn',
          1 => false,
        ),
      ),
      'explanation' => 'Hệ số tương quan Pearson nằm trong khoảng từ -1 đến 1.',
    ),
    7 => 
    array (
      'q' => 'Mô hình tốt trên train nhưng kém trên test gặp vấn đề gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Underfitting',
          1 => false,
        ),
        1 => 
        array (
          0 => 'Overfitting',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Bias',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Variance',
          1 => false,
        ),
      ),
      'explanation' => 'Khi mô hình quá khớp dữ liệu huấn luyện, nó sẽ kém hiệu suất trên dữ liệu test.',
    ),
    8 => 
    array (
      'q' => 'Biểu đồ nào thể hiện phân phối của một biến số liên tục?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Scatter plot',
          1 => false,
        ),
        1 => 
        array (
          0 => 'Box plot',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Histogram',
          1 => true,
        ),
        3 => 
        array (
          0 => 'Line chart',
          1 => false,
        ),
      ),
      'explanation' => 'Histogram được sử dụng để thể hiện phân phối của một biến số liên tục.',
    ),
    9 => 
    array (
      'q' => 'Hai kỹ thuật nào thường đưa đặc trưng số về cùng thang đo?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Chuẩn hóa Min-Max',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Chuẩn hóa Z-score',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Chuỗi mã hóa',
          1 => false,
        ),
        3 => 
        array (
          0 => 'One-hot encoding',
          1 => false,
        ),
      ),
      'explanation' => 'Chuẩn hóa Min-Max và Chuẩn hóa Z-score đều đưa đặc trưng số về cùng thang đo.',
    ),
    10 => 
    array (
      'q' => 'MAE đo đại lượng nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Trung bình trị tuyệt đối của sai số',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Độ lệch chuẩn',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Phương sai',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Hàm mất mát',
          1 => false,
        ),
      ),
      'explanation' => 'MAE (Mean Absolute Error) đo trung bình trị tuyệt đối của sai số.',
    ),
    11 => 
    array (
      'q' => 'Ma trận nào tổng hợp TP, FP, TN và FN?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Confusion matrix',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Precision-Recall curve',
          1 => false,
        ),
        2 => 
        array (
          0 => 'ROC curve',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Accuracy matrix',
          1 => false,
        ),
      ),
      'explanation' => 'Confusion matrix tổng hợp số lượng thực tế dương (TP, FP), thực tế âm (TN, FN).',
    ),
    12 => 
    array (
      'q' => 'Cách xử lý giá trị thiếu bằng trung vị gọi là gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Imputation',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Chuẩn hóa',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Chuỗi mã hóa',
          1 => false,
        ),
        3 => 
        array (
          0 => 'One-hot encoding',
          1 => false,
        ),
      ),
      'explanation' => 'Trong xử lý dữ liệu, cách thay thế giá trị thiếu bằng trung vị được gọi là imputation.',
    ),
    13 => 
    array (
      'q' => 'Kỹ thuật nào mã hóa biến phân loại không thứ tự thành các cột nhị phân?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'One-hot encoding',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Chuẩn hóa Min-Max',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Chuẩn hóa Z-score',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Imputation',
          1 => false,
        ),
      ),
      'explanation' => 'One-hot encoding mã hóa biến phân loại không thứ tự thành các cột nhị phân.',
    ),
    14 => 
    array (
      'q' => 'Hai cách nào giúp ước lượng khả năng tổng quát hóa của mô hình?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Cross-validation',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Holdout test',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Backpropagation',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Gradient descent',
          1 => false,
        ),
      ),
      'explanation' => 'Cross-validation và Holdout test là hai cách phổ biến để ước lượng khả năng tổng quát hóa của mô hình.',
    ),
    15 => 
    array (
      'q' => 'Dự đoán giá nhà là bài toán gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Hồi quy',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Phân loại',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Clustering',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Reinforcement learning',
          1 => false,
        ),
      ),
      'explanation' => 'Dự đoán giá nhà là một bài toán hồi quy.',
    ),
    16 => 
    array (
      'q' => 'Dự đoán thư rác hay không là bài toán gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Phân loại',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Hồi quy',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Clustering',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Reinforcement learning',
          1 => false,
        ),
      ),
      'explanation' => 'Dự đoán thư rác hay không là một bài toán phân loại.',
    ),
    17 => 
    array (
      'q' => 'Biểu đồ nào phù hợp quan sát quan hệ giữa hai biến số?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Scatter plot',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Histogram',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Box plot',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Line chart',
          1 => false,
        ),
      ),
      'explanation' => 'Scatter plot được sử dụng để quan sát quan hệ giữa hai biến số.',
    ),
    18 => 
    array (
      'q' => 'Trong học máy, cột đầu vào được gọi là gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Đặc trưng',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Label',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Target',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Feature',
          1 => false,
        ),
      ),
      'explanation' => 'Trong học máy, cột đầu vào thường được gọi là đặc trưng.',
    ),
    19 => 
    array (
      'q' => 'Hai thư viện Python nền tảng cho mảng số và bảng dữ liệu là gì?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'NumPy',
          1 => true,
        ),
        1 => 
        array (
          0 => 'pandas',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Matplotlib',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Seaborn',
          1 => false,
        ),
      ),
      'explanation' => 'NumPy và pandas là hai thư viện quan trọng trong xử lý dữ liệu Python.',
    ),
    20 => 
    array (
      'q' => 'Giá trị trung bình cộng nhạy với yếu tố nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Giá trị ngoại lệ',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Dữ liệu chuẩn hóa',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Trong phân phối đối xứng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Không phụ thuộc vào dữ liệu',
          1 => false,
        ),
      ),
      'explanation' => 'Giá trị trung bình cộng nhạy với giá trị ngoại lệ.',
    ),
    21 => 
    array (
      'q' => 'P-value nhỏ thường cung cấp bằng chứng chống lại giả thuyết nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Giả thuyết không',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Giả thuyết thay thế',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Giả thuyết chính',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Giả thuyết phụ',
          1 => false,
        ),
      ),
      'explanation' => 'P-value nhỏ cung cấp bằng chứng mạnh mẽ chống lại giả thuyết không.',
    ),
    22 => 
    array (
      'q' => 'Đặt random seed nhằm mục đích gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Tái lập kết quả',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tăng tốc độ tính toán',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Giảm độ phức tạp của mô hình',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Cải thiện hiệu suất',
          1 => false,
        ),
      ),
      'explanation' => 'Đặt random seed nhằm tái lập kết quả khi thực hiện các phép tính ngẫu nhiên.',
    ),
    23 => 
    array (
      'q' => 'Dùng dữ liệu test để chọn đặc trưng gây ra vấn đề gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Rò rỉ dữ liệu',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Overfitting',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Underfitting',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Bias',
          1 => false,
        ),
      ),
      'explanation' => 'Dùng dữ liệu test để chọn đặc trưng sẽ làm rò rỉ dữ liệu, ảnh hưởng đến khả năng tổng quát hóa của mô hình.',
    ),
    24 => 
    array (
      'q' => 'Hai chỉ số nào thường dùng cho mô hình phân loại?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Accuracy',
          1 => true,
        ),
        1 => 
        array (
          0 => 'F1-score',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Precision',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Recall',
          1 => false,
        ),
      ),
      'explanation' => 'Accuracy và F1-score là hai chỉ số phổ biến trong đánh giá mô hình phân loại.',
    ),
    25 => 
    array (
      'q' => 'Biểu đồ nào hiển thị tứ phân vị và ngoại lệ?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Box plot',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Histogram',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Scatter plot',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Line chart',
          1 => false,
        ),
      ),
      'explanation' => 'Box plot được sử dụng để hiển thị tứ phân vị và ngoại lệ.',
    ),
    26 => 
    array (
      'q' => 'K-means thuộc nhóm thuật toán nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Phân cụm không giám sát',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Học có giám sát',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Học tăng cường',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Học sâu',
          1 => false,
        ),
      ),
      'explanation' => 'K-means là một thuật toán phân cụm không giám sát.',
    ),
    27 => 
    array (
      'q' => 'PCA chủ yếu dùng để làm gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Giảm số chiều',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tăng số chiều',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Phân loại',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Hồi quy',
          1 => false,
        ),
      ),
      'explanation' => 'PCA (Principal Component Analysis) chủ yếu được sử dụng để giảm số chiều.',
    ),
    28 => 
    array (
      'q' => 'Z-score bằng hiệu với trung bình chia cho đại lượng nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Độ lệch chuẩn',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Phương sai',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Trung vị',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Hàm mật độ',
          1 => false,
        ),
      ),
      'explanation' => 'Z-score được tính bằng cách chia hiệu giữa giá trị và trung bình cho độ lệch chuẩn.',
    ),
    29 => 
    array (
      'q' => 'Hai thư viện nào thường dùng trực quan hóa dữ liệu Python?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Matplotlib',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Seaborn',
          1 => true,
        ),
        2 => 
        array (
          0 => 'NumPy',
          1 => false,
        ),
        3 => 
        array (
          0 => 'pandas',
          1 => false,
        ),
      ),
      'explanation' => 'Matplotlib và Seaborn là hai thư viện phổ biến trong việc trực quan hóa dữ liệu.',
    ),
  ),
  'Python ứng dụng cho sinh viên' => 
  array (
    0 => 
    array (
      'q' => 'Hàm nào trả về số phần tử của một danh sách?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'len()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'count()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'append()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'sum()',
          1 => false,
        ),
      ),
      'explanation' => 'Hàm len() được sử dụng để tính độ dài của một đối tượng như chuỗi hoặc danh sách.',
    ),
    1 => 
    array (
      'q' => 'Kiểu collection nào có thể thay đổi sau khi tạo?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'list',
          1 => true,
        ),
        1 => 
        array (
          0 => 'tuple',
          1 => false,
        ),
        2 => 
        array (
          0 => 'set',
          1 => false,
        ),
        3 => 
        array (
          0 => 'dict',
          1 => false,
        ),
      ),
      'explanation' => 'List là một kiểu collection có thể thay đổi sau khi tạo.',
    ),
    2 => 
    array (
      'q' => 'Kiểu collection có thứ tự nhưng bất biến là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'tuple',
          1 => true,
        ),
        1 => 
        array (
          0 => 'list',
          1 => false,
        ),
        2 => 
        array (
          0 => 'set',
          1 => false,
        ),
        3 => 
        array (
          0 => 'dict',
          1 => false,
        ),
      ),
      'explanation' => 'Tuple là kiểu collection có thứ tự nhưng bất biến.',
    ),
    3 => 
    array (
      'q' => 'Kiểu nào lưu cặp khóa và giá trị?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'dict',
          1 => true,
        ),
        1 => 
        array (
          0 => 'list',
          1 => false,
        ),
        2 => 
        array (
          0 => 'tuple',
          1 => false,
        ),
        3 => 
        array (
          0 => 'set',
          1 => false,
        ),
      ),
      'explanation' => 'Dict là kiểu dữ liệu lưu trữ các cặp khóa và giá trị.',
    ),
    4 => 
    array (
      'q' => 'Hai cú pháp nào tạo collection ngắn gọn từ vòng lặp?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'List comprehension',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Dictionary comprehension',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Set comprehension',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tuple comprehension',
          1 => false,
        ),
      ),
      'explanation' => 'List và dictionary comprehension là hai cách tạo collection ngắn gọn từ vòng lặp.',
    ),
    5 => 
    array (
      'q' => 'Phương thức nào khởi tạo đối tượng Python?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => '__init__()',
          1 => true,
        ),
        1 => 
        array (
          0 => '__new__()',
          1 => false,
        ),
        2 => 
        array (
          0 => '__call__()',
          1 => false,
        ),
        3 => 
        array (
          0 => '__del__()',
          1 => false,
        ),
      ),
      'explanation' => 'Phương thức __init__() khởi tạo đối tượng Python.',
    ),
    6 => 
    array (
      'q' => 'Tham số đầu tiên quy ước của instance method là gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'self',
          1 => true,
        ),
        1 => 
        array (
          0 => 'cls',
          1 => false,
        ),
        2 => 
        array (
          0 => 'args',
          1 => false,
        ),
        3 => 
        array (
          0 => 'kwargs',
          1 => false,
        ),
      ),
      'explanation' => 'Tham số đầu tiên của instance method là self.',
    ),
    7 => 
    array (
      'q' => 'Cú pháp nào bảo đảm file được đóng sau khi đọc?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'with open(...)',
          1 => true,
        ),
        1 => 
        array (
          0 => 'open()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'read()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'close()',
          1 => false,
        ),
      ),
      'explanation' => 'Cú pháp with open(...) đảm bảo file được đóng sau khi xử lý.',
    ),
    8 => 
    array (
      'q' => 'Khối nào bắt và xử lý ngoại lệ?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'except',
          1 => true,
        ),
        1 => 
        array (
          0 => 'else',
          1 => false,
        ),
        2 => 
        array (
          0 => 'finally',
          1 => false,
        ),
        3 => 
        array (
          0 => 'try',
          1 => false,
        ),
      ),
      'explanation' => 'Khối except bắt và xử lý ngoại lệ.',
    ),
    9 => 
    array (
      'q' => 'Hai công cụ nào lần lượt tạo môi trường ảo và cài package?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'venv',
          1 => true,
        ),
        1 => 
        array (
          0 => 'pip',
          1 => true,
        ),
        2 => 
        array (
          0 => 'conda',
          1 => false,
        ),
        3 => 
        array (
          0 => 'virtualenv',
          1 => false,
        ),
      ),
      'explanation' => 'venv và pip lần lượt tạo môi trường ảo và cài đặt package.',
    ),
    10 => 
    array (
      'q' => 'range(2, 6) tạo ra giá trị cuối cùng nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '5',
          1 => true,
        ),
        1 => 
        array (
          0 => '6',
          1 => false,
        ),
        2 => 
        array (
          0 => '4',
          1 => false,
        ),
        3 => 
        array (
          0 => '7',
          1 => false,
        ),
      ),
      'explanation' => 'range(2, 6) tạo ra một chuỗi số từ 2 đến 5.',
    ),
    11 => 
    array (
      'q' => 'Hàm nào lặp đồng thời chỉ số và giá trị?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'enumerate()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'zip()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'range()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'items()',
          1 => false,
        ),
      ),
      'explanation' => 'Hàm enumerate() lặp đồng thời chỉ số và giá trị.',
    ),
    12 => 
    array (
      'q' => 'Hàm nào ghép các iterable theo từng vị trí?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'zip()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'enumerate()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'range()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'join()',
          1 => false,
        ),
      ),
      'explanation' => 'Hàm zip() ghép các iterable theo từng vị trí.',
    ),
    13 => 
    array (
      'q' => 'Từ khóa nào tạo hàm ẩn danh ngắn?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'lambda',
          1 => true,
        ),
        1 => 
        array (
          0 => 'def',
          1 => false,
        ),
        2 => 
        array (
          0 => 'class',
          1 => false,
        ),
        3 => 
        array (
          0 => 'function',
          1 => false,
        ),
      ),
      'explanation' => 'Từ khóa lambda tạo hàm ẩn danh ngắn.',
    ),
    14 => 
    array (
      'q' => 'Hai cách nào kiểm tra kiểu của một đối tượng?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'isinstance()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'type()',
          1 => true,
        ),
        2 => 
        array (
          0 => 'assert()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'check_type()',
          1 => false,
        ),
      ),
      'explanation' => 'isinstance() và type() đều kiểm tra kiểu của một đối tượng.',
    ),
    15 => 
    array (
      'q' => 'Framework nào phổ biến để viết unit test Python?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'pytest',
          1 => true,
        ),
        1 => 
        array (
          0 => 'unittest',
          1 => false,
        ),
        2 => 
        array (
          0 => 'doctest',
          1 => false,
        ),
        3 => 
        array (
          0 => 'nose2',
          1 => false,
        ),
      ),
      'explanation' => 'pytest là framework unit test phổ biến.',
    ),
    16 => 
    array (
      'q' => 'Từ khóa nào biến hàm thành generator?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'yield',
          1 => true,
        ),
        1 => 
        array (
          0 => 'return',
          1 => false,
        ),
        2 => 
        array (
          0 => 'pass',
          1 => false,
        ),
        3 => 
        array (
          0 => 'break',
          1 => false,
        ),
      ),
      'explanation' => 'Từ khóa yield biến hàm thành generator.',
    ),
    17 => 
    array (
      'q' => 'Cú pháp @decorator có tác dụng gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Bọc hoặc mở rộng hành vi hàm',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Gán giá trị cho biến',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Tạo class mới',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Đặt giá trị mặc định',
          1 => false,
        ),
      ),
      'explanation' => '@decorator bọc hoặc mở rộng hành vi hàm.',
    ),
    18 => 
    array (
      'q' => 'Điều kiện nào giúp mã chỉ chạy khi file được thực thi trực tiếp?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'if __name__ == "__main__"',
          1 => true,
        ),
        1 => 
        array (
          0 => 'if name == "__main__"',
          1 => false,
        ),
        2 => 
        array (
          0 => 'if __name__ == "main"',
          1 => false,
        ),
        3 => 
        array (
          0 => 'if __name__ == 1',
          1 => false,
        ),
      ),
      'explanation' => 'Điều kiện if __name__ == "__main__" giúp mã chỉ chạy khi file được thực thi trực tiếp.',
    ),
    19 => 
    array (
      'q' => 'Hai phương thức list nào thêm một phần tử và thêm nhiều phần tử?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'append()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'extend()',
          1 => true,
        ),
        2 => 
        array (
          0 => 'insert()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'pop()',
          1 => false,
        ),
      ),
      'explanation' => 'append() và extend() là hai phương thức list để thêm phần tử.',
    ),
    20 => 
    array (
      'q' => 'Hàm pandas nào đọc tệp CSV?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'read_csv()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'load_csv()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'import_csv()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'csv_read()',
          1 => false,
        ),
      ),
      'explanation' => 'Hàm read_csv() của pandas dùng để đọc tệp CSV.',
    ),
    21 => 
    array (
      'q' => 'Indexer pandas nào chọn theo nhãn?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'loc',
          1 => true,
        ),
        1 => 
        array (
          0 => 'iloc',
          1 => false,
        ),
        2 => 
        array (
          0 => 'ix',
          1 => false,
        ),
        3 => 
        array (
          0 => 'at',
          1 => false,
        ),
      ),
      'explanation' => 'loc indexer của pandas chọn theo nhãn.',
    ),
    22 => 
    array (
      'q' => 'Indexer pandas nào chọn theo vị trí số nguyên?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'iloc',
          1 => true,
        ),
        1 => 
        array (
          0 => 'loc',
          1 => false,
        ),
        2 => 
        array (
          0 => 'ix',
          1 => false,
        ),
        3 => 
        array (
          0 => 'at',
          1 => false,
        ),
      ),
      'explanation' => 'iloc indexer của pandas chọn theo vị trí số nguyên.',
    ),
    23 => 
    array (
      'q' => 'Kiểu mảng nhiều chiều chính của NumPy là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'ndarray',
          1 => true,
        ),
        1 => 
        array (
          0 => 'array',
          1 => false,
        ),
        2 => 
        array (
          0 => 'matrix',
          1 => false,
        ),
        3 => 
        array (
          0 => 'tensor',
          1 => false,
        ),
      ),
      'explanation' => 'ndarray là kiểu mảng nhiều chiều chính của NumPy.',
    ),
    24 => 
    array (
      'q' => 'Hai phương thức NumPy nào đổi hình dạng và kiểu dữ liệu?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'reshape()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'astype()',
          1 => true,
        ),
        2 => 
        array (
          0 => 'transpose()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'flatten()',
          1 => false,
        ),
      ),
      'explanation' => 'reshape() và astype() là hai phương thức NumPy để đổi hình dạng và kiểu dữ liệu.',
    ),
    25 => 
    array (
      'q' => 'Cú pháp chuỗi nào chèn biểu thức trực tiếp bằng dấu ngoặc nhọn?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'f-string',
          1 => true,
        ),
        1 => 
        array (
          0 => 'format()',
          1 => false,
        ),
        2 => 
        array (
          0 => 'template',
          1 => false,
        ),
        3 => 
        array (
          0 => 'interpolate',
          1 => false,
        ),
      ),
      'explanation' => 'f-string cho phép chèn biểu thức trực tiếp bằng dấu ngoặc nhọn.',
    ),
    26 => 
    array (
      'q' => 'Lớp nào của pathlib biểu diễn đường dẫn?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Path',
          1 => true,
        ),
        1 => 
        array (
          0 => 'File',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Directory',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Link',
          1 => false,
        ),
      ),
      'explanation' => 'Lớp Path của pathlib biểu diễn đường dẫn.',
    ),
    27 => 
    array (
      'q' => 'Từ khóa nào chủ động phát sinh ngoại lệ?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'raise',
          1 => true,
        ),
        1 => 
        array (
          0 => 'throw',
          1 => false,
        ),
        2 => 
        array (
          0 => 'error',
          1 => false,
        ),
        3 => 
        array (
          0 => 'exception',
          1 => false,
        ),
      ),
      'explanation' => 'raise từ khóa dùng để chủ động phát sinh ngoại lệ.',
    ),
    28 => 
    array (
      'q' => 'Protocol nào hỗ trợ câu lệnh with?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Trình quản lý ngữ cảnh',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Decorator',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Generator',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Iterator',
          1 => false,
        ),
      ),
      'explanation' => 'Context manager protocol hỗ trợ câu lệnh with.',
    ),
    29 => 
    array (
      'q' => 'Hai cách nào sắp xếp list tại chỗ và tạo list mới?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'list.sort()',
          1 => true,
        ),
        1 => 
        array (
          0 => 'sorted()',
          1 => true,
        ),
        2 => 
        array (
          0 => 'append()',
          1 => false,
        ),
        3 => 
        array (
          0 => 'extend()',
          1 => false,
        ),
      ),
      'explanation' => 'list.sort() và sorted() là hai cách sắp xếp list tại chỗ và tạo ra một list mới.',
    ),
  ),
  'An toàn ứng dụng Web' => 
  array (
    0 => 
    array (
      'q' => 'Biện pháp chính ngăn SQL Injection khi truy vấn dữ liệu là gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Câu lệnh chuẩn bị sẵn',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Escape toàn bộ dữ liệu người dùng',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Sử dụng truy vấn có tham số',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Lọc ký tự đặc biệt trong dữ liệu nhập',
          1 => false,
        ),
      ),
      'explanation' => 'Prepared statements and parameterized queries separate SQL code from data, preventing injection.',
    ),
    1 => 
    array (
      'q' => 'Cách phòng XSS phù hợp khi hiển thị dữ liệu người dùng là gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Mã hóa đầu ra theo ngữ cảnh',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Escape toàn bộ dữ liệu người dùng',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Chỉ sử dụng chính sách CSP',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Lọc ký tự đặc biệt trong dữ liệu nhập',
          1 => false,
        ),
      ),
      'explanation' => 'Contextual escaping ensures that any injected script is rendered as harmless text.',
    ),
    2 => 
    array (
      'q' => 'Token ngẫu nhiên gắn với phiên giúp ngăn tấn công nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'CSRF',
          1 => true,
        ),
        1 => 
        array (
          0 => 'XSS',
          1 => false,
        ),
        2 => 
        array (
          0 => 'SQL Injection',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tấn công brute-force',
          1 => false,
        ),
      ),
      'explanation' => 'CSRF tokens are used to verify the user\'s intent and prevent cross-site request forgery.',
    ),
    3 => 
    array (
      'q' => 'Cho phép sửa tài nguyên chỉ dựa vào id mà không kiểm tra chủ sở hữu là lỗi gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Lỗi kiểm soát truy cập',
          1 => true,
        ),
        1 => 
        array (
          0 => 'SQL Injection',
          1 => false,
        ),
        2 => 
        array (
          0 => 'XSS',
          1 => false,
        ),
        3 => 
        array (
          0 => 'CSRF',
          1 => false,
        ),
      ),
      'explanation' => 'Broken access control allows unauthorized users to modify resources.',
    ),
    4 => 
    array (
      'q' => 'Hai biện pháp nào tăng an toàn tài khoản khi mật khẩu bị lộ?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'MFA',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Băm mật khẩu bằng Argon2 hoặc bcrypt',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Dùng thuật toán băm yếu như MD5',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Lưu mật khẩu dạng văn bản thuần',
          1 => false,
        ),
      ),
      'explanation' => 'Multi-factor authentication and strong password hashing are essential for account security.',
    ),
    5 => 
    array (
      'q' => 'Thuộc tính cookie nào hạn chế gửi cookie trong request chéo site?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'SameSite',
          1 => true,
        ),
        1 => 
        array (
          0 => 'HttpOnly',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Secure',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Domain',
          1 => false,
        ),
      ),
      'explanation' => 'The SameSite attribute restricts cookies from being sent with cross-site requests.',
    ),
    6 => 
    array (
      'q' => 'HTTPS bảo vệ dữ liệu truyền bằng giao thức nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'TLS',
          1 => true,
        ),
        1 => 
        array (
          0 => 'SSL',
          1 => false,
        ),
        2 => 
        array (
          0 => 'SFTP',
          1 => false,
        ),
        3 => 
        array (
          0 => 'SSH',
          1 => false,
        ),
      ),
      'explanation' => 'HTTPS uses TLS to secure data in transit.',
    ),
    7 => 
    array (
      'q' => 'Header nào giới hạn nguồn script được phép chạy?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Content-Security-Policy',
          1 => true,
        ),
        1 => 
        array (
          0 => 'X-Frame-Options',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Referrer-Policy',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Strict-Transport-Security',
          1 => false,
        ),
      ),
      'explanation' => 'The Content-Security-Policy header defines which sources can be loaded.',
    ),
    8 => 
    array (
      'q' => 'Biện pháp nào ngăn session fixation sau đăng nhập?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Tạo lại session ID',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Dùng session ID cố định',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Chỉ lưu dữ liệu session trong cookie',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Gia hạn session sau khi đăng nhập',
          1 => false,
        ),
      ),
      'explanation' => 'Generating a new session ID after login prevents session fixation attacks.',
    ),
    9 => 
    array (
      'q' => 'Hai lớp bảo vệ nào cần dùng cho dữ liệu nhập và dữ liệu xuất?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Kiểm tra đầu vào',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Mã hóa đầu ra',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Dùng cùng một cách kiểm tra cho cả đầu vào và đầu ra',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Lưu dữ liệu dạng văn bản thuần',
          1 => false,
        ),
      ),
      'explanation' => 'Input validation and output encoding are crucial for preventing injection attacks.',
    ),
    10 => 
    array (
      'q' => 'OWASP Top 10 là tài liệu về điều gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Các rủi ro bảo mật ứng dụng web phổ biến',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Các thực hành tốt khi lập trình an toàn',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Danh sách ngôn ngữ lập trình',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Framework phát triển phần mềm',
          1 => false,
        ),
      ),
      'explanation' => 'OWASP Top 10 identifies the most critical security risks in web applications.',
    ),
    11 => 
    array (
      'q' => 'Nguyên tắc cấp đúng quyền tối thiểu gọi là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Đặc quyền tối thiểu',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Kiểm soát truy cập theo vai trò',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Kiểm soát truy cập tùy quyền',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Kiểm soát truy cập bắt buộc',
          1 => false,
        ),
      ),
      'explanation' => 'The principle of least privilege ensures users have only the permissions necessary for their role.',
    ),
    12 => 
    array (
      'q' => 'Thuật toán nào phù hợp để lưu mật khẩu?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Argon2id',
          1 => true,
        ),
        1 => 
        array (
          0 => 'SHA-1',
          1 => false,
        ),
        2 => 
        array (
          0 => 'MD5',
          1 => false,
        ),
        3 => 
        array (
          0 => 'BCrypt',
          1 => false,
        ),
      ),
      'explanation' => 'Argon2 is a modern password hashing function designed to be slow and memory-intensive.',
    ),
    13 => 
    array (
      'q' => 'Khóa API nên được lưu ở đâu?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Secret manager hoặc biến môi trường',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Lưu trong repository công khai',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Ghi cứng trong mã nguồn',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Dùng tệp văn bản thuần',
          1 => false,
        ),
      ),
      'explanation' => 'API keys should be stored securely, such as in secret managers or environment variables.',
    ),
    14 => 
    array (
      'q' => 'Hai header nào ép HTTPS và ngăn suy đoán MIME?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Strict-Transport-Security',
          1 => true,
        ),
        1 => 
        array (
          0 => 'X-Frame-Options',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Content-Security-Policy',
          1 => false,
        ),
        3 => 
        array (
          0 => 'X-Content-Type-Options',
          1 => true,
        ),
      ),
      'explanation' => 'Strict-Transport-Security and X-Content-Type-Options headers enforce HTTPS and prevent MIME type sniffing.',
    ),
    15 => 
    array (
      'q' => 'Cờ cookie nào ngăn JavaScript đọc cookie?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'HttpOnly',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Secure',
          1 => false,
        ),
        2 => 
        array (
          0 => 'SameSite',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Domain',
          1 => false,
        ),
      ),
      'explanation' => 'The HttpOnly flag prevents client-side scripts from accessing cookies.',
    ),
    16 => 
    array (
      'q' => 'Cờ cookie nào chỉ gửi cookie qua HTTPS?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Secure',
          1 => true,
        ),
        1 => 
        array (
          0 => 'HttpOnly',
          1 => false,
        ),
        2 => 
        array (
          0 => 'SameSite',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Domain',
          1 => false,
        ),
      ),
      'explanation' => 'The Secure flag ensures that cookies are only sent over HTTPS.',
    ),
    17 => 
    array (
      'q' => 'CORS quyết định điều gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Origin nào được phép gọi API từ trình duyệt',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Máy chủ nào được phép lưu ứng dụng',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Cách cache phản hồi từ máy chủ',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Kiểu dữ liệu nào được phép trong request',
          1 => false,
        ),
      ),
      'explanation' => 'CORS controls which origins have permission to make cross-origin requests.',
    ),
    18 => 
    array (
      'q' => 'Cơ chế nào hạn chế brute-force đăng nhập?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Giới hạn tần suất request',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Xác thực hai yếu tố',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Yêu cầu độ phức tạp mật khẩu',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Khóa tài khoản sau nhiều lần thất bại',
          1 => false,
        ),
      ),
      'explanation' => 'Rate limiting prevents attackers from making too many login attempts in a short period.',
    ),
    19 => 
    array (
      'q' => 'Hai loại log nào hữu ích phát hiện sự cố bảo mật?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Log đăng nhập thất bại',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Log thay đổi quyền',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Log truy cập của mọi người dùng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Log lỗi từ máy chủ',
          1 => false,
        ),
      ),
      'explanation' => 'Failed login attempts and privilege change logs are valuable for security incident detection.',
    ),
    20 => 
    array (
      'q' => 'SSRF lợi dụng server để làm gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Gửi request đến tài nguyên nội bộ',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Thực thi mã tùy ý trên máy chủ',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Đánh cắp session cookie của người dùng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Phát tán thư rác qua ứng dụng',
          1 => false,
        ),
      ),
      'explanation' => 'SSRF allows attackers to send requests to internal resources using the server\'s privileges.',
    ),
    21 => 
    array (
      'q' => 'Cách giảm path traversal là gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Chuẩn hóa và giới hạn đường dẫn cho phép',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Dùng một thư mục chung cho mọi tệp',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Cho phép truy cập toàn bộ đường dẫn hệ thống',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tắt chức năng tải tệp lên',
          1 => false,
        ),
      ),
      'explanation' => 'Path normalization and restricting allowed paths prevent path traversal attacks.',
    ),
    22 => 
    array (
      'q' => 'Cách an toàn nhất tránh command injection là gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Không ghép input vào lệnh shell',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Escape ký tự đặc biệt trong dữ liệu nhập',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Dùng danh sách lệnh được phép',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Lọc các lệnh shell phổ biến',
          1 => false,
        ),
      ),
      'explanation' => 'Avoiding command execution with user inputs is the best way to prevent command injection.',
    ),
    23 => 
    array (
      'q' => 'IDOR phải được ngăn bằng kiểm tra nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Ủy quyền trên từng tài nguyên',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Giới hạn tần suất request API',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Dùng chung một access token cho mọi người dùng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Dùng CAPTCHA khi gửi form',
          1 => false,
        ),
      ),
      'explanation' => 'Role-based access control ensures that only authorized users can access resources.',
    ),
    24 => 
    array (
      'q' => 'Hai phương pháp kiểm thử nào phân tích mã và ứng dụng đang chạy?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'SAST',
          1 => true,
        ),
        1 => 
        array (
          0 => 'DAST',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Review mã thủ công',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Kiểm thử xâm nhập',
          1 => false,
        ),
      ),
      'explanation' => 'Static and dynamic analysis tools examine the source code and running application for vulnerabilities.',
    ),
    25 => 
    array (
      'q' => 'Công cụ dependency scanning tìm rủi ro gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Thư viện có lỗ hổng đã biết',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Lỗ hổng trong mã ứng dụng',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Điểm nghẽn hiệu năng của ứng dụng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Lỗi cấu hình trên máy chủ',
          1 => false,
        ),
      ),
      'explanation' => 'Dependency scanning tools identify known vulnerabilities in third-party libraries.',
    ),
    26 => 
    array (
      'q' => 'Dữ liệu nhạy cảm cần mã hóa ở hai trạng thái nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Khi lưu trữ và khi truyền',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Chỉ khi lưu trong cơ sở dữ liệu',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Chỉ khi truyền qua mạng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Không bao giờ vì mã hóa có thể bị phá',
          1 => false,
        ),
      ),
      'explanation' => 'Sensitive data should be encrypted both at rest and in transit.',
    ),
    27 => 
    array (
      'q' => 'Salt trong băm mật khẩu có tác dụng gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Làm cùng mật khẩu cho kết quả băm khác nhau',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tăng tốc độ băm mật khẩu',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Giảm dung lượng lưu mật khẩu',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Làm tấn công brute-force dễ hơn',
          1 => false,
        ),
      ),
      'explanation' => 'A salt adds randomness to hashed passwords, making them unique and harder to crack.',
    ),
    28 => 
    array (
      'q' => 'Nonce hoặc IV phải có tính chất nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Không tái sử dụng với cùng khóa',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Giống nhau trong mọi lần mã hóa',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Luôn là một giá trị cố định',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Được tạo trực tiếp từ dữ liệu người dùng',
          1 => false,
        ),
      ),
      'explanation' => 'Nonces and IVs must be unique per encryption operation to prevent reuse attacks.',
    ),
    29 => 
    array (
      'q' => 'Hai bước đầu tiên khi phát hiện xâm nhập là gì?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Cô lập ảnh hưởng',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Bảo toàn bằng chứng',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Sửa lỗ hổng ngay lập tức',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Thông báo ngay cho mọi người dùng về nguy cơ',
          1 => false,
        ),
      ),
      'explanation' => 'Isolating the affected area and preserving evidence are critical first steps in incident response.',
    ),
  ),
  'Mạng máy tính căn bản' => 
  array (
    0 => 
    array (
      'q' => 'Lớp nào của mô hình OSI chịu trách nhiệm định tuyến?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Network',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Session',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Presentation',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Transport',
          1 => false,
        ),
      ),
      'explanation' => 'Định tuyến là trách nhiệm của lớp Network trong OSI.',
    ),
    1 => 
    array (
      'q' => 'Giao thức nào ở tầng vận chuyển cung cấp truyền tin tin cậy?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'UDP',
          1 => false,
        ),
        1 => 
        array (
          0 => 'TCP',
          1 => true,
        ),
        2 => 
        array (
          0 => 'ICMP',
          1 => false,
        ),
        3 => 
        array (
          0 => 'ARP',
          1 => false,
        ),
      ),
      'explanation' => 'TCP là giao thức vận chuyển cung cấp truyền tin tin cậy.',
    ),
    2 => 
    array (
      'q' => 'Địa chỉ MAC hoạt động chủ yếu ở tầng nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Data Link',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Network',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Transport',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Session',
          1 => false,
        ),
      ),
      'explanation' => 'MAC address hoạt động chủ yếu ở tầng Data Link của OSI.',
    ),
    3 => 
    array (
      'q' => 'Địa chỉ IPv4 có bao nhiêu bit?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => '128 bit',
          1 => false,
        ),
        1 => 
        array (
          0 => '32 bit',
          1 => true,
        ),
        2 => 
        array (
          0 => '64 bit',
          1 => false,
        ),
        3 => 
        array (
          0 => '96 bit',
          1 => false,
        ),
      ),
      'explanation' => 'Địa chỉ IPv4 có 32 bit.',
    ),
    4 => 
    array (
      'q' => 'Hai giao thức nào lần lượt phân giải tên miền và cấp cấu hình IP tự động?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'DHCP',
          1 => true,
        ),
        1 => 
        array (
          0 => 'DNS',
          1 => true,
        ),
        2 => 
        array (
          0 => 'SMTP',
          1 => false,
        ),
        3 => 
        array (
          0 => 'FTP',
          1 => false,
        ),
      ),
      'explanation' => 'DNS phân giải tên miền, DHCP cấp cấu hình IP tự động.',
    ),
    5 => 
    array (
      'q' => 'Địa chỉ IPv6 có bao nhiêu bit?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => '128 bit',
          1 => true,
        ),
        1 => 
        array (
          0 => '96 bit',
          1 => false,
        ),
        2 => 
        array (
          0 => '64 bit',
          1 => false,
        ),
        3 => 
        array (
          0 => '32 bit',
          1 => false,
        ),
      ),
      'explanation' => 'Địa chỉ IPv6 có 128 bit.',
    ),
    6 => 
    array (
      'q' => 'Mạng /24 có tổng cộng bao nhiêu địa chỉ IPv4?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => '256',
          1 => true,
        ),
        1 => 
        array (
          0 => '128',
          1 => false,
        ),
        2 => 
        array (
          0 => '512',
          1 => false,
        ),
        3 => 
        array (
          0 => '1024',
          1 => false,
        ),
      ),
      'explanation' => '/24 trong CIDR biểu thị 24 bit mạng, còn lại là 8 bit cho địa chỉ host.',
    ),
    7 => 
    array (
      'q' => 'Giao thức nào ánh xạ IPv4 sang địa chỉ MAC trong LAN?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'ICMP',
          1 => false,
        ),
        1 => 
        array (
          0 => 'ARP',
          1 => true,
        ),
        2 => 
        array (
          0 => 'RARP',
          1 => false,
        ),
        3 => 
        array (
          0 => 'DNS',
          1 => false,
        ),
      ),
      'explanation' => 'ARP ánh xạ IPv4 sang địa chỉ MAC trong LAN.',
    ),
    8 => 
    array (
      'q' => 'NAT thường dùng để làm gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Chia sẻ địa chỉ IP công cộng',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tăng tốc truyền tải dữ liệu',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Giảm tiêu thụ bộ nhớ',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tăng cường bảo mật',
          1 => false,
        ),
      ),
      'explanation' => 'NAT dùng để chia sẻ địa chỉ IP công cộng.',
    ),
    9 => 
    array (
      'q' => 'Hai gói đầu tiên của bắt tay TCP ba bước là gì?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'SYN',
          1 => true,
        ),
        1 => 
        array (
          0 => 'ACK',
          1 => false,
        ),
        2 => 
        array (
          0 => 'FIN',
          1 => false,
        ),
        3 => 
        array (
          0 => 'SYN-ACK',
          1 => true,
        ),
      ),
      'explanation' => 'Hai gói đầu tiên của TCP là SYN và SYN-ACK.',
    ),
    10 => 
    array (
      'q' => 'Cổng mặc định của HTTPS là bao nhiêu?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '443',
          1 => true,
        ),
        1 => 
        array (
          0 => '80',
          1 => false,
        ),
        2 => 
        array (
          0 => '21',
          1 => false,
        ),
        3 => 
        array (
          0 => '25',
          1 => false,
        ),
      ),
      'explanation' => 'Cổng mặc định của HTTPS là 443.',
    ),
    11 => 
    array (
      'q' => 'Thiết bị nào chuyển frame dựa trên bảng MAC?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Switch',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Router',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Hub',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Modem',
          1 => false,
        ),
      ),
      'explanation' => 'Switch chuyển frame dựa trên bảng MAC.',
    ),
    12 => 
    array (
      'q' => 'Thiết bị nào chuyển packet giữa các mạng IP?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Router',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Switch',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Hub',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Bridge',
          1 => false,
        ),
      ),
      'explanation' => 'Router chuyển packet giữa các mạng IP.',
    ),
    13 => 
    array (
      'q' => 'Lệnh ping chủ yếu dùng giao thức nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'ICMP',
          1 => true,
        ),
        1 => 
        array (
          0 => 'TCP',
          1 => false,
        ),
        2 => 
        array (
          0 => 'UDP',
          1 => false,
        ),
        3 => 
        array (
          0 => 'DNS',
          1 => false,
        ),
      ),
      'explanation' => 'Ping sử dụng ICMP để kiểm tra kết nối.',
    ),
    14 => 
    array (
      'q' => 'Hai trường nào giúp định danh một socket mạng?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Địa chỉ IP',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tên miền',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Số cổng',
          1 => true,
        ),
        3 => 
        array (
          0 => 'Địa chỉ MAC',
          1 => false,
        ),
      ),
      'explanation' => 'Hai trường giúp định danh một socket mạng là địa chỉ IP và số cổng.',
    ),
    15 => 
    array (
      'q' => 'TTL ngăn vấn đề gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Packet lặp vô hạn',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Chuyển mạch sai',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Bảo mật',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Giao tiếp lỗi',
          1 => false,
        ),
      ),
      'explanation' => 'TTL ngăn packet lặp vô hạn.',
    ),
    16 => 
    array (
      'q' => 'Default gateway được dùng khi nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Khi đích nằm ngoài mạng cục bộ',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Khi đích nằm trong mạng cục bộ',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Khi không có địa chỉ IP',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Khi không cần kết nối Internet',
          1 => false,
        ),
      ),
      'explanation' => 'Default gateway được dùng khi đích nằm ngoài mạng cục bộ.',
    ),
    17 => 
    array (
      'q' => 'CIDR /16 biểu thị bao nhiêu bit mạng?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => '16',
          1 => true,
        ),
        1 => 
        array (
          0 => '8',
          1 => false,
        ),
        2 => 
        array (
          0 => '24',
          1 => false,
        ),
        3 => 
        array (
          0 => '32',
          1 => false,
        ),
      ),
      'explanation' => 'CIDR /16 biểu thị 16 bit mạng.',
    ),
    18 => 
    array (
      'q' => 'Dải 10.0.0.0/8 thuộc loại địa chỉ nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'IPv4 riêng',
          1 => true,
        ),
        1 => 
        array (
          0 => 'IPv4 công cộng',
          1 => false,
        ),
        2 => 
        array (
          0 => 'IPv6 riêng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'IPv6 công cộng',
          1 => false,
        ),
      ),
      'explanation' => 'Dải 10.0.0.0/8 thuộc loại địa chỉ IPv4 riêng.',
    ),
    19 => 
    array (
      'q' => 'Hai đặc tính nào thuộc TCP?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Có kết nối',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Bảo đảm thứ tự',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Tích hợp ứng dụng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Độc lập giao thức',
          1 => false,
        ),
      ),
      'explanation' => 'TCP có hai đặc tính là có kết nối và bảo đảm thứ tự.',
    ),
    20 => 
    array (
      'q' => 'UDP phù hợp cho ứng dụng nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Ứng dụng ưu tiên độ trễ thấp',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Ứng dụng cần truyền tin cậy',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Ứng dụng yêu cầu kết nối',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Ứng dụng cần bảo mật',
          1 => false,
        ),
      ),
      'explanation' => 'UDP phù hợp cho ứng dụng ưu tiên độ trễ thấp.',
    ),
    21 => 
    array (
      'q' => 'VLAN dùng để làm gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Phân đoạn logic một mạng chuyển mạch',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tăng tốc truyền tải dữ liệu',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Giảm tiêu thụ điện năng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Bảo mật vật lý',
          1 => false,
        ),
      ),
      'explanation' => 'VLAN dùng để phân đoạn logic một mạng chuyển mạch.',
    ),
    22 => 
    array (
      'q' => 'STP ngăn hiện tượng nào trong mạng switch?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Vòng lặp lớp 2',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tốc độ truyền tải thấp',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Bảo mật',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Chuyển mạch sai',
          1 => false,
        ),
      ),
      'explanation' => 'STP ngăn vòng lặp lớp 2 trong mạng switch.',
    ),
    23 => 
    array (
      'q' => 'Chuẩn bảo mật Wi-Fi hiện đại nên ưu tiên là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'WPA3',
          1 => true,
        ),
        1 => 
        array (
          0 => 'WPA2',
          1 => false,
        ),
        2 => 
        array (
          0 => 'WEP',
          1 => false,
        ),
        3 => 
        array (
          0 => 'IEEE 802.1X',
          1 => false,
        ),
      ),
      'explanation' => 'Chuẩn bảo mật Wi-Fi hiện đại nên ưu tiên là WPA3.',
    ),
    24 => 
    array (
      'q' => 'Hai đại lượng nào lần lượt mô tả dung lượng và độ trễ đường truyền?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Bandwidth',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Latency',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Throughput',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Jitter',
          1 => false,
        ),
      ),
      'explanation' => 'Dung lượng và độ trễ đường truyền được mô tả bởi Bandwidth và Latency.',
    ),
    25 => 
    array (
      'q' => 'Bản ghi DNS nào ánh xạ tên miền sang IPv4?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'A',
          1 => true,
        ),
        1 => 
        array (
          0 => 'AAAA',
          1 => false,
        ),
        2 => 
        array (
          0 => 'PTR',
          1 => false,
        ),
        3 => 
        array (
          0 => 'MX',
          1 => false,
        ),
      ),
      'explanation' => 'Bản ghi DNS A ánh xạ tên miền sang IPv4.',
    ),
    26 => 
    array (
      'q' => 'Bản ghi DNS nào ánh xạ tên miền sang IPv6?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'AAAA',
          1 => true,
        ),
        1 => 
        array (
          0 => 'A',
          1 => false,
        ),
        2 => 
        array (
          0 => 'PTR',
          1 => false,
        ),
        3 => 
        array (
          0 => 'CNAME',
          1 => false,
        ),
      ),
      'explanation' => 'Bản ghi DNS AAAA ánh xạ tên miền sang IPv6.',
    ),
    27 => 
    array (
      'q' => 'Traceroute xác định đường đi bằng cách thay đổi trường nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'TTL',
          1 => true,
        ),
        1 => 
        array (
          0 => 'IP',
          1 => false,
        ),
        2 => 
        array (
          0 => 'MAC',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Port',
          1 => false,
        ),
      ),
      'explanation' => 'Traceroute xác định đường đi bằng cách thay đổi trường TTL.',
    ),
    28 => 
    array (
      'q' => 'Firewall lọc traffic dựa trên điều gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Quy tắc địa chỉ, cổng và giao thức',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Mã nguồn',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Dữ liệu ứng dụng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Thời gian kết nối',
          1 => false,
        ),
      ),
      'explanation' => 'Firewall lọc traffic dựa trên quy tắc địa chỉ, cổng và giao thức.',
    ),
    29 => 
    array (
      'q' => 'Hai bước đầu trong quy trình DHCP DORA là gì?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Discover',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Offer',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Request',
          1 => false,
        ),
        3 => 
        array (
          0 => 'ACK',
          1 => false,
        ),
      ),
      'explanation' => 'Hai bước đầu trong quy trình DHCP DORA là Discover và Offer.',
    ),
  ),
  'Docker cho lập trình viên' => 
  array (
    0 => 
    array (
      'q' => 'Docker image khác container ở điểm nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Image là instance đang chạy, container là mẫu bất biến',
          1 => false,
        ),
        1 => 
        array (
          0 => 'Image và container đều là instance đang chạy',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Image là mẫu bất biến, container là instance đang chạy',
          1 => true,
        ),
        3 => 
        array (
          0 => 'Image và container đều là mẫu bất biến',
          1 => false,
        ),
      ),
      'explanation' => 'Container là phiên bản chạy của image, trong khi image là mẫu bất biến.',
    ),
    1 => 
    array (
      'q' => 'Chỉ thị Dockerfile nào chọn image nền?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'FROM',
          1 => true,
        ),
        1 => 
        array (
          0 => 'RUN',
          1 => false,
        ),
        2 => 
        array (
          0 => 'COPY',
          1 => false,
        ),
        3 => 
        array (
          0 => 'WORKDIR',
          1 => false,
        ),
      ),
      'explanation' => 'FROM chỉ định base image cho image mới được xây dựng.',
    ),
    2 => 
    array (
      'q' => 'Chỉ thị nào chạy lệnh trong quá trình build image?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'RUN',
          1 => true,
        ),
        1 => 
        array (
          0 => 'CMD',
          1 => false,
        ),
        2 => 
        array (
          0 => 'ENTRYPOINT',
          1 => false,
        ),
        3 => 
        array (
          0 => 'EXPOSE',
          1 => false,
        ),
      ),
      'explanation' => 'RUN thực thi các lệnh vào image đang được xây dựng.',
    ),
    3 => 
    array (
      'q' => 'Chỉ thị nào đặt thư mục làm việc trong image?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'WORKDIR',
          1 => true,
        ),
        1 => 
        array (
          0 => 'VOLUME',
          1 => false,
        ),
        2 => 
        array (
          0 => 'USER',
          1 => false,
        ),
        3 => 
        array (
          0 => 'ENV',
          1 => false,
        ),
      ),
      'explanation' => 'WORKDIR thiết lập thư mục làm việc cho container.',
    ),
    4 => 
    array (
      'q' => 'Hai chỉ thị nào cấu hình lệnh mặc định và executable chính của container?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'CMD',
          1 => true,
        ),
        1 => 
        array (
          0 => 'ENTRYPOINT',
          1 => true,
        ),
        2 => 
        array (
          0 => 'RUN',
          1 => false,
        ),
        3 => 
        array (
          0 => 'FROM',
          1 => false,
        ),
      ),
      'explanation' => 'CMD và ENTRYPOINT xác định cách chạy container.',
    ),
    5 => 
    array (
      'q' => 'Chỉ thị nào sao chép file từ build context vào image?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'COPY',
          1 => true,
        ),
        1 => 
        array (
          0 => 'ADD',
          1 => false,
        ),
        2 => 
        array (
          0 => 'VOLUME',
          1 => false,
        ),
        3 => 
        array (
          0 => 'USER',
          1 => false,
        ),
      ),
      'explanation' => 'COPY sao chép tệp và thư mục từ build context vào image.',
    ),
    6 => 
    array (
      'q' => 'EXPOSE có tự publish cổng ra host không?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Không',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Có',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Tự động',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Được cấu hình',
          1 => false,
        ),
      ),
      'explanation' => 'EXPOSE chỉ định các cổng cần mở nhưng không tự publish.',
    ),
    7 => 
    array (
      'q' => 'Cơ chế nào lưu dữ liệu bền vững do Docker quản lý?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Named volume',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Bind mount',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Tmpfs',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Anonymous volume',
          1 => false,
        ),
      ),
      'explanation' => 'Named volumes cung cấp cách lưu trữ dữ liệu bền vững.',
    ),
    8 => 
    array (
      'q' => 'Bind mount ánh xạ gì vào container?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Đường dẫn cụ thể trên host',
          1 => true,
        ),
        1 => 
        array (
          0 => 'File riêng lẻ',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Image',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Layer',
          1 => false,
        ),
      ),
      'explanation' => 'Bind mounts liên kết thư mục hoặc file từ hệ thống tệp của máy chủ vào container.',
    ),
    9 => 
    array (
      'q' => 'Hai lệnh nào tạo image và chạy container?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'docker build',
          1 => true,
        ),
        1 => 
        array (
          0 => 'docker run',
          1 => true,
        ),
        2 => 
        array (
          0 => 'docker push',
          1 => false,
        ),
        3 => 
        array (
          0 => 'docker pull',
          1 => false,
        ),
      ),
      'explanation' => 'docker build tạo image, docker run chạy container.',
    ),
    10 => 
    array (
      'q' => 'Tùy chọn docker run nào ánh xạ cổng host sang container?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '-p',
          1 => true,
        ),
        1 => 
        array (
          0 => '--publish',
          1 => false,
        ),
        2 => 
        array (
          0 => '-v',
          1 => false,
        ),
        3 => 
        array (
          0 => '-e',
          1 => false,
        ),
      ),
      'explanation' => '-p hoặc --publish dùng để ánh xạ cổng.',
    ),
    11 => 
    array (
      'q' => 'Lệnh nào liệt kê container đang chạy?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'docker ps',
          1 => true,
        ),
        1 => 
        array (
          0 => 'docker images',
          1 => false,
        ),
        2 => 
        array (
          0 => 'docker inspect',
          1 => false,
        ),
        3 => 
        array (
          0 => 'docker logs',
          1 => false,
        ),
      ),
      'explanation' => 'docker ps hiển thị danh sách các container đang hoạt động.',
    ),
    12 => 
    array (
      'q' => 'Lệnh nào xem đầu ra của container?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'docker logs',
          1 => true,
        ),
        1 => 
        array (
          0 => 'docker exec',
          1 => false,
        ),
        2 => 
        array (
          0 => 'docker stop',
          1 => false,
        ),
        3 => 
        array (
          0 => 'docker rm',
          1 => false,
        ),
      ),
      'explanation' => 'docker logs hiển thị log và output từ container.',
    ),
    13 => 
    array (
      'q' => 'Lệnh nào chạy shell bên trong container đang hoạt động?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'docker exec',
          1 => true,
        ),
        1 => 
        array (
          0 => 'docker run',
          1 => false,
        ),
        2 => 
        array (
          0 => 'docker attach',
          1 => false,
        ),
        3 => 
        array (
          0 => 'docker exec -it',
          1 => false,
        ),
      ),
      'explanation' => 'docker exec -it mở một shell vào container.',
    ),
    14 => 
    array (
      'q' => 'Hai lệnh nào dừng và xóa container?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'docker stop',
          1 => true,
        ),
        1 => 
        array (
          0 => 'docker rm',
          1 => true,
        ),
        2 => 
        array (
          0 => 'docker run',
          1 => false,
        ),
        3 => 
        array (
          0 => 'docker build',
          1 => false,
        ),
      ),
      'explanation' => 'docker stop dừng container, docker rm xóa container.',
    ),
    15 => 
    array (
      'q' => 'Layer cache giúp cải thiện điều gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Tốc độ build lại image',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Kích thước image',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Hiệu suất chạy container',
          1 => false,
        ),
        3 => 
        array (
          0 => 'An ninh của container',
          1 => false,
        ),
      ),
      'explanation' => 'Layer cache giúp nhanh chóng tái sử dụng các lớp đã xây dựng.',
    ),
    16 => 
    array (
      'q' => 'Tệp nào loại trừ file khỏi build context?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '.dockerignore',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Dockerfile',
          1 => false,
        ),
        2 => 
        array (
          0 => 'docker-compose.yml',
          1 => false,
        ),
        3 => 
        array (
          0 => 'compose.yaml',
          1 => false,
        ),
      ),
      'explanation' => '.dockerignore xác định các tệp cần loại trừ.',
    ),
    17 => 
    array (
      'q' => 'Multi-stage build giúp giảm điều gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Kích thước image cuối',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Thời gian xây dựng',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Số lượng layer',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tốc độ chạy container',
          1 => false,
        ),
      ),
      'explanation' => 'Multi-stage build giảm kích thước final image.',
    ),
    18 => 
    array (
      'q' => 'Docker Compose mô tả ứng dụng nhiều dịch vụ trong file nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'compose.yaml',
          1 => true,
        ),
        1 => 
        array (
          0 => 'docker-compose.yml',
          1 => false,
        ),
        2 => 
        array (
          0 => 'dockerfile',
          1 => false,
        ),
        3 => 
        array (
          0 => 'docker-compose.json',
          1 => false,
        ),
      ),
      'explanation' => 'compose.yaml hoặc docker-compose.yml chứa cấu hình cho các dịch vụ.',
    ),
    19 => 
    array (
      'q' => 'Hai lệnh nào khởi động nền và dừng stack Compose?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'docker compose up -d',
          1 => true,
        ),
        1 => 
        array (
          0 => 'docker compose down',
          1 => true,
        ),
        2 => 
        array (
          0 => 'docker run',
          1 => false,
        ),
        3 => 
        array (
          0 => 'docker build',
          1 => false,
        ),
      ),
      'explanation' => 'docker compose up -d khởi chạy, docker compose down dừng.',
    ),
    20 => 
    array (
      'q' => 'Healthcheck dùng để đánh giá điều gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Trạng thái sẵn sàng của tiến trình trong container',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tốc độ xử lý',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Thời gian hoạt động',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Kích thước image',
          1 => false,
        ),
      ),
      'explanation' => 'Healthcheck kiểm tra trạng thái hoạt động của dịch vụ.',
    ),
    21 => 
    array (
      'q' => 'depends_on có bảo đảm ứng dụng phụ thuộc đã sẵn sàng không?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Không',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Có',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Tự động',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Được cấu hình',
          1 => false,
        ),
      ),
      'explanation' => 'depends_on chỉ định thứ tự khởi chạy nhưng không kiểm tra trạng thái.',
    ),
    22 => 
    array (
      'q' => 'Registry dùng để làm gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Lưu trữ và phân phối image',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tạo image mới',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Xây dựng image',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Khởi động container',
          1 => false,
        ),
      ),
      'explanation' => 'Registry lưu trữ và chia sẻ images.',
    ),
    23 => 
    array (
      'q' => 'Lệnh nào tải image từ registry?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'docker pull',
          1 => true,
        ),
        1 => 
        array (
          0 => 'docker push',
          1 => false,
        ),
        2 => 
        array (
          0 => 'docker build',
          1 => false,
        ),
        3 => 
        array (
          0 => 'docker run',
          1 => false,
        ),
      ),
      'explanation' => 'docker pull tải image từ registry.',
    ),
    24 => 
    array (
      'q' => 'Hai thao tác nào cần trước khi đưa image có tên phiên bản lên registry?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'docker tag',
          1 => true,
        ),
        1 => 
        array (
          0 => 'docker push',
          1 => true,
        ),
        2 => 
        array (
          0 => 'docker build',
          1 => false,
        ),
        3 => 
        array (
          0 => 'docker run',
          1 => false,
        ),
      ),
      'explanation' => 'docker tag và docker push cần thiết để đăng ký.',
    ),
    25 => 
    array (
      'q' => 'Container bị xóa thì dữ liệu trong writable layer ra sao?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Bị mất',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Lưu lại',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Tự động lưu',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Được bảo vệ',
          1 => false,
        ),
      ),
      'explanation' => 'Dữ liệu trong writable layer sẽ bị xóa khi container bị xóa.',
    ),
    26 => 
    array (
      'q' => 'Các service cùng mạng Compose gọi nhau bằng gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Tên service',
          1 => true,
        ),
        1 => 
        array (
          0 => 'IP address',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Port number',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Volume name',
          1 => false,
        ),
      ),
      'explanation' => 'Tên service được sử dụng để giao tiếp giữa các dịch vụ trong cùng một mạng.',
    ),
    27 => 
    array (
      'q' => 'Cách giảm quyền của tiến trình trong container là gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Chạy bằng user không phải root',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Sử dụng SELinux',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Tạo layer riêng biệt',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Đặt quyền trong Dockerfile',
          1 => false,
        ),
      ),
      'explanation' => 'Chạy container với một user khác root để giảm quyền.',
    ),
    28 => 
    array (
      'q' => 'Tùy chọn nào tự xóa container sau khi tiến trình kết thúc?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => '--rm',
          1 => true,
        ),
        1 => 
        array (
          0 => '-r',
          1 => false,
        ),
        2 => 
        array (
          0 => '--remove',
          1 => false,
        ),
        3 => 
        array (
          0 => '--delete',
          1 => false,
        ),
      ),
      'explanation' => '--rm sẽ tự động xóa container sau khi tiến trình kết thúc.',
    ),
    29 => 
    array (
      'q' => 'Hai lệnh nào xem cấu hình chi tiết và tài nguyên container?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'docker inspect',
          1 => true,
        ),
        1 => 
        array (
          0 => 'docker stats',
          1 => true,
        ),
        2 => 
        array (
          0 => 'docker ps',
          1 => false,
        ),
        3 => 
        array (
          0 => 'docker logs',
          1 => false,
        ),
      ),
      'explanation' => 'docker inspect và docker stats cung cấp thông tin chi tiết về container.',
    ),
  ),
  'Kiểm thử phần mềm thực chiến' => 
  array (
    0 => 
    array (
      'q' => 'Kiểm thử một hàm hoặc lớp độc lập gọi là gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Unit testing',
          1 => true,
        ),
        1 => 
        array (
          0 => 'System testing',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Integration testing',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Functional testing',
          1 => false,
        ),
      ),
      'explanation' => 'Để kiểm thử độc lập, ta chỉ tập trung vào chức năng của hàm hoặc lớp mà không quan tâm đến các thành phần khác.',
    ),
    1 => 
    array (
      'q' => 'Kiểm thử tương tác giữa các module gọi là gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Integration testing',
          1 => true,
        ),
        1 => 
        array (
          0 => 'System testing',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Unit testing',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Acceptance testing',
          1 => false,
        ),
      ),
      'explanation' => 'Kiểm thử tương tác giữa các module nhằm đảm bảo chúng hoạt động đúng khi kết hợp với nhau.',
    ),
    2 => 
    array (
      'q' => 'Kiểm thử toàn bộ hệ thống theo yêu cầu gọi là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'System testing',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Acceptance testing',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Kiểm thử hiệu năng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Kiểm thử bảo mật',
          1 => false,
        ),
      ),
      'explanation' => 'Kiểm thử toàn bộ hệ thống theo yêu cầu đảm bảo rằng hệ thống đáp ứng đúng các yêu cầu đã đề ra.',
    ),
    3 => 
    array (
      'q' => 'UAT thường do nhóm nào thực hiện?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Người dùng hoặc đại diện nghiệp vụ',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Nhóm phát triển',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Nhóm quản lý dự án',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Nhóm kiểm thử',
          1 => false,
        ),
      ),
      'explanation' => 'UAT (User Acceptance Testing) thường do người dùng hoặc đại diện nghiệp vụ thực hiện để đảm bảo hệ thống đáp ứng đúng yêu cầu của họ.',
    ),
    4 => 
    array (
      'q' => 'Hai thành phần bắt buộc để test case có thể xác nhận kết quả?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Dữ liệu đầu vào',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Kết quả mong đợi',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Thời gian chạy',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Hàm được gọi',
          1 => false,
        ),
      ),
      'explanation' => 'Để xác nhận kết quả, test case cần có dữ liệu đầu vào và kết quả mong đợi.',
    ),
    5 => 
    array (
      'q' => 'Kỹ thuật chia dữ liệu thành các nhóm hành vi tương đương là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Phân vùng tương đương',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Bounded context',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Domain-driven design',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Behavior-driven development',
          1 => false,
        ),
      ),
      'explanation' => 'Phân vùng tương đương là kỹ thuật chia dữ liệu thành các nhóm hành vi tương đương để tối ưu hóa quá trình kiểm thử.',
    ),
    6 => 
    array (
      'q' => 'Kiểm thử tại min, max và ngay sát chúng gọi là gì?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Phân tích giá trị biên',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Boundary value analysis',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Equivalence partitioning',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Stress testing',
          1 => false,
        ),
      ),
      'explanation' => 'Kiểm thử tại min, max và ngay sát chúng nhằm đảm bảo các trường hợp giới hạn được xử lý đúng.',
    ),
    7 => 
    array (
      'q' => 'Kiểm thử không biết cấu trúc mã gọi là gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Black-box testing',
          1 => true,
        ),
        1 => 
        array (
          0 => 'White-box testing',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Gray-box testing',
          1 => false,
        ),
        3 => 
        array (
          0 => 'System testing',
          1 => false,
        ),
      ),
      'explanation' => 'Kiểm thử không biết cấu trúc mã (black-box) tập trung vào chức năng của hệ thống, không quan tâm đến nội bộ.',
    ),
    8 => 
    array (
      'q' => 'Kiểm thử dựa trên nhánh và câu lệnh mã gọi là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'White-box testing',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Black-box testing',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Integration testing',
          1 => false,
        ),
        3 => 
        array (
          0 => 'System testing',
          1 => false,
        ),
      ),
      'explanation' => 'Kiểm thử dựa trên nhánh và câu lệnh mã (white-box) tập trung vào cấu trúc và logic của mã nguồn.',
    ),
    9 => 
    array (
      'q' => 'Hai loại kiểm thử nhanh nào xác nhận build dùng được và thay đổi nhỏ ổn định?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Smoke testing',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Sanity testing',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Regression testing',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Kiểm thử hiệu năng',
          1 => false,
        ),
      ),
      'explanation' => 'Smoke testing và Sanity testing xác nhận build dùng được và thay đổi nhỏ ổn định.',
    ),
    10 => 
    array (
      'q' => 'Mục đích của regression testing là gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Phát hiện chức năng cũ bị hỏng sau thay đổi',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Kiểm thử toàn bộ hệ thống',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Kiểm thử tương tác giữa các module',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Kiểm thử giao diện người dùng',
          1 => false,
        ),
      ),
      'explanation' => 'Regression testing nhằm phát hiện chức năng cũ bị hỏng sau khi có thay đổi trong mã nguồn.',
    ),
    11 => 
    array (
      'q' => 'Chu trình TDD đúng là gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Red - Green - Refactor',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Green - Red - Refactor',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Refactor - Red - Green',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Red - Refactor - Green',
          1 => false,
        ),
      ),
      'explanation' => 'Chu trình TDD (Test-Driven Development) bao gồm ba bước: Red, Green, và Refactor.',
    ),
    12 => 
    array (
      'q' => 'Mock khác stub ở điểm chính nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Mock còn xác minh tương tác',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Stub cung cấp dữ liệu giả',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Mock và stub đều là đối tượng thay thế',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Stub không thể kiểm tra hành vi',
          1 => false,
        ),
      ),
      'explanation' => 'Mock khác stub ở điểm chính là mock có khả năng xác minh tương tác, trong khi stub chỉ cung cấp dữ liệu giả.',
    ),
    13 => 
    array (
      'q' => 'Code coverage cao có đảm bảo không còn lỗi không?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Không',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Có',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Tùy thuộc vào loại kiểm thử',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Đảm bảo nếu code coverage đạt 100%',
          1 => false,
        ),
      ),
      'explanation' => 'Code coverage cao không đảm bảo rằng không còn lỗi, vì nó chỉ đo lường phần mã được kiểm thử.',
    ),
    14 => 
    array (
      'q' => 'Hai thuộc tính nào phân biệt mức ảnh hưởng và mức khẩn cấp của lỗi?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Severity',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Priority',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Độ bao phủ mã',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Test case count',
          1 => false,
        ),
      ),
      'explanation' => 'Severity và Priority là hai thuộc tính phân biệt mức ảnh hưởng và mức khẩn cấp của lỗi.',
    ),
    15 => 
    array (
      'q' => 'Flaky test là test như thế nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Kết quả không ổn định dù mã không đổi',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Luôn thất bại',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Luôn thành công',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Không thể tái tạo lỗi',
          1 => false,
        ),
      ),
      'explanation' => 'Flaky test là những test có kết quả không ổn định, thường xảy ra do các yếu tố ngẫu nhiên.',
    ),
    16 => 
    array (
      'q' => 'Exploratory testing kết hợp hoạt động nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Học, thiết kế và thực thi kiểm thử',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Định nghĩa yêu cầu',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Kiểm thử tích cực',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Kiểm thử tiêu cực',
          1 => false,
        ),
      ),
      'explanation' => 'Exploratory testing kết hợp hoạt động học, thiết kế và thực thi kiểm thử.',
    ),
    17 => 
    array (
      'q' => 'Load testing đánh giá điều gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Hệ thống dưới tải kỳ vọng',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Hiệu suất hệ thống',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Tính ổn định của hệ thống',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tốc độ phản hồi',
          1 => false,
        ),
      ),
      'explanation' => 'Load testing đánh giá hiệu năng và khả năng xử lý tải lớn của hệ thống.',
    ),
    18 => 
    array (
      'q' => 'Stress testing đẩy hệ thống tới đâu?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Vượt quá giới hạn vận hành',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Đạt mức tối đa khả năng xử lý',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Xác định điểm giới hạn',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Kiểm tra độ ổn định',
          1 => false,
        ),
      ),
      'explanation' => 'Stress testing đẩy hệ thống vượt quá giới hạn vận hành để xác định điểm giới hạn của nó.',
    ),
    19 => 
    array (
      'q' => 'Hai công cụ thay thế dependency thật trong unit test là gì?',
      'type' => 'multiple',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Mock',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Stub',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Faker',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Factory Girl',
          1 => false,
        ),
      ),
      'explanation' => 'Mock và Stub là hai công cụ thay thế dependency thật trong unit test.',
    ),
    20 => 
    array (
      'q' => 'CI nên chạy test tự động khi nào?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Mỗi thay đổi được đẩy lên repository',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Sau mỗi phiên làm việc',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Hàng ngày vào giờ cố định',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Khi quản lý dự án yêu cầu',
          1 => false,
        ),
      ),
      'explanation' => 'CI (Continuous Integration) nên chạy test tự động mỗi khi có thay đổi được đẩy lên repository.',
    ),
    21 => 
    array (
      'q' => 'Test pyramid đề xuất nhiều nhất loại test nào?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Unit test',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Integration test',
          1 => false,
        ),
        2 => 
        array (
          0 => 'System test',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Acceptance test',
          1 => false,
        ),
      ),
      'explanation' => 'Test pyramid đề xuất nhiều nhất unit tests, sau đó là integration tests và cuối cùng là system tests.',
    ),
    22 => 
    array (
      'q' => 'Mẫu Arrange-Act-Assert giúp cấu trúc điều gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Một test case tự động',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Hàm được kiểm thử',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Kiểm thử tích cực',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Kiểm thử tiêu cực',
          1 => false,
        ),
      ),
      'explanation' => 'Mẫu Arrange-Act-Assert giúp cấu trúc một test case tự động.',
    ),
    23 => 
    array (
      'q' => 'Mutation testing đánh giá điều gì?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Khả năng test phát hiện thay đổi sai trong mã',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Tốc độ của test',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Độ chính xác của test',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Hiệu suất hệ thống',
          1 => false,
        ),
      ),
      'explanation' => 'Mutation testing đánh giá khả năng của các test để phát hiện thay đổi sai trong mã.',
    ),
    24 => 
    array (
      'q' => 'Hai loại test nào xác minh giao tiếp API và luồng người dùng toàn hệ thống?',
      'type' => 'multiple',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Contract test',
          1 => true,
        ),
        1 => 
        array (
          0 => 'End-to-end test',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Kiểm thử hiệu năng',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Kiểm thử bảo mật',
          1 => false,
        ),
      ),
      'explanation' => 'Contract test và End-to-end test xác minh giao tiếp API và luồng người dùng toàn hệ thống.',
    ),
    25 => 
    array (
      'q' => 'Negative testing dùng dữ liệu như thế nào?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Dữ liệu không hợp lệ hoặc tình huống lỗi',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Dữ liệu hợp lệ',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Dữ liệu mẫu',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Dữ liệu thực tế',
          1 => false,
        ),
      ),
      'explanation' => 'Negative testing sử dụng dữ liệu không hợp lệ hoặc tình huống lỗi để kiểm thử.',
    ),
    26 => 
    array (
      'q' => 'Static testing có chạy chương trình không?',
      'type' => 'single',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Không',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Có',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Tùy thuộc vào ngôn ngữ lập trình',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Tùy thuộc vào công cụ',
          1 => false,
        ),
      ),
      'explanation' => 'Static testing không chạy chương trình, thay vào đó nó phân tích mã nguồn mà không thực thi.',
    ),
    27 => 
    array (
      'q' => 'Beta testing diễn ra với ai?',
      'type' => 'single',
      'difficulty' => 'easy',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Nhóm người dùng thực tế bên ngoài',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Nhóm phát triển',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Nhóm quản lý dự án',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Nhóm kiểm thử',
          1 => false,
        ),
      ),
      'explanation' => 'Beta testing diễn ra với nhóm người dùng thực tế bên ngoài để thu thập phản hồi.',
    ),
    28 => 
    array (
      'q' => 'Traceability matrix liên kết test case với gì?',
      'type' => 'single',
      'difficulty' => 'medium',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Yêu cầu',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Kiểm thử tích cực',
          1 => false,
        ),
        2 => 
        array (
          0 => 'Kiểm thử tiêu cực',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Mã nguồn',
          1 => false,
        ),
      ),
      'explanation' => 'Traceability matrix liên kết test case với yêu cầu để đảm bảo tất cả yêu cầu đều được kiểm thử.',
    ),
    29 => 
    array (
      'q' => 'Hai yếu tố nào dùng ưu tiên kiểm thử dựa trên rủi ro?',
      'type' => 'multiple',
      'difficulty' => 'hard',
      'options' => 
      array (
        0 => 
        array (
          0 => 'Xác suất xảy ra',
          1 => true,
        ),
        1 => 
        array (
          0 => 'Mức độ tác động',
          1 => true,
        ),
        2 => 
        array (
          0 => 'Thời gian thực hiện',
          1 => false,
        ),
        3 => 
        array (
          0 => 'Chi phí thực hiện',
          1 => false,
        ),
      ),
      'explanation' => 'Xác suất xảy ra và mức độ tác động là hai yếu tố dùng để ưu tiên kiểm thử dựa trên rủi ro.',
    ),
  ),
);
