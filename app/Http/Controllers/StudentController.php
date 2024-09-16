<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Exports\StudentsExport;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    public function index()
    {
        $item_per_page = request('item_per_page', 10);

        if (isset($item_per_page)) {
            $students = Student::studentsQuery()->paginate($item_per_page);
        } else {
            $students = Student::studentsQuery()->get();
        }

        return StudentResource::collection($students);
    }


    public function destroy(Student $student)
    {
        $student->delete();
        return response()->noContent();
    }

    public function massDestroy($students)
    {
        $studentsArray = explode(',', $students);
        Student::whereKey($studentsArray)->delete();
        return response()->noContent();
    }

    public function export($students)
    {
        $studentsArray = explode(',', $students);
        return (new StudentsExport($studentsArray))->download('students.xlsx');
    }
}
