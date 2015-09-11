<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Color;
use App\ProductColor;
use App\Language;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $languages = Language::paginate();
        $languages->setPath(route('languages.index'));

        //dd($languages);
        return view("languages.lista",compact('languages'));
    }

    public function camposEdicion($id)
    {
        $language = null;
        if($id != null)
            $language = Language::findOrFail($id);

        return ['language' => $language];
    }

    public function guardarDatos($request,$id)
    {
        $data = $request->all();

        $rules = [
            'name' => 'required',
        ];

        $this->validate($request, $rules);


        if($id != null)
            $language = Language::findOrFail($id);
        else
            $language = new Language;

        $language->name = $request->input('name');
        $language->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $camposEdicion = $this->camposEdicion(null);

        //dd($languages);
        //dd($languages);

        return view("languages.crear",$camposEdicion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request,Redirector $redirect)
    {
        //
        $this->guardarDatos($request,null);

        Session::flash('message','El idioma se ha creado correctamente');

        return $redirect->route("languages.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //


        $camposEdicion = $this->camposEdicion($id);


        return view("languages.edit",$camposEdicion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id, Redirector $redirect)
    {
        //
        $this->guardarDatos($request,$id);

        Session::flash('message','El idioma se ha modificado correctamente');

        return $redirect->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $language = Language::findOrFail($id);
        $language->delete();

        if($request->ajax())
            return "El idioma ".$language->Name." se ha eliminado correctamente.";
    }
}
