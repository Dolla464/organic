<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\JsonResponse;


class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $products = Product::all();
            
            return response()->json([
                'success' => true,
                'message' => 'Products retrieved successfully',
                'data' => ProductResource::collection($products)
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve products',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    function showproduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $data = [
                "msg" => "Return one Record",
                "status" => 200,
                "data" => new ProductResource($product)
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

    function deleteproduct(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        if ($product) {
            if (File::exists(public_path('/img/products/' . $product->pro_img))) {
                File::delete(public_path('/img/products/' . $product->pro_img));
            }
            $product->delete();
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

    function storeproduct(Request $request)
    {
        $validatedData = validator($request->all(), [
            'prophoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'titleEN' => 'required|unique:products,pro_title_en,' . $request->pro_id . ',pro_id',
            'titleAR' => 'required',
            'descriptionEN' => 'required',
            'descriptionAR' => 'required',
            'originalprice' => 'required|numeric',
            'discount' => 'required|numeric|between:0,100',
            'netprice' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,cat_id',
        ]);

        if ($validatedData->fails()) {
            $data = [
                "msg" => "Validation Required",
                "status" => 201,
                "data" => $validatedData->errors()
            ];
            return response()->json($data);
        }

        if ($request->hasFile("prophoto")) {
            $image = $request->prophoto;
            $imageName = rand(1, 10000) . "_" . time() . "." . $image->extension();
            $image->move(public_path("/img/products/"), $imageName);
        }

        $newRecord = Product::create([
            'pro_img' => $imageName,
            'pro_title_en' => $request->titleEN,
            'pro_title_ar' => $request->titleAR,
            'pro_description_en' => $request->descriptionEN,
            'pro_description_ar' => $request->descriptionAR,
            'original_price' => $request->originalprice,
            'discount' => $request->discount,
            'net_price' => $request->netprice,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);
        $data = [
            "msg" => "Created successfully",
            "status" => 200,
            "data" => new ProductResource($newRecord)
        ];
        return response()->json($data);
    }

    function updateproduct(Request $request)
    {

        $old_id = $request->old_id;
        $validatedData = validator($request->all(), [
            'prophoto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'titleEN' => 'required',
            'titleAR' => 'required',
            'descriptionEN' => 'required',
            'descriptionAR' => 'required',
            'originalprice' => 'required|numeric',
            'discount' => 'required|numeric|between:0,100',
            'netprice' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,cat_id',
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
        $product = Product::find($old_id);
        if ($product) {

            //check if user upload photo or not
            if ($request->hasFile("prophoto")) {
                //to remove the old photo from the public file
                if (File::exists(public_path('/img/products/' . $product->pro_image))) {
                    File::delete(public_path('/img/products/' . $product->pro_image));
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
            $product->net_price = $request['netprice'];
            $product->quantity = $request['quantity'];
            $product->category_id = $request['category_id'];

            $product->save();

            $data = [
                "msg" => "Updated successfully",
                "status" => 200,
                "data" => new ProductResource($product)
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
