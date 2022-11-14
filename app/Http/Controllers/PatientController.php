<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    # Membuat method index 
    public function index()
    {
        # Menangkap semua data patients dari database 
        $patients = Patient::all();
        
        # Jika data tidak kosong maka tampilkan data patients (DB)
        if(!empty($patients))
        {
            $data = [
                'message'=>'Get all resource',
                'data' => $patients,
            ];
            # mengembalikan data (json) status code 200
            return response()->json($data, 200);
        }

        # Jika kosong maka tampil message 'Data is empty'
        else
        {
            $data = ['message'=>'Data is empty'];

            # mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }

    # Membuat methode store untuk menambahkan data
    public function store(Request $request)
    {
        # Menangkap dan memvalidasi data request yang dimasukkan    
        $validatedData = $request->validate([
            # kolom => 'rules|rules
            'name' => 'string|max:75|required',
            'phone' => 'numeric|min:08000000|required|unique:patients',
            'address' => 'required',
            'status' => 'required',
            'in_date_at' => 'required|date',
            'out_date_at' => 'required|date',
        ]);

        # menggunakan model Student untuk create data
        $patients = Patient::create($validatedData);

        # menampilkan data yang berhasil di-create
        $data = [
            'message'=>'Resource is added succesfully',
            'data'=>$patients,
        ];

        # mengembalikan data (json) status code 201
        return response()->json($patients, 201);
    }

    # Membuat methode show untuk menampilkan data
    public function show($id)
    {
        # menangkap data dari patients(DB) dengan id tertentu
        $patients = Patient::find($id);

        # Jika data patients ada maka akan ditampilkan
        if($patients)
        {
            $data = [
                'message'=>'Get detail resource',
                'data'=>$patients, 
            ];  
            # mengembalikan data json status code 200
            return response()->json($data, 200);

        # Jika data kosong maka akan tampil pesan sebagai berikut
        }else{
            $data = ['message'=>'Resource not found'];
            return response()->json($data, 404);
        }
        
    }

    # membuat methode update untuk mengubah resource patients
    public function update(Request $request, $id)
    {
        # menangkap data dari patients(DB) dengan id tertentu
        $patients = Patient::find($id);

        # Jika data patients ada maka akan diproses
        if ($patients) {
            # menangkap data request untuk mengupdate data
            # ?? maksudnya jika data tidak diisi maka akan dimasukkan
            # data yang lama
            $input = [
                'name' => $request->name ?? $patients->name,
                'phone' => $request->phone ?? $patients->phone,
                'address' => $request->address ?? $patients->address,
                'status' => $request->status ?? $patients->status,
                'in_date_at' => $patients->in_date_at,
                'out_date_at' => $request->out_date_at ?? $patients->out_date_at,
            ];

        # melakukan update data
        $patients->update($input);

        # Menampilkan data yang berhasil di-update
        $data = [
            'message'=>'Resource is update successfully',
            'data'=>$patients,
        ];

        # mengembalikan data (json) status code 200
        return response()->json($data, 200);

    }   else {
        $data = ['message'=>'Resource not found'];
        # mengembalikan data (json) status code 404
        return response()->json($data, 404);
    }
    }

    # Membuat method destroy untuk menghapus data
    public function destroy($id)
    {
        # menangkap data dari patients(DB) dengan id tertentu
        $patients = Patient::find($id);
        # Jika data patients ada maka akan diproses
        if ($patients)
        {
        # Melakukan proses delete data
        $patients->delete();

        # Menampilkan message Resource is delete succesfully
        $data = [
            'message'=>'Resource is delete successfully', 
        ];
        # mengembalikan data (json) status code 200
        return response()->json($data, 200);
        }else{
        $data = ['message'=>'Resource not found'];
        # mengembalikan data (json) status code 404
        return response()->json($data, 404);
        }   
    }   

    public function search($name)
    {
        # Menangkap request $name yang mengandung kata name dari database patients 
        $patients = Patient::where('name','like',"%".$name."%")->get();
        
        # menampilkan setiap data dari patients yang ditangkap
        # dan ditampilkan sebanyak data yang muncul
        foreach ($patients as $patient){
        $data = [
            'message'=>'Get searched resource',
            'data'=>$patients 
        ];  
        # mengembalikan data json status code 200
        return response()->json($data, 200);}
        
        # jika data yang ditangkap kosong maka fungsi foreach
        # akan dilewati dan langsung memproses kode di bawah ini
        $data = ['message'=>'Resource not found'];  
        # mengembalikan data json status code 200
        return response()->json($data, 404);
        
    }

    public function positive()
    {
        # cari data dari patients(DB) dengan endpoint positive
        $patients = Patient::where('patients.status','=','Positive')->get();
        # menampilkan setiap data dari patients yang ditangkap
        # dan ditampilkan sebanyak data yang muncul
        foreach ($patients as $patient){
            $data = [
                'message'=>'Get searched resource',
                'data'=>$patients 
            ];  
            # mengembalikan data json status code 200
            return response()->json($data, 200);}
            
            # jika data yang ditangkap kosong maka fungsi foreach
            # akan dilewati dan langsung memproses kode di bawah ini
            $data = ['message'=>'Resource not found'];  
            # mengembalikan data json status code 200
            return response()->json($data, 404);
    }

    public function recovered()
    {
        # cari data dari patients(DB) dengan endpoint recovered
        $patients = Patient::where('patients.status','=','Recovered')->get();
       # menampilkan setiap data dari patients yang ditangkap
        # dan ditampilkan sebanyak data yang muncul
        foreach ($patients as $patient){
            $data = [
                'message'=>'Get searched resource',
                'data'=>$patients 
            ];  
            # mengembalikan data json status code 200
            return response()->json($data, 200);}
            
            # jika data yang ditangkap kosong maka fungsi foreach
            # akan dilewati dan langsung memproses kode di bawah ini
            $data = ['message'=>'Resource not found'];  
            # mengembalikan data json status code 200
            return response()->json($data, 404);
    }

    public function dead()
    {
        # cari data dari patients(DB) dengan endpoint positive
        $patients = Patient::where('patients.status','=','Dead')->get();
        # menampilkan setiap data dari patients yang ditangkap
        # dan ditampilkan sebanyak data yang muncul
        foreach ($patients as $patient){
            $data = [
                'message'=>'Get searched resource',
                'data'=>$patients 
            ];  
            # mengembalikan data json status code 200
            return response()->json($data, 200);}
            
            # jika data yang ditangkap kosong maka fungsi foreach
            # akan dilewati dan langsung memproses kode di bawah ini
            $data = ['message'=>'Resource not found'];  
            # mengembalikan data json status code 200
            return response()->json($data, 404);
    }
}
