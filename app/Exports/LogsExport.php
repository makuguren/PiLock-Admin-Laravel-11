<?php

namespace App\Exports;

use App\Models\Log;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LogsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    public $course_id, $fromdate, $todate, $year;

    public function __construct(int $course_id, $fromdate, $todate)
    {
        $this->course_id = $course_id;
        $this->fromdate = $fromdate;
        $this->todate = $todate;
    }

    public function query()
    {
        return Log::query()->where('course_id', $this->course_id)->whereBetween('date', [$this->fromdate, $this->todate]);
    }

    public function headings(): array
    {
        return [
            'STUDENT ID',
            'NAME',
            'SECTION',
            'COURSE TITLE',
            'INSTRUCTOR',
            'DATE',
            'TIME IN',
            'TIME OUT'
        ];
    }

    public function map($log): array
    {
        return [
            $log->student->student_id,
            $log->student->name,
            $log->course->section->program . ' ' . $log->course->section->year . $log->course->section->block,
            $log->course->course_title,
            $log->course->instructor->name,
            $log->date,
            $log->time_in,
            $log->time_out
        ];
    }
}
