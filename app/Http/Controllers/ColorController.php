<?php

namespace App\Http\Controllers;

use App\Color;
use App\Product;
use App\Category;
use App\Language;
use App\LanguageColor;
use App\ProductColor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $colors = Color::paginate();
        $colors->setPath(route('colors.index'));

        //dd($colors);
        return view("colors.lista",compact('colors'));
    }

    public function camposEdicion($id)
    {
        $color = null;
        if($id != null)
            $color = Color::findOrFail($id);

        return ['color' => $color];
    }

    public function guardarDatos($request,$id)
    {
        $data = $request->all();

        $rules = [
            'name' => 'required',
        ];

        $this->validate($request, $rules);


        if($id != null)
            $color = Color::findOrFail($id);
        else
            $color = new Color;

        $color->name = $request->input('name');
        $color->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $camposEdicion = $this->camposEdicion(null);

        //dd($colors);
        //dd($colors);

        return view("colors.crear",$camposEdicion);
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

        Session::flash('message','El color se ha creado correctamente');

        return $redirect->route("colors.index");
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


        return view("colors.edit",$camposEdicion);
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

        Session::flash('message','El color se ha modificado correctamente');

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
        $color = Color::findOrFail($id);
        $color->delete();

        if($request->ajax())
            return "El color ".$color->Name." se ha eliminado correctamente.";
    }

    public function camposTraduccion($id)
    {
        $color = Color::findOrFail($id);

        $languages = Language::orderBy('name','asc')->get();

        $arrayLan = null;

        foreach ($languages as $lan)
        {
            $arrayLan[$lan->id] = ['name' => ''];

            $langCats = LanguageColor::where('id_color', $color->id)
                ->where('id_language', $lan->id);


            if($langCats->count() > 0)
            {
                $langCats = $langCats->first();
                $arrayLan[$lan->id] = ['name' => $langCats->name];
            }
        }

        return ['arrayLan'=>$arrayLan,'languages' => $languages, 'color' => $color];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function translate($id)
    {
        //

        //dd($this->camposTraduccion($id));

        return view("colors.translate",$this->camposTraduccion($id));
    }

    public function guardarTraduccion($request,$id)
    {
        $color = Color::findOrFail($id);
        $color->name = $request->input('name');
        $color->save();

        $languages = Language::get();

        foreach ($languages as $lang)
        {
            $nameLang = $request->input('name'.$lang->id);

            if(trim($nameLang) != "")
            {
                $languages_colors = LanguageColor::where('id_language',$lang->id)
                    ->where('id_color',$color->id)
                    ->first();

                if(!isset($languages_colors->id))
                    $languages_colors = new LanguageColor;

                $languages_colors->id_language = $lang->id;
                $languages_colors->id_color = $color->id;
                $languages_colors->name = $nameLang;
                $languages_colors->save();
            }
            else
            {
                $languages_colors = LanguageColor::where('id_language',$lang->id)
                    ->where('id_color',$color->id)
                    ->first();

                if(isset($languages_colors->id))
                    $languages_colors->delete();
            }
        }
    }

    public function translateUpdate(Request $request, $id, Redirector $redirect)
    {
        //

        $this->guardarTraduccion($request,$id);

        Session::flash('message','Se han guardado las traducciones del color correctamente');

        return $redirect->back();

        //return view("products.translate",$this->camposTraduccion($id));
    }
}
