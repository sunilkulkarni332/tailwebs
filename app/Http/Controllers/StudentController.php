<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {        
        $studentList = Student::Paginate(10); // Paginate with 10 items per page
        return view('student.home', compact('studentList'));
    }

    public function studentInsert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject_name' => 'required',
            'marks' => 'required',
        ]);

        $existStudent = Student::where('name',$request->name)->where('subject_name',$request->subject_name)->first();
        if($existStudent){
            Student::where('id',$existStudent->id)->update(['marks' =>$request->marks]);
        }else{
            Student::create([
                'name' => $request->name,
                'subject_name' => $request->subject_name,
                'marks' => $request->marks,
            ]);
        }
        
        return redirect('/teacher/studentList')->with('success', 'Student successful added!');
    }

    public function studentUpdate(Request $request){
        Student::where('id',$request->id)->update(['marks' =>$request->marks]);
        return redirect('/teacher/studentList')->with('success', 'Student successful Updated!');
    }

    public function studentDelete($id){
        $model = Student::find( $id );
        $model->delete();
        return redirect('/teacher/studentList')->with('success', 'Student successful deleted!');
    }
}
