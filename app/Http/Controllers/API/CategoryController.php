<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(8);

        $categories->getCollection()->transform(function ($category) {
            return $category;
        });

        return response()->json($categories);
    }

    public function showcategory($id)
    {
        // Validate ID is numeric
        if (!is_numeric($id)) {
            return response()->json([
                "success" => false,
                "message" => "Invalid ID format",
                "data" => null
            ], 400);
        }

        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    "success" => false,
                    "message" => "Category not found",
                    "data" => null
                ], 404);
            }

            return response()->json([
                "success" => true,
                "message" => "Category retrieved successfully",
                "data" => new CategoryResource($category)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Server error",
                "error" => $e->getMessage(),
                "data" => null
            ], 500);
        }
    }

    function deletecategory(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
        if ($category) {
            if (File::exists(public_path('/img/categories/' . $category->cat_image))) {
                File::delete(public_path('/img/categories/' . $category->cat_image));
            }
            $category->delete();
            $data = [
                "msg" => "Deleted successfully",
                "status" => 200,
                "data" => null
            ];
            return response()->json($data);
        } else {
            $data = [
                "msg" => "No Such ID",
                "status" => 201,
                "data" => null
            ];
            return response()->json($data);
        }
    }

    function storecategory(Request $request)
    {
        $validatedData = validator($request->all(), [
            'catphoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'titleEN' => 'required|unique:categories,cat_title_en,' . $request->cat_id . ',cat_id',
            'titleAR' => 'required',
            'descriptionEN' => 'required',
            'descriptionAR' => 'required',
            'discount' => 'required',
        ]);

        if ($validatedData->fails()) {
            $data = [
                "msg" => "Validation Required",
                "status" => 201,
                "data" => $validatedData->errors()
            ];
            return response()->json($data);
        }

        if ($request->hasFile("catphoto")) {
            $image = $request->catphoto;
            $imageName = rand(1, 10000) . "_" . time() . "." . $image->extension();
            $image->move(public_path("/img/categories/"), $imageName);
        }

        $newRecord = Category::create([
            'cat_image' => $imageName,
            'cat_title_en' => $request->titleEN,
            'cat_title_ar' => $request->titleAR,
            'cat_description_en' => $request->descriptionEN,
            'cat_description_ar' => $request->descriptionAR,
            'discount' => $request->discount,
        ]);
        $data = [
            "msg" => "Created successfully",
            "status" => 200,
            "data" => new CategoryResource($newRecord)
        ];
        return response()->json($data);
    }

    function updatecategory(Request $request)
    {

        $old_id = $request->old_id;
        $validatedData = validator($request->all(), [
            'cat_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'titleEN' => 'required',
            'titleAR' => 'required',
            'descriptionEN' => 'required',
            'descriptionAR' => 'required',
            'discount' => 'required',
        ]);

        if ($validatedData->fails()) {
            $data = [
                "msg" => "Validation Required",
                "status" => 201,
                "data" => $validatedData->errors()
            ];
            return response()->json($data);
        }

        //find category
        $category = Category::find($old_id);
        if ($category) {

            //check if user upload photo or not
            if ($request->hasFile("catphoto")) {
                //to remove the old photo from the public file
                if (File::exists(public_path('/img/categories/' . $category->cat_image))) {
                    File::delete(public_path('/img/categories/' . $category->cat_image));
                }

                $image = $request->catphoto;
                $imageName = rand(1, 10000) . "_" . time() . "." . $image->extension();
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
            $data = [
                "msg" => "Updated successfully",
                "status" => 200,
                "data" => new CategoryResource($category)
            ];
            return response()->json($data);
        } else {
            $data = [
                "msg" => "No such ID",
                "status" => 203,
                "data" => null
            ];
            return response()->json($data);
        }
    }
}
