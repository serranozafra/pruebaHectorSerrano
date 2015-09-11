<?php

namespace App\Http\Controllers;

use App\Category;
use App\Language;
use App\LanguageCategory;
use App\Product;
use App\Color;
use App\CategoryColor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $categories = Category::paginate();
        $categories->setPath(route('categories.index'));

        //dd($categories);
        return view("categories.lista",compact('categories'));
    }

    public function camposEdicion($id)
    {
        $category = null;
        if($id != null)
            $category = Category::findOrFail($id);

        return ['category' => $category];
    }

    public function guardarDatos($request,$id)
    {
        $data = $request->all();

        $rules = [
            'name' => 'required',
        ];

        $this->validate($request, $rules);


        if($id != null)
            $category = Category::findOrFail($id);
        else
            $category = new Category;

        $category->name = $request->input('name');
        $category->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $camposEdicion = $this->camposEdicion(null);

        //dd($categories);
        //dd($colors);

        return view("categories.crear",$camposEdicion);
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

        Session::flash('message','La categor&iacute;a se ha creado correctamente');

        return $redirect->route("categories.index");
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


        return view("categories.edit",$camposEdicion);
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

        Session::flash('message','La categor&iacute;a se ha modificado correctamente');

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
        $category = Category::findOrFail($id);

        $product = Product::where('id_category',$category->id)
                            ->update(['id_category' => null]);


        $category->delete();

        if($request->ajax())
            return "La categoria ".$category->Name." se ha eliminado correctamente.";
    }

    public function camposTraduccion($id)
    {
        $categoria = Category::findOrFail($id);

        $languages = Language::orderBy('name','asc')->get();

        $arrayLan = null;

        foreach ($languages as $lan)
        {
            $arrayLan[$lan->id] = ['name' => ''];

            $langCats = LanguageCategory::where('id_category', $categoria->id)
                ->where('id_language', $lan->id);


            if($langCats->count() > 0)
            {
                $langCats = $langCats->first();
                $arrayLan[$lan->id] = ['name' => $langCats->name];
            }
        }

        return ['arrayLan'=>$arrayLan,'languages' => $languages, 'category' => $categoria];
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

        return view("categories.translate",$this->camposTraduccion($id));
    }

    public function guardarTraduccion($request,$id)
    {
        $categoria = Category::findOrFail($id);
        $categoria->name = $request->input('name');
        $categoria->save();

        $languages = Language::get();

        foreach ($languages as $lang)
        {
            $nameLang = $request->input('name'.$lang->id);

            if(trim($nameLang) != "")
            {
                $languages_categories = LanguageCategory::where('id_language',$lang->id)
                    ->where('id_category',$categoria->id)
                    ->first();

                if(!isset($languages_categories->id))
                    $languages_categories = new LanguageCategory;

                $languages_categories->id_language = $lang->id;
                $languages_categories->id_category = $categoria->id;
                $languages_categories->name = $nameLang;
                $languages_categories->save();
            }
            else
            {
                $languages_categories = LanguageCategory::where('id_language',$lang->id)
                    ->where('id_category',$categoria->id)
                    ->first();

                if(isset($languages_categories->id))
                    $languages_categories->delete();
            }
        }
    }

    public function translateUpdate(Request $request, $id, Redirector $redirect)
    {
        //

        $this->guardarTraduccion($request,$id);

        Session::flash('message','Se han guardado las traducciones de la categor&iacute;a correctamente');

        return $redirect->back();

        //return view("products.translate",$this->camposTraduccion($id));
    }
}
