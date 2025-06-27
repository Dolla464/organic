<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
// Make sure you have a Product model and import it

class CartController extends Controller
{

    //Add a product to the cart or update its quantity.
    public function add(Request $request)
    {
        $request->validate([
            // Laravel's 'exists' rule automatically respects the model's primary key,
            // so 'exists:products,pro_id' is not needed. 'exists:products,id' works
            // if you map 'id' in the request to the primary key. Let's assume the
            // request sends the pro_id as 'product_id'.
            'product_id' => 'required|exists:products,pro_id', // More explicit validation
            'quantity' => 'required|integer|min:1',
        ]);

        // findOrFail will use the 'pro_id' you defined in the model
        $product = Product::findOrFail($request->product_id);

        if ($product->quantity < $request->quantity) {
            return response()->json(['message' => 'Not enough items in stock!'], 422);
        }

        $cart = session()->get('cart', []);

        // Use 'pro_id' as the key in the cart array for consistency
        $productId = $product->pro_id;

        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $request->quantity;
            if ($product->quantity < $newQuantity) {
                return response()->json(['message' => 'Not enough items in stock to add more!'], 422);
            }
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            $cart[$productId] = [
                "name" => $product->pro_title_en,
                "quantity" => (int)$request->quantity,
                // The accessor works perfectly here!
                "price" => $product->price_after_sale,
                "image" => $product->pro_img
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Product added to cart successfully!',
            'cart' => session('cart'),
            'cartItemCount' => count(session('cart')),
        ]);
    }

    //remove a product from the cart
    public function remove(Request $request)
    {
        $request->validate(['product_id' => 'required']);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        // Return a JSON response, just like the add method
        return response()->json([
            'message' => 'Product removed successfully!',
            'cart' => session('cart'),
            'cartItemCount' => count(session('cart')),
        ]);
    }

    // update quantity in the cart 
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,pro_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validatedData['product_id']);
        $cart = session()->get('cart', []);
        $productId = $product->pro_id;

        // Ensure product is actually in the cart
        if (isset($cart[$productId])) {
            // Check stock
            if ($product->quantity < $validatedData['quantity']) {
                return response()->json(['message' => 'Not enough items in stock!'], 422);
            }

            // Update quantity
            $cart[$productId]['quantity'] = (int)$validatedData['quantity'];
            session()->put('cart', $cart);

            return response()->json([
                'message' => 'Cart updated successfully!',
                'cart' => session('cart'),
            ]);
        }

        return response()->json(['message' => 'Item not found in cart.'], 404);
    }
}
