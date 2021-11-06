<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Add a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $req)
    {
        try {
            $rules = [
                // "id" => "required",
                "name" => "required|max:255",
                "description" => "required|max:255",
                "price" => "required|max:255",
                "image" => "required|max:255",

            ];

            $validatedData = Validator::make($req->all(), $rules);
            if ($validatedData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => "Incorrect data"
                ]);
            }
            $validatedData = $req->validate($rules);

            $Product = Product::create($validatedData);
            if ($Product) {
                return response()->json([
                    "success" => true,
                    "message" => "Product created",
                    "data" => $Product
                ], 201);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "create Product fail",
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Server error, try again later!",
            ], 500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        try {
            // $Products = Product::orderBy('name', 'DESC')->get();
            $Products = Product::all();

            if ($Products) {
                return response()->json([
                    "success" => true,
                    "message" => "get Product success",
                    "data" => $Products
                ], 200);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "get Product failed",
                    "data" => []

                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function showProduct($id)
    {
        try {
            $Product = Product::find($id);
            if ($Product) {
                return response()->json([
                    "success" => true,
                    "message" => "Product exist",
                    "data" => $Product
                ], 200);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "Product not exist",
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Server error, try again later!",
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        try {
            $Product = Product::findOrFail($id);
            // dd($Product->original);
            if ($Product) {
                $Product->delete();
                return response()->json([
                    "success" => true,
                    "message" => "Product deleted",
                    "data" => $Product
                ], 200);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "Product not exist",
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Server error, try again later!",
            ], 500);
        }
    }
}
