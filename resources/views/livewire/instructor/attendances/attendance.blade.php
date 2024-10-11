<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Attendance Sheet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px;
            border-bottom: 2px solid blue; /* Added underline */
            padding-bottom: 10px; /* Space between logos and underline */
        }
        .header img {
            height: 50px;
        }
        .title {
            text-align: center;
            margin-top: 40px;
        }
        .table-container {
            text-align: left;
            margin: 20px;
        }
        .info-table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
            border: none;
        }
        .info-table td {
            border: none;
            padding: 20px;
        }
        .attendance-table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
        }
        .attendance-table th, .attendance-table td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        .attendance-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ $cspcheader }}" style="height: 50px;" alt="CSPC Logo">
    <img src="{{ $ccsheader }}" style="height: 50px;" alt="CCS Logo">
</div>

<div class="title">
    <h2>ATTENDANCE SHEET</h2>
    <h3>{{ $section }}</h3>
</div>

<div class="table-container">
    <table class="info-table">
        <tr>
            <td>Subject Code: {{ $course_code }}</td>
            <td>Instructor: {{ Auth::user()->name }}</td>
            <td>Date: {{ $date }}</td>
        </tr>
    </table>
    <table class="attendance-table">
        <tr>
            <th>STUDENT ID</th>
            <th>NAME</th>
            <th>SEAT NO.</th>
            <th>STATUS</th>
        </tr>
        @foreach ($courses as $course)
            @foreach ($course->attendance as $attendance)
                {{-- @php
                    // Find the seat plan for the specific course and student
                    $seatPlan = \App\Models\SeatPlan::where('student_id', $attendance->student->id)
                        ->where('course_id', $attendance->course_id)
                        ->first();
                @endphp --}}
                <tr>
                    <td>{{ $attendance->student->student_id }}</td>
                    <td>{{ $attendance->student->name }}</td>
                    <td>{{ $attendance->seat_number ?? 'N/A' }}
                    <td>
                        @if ($attendance->isPresent == '0')
                            ABSENT
                        @else
                            PRESENT
                        @endif
                    </td>
                </tr>
            @endforeach
        @endforeach
    </table>
</div>

</body>
</html>
