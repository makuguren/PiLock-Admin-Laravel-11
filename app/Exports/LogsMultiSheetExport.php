<?php

namespace App\Exports;

use App\Exports\LogsExport;
use App\Exports\InstructorLogsExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LogsMultiSheetExport implements WithMultipleSheets
{
    use Exportable;

    protected $course_ids, $fromdate, $todate;

    public function __construct(array $course_ids, $fromdate, $todate)
    {
        $this->course_ids = $course_ids;
        $this->fromdate = $fromdate;
        $this->todate = $todate;
    }

    public function sheets(): array
    {
        $sheets = [];

        // Add a separate sheet for each course
        foreach ($this->course_ids as $course_id) {
            $sheets[] = new StudentLogsExport($course_id, $this->fromdate, $this->todate);
        }

        // Add one sheet for instructor logs
        foreach ($this->course_ids as $course_id) {
            $sheets[] = new InstructorLogsExport($course_id, $this->fromdate, $this->todate);
        }

        return $sheets;
    }
}
