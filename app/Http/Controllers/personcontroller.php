<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\persons;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;


class personcontroller extends Controller
{
    public function veiw()
    {
        $persons = persons::paginate(5);
        return view('/crud')->with('persons',$persons);
        
    }
   
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $reg)
    {
        $validation=$reg->validate([
            'email'=>'required|min:10|unique:employess',
            'phone'=>'required|unique:employess'
        ]);
       
        $name=$reg->input('name');
        $email=$reg->input('email');
        $address=$reg->input('address');
        $phone=$reg->input('phone');
        $data= array('name'=>$name,"email"=>$email,"address"=>$address,"phone"=>$phone);
        DB::table('employess')->insert($data);
        return redirect('/view'); 
     
        
    }
    public function update($id,Request $reg)
    {
        $personss = persons::find($id);
        return response()->json($personss);
    }
    public function edit(Request $reg)
    {
        $id=$reg->input('id');
        $personss = persons::find($id);
        $personss->name=$reg->input('name');
        $personss->email=$reg->input('email');
        $personss->address=$reg->input('address');
        $personss->phone=$reg->input('phone');
        $personss->save();
        return redirect('/view'); 

    }
    public function delete(Request $reg)
    {
        $id=$reg->input('delete_id');
        $personss = persons::find($id);
        $personss->delete();
        return redirect('/view'); 

    }
}
