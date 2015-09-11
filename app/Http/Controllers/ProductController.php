<?php

namespace App\Http\Controllers;

use App\Language;
use App\LanguageProduct;
use App\Product;
use App\Category;
use App\Color;
use App\ProductColor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $products = Product::orderBy('name','asc')->paginate();
        $products->setPath(route('products.index'));

        //dd($products);
        return view("products.lista",compact('products'));
    }

    public function camposEdicion($id)
    {
        $product = null;
        if($id != null)
            $product = Product::findOrFail($id);

        $categories = Category::orderBy('name', 'asc')->get();
        $arrayCat = null;
        $arrayCol = null;
        $checked = null;

        foreach ($categories as $cat)
        {
            $arrayCat[$cat->id] = $cat->name;
        }

        $colors = Color::orderBy('name', 'asc')->get();

        foreach($colors as $col)
        {
            $arrayCol[$col->id] = ['name'=>$col->name,'checked' => ""];

            if(isset($product))
            {
                $checkColor = ProductColor::where('id_product', $product->id)
                    ->where('id_color', $col->id)
                    ->count();

                if($checkColor > 0)
                    $arrayCol[$col->id]['checked'] = "checked";
            }
        }

        return ['arrayCat'=>$arrayCat,'colors' => $arrayCol, 'product' => $product];
    }

    public function guardarDatos($request,$id)
    {
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'id_category' => 'required'
        ];

        $this->validate($request, $rules);


        if($id != null)
            $producto = Product::findOrFail($id);
        else
            $producto = new Product;

        $producto->name = $request->input('name');
        $producto->description = $request->input('description');
        $producto->price = $request->input('price');
        $producto->id_category = $request->input('id_category');
        $producto->save();

        $colors = Color::orderBy('name', 'asc')->get();

        foreach ($colors as $col)
        {
            $checkColor = $request->input('color'.$col->id);

            if(isset($checkColor))
            {
                $products_colors = ProductColor::where('id_color',$col->id)
                    ->where('id_product',$producto->id)
                    ->first();

                if(!isset($products_colors->id))
                    $products_colors = new ProductColor;

                $products_colors->id_color = $col->id;
                $products_colors->id_product = $producto->id;

                $products_colors->save();
            }
            else
            {
                $products_colors = ProductColor::where('id_color',$col->id)
                    ->where('id_product',$producto->id)
                    ->first();

                if(isset($products_colors->id))
                    $products_colors->delete();
            }
        }
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

        return view("products.crear",$camposEdicion);
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

        Session::flash('message','El producto se ha creado correctamente');

        return $redirect->route("products.index");
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

    public function camposTraduccion($id)
    {
        $product = Product::findOrFail($id);

        $languages = Language::orderBy('name','asc')->get();

        $arrayLan = null;

        foreach ($languages as $lan)
        {
            $arrayLan[$lan->id] = ['name' => '', 'description' => ''];

            $langProds = LanguageProduct::where('id_product', $product->id)
                ->where('id_language', $lan->id);


            if($langProds->count() > 0)
            {
                $langProds = $langProds->first();
                $arrayLan[$lan->id] = ['name' => $langProds->name, 'description' => $langProds->description];
            }
        }

        return ['arrayLan'=>$arrayLan,'languages' => $languages, 'product' => $product];
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

        return view("products.translate",$this->camposTraduccion($id));
    }

    public function guardarTraduccion($request,$id)
    {
        $producto = Product::findOrFail($id);
        $producto->name = $request->input('name');
        $producto->description = $request->input('description');
        $producto->save();

        $languages = Language::get();

        foreach ($languages as $lang)
        {
            $nameLang = $request->input('name'.$lang->id);
            $descLang = $request->input('description'.$lang->id);

            if(trim($nameLang) != "" && trim($descLang) != "")
            {
                $languages_products = LanguageProduct::where('id_language',$lang->id)
                    ->where('id_product',$producto->id)
                    ->first();

                if(!isset($languages_products->id))
                    $languages_products = new LanguageProduct;

                $languages_products->id_language = $lang->id;
                $languages_products->id_product = $producto->id;
                $languages_products->name = $nameLang;
                $languages_products->description = $descLang;
                $languages_products->save();
            }
            else
            {
                $languages_products = LanguageProduct::where('id_language',$lang->id)
                    ->where('id_product',$producto->id)
                    ->first();

                if(isset($languages_products->id))
                    $languages_products->delete();
            }
        }
    }

    public function translateUpdate(Request $request, $id, Redirector $redirect)
    {
        //

        $this->guardarTraduccion($request,$id);

        Session::flash('message','Se han guardado las traducciones del producto correctamente');

        return $redirect->back();

        //return view("products.translate",$this->camposTraduccion($id));
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


        return view("products.edit",$camposEdicion);
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

        Session::flash('message','El producto se ha modificado correctamente');

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
        $product = Product::findOrFail($id);
        $product->delete();

        if($request->ajax())
            return "El producto ".$product->Name." se ha eliminado correctamente.";
    }
}
