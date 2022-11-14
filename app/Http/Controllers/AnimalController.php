<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnimalController extends Controller
{
    public $data = ['kucing','ayam','ikan'];
    public function index()
        {
            $animal = $this->data;
            echo "Menampilkan data animals - ","<br>";
            foreach ($animal as $anml) {
                
                print "<br>- $anml</br>";

            }
            return $this->data;

            
            
        }
    public function store(Request $request)
    {
        echo "Menambahkan hewan baru - ";
        $animal = array_push($this->data, $request->nama);
        $this->index();
        
    }

    public function update(Request $request, $id)
    {
        echo "Mengubah data animals id $id - ","<br>";
        // echo "Nama hewan : $request->nama","<br>";
        $this->data[$id] = $request->nama;        
        $this->index();
    }

    public function destroy($id)
    {
        echo "Menghapus data animals id $id <br>";
        array_splice($this->data, $id, 1);
        $animal = ($this->data);
        $this->index();
    }
}
