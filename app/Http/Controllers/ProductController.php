<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_REQUEST['category'])){
            $products = Product::where('category',$_REQUEST['category'])->get();
        }else{
            $products = Product::all();
        }
        return view('home')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $inputs = $request->except('image','_token');
        if ($request->hasFile('image')) {
            $inputs['image'] = $this->uploadImageFile($request->file('image')); 
        }
        Product::create($inputs);
        return redirect('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('pages.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('pages.create')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $oldimage = isset($request->current_image) ? $request->current_image : '';
        $inputs = $request->except('image','_token','_method','current_image');
        if ($request->hasFile('image')) {
            $inputs['image'] = $this->uploadImageFile($request->file('image')); 
        }else{
            $inputs['image'] = $oldimage;
        }
        Product::where('id',$id)->update($inputs);
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // $product = Product::find($id);
        $product->delete();
        return redirect('home');
    }

    public function uploadImageFile($file) {  
        $destinationPath = public_path('uploads');
        $file->move($destinationPath,$file->getClientOriginalName());
        return $file->getClientOriginalName();
    }
}
