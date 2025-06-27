<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        //$product = Product::all();
        $product = DB::table('products')->select("pro_id","pro_img","pro_title_".app()->getLocale() . " as title","pro_description_".app()->getLocale() . " as description","original_price","discount","net_price","quantity","category_id","created_at","updated_at")->get();
        return view('products.products', ["resultProduct" => $product]);
    }

    public function show($pro_id)
    {
        $product = Product::findOrFail($pro_id);
        return view('products.show', ["resultChoosenProduct" => $product]);
    }

    public function delete($pro_id)
    {
        $product = Product::findOrFail($pro_id);
        $product->delete();
        return redirect()->route('products')->with('success', 'Product Deleted Successfully');
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', ['resultCategory' => $categories]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prophoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'titleEN' => 'required|unique:products,pro_title_en,' . $request->pro_id . ',pro_id',
            'titleAR' => 'required',
            'descriptionEN' => 'required',
            'descriptionAR' => 'required',
            'originalprice' => 'required|numeric',
            'discount' => 'required|numeric|between:0,100',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,cat_id',
        ]);

        if ($request->hasFile("prophoto")) {
            $image = $request->prophoto;
            $imageName = rand(1, 10000) . "_" . time() . "." . $image->extension();
            $image->move(public_path("/img/products/"), $imageName);
        }

        Product::create([
            'pro_img' => $imageName,
            'pro_title_en' => $request->titleEN,
            'pro_title_ar' => $request->titleAR,
            'pro_description_en' => $request->descriptionEN,
            'pro_description_ar' => $request->descriptionAR,
            'original_price' => $request->originalprice,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('products')->with('success', 'Product created successfully!');
    }

    public function edit($pro_id)
    {
        $categories = Category::all();

        $product = Product::findOrFail($pro_id);

        return view('products.edit', ['product' => $product, 'resultCategory' => $categories]);
    }

    public function updatestore(Request $request, $pro_id)
    {
        //find product
        $product = Product::findOrFail($pro_id);

        $validatedData = $request->validate([
            'prophoto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'titleEN' => 'required',
            'titleAR' => 'required',
            'descriptionEN' => 'required',
            'descriptionAR' => 'required',
            'originalprice' => 'required|numeric',
            'discount' => 'required|numeric|between:0,100',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,cat_id',
        ]);

        //check if user upload photo or not
        if ($request->hasFile("prophoto")) {

            //to remove the old photo from the public file
            if (File::exists(public_path('/img/products/' . $product->pro_img))) {
                File::delete(public_path('/img/products/' . $product->pro_img));
            }

            $image = $request->prophoto;
            $imageName = rand(1, 10000) . "_" . time() . "." . $image->extension();
            $image->move(public_path("/img/products/"), $imageName);
        } else {
            $imageName = $product->pro_img;
        }

        //update product fields
        $product->pro_img = $imageName;
        $product->pro_title_en = $request['titleEN'];
        $product->pro_title_ar = $request['titleAR'];
        $product->pro_description_en = $request['descriptionEN'];
        $product->pro_description_ar = $request['descriptionAR'];
        $product->original_price = $request['originalprice'];
        $product->discount = $request['discount'];
        $product->quantity = $request['quantity'];
        $product->category_id = $request['category_id'];

        $product->save();

        return redirect()->route('products')->with('success', 'Product updated successfully!');
    }
}
