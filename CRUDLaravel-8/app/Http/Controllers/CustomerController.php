<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Nationality;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::all();
        return view('customer.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Nationality::all();
        return view('customer.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'cst_name' => $request->name,
            'nationality_id' => $request->nationality,
            'cst_dob' => $request->dob,
            'cst_email' => $request->email,
            'cst_phoneNum'=>$request->phone
        ];
             
        $save = Customer::create($data);
        foreach ($request->addmorerelasi as $key => $value){
            $family = [
                'fl_relation'=> $request->addmorerelasi[$key],
                'fl_name' => $request->addmorename[$key],
                'fl_dob'=> $request->addmoredob[$key]
            ];
            $save->familyList()->create($family);
        }
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nationality = Nationality::all();
        $data = Customer::with('familyList')->where('cst_id', '=',$id)->first();
        return view('customer.show',compact('data','nationality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nationality = Nationality::all();
        $data = Customer::with('familyList')->where('cst_id', '=',$id)->first();
        return view('customer.edit',compact('data','nationality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all(),$id);
        $data = Customer::with('familyList')->where('cst_id', '=',$id)->first();
        $data->cst_name= $request->name;
        $data->nationality_id= $request->nationality;
        $data->cst_dob= $request->dob;
        $data->cst_phoneNum= $request->phone;
        $data->cst_email= $request->email;
        $data->save();
        $data->familyList()->delete();
        foreach ($request->addmorerelasi as $key => $value){
            $family = [
                'fl_relation'=> $request->addmorerelasi[$key],
                'fl_name' => $request->addmorename[$key],
                'fl_dob'=> $request->addmoredob[$key]
            ];
            $data->familyList()->create($family);
        }
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Customer::with('familyList')->where('cst_id', '=',$id)->first();
        $data->familyList()->delete();
        $data->delete();
        return redirect()->route('customer.index');
    }
}
