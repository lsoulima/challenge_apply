<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
                "parent_category" => "required|max:255"
            ];

            $validatedData = Validator::make($req->all(), $rules);
            if ($validatedData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => "Incorrect data"
                ]);
            }
            $validatedData = $req->validate($rules);

            $Category = Category::create($validatedData);
            if ($Category) {
                return response()->json([
                    "success" => true,
                    "message" => "Category created",
                    "data" => $Category
                ], 201);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "create Category fail",
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
            // $Categories = Category::orderBy('name', 'DESC')->get();
            $Categories = Category::all();

            if ($Categories) {
                return response()->json([
                    "success" => true,
                    "message" => "get category success",
                    "data" => $Categories
                ], 200);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "get category failed",
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
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function showCategory($id)
    {
        try {
            $Category = Category::find($id);
            if ($Category) {
                return response()->json([
                    "success" => true,
                    "message" => "Category exist",
                    "data" => $Category
                ], 200);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "Category not exist",
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
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        try {
            $Category = Category::findOrFail($id);
            // dd($Category->original);
            if ($Category) {
                $Category->delete();
                return response()->json([
                    "success" => true,
                    "message" => "Category deleted",
                    "data" => $Category
                ], 200);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "Category not exist",
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
