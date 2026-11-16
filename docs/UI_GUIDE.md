# UI Guide — LMS E-Learning

## Tinh thần thiết kế

Giao diện mang tinh thần website đại học và sản phẩm giáo dục biên tập kỹ: điềm tĩnh, rõ ràng, nhiều khoảng trắng và dùng ảnh thật để tạo ngữ cảnh. Hệ thống tránh gradient trang trí, glassmorphism, card màu rực và hiệu ứng nổi; phân cấp đến từ typography, nhịp khoảng cách và đường viền trung tính.

## Nền tảng

- Font: **Be Vietnam Pro** (400/500/600/700), tải qua Bunny Fonts; hỗ trợ dấu tiếng Việt tốt.
- Màu chính HUIT Blue: `primary-600 #2563EB`; nút/link chính `primary-700 #1D4ED8`; hover `primary-800 #1E40AF`; nền nhạt `primary-50 #EFF6FF`.
- Thành công/tiến độ: Emerald `#10B981`; cảnh báo: Amber `#F59E0B`; lỗi: Red `#DC2626`.
- Chữ: Slate 950 cho tiêu đề, Slate 700 cho nội dung, Slate 500 cho phụ chú. Nền trang Slate 50.
- Khoảng cách theo nhịp 4px; nội dung trang dùng `page-container`; card chủ yếu `rounded-lg`, viền Slate 200 và không shadow.
- Ảnh khóa học dùng thumbnail thật; nếu thiếu thì ánh xạ ảnh theo danh mục từ `public/images/lms/`, không lặp lại một illustration cho mọi khóa học.
- Hover chỉ đổi màu chữ, gạch chân hoặc màu viền nhẹ; không translate, scale hay đổi nền rực.
- Sidebar quản trị, sidebar bài học và footer luôn dùng nền trắng/Slate 50 với viền Slate 200; không dùng mảng nền đen hoặc navy.
- Focus luôn có vòng Primary Blue 2px; không dùng màu là tín hiệu duy nhất. Hỗ trợ `prefers-reduced-motion`.

## Thành phần dùng chung

```blade
<x-alert type="success">Đã lưu khóa học.</x-alert>
<x-input name="title" label="Tên khóa học" help="Tối đa 150 ký tự" />
<x-textarea name="description" label="Mô tả" rows="5" />
<x-select name="status" label="Trạng thái"><option>Xuất bản</option></x-select>
<x-button variant="primary" size="md">Lưu thay đổi</x-button>
<x-button variant="secondary" type="button">Hủy</x-button>
<x-button variant="danger">Xóa</x-button>
<x-card title="Nội dung khóa học">...</x-card>
<x-badge variant="green">Đã xuất bản</x-badge>
<x-progress-bar :value="$progress" label="Tiến độ" />
<x-empty-state title="Chưa có khóa học" description="Tạo khóa học đầu tiên để bắt đầu." />
<x-confirm-delete :action="route('...')" message="Bạn chắc chắn muốn xóa?" />
```

Trạng thái chuẩn: `published/paid/Đạt` → green; `draft` → gray; `pending` → yellow; `failed/Không đạt` → red; thông tin → blue. Nút có `size=sm|md|lg`, `variant=primary|secondary|danger|ghost`, `loading=true`. Với Livewire có thể thêm `wire:loading.attr="disabled"` và nội dung tải riêng.

Bảng chuẩn:

```blade
<div class="table-shell"><table class="data-table">...</table></div>
```

## Mẫu trang

- **Danh sách:** page title + mô tả; hành động chính bên phải; filter trong card; bảng/cuộn ngang hoặc grid; phân trang cuối trang; empty state có hướng dẫn và CTA.
- **Biểu mẫu:** rộng tối đa `max-w-3xl`; nhóm trường theo card; label luôn hiển thị; help text trước lỗi; thanh hành động cuối form.
- **Chi tiết:** header có breadcrumb, title, badge trạng thái và nhóm hành động; thân trang chia 2/3 + 1/3 trên desktop, một cột trên mobile.
- **Dashboard:** hàng thống kê trắng, đường viền mảnh, số liệu rõ; danh sách hoạt động gần đây ở dưới. Không dùng bento nhiều màu.
- **Học tập:** sidebar chương/bài thu gọn trên mobile; nội dung chính tối đa chiều rộng đọc; tiến độ luôn thấy; CTA tiếp tục rõ ràng.
- **Thi:** câu hỏi dùng `text-lg sm:text-xl leading-8`; timer `sticky top-20 rounded-xl border bg-white p-4 tabular-nums`; navigator `grid grid-cols-5 gap-2`; trạng thái đã trả lời/đánh dấu có cả màu và icon; nút nộp luôn mở hộp xác nhận.

## Responsive và accessibility

Thiết kế từ mobile trước. Menu công khai chuyển sang hamburger dưới `md`; sidebar quản trị thành drawer dưới `lg`; bảng có `overflow-x-auto`. Input phải có label liên kết bằng `for/id`; icon-only button có `aria-label`; flash dùng `role=alert`; progress có ARIA value. Vùng bấm tối thiểu khoảng 40×40px.

## Do / Don't

- Do: một CTA chính mỗi vùng; câu chữ tiếng Việt ngắn; dùng `route()` và `Route::has()`; hiển thị empty/loading/error; giữ tương phản cao.
- Do: dùng thumbnail ảnh thật tỉ lệ nhất quán và `object-cover`; ghi nguồn ảnh trong `public/images/CREDITS.md`.
- Don't: ghép nhiều màu rực, gradient trang trí, glassmorphism, shadow đậm, card hover nổi/scale; không dùng placeholder thay label.
- Don't: hard-code URL, thêm thư viện icon nặng, hoặc sao chép logo/illustration từ sản phẩm khác.

## Nguồn cảm hứng

Các nguồn dưới đây chỉ định hướng xu hướng, không sao chép shot hoặc asset:

- [Mobbin web patterns](https://mobbin.com/browse/web/apps): phân cấp nội dung và luồng tác vụ quen thuộc.
- [Land-book](https://land-book.com/): bố cục editorial, typography rõ và ảnh thật có chủ đích.
- [Behance — education website search](https://www.behance.net/search/projects?search=university%20education%20website): pattern website giáo dục và đại học.
- [Tailwind UI](https://tailwindui.com/components): pattern responsive navigation, form, table và focus state.
- [Flowbite](https://flowbite.com/docs/components/alerts/): cách tổ chức trạng thái alert/badge/modal dễ hiểu và accessible.
- Từ khóa tham khảo bổ sung: `university website`, `editorial SaaS`, `quiz app`, `exam timer UI`, `certificate design`.

### Tham khảo Behance

Chỉ kế thừa cách tổ chức thông tin và luồng tác vụ; không sao chép nhận diện, hình minh họa hay bố cục theo từng pixel:

- [VK Education LMS redesign](https://www.behance.net/gallery/219868305/redizajn-LMS-sistemy-VK-Education): dải “Tiếp tục học”, tab khóa đang học/đã hoàn thành, trạng thái chi tiết trong từng chương trình và cột việc sắp tới.
- [Empat School LMS Dashboard](https://www.behance.net/gallery/253375055/Empat-School-LMS-Dashboard-for-a-Real-EdTech-Program): một CTA tiếp tục rõ nhất, hồ sơ học viên, heatmap hoạt động 12 tuần và khối chứng chỉ.
- [Synaptix LMS Dashboard](https://www.behance.net/gallery/241141177/Synaptix-LMS-Dashboard-UI-UX-Design-Case-Study): phân cấp bằng typography, nhãn uppercase nhỏ và bảng dữ liệu thoáng.
- [Trenning V2 SaaS LMS](https://www.behance.net/gallery/202271645/Trenning-V2-SaaS-Learning-Management-System-(LMS)): cấu trúc dashboard theo tác vụ và các hàng dữ liệu có nhịp dọc rộng.

## Nguồn ảnh

Toàn bộ ảnh lưu cục bộ dưới `public/images/lms/`, nén dưới 250 KB và dùng theo [Pexels License](https://www.pexels.com/license/). Danh sách đầy đủ file, tác giả và URL nguồn nằm tại [`public/images/CREDITS.md`](../public/images/CREDITS.md): Charlotte May (hero sinh viên), Yan Krukau (auth), Digital Buggu, Rodrigo Santos, Syirwan Ainu và Daniil Komov (bộ ảnh web/code luân phiên theo mã khóa học), Sergei Starostin (server/database và network), cottonbro studio (security), Lukas Blazek (data), fauxels (software process/team).

## Preview tĩnh

```blade
<section class="page-container py-8">
  <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
    <div><h1 class="page-title">Khóa học của tôi</h1><p class="page-subtitle">Tiếp tục từ nơi bạn đã dừng.</p></div>
    <x-button>Khám phá khóa học</x-button>
  </div>
  <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
    <x-card>
      <x-badge variant="blue">Lập trình</x-badge>
      <h2 class="mt-3 text-lg font-bold">Laravel căn bản</h2>
      <div class="mt-5"><x-progress-bar value="68" label="8/12 bài học" /></div>
    </x-card>
  </div>
</section>
```
