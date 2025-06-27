<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        //$category = Category::all();
        $category = DB::table('categories')->select("cat_id","cat_image","cat_title_".app()->getLocale() . " as title","cat_description_".app()->getLocale() . " as description","discount","created_at","updated_at")->get();
        return view('categories.categories', ["resultCategory" => $category]);
    }

    public function show($cat_id)
    {
        $category = Category::findOrFail($cat_id);
        return view('categories.show', ["resultChoosenCategory" => $category]);
    }

    public function delete($cat_id)
    {
        $category = Category::findOrFail($cat_id);
        $category->delete();
        return redirect()->route('categories')->with('success', 'Category Deleted Successfully');
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'catphoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'titleEN' => 'required|unique:categories,cat_title_en,' . $request->cat_id . ',cat_id',
            'titleAR' => 'required',
            'descriptionEN' => 'required',
            'descriptionAR' => 'required',
            'discount' => 'required',
        ]);

        if($request->hasFile("catphoto"))
        {
            $image = $request->catphoto;
            $imageName = rand(1,10000)."_" . time()."." .$image->extension();
            $image->move(public_path("/img/categories/"),$imageName);
        }

        Category::create([
            'cat_image' => $imageName,
            'cat_title_en' => $request->titleEN,
            'cat_title_ar' => $request->titleAR,
            'cat_description_en' => $request->descriptionEN,
            'cat_description_ar' => $request->descriptionAR,
            'discount' => $request->discount,
        ]);
        return redirect()->route('categories')->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function updatestore(Request $request,$cat_id)
    {
        //find category
        $category=Category::findOrFail($cat_id);

        $validatedData = $request->validate([
            'catphoto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'titleEN' => 'required',
            'titleAR' => 'required',
            'descriptionEN' => 'required',
            'descriptionAR' => 'required',
            'discount' => 'required',
        ]);

        //check if user upload photo or not
        if($request->hasFile("catphoto"))
        {
            //to remove the old photo from the public file
            if (File::exists(public_path('/img/categories/' . $category->cat_image))) {
                File::delete(public_path('/img/categories/' . $category->cat_image));
            }
            
            $image = $request->catphoto;
            $imageName = rand(1,10000) . "_" . time() . "." . $image->extension();
            $image->move(public_path("/img/categories/"), $imageName);
        } else {
            $imageName = $category->cat_image;
        
        }

        //update category fields
        $category->cat_image = $imageName;
        $category->cat_title_en = $request['titleEN'];
        $category->cat_title_ar = $request['titleAR'];
        $category->cat_description_en = $request['descriptionEN'];
        $category->cat_description_ar = $request['descriptionAR'];
        $category->discount = $request['discount'];

        $category->save();

        return redirect()->route('categories')->with('success', 'Category updated successfully!');

    }
}
