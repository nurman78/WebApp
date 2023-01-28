<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index(){
        $result = [];
        $data = Mahasiswa::get();

        if($data) {
            $result['status'] = true;
            $result['code'] = 200;
            $result['message'] = 'sukses';
            $result['data'] = $data;
        } else {
            $result['status'] = false;
            $result['code'] = 404;
            $result['message'] = 'something error';        
        }
        return response()->json($result);
    }

    public function store(Request $req){
        $result = [];
        
        // validasi isian api
        $validator = Validator::make(request()->all(),[
            'name'=>'required',
            'alamat'=>'required'
        ]);
        
        // jika tidak valid
        if($validator->fails()){
            return response()->json($validator->messages(), 404);
        }

        // jika valid
        $data = new Mahasiswa;

        $data->name = $req->name;
        $data->alamat = $req->alamat;
        $data->save();
        
        if($data) {
            $result['status'] = true;
            $result['code'] = 200;
            $result['message'] = 'sukses';
            $result['data'] = $data;
        } else {
            $result['status'] = false;
            $result['code'] = 404;
            $result['message'] = 'something error';        
        }
        return response()->json($result);
    }

    public function show($id){
        $result = [];
        $data = Mahasiswa::find($id);

        if($data) {
            $result['status'] = true;
            $result['code'] = 200;
            $result['message'] = 'sukses';
            $result['data'] = $data;
        } else {
            $result['status'] = false;
            $result['code'] = 404;
            $result['message'] = 'something error';        
        }
        return response()->json($result);
    }

    public function delete($id){
        $result = [];
        // valida
        try {
            $data = Mahasiswa::findOrfail($id);
            
            if($data) {
                $data->delete();
                
                $result['status'] = true;
                $result['code'] = 200;
                $result['message'] = 'data terhapus';
                // $result['data'] = $data;
            } else {
                $result['status'] = false;
                $result['code'] = 404;
                $result['message'] = 'something error';        
            }
            return response()->json($result);
            
        } catch (Exception $err) {
            $result['status'] = false;
            $result['code'] = 404;
            $result['message'] = 'something error';  
            return $err->getMessage();  
        }
    }

    public function update(Request $req, $id){
        $result = [];        
        try {
            // validasi isian api
            $validator = Validator::make(request()->all(),[
                'name'=>'required',
                'alamat'=>'required'
            ]);
            
            // jika tidak valid
            if($validator->fails()){
                return response()->json($validator->messages(), 404);
            }
            
            // jika valid
            $data = Mahasiswa::find($id);
            
            if($data) {
                $data->name = $req->name;
                $data->alamat = $req->alamat;
                $data->save();
                
                $result['status'] = true;
                $result['code'] = 200;
                $result['message'] = 'sukses';
                $result['data'] = $data;
            } else {
                $result['status'] = false;
                $result['code'] = 404;
                $result['message'] = 'something error';        
            }
            return response()->json($result);
            
        } catch (Exception $err) {
            return $err->getMessage();  
        }
    }
}
