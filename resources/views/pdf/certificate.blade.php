<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <style>
        @page { size: A4 landscape; margin: 0; }
        * { box-sizing: border-box; }
        html, body { width: 297mm; height: 210mm; margin: 0; padding: 0; overflow: hidden; }
        body { font-family: "DejaVu Sans", sans-serif; color: #1e3a8a; background: #f8fafc; }
        .certificate { position: absolute; left: 10mm; top: 10mm; width: 277mm; height: 190mm; border: 1.2mm solid #1e40af; padding: 2.2mm; }
        .inner { position: absolute; left: 2.2mm; right: 2.2mm; top: 2.2mm; bottom: 2.2mm; text-align: center; padding: 9mm 18mm 13mm; overflow: hidden; }
        .corner { position: absolute; width: 24mm; height: 24mm; }
        /* Explicit coordinates avoid Dompdf's inconsistent right/bottom positioning. */
        .tl { left: 5mm; top: 5mm; border-left: 2mm solid #d4a72c; border-top: 2mm solid #d4a72c; }
        .tr { left: 247mm; top: 5mm; border-right: 2mm solid #d4a72c; border-top: 2mm solid #d4a72c; }
        .bl { left: 5mm; top: 157mm; border-left: 2mm solid #d4a72c; border-bottom: 2mm solid #d4a72c; }
        .br { left: 247mm; top: 157mm; border-right: 2mm solid #d4a72c; border-bottom: 2mm solid #d4a72c; }
        .brand { font-size: 10pt; letter-spacing: 2.5pt; color: #2563eb; font-weight: bold; }
        .seal { margin: 3mm auto 0; width: 14mm; height: 14mm; border: 1mm double #d4a72c; border-radius: 50%; line-height: 12mm; font-size: 16pt; color: #d4a72c; }
        h1 { margin: 3mm 0 2mm; font-size: 25pt; letter-spacing: 1.5pt; color: #1e40af; }
        .lead { margin: 0; color: #64748b; font-size: 10.5pt; }
        .name { margin: 3mm 0 1.5mm; font-size: 23pt; line-height: 1.2; font-weight: bold; color: #1d4ed8; border-bottom: .3mm solid #cbd5e1; display: inline-block; padding: 0 10mm 2mm; }
        .course { margin: 2mm 0 0; font-size: 16pt; line-height: 1.25; font-weight: bold; color: #0f172a; }
        .meta { width: 88%; margin: 6mm auto 0; border-collapse: collapse; font-size: 9pt; color: #475569; }
        .meta td { width: 33.33%; vertical-align: top; padding: 0 3mm; }
        .label { font-size: 7.5pt; text-transform: uppercase; color: #94a3b8; letter-spacing: .8pt; }
        .value { margin-top: 1mm; font-weight: bold; color: #334155; }
        .signature { position: absolute; right: 25mm; top: 123mm; width: 72mm; text-align: center; color: #334155; }
        .signature-name { font-size: 10pt; font-weight: bold; }
        .signature-line { width: 58mm; margin: 3mm auto 2mm; border-top: .35mm solid #64748b; }
        .signature-role { font-size: 8pt; color: #64748b; }
        .verify { position: absolute; left: 24mm; right: 24mm; bottom: 10mm; border-top: .25mm solid #cbd5e1; padding-top: 2.5mm; font-size: 7.5pt; line-height: 1.4; color: #475569; }
    </style>
</head>
<body>
<div class="certificate">
    <div class="inner">
        <div class="corner tl"></div><div class="corner tr"></div><div class="corner bl"></div><div class="corner br"></div>
        <div class="brand">LMS E-LEARNING · HUIT</div>
        <div class="seal">◆</div>
        <h1>CHỨNG NHẬN HOÀN THÀNH</h1>
        <p class="lead">Trân trọng chứng nhận học viên</p>
        <div class="name">{{ $certificate->user->name }}</div>
        <p class="lead">đã hoàn thành xuất sắc khóa học</p>
        <div class="course">{{ $certificate->course->title }}</div>
        <table class="meta"><tr>
            <td><div class="label">Giảng viên</div><div class="value">{{ $certificate->course->instructor->name }}</div></td>
            <td><div class="label">Ngày cấp</div><div class="value">{{ $certificate->issued_at->format('d/m/Y') }}</div></td>
            <td><div class="label">Mã chứng chỉ</div><div class="value">{{ $certificate->code }}</div></td>
        </tr></table>
        <div class="signature">
            <div class="signature-name">{{ $certificate->course->instructor->name }}</div>
            <div class="signature-line"></div>
            <div class="signature-role">Giảng viên phụ trách</div>
        </div>
        <div class="verify">Mã: {{ $certificate->code }}<br>Xác thực tại: {{ route('certificates.verify', $certificate->code) }}</div>
    </div>
</div>
</body>
</html>
