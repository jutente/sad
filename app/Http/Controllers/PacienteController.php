<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Paciente;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = new Paciente;

        if (request()->has('nome')){
            $pacientes = $pacientes->where('nome', 'like', '%' . request('nome') . '%');
        }

        $pacientes = $pacientes->orderby('nome')->paginate(15);
        
        return view('paciente.index',compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paciente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Paciente::create($request->all());

        Session::flash('create_paciente', 'paciente cadastrado com sucesso!');

        return redirect(route('paciente.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);
        
           return view('paciente.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);       
        
        return view('paciente.edit', compact('paciente'));
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
        $paciente = Paciente::findOrFail($id);
            
        $paciente->update($request->all());
        
        Session::flash('edited_paciente', 'paciente alterado com sucesso!');

        return redirect(route('paciente.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Paciente::findOrFail($id)->delete();
        
        Session::flash('deleted_paciente', 'paciente excluído com sucesso!');
        
        return redirect(route('paciente.index'));
    }
}
