# UI Guide — LMS E-Learning

## Design principles

The interface follows the spirit of a university website and a carefully edited education product: calm, clear, generous whitespace, and real photos for context. The system avoids decorative gradients, glassmorphism, bright colored cards, and floating effects; hierarchy comes from typography, spacing rhythm, and neutral borders.

## Foundations

- Font: **Be Vietnam Pro** (400/500/600/700), loaded via Bunny Fonts; handles Vietnamese diacritics well.
- Primary color HUIT Blue (the Tailwind blue scale, exposed as `primary` in `tailwind.config.js`): `primary-600 #2563EB`; main buttons/links `primary-700 #1D4ED8`; hover `primary-800 #1E40AF`; light background `primary-50 #EFF6FF`.
- Success/progress: Emerald `#10B981`; warning: Amber `#F59E0B`; error: Red `#DC2626`.
- Text: Slate 950 for headings, Slate 700 for body, Slate 500 for captions. Page background Slate 50.
- Spacing on a 4px rhythm; page content uses `page-container`; cards are mostly `rounded-lg` with a Slate 200 border and no shadow.
- Course images use real thumbnails; if missing, map a photo by category from `public/images/lms/`, never repeating one illustration for every course.
- Hover only changes text color, underline, or a subtle border color; no translate, scale, or vivid background change.
- The admin sidebar, lesson sidebar, and footer always use a white/Slate 50 background with a Slate 200 border; no black or navy surfaces.
- Focus always shows a 2px Primary Blue ring; color is never the only signal. `prefers-reduced-motion` is supported.

## Shared components

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

Standard states: `published/paid/Đạt` (passed) → green; `draft` → gray; `pending` → yellow; `failed/Không đạt` (not passed) → red; informational → blue. Buttons accept `size=sm|md|lg`, `variant=primary|secondary|danger|ghost`, and `loading=true`. With Livewire you can add `wire:loading.attr="disabled"` and a dedicated loading label.

Standard table:

```blade
<div class="table-shell"><table class="data-table">...</table></div>
```

## Page patterns

- **List:** page title + description; primary action on the right; filters inside a card; table (horizontally scrollable) or grid; pagination at the bottom; empty state with guidance and a CTA.
- **Form:** max width `max-w-3xl`; fields grouped in cards; labels always visible; help text before errors; action bar at the end of the form.
- **Detail:** header with breadcrumb, title, status badge, and action group; body split 2/3 + 1/3 on desktop, single column on mobile.
- **Dashboard:** a row of white stat cards with thin borders and clear figures; recent activity list below. No multicolor bento layouts.
- **Learning:** section/lesson sidebar collapses on mobile; main content capped at a readable width; progress always visible; a clear continue CTA.
- **Exam:** questions use `text-lg sm:text-xl leading-8`; timer `sticky top-20 rounded-xl border bg-white p-4 tabular-nums`; navigator `grid grid-cols-5 gap-2`; answered/flagged states use both color and an icon; the submit button always opens a confirmation dialog.

## Responsive and accessibility

Mobile-first design. The public menu becomes a hamburger below `md`; the admin sidebar becomes a drawer below `lg`; tables use `overflow-x-auto`. Inputs must have labels linked via `for/id`; icon-only buttons have `aria-label`; flash messages use `role=alert`; progress bars expose ARIA values. Minimum tap target is about 40×40px.

## Do / Don't

- Do: one primary CTA per area; short Vietnamese copy; use `route()` and `Route::has()`; show empty/loading/error states; keep contrast high.
- Do: use real photo thumbnails with a consistent aspect ratio and `object-cover`; record image sources in `public/images/CREDITS.md`.
- Don't: mix many vivid colors, use decorative gradients, glassmorphism, heavy shadows, or cards that lift/scale on hover; do not use placeholders instead of labels.
- Don't: hard-code URLs, add heavy icon libraries, or copy logos/illustrations from other products.

## Inspiration sources

The sources below only guide trends; do not copy shots or assets:

- [Mobbin web patterns](https://mobbin.com/browse/web/apps): familiar content hierarchy and task flows.
- [Land-book](https://land-book.com/): editorial layouts, clear typography, and purposeful real photos.
- [Behance — education website search](https://www.behance.net/search/projects?search=university%20education%20website): education and university website patterns.
- [Tailwind UI](https://tailwindui.com/components): patterns for responsive navigation, forms, tables, and focus states.
- [Flowbite](https://flowbite.com/docs/components/alerts/): an easy-to-follow, accessible way to organize alert/badge/modal states.
- Additional search keywords: `university website`, `editorial SaaS`, `quiz app`, `exam timer UI`, `certificate design`.

### Behance references

Only inherit the information organization and task flows; do not copy branding, illustrations, or pixel-level layouts:

- [VK Education LMS redesign](https://www.behance.net/gallery/219868305/redizajn-LMS-sistemy-VK-Education): a "Tiếp tục học" (Continue learning) strip, in-progress/completed course tabs, detailed status within each program, and an upcoming-tasks column.
- [Empat School LMS Dashboard](https://www.behance.net/gallery/253375055/Empat-School-LMS-Dashboard-for-a-Real-EdTech-Program): one clearest continue CTA, a student profile, a 12-week activity heatmap, and a certificates block.
- [Synaptix LMS Dashboard](https://www.behance.net/gallery/241141177/Synaptix-LMS-Dashboard-UI-UX-Design-Case-Study): hierarchy through typography, small uppercase labels, and airy data tables.
- [Trenning V2 SaaS LMS](https://www.behance.net/gallery/202271645/Trenning-V2-SaaS-Learning-Management-System-(LMS)): task-oriented dashboard structure and data rows with generous vertical rhythm.

## Image credits

All images are stored locally under `public/images/lms/`, compressed to under 250 KB, and used under the [Pexels License](https://www.pexels.com/license/). The full list of files, authors, and source URLs is in [`public/images/CREDITS.md`](../public/images/CREDITS.md): Charlotte May (student hero), Yan Krukau (auth), Digital Buggu, Rodrigo Santos, Syirwan Ainu, and Daniil Komov (web/code photo set rotated by course id), Sergei Starostin (server/database and network), cottonbro studio (security), Lukas Blazek (data), fauxels (software process/team).

## Static preview

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
