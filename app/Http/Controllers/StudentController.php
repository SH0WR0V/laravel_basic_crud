<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function studentList(){
        $students = Student::all(); 
        return view('student.studentList')->with('students', $students);
    }
    public function studentEdit(Request $request){
        $student = Student::where('id', $request->id)->first();
        // return $student;
        return view('student.studentEdit')->with('student', $student);
        // return view('student.studentCreate')->with('student', $student);
    }
    public function studentEditSubmitted(Request $request){
        $student = Student::where('id', $request->id)->first();
        // return  $student;
        $student->name = $request->name;
        $student->id = $request->id;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();
        return redirect()->route('studentList');

    }

    public function studentDelete(Request $request){
        $student = Student::where('id', $request->id)->first();
        $student->delete();

        return redirect()->route('studentList');
    }
    public function studentCreate(){
        return view('student.studentCreate');
    }
    public function studentCreateSubmitted(Request $request){
        $validate = $request->validate([
            "name"=>"required|min:4|max:20",
            "id"=>"required|unique:students",
            'email'=>'email',
            'phone'=>'required'
        ],
        ['name.required'=>"Please put you name here"]
    );
        $student = new  Student();
        $student->name = $request->name;
        $student->id = $request->id;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();

        return redirect()->route('studentList');
    }

    public function RunSearch(){
        return view('student.studentSearch');
    }

    public function search(Request $request){

        if($request->ajax()){
    
            $data=Student::where('id','like','%'.$request->search.'%')
            ->orwhere('name','like', $request->search.'%')->get();
    
    
            $output='';
        if(count($data)>0){
    
             $output ='
                <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                </tr>
                </thead>
                <tbody>';
    
                    foreach($data as $row){
                        $output .='
                        <tr>
                        <th scope="row">'.$row->id.'</th>
                        <td>'.$row->name.'</td>
                        <td>'.$row->email.'</td>
                        <td>'.$row->phone.'</td>
                        </tr>
                        ';
                    }
    
             $output .= '
                 </tbody>
                </table>';
        }
        else{
    
            $output .='No results';
    
        }
        return $output;
        }
      }  
}
