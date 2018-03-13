<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Distrito;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;

class DistritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distritos = new Distrito;

        if (request()->has('nome')){
            $distritos = $distritos->where('nome', 'like', '%' . request('nome') . '%');
        }

        $distritos = $distritos->orderby('nome')->paginate(15);
        
        return view('distrito.index',compact('distritos'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('distrito.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Distrito::create($request->all());

        Session::flash('create_distrito', 'distrito cadastrado com sucesso!');

        return redirect(route('distrito.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $distrito = Distrito::findOrFail($id);
        
           return view('distrito.show', compact('distrito'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $distrito = Distrito::findOrFail($id);       
        
        return view('distrito.edit', compact('distrito'));
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
        $distrito = Distrito::findOrFail($id);
            
        $distrito->update($request->all());
        
        Session::flash('edited_distrito', 'distrito alterado com sucesso!');

        return redirect(route('distrito.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Distrito::findOrFail($id)->delete();
        
        Session::flash('deleted_distrito', 'distrito excluído com sucesso!');
        
        return redirect(route('distrito.index'));
    }
}
