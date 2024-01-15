<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(){
        // $students = Student::all();
        $user = Auth::user();
        $id = Auth::id();
        $students = Student::paginate(2);
        return view ('index',['students' => $students,'user' => $user,'id'=>$id]);
    }
    public function filter(){
        $students = Student::where('score', '>=', 100)
        ->where('name', 'LIKE', '%a%')
        ->get();
        return view ('filter',compact('students'));
    }

    public function show($id){
    //     $students = Teacher::find($id)->students;
    //     return view('Example',['students' => $students]);
    // }


    $student = Student::find($id);
    // $activities = $student->activities;                
    return view('show',['student' => $student]);
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'score' => 'required'
        ]);

        Student::create([
            'name' => $request->name,
            'score' => $request->score,
            'teacher_id' => 1
        ]);

        return redirect::route('index');
    }

    public function edit(Student $student)
    {
        return view('edit', compact('student'));
    }

    public function update(Request $request, Student $student){

        $student->update([
            'name' => $request->name,
            'score' => $request->score
        ]);

        return redirect::route('index');
    }

    public function delete(Student $student)
    {
        $student->delete();
        return Redirect::route('index');
    }
}