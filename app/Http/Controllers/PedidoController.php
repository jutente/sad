<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = new Pedido;
           
       
        // filtros
        if (request()->has('unidade_id')){
            $pedidos = $pedidos->where('unidade_id', '=', request('unidade_id'));
        }

        if (request()->has('paciente_id')){
            if (request('paciente_id') != ""){
                $pedidos = $pedidos->where('paciente_id', '=', request('paciente_id'));
            }
        }

        if (request()->has('profissional_id')){
            if (request('profissional_id') != ""){
                $pedidos = $pedidos->where('profissional_id', '=', request('profissional_id'));
            }
        }

        if (request()->has('parametro_id')){
            if (request('parametro_id') != ""){
                $pedidos = $pedidos->where('parametro_id', '=', request('parametro_id'));
            }
        }

     
     
        // ordenando
      $pedidos = $pedidos->orderby('id')->paginate(15);  
      
      $profissionals =  Profissional::orderBy('nome')->pluck('nome', 'id');
      $unidades = Unidade::orderBy('nome')->pluck('nome', 'id');     
      $pacientes = Paciente::orderBy('nome')->pluck('nome', 'id'); 
     
    
      return view('pedido.index', compact('pedidos', 'profissionals', 'unidades', 'pacientes')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profissionals =  Profissional::orderBy('nome')->pluck('nome', 'id');
        $unidades = Unidade::orderBy('nome')->pluck('nome', 'id');     
        $pacientes = Paciente::orderBy('nome')->pluck('nome', 'id'); 
      
      return view('pedido.create', compact('profissionals', 'unidades', 'pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        pedido::create($request->all());

        Session::flash('create_pedido', 'pedido cadastrado com sucesso!');

        return redirect(route('pedido.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = pedido::findOrFail($id);
        
           return view('pedido.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = pedido::findOrFail($id);    
        
        $profissionals =  Profissional::orderBy('nome')->pluck('nome', 'id');
        $unidades = Unidade::orderBy('nome')->pluck('nome', 'id');     
        $pacientes = Paciente::orderBy('nome')->pluck('nome', 'id'); 
        
        return view('pedido.edit', compact('pedido', 'profissionals', 'unidades', 'pacientes'));
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
        $pedido = pedido::findOrFail($id);
                   
        $pedido->update($request->all());        
       
        Session::flash('edited_pedido', 'pedido alterado com sucesso!');

        return redirect(route('pedido.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        pedido::findOrFail($id)->delete();
        
        Session::flash('deleted_pedido', 'pedido excluído com sucesso!');
        
        return redirect(route('pedido.index'));
    }
}
