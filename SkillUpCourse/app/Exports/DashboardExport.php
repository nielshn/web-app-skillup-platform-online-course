<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\SubscribeTransaction;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DashboardExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $rowCount;

    public function collection()
    {
        $user = Auth::user();
        $coursesQuery = Course::query();

        if ($user->hasRole('teacher')) {
            $coursesQuery->whereHas('teacher', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });

            $students = CourseStudent::whereIn('course_id', $coursesQuery->select('id'))
                ->distinct('user_id')
                ->count('user_id');

            $courses = $coursesQuery->count();

            $data = collect([
                ['Category' => 'Courses', 'Count' => $courses],
                ['Category' => 'Students', 'Count' => $students]
            ]);
        } else {
            $students = CourseStudent::distinct('user_id')
                ->count('user_id');
            $courses = $coursesQuery->count();
            $transactions = SubscribeTransaction::count();

            $data = collect([
                ['Category' => 'Courses', 'Count' => $courses],
                ['Category' => 'Students', 'Count' => $students],
                ['Category' => 'Transactions', 'Count' => $transactions]
            ]);
        }

        $this->rowCount = $data->count();
        return $data;
    }

    public function headings(): array
    {
        return [
            'Category',
            'Count',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->rowCount + 1; // Karena header berada di baris pertama

        // Mengatur border untuk seluruh tabel sesuai dengan jumlah baris
        $sheet->getStyle("A1:B{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Mengatur style untuk header
        $sheet->getStyle('A1:B1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '4F81BD'],
            ],
        ]);

        // Mengatur style untuk body
        $sheet->getStyle("A2:B{$lastRow}")->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'DDEBF7'],
            ],
        ]);

        return [
            // Mengatur lebar kolom agar otomatis menyesuaikan dengan konten
            'A' => ['autoSize' => true],
            'B' => ['autoSize' => true],
        ];
    }
}
