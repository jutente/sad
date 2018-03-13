<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Distrito;
use App\Unidade;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;

class UnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = new Unidade;

        // filtros
        if (request()->has('nome')){
            $unidades = $unidades->where('nome', 'like', '%' . request('nome') . '%');
        }

        $unidades = $unidades->orderby('nome')->paginate(15);

        return view('unidade.index',compact('unidades')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setors = Setor::orderBy('nome')->pluck('nome', 'id');

        return view('unidade.create', compact('unidades','setors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Unidade::create($request->all());

        Session::flash('create_unidade', 'Unidade cadastrado com sucesso!');

        return redirect(route('unidade.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidade = Unidade::findOrFail($id);
        
           return view('unidade.show', compact('unidade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidade = Unidade::findOrFail($id);       
        
        return view('unidade.edit', compact('unidade'));
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
        $unidade = Unidade::findOrFail($id);
            
        $unidade->update($request->all());
        
        Session::flash('edited_unidade', 'unidade alterado com sucesso!');

        return redirect(route('unidade.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unidade::findOrFail($id)->delete();
        
        Session::flash('deleted_unidade', 'Unidade excluído com sucesso!');
        
        return redirect(route('unidade.index'));
    }
}
