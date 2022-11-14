<?php

namespace App\Http\Controllers;
#mengimport model Student
# digunakan untuk berinteraksi dengan database student
use App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;


class StudentController extends Controller
{
    // membuat methode index
    
    public function index(){
        #memanggil methode getAllStudents dari model Student
        $students = Student::all();
        if(!empty($students))
        {
            $data = [
                'message'=>'Get all students',
                'data' => $students,
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                'message'=>'Student not found',
            ];
            return response()->json($data, 404);
        }        
    }

    # mendapatkan detail resource
    #membuat method show
    public function show($id)
    {
        #cari data Student 
        $student = Student::find($id);
        if($student)
        {
            $data = [
                'message'=>'Get detail data student',
                'data'=>$student, 
            ];  
            # mengembalikan data json status code 200
            return response()->json($data, 200);

        }else{
            $data = [
                'message'=>'Student not found',
            ];
            return response()->json($data, 404);
        }
        
    }

    # membuat methode store untuk menambahkan resource student
    public function store(Request $request){
        
        $validatedData = $request->validate([
            # kolom => 'rules|rules|
            'nama' => 'string|max:75|required',
            'nim' => 'numeric|min:10|required|unique:student',
            'email' => 'email|required',
            'jurusan' => 'required'
        ]);
       
        #mengguanakan model Student untuk insert data
        $student = Student::create($validatedData);

        $data = [
            'message'=>'Student is created succesfully',
            'data'=>$student,
        ];

        # mengembalikan data (json) status code 201
        return response()->json($student, 200);
    }
    # membuat methode update untuk mengubah resource student
    public function update(Request $request, $id){
        $student = Student::find($id);

        if ($student) {
            # mendapatkan data request
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan,
            ];
            # mengupdate data
            $student->update($input);


        $data = [
            'message'=>'Student is change succesfully',
            'data'=>$student,
        ];
        # mengembalikan data (json) status code 200
        return response()->json($data, 200);

    }   else {
        $data = [
            'message'=>'Student not found',
            'data'=>$student,
        ];
        return response()->json($data, 404);

    }

        
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student){
        $student->delete();
        $data = [
            'message'=>'Student has been deleted', 
        ];
        return response()->json($data, 200);
    }   else {
        $data = [
            'message'=>'Student not found',
        ];
        return response()->json($data, 404);
        }   
    }   
}