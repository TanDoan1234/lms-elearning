<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuestionTemplateExport implements FromArray, ShouldAutoSize, WithHeadings
{
    public function headings(): array
    {
        return ['noi_dung', 'loai', 'do_kho', 'dap_an_a', 'dap_an_b', 'dap_an_c', 'dap_an_d', 'dap_an_e', 'dap_an_f', 'dap_an_dung', 'giai_thich'];
    }

    public function array(): array
    {
        return [
            ['PHP là viết tắt của gì?', 'single', 'easy', 'PHP: Hypertext Preprocessor', 'Personal Home Page', 'Private Home Page', 'Programming Hypertext Page', '', '', 'A', 'PHP là ngôn ngữ kịch bản phía máy chủ.'],
            ['Chọn các kiểu dữ liệu vô hướng trong PHP.', 'multiple', 'medium', 'int', 'string', 'array', 'object', 'resource', 'callable', 'A,B', 'int và string là kiểu vô hướng.'],
        ];
    }
}
