<?php

namespace App\Exports;

use App\Models\FacultyLog;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class InstructorLogsExport implements FromQuery, WithHeadings, WithMapping, WithTitle
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
        return FacultyLog::query()
            ->where('course_id', $this->course_id)
            ->whereBetween('date', [$this->fromdate, $this->todate]);
    }

    public function headings(): array
    {
        return [
            'FACULTY ID',
            'NAME',
            'SECTION',
            'COURSE TITLE',
            'DATE',
            'TIME IN',
            'TIME OUT'
        ];
    }

    public function map($facultyLog): array
    {
        return [
            $facultyLog->course->instructor->id,
            $facultyLog->course->instructor->first_name . ' ' . $facultyLog->course->instructor->last_name,
            $facultyLog->course->section->program . ' ' . $facultyLog->course->section->year . $facultyLog->course->section->block,
            $facultyLog->course->course_title,
            $facultyLog->date,
            $facultyLog->time_in,
            $facultyLog->time_out
        ];
    }

    public function title(): string
    {
        return 'Faculty Logs ' . $this->fromdate . ' - ' . $this->todate;
    }
}
