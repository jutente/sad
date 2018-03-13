<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produto;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = new produto;

        if (request()->has('nome')){
            $produtos = $produtos->where('nome', 'like', '%' . request('nome') . '%');
        }

        $produtos = $produtos->orderby('nome')->paginate(15);
        
        return view('produto.index',compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        produto::create($request->all());

        Session::flash('create_produto', 'produto cadastrado com sucesso!');

        return redirect(route('produto.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = produto::findOrFail($id);
        
           return view('produto.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = produto::findOrFail($id);       
        
        return view('produto.edit', compact('produto'));
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
        $produto = produto::findOrFail($id);
            
        $produto->update($request->all());
        
        Session::flash('edited_produto', 'produto alterado com sucesso!');

        return redirect(route('produto.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        produto::findOrFail($id)->delete();
        
        Session::flash('deleted_produto', 'produto excluído com sucesso!');
        
        return redirect(route('produto.index'));
    }
}
