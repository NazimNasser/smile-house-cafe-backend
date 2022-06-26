<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryApiController extends Controller
{
    public function index()
    {
        // return CategoryResource::collection(Category::all());
                $category  = Category::all();
                $respond = [
                    'status'=> 201,
                    'message' => "All Category",
                    'data' => $category,
                ];
        
                return $respond;
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function get($id){
        $category= Category::find($id);

        if(!isset($category)){

            $respond = [
                'status'=> 404,
                'message' => "Category of id=$id doesn't exist",
                'data' => $category,
            ];

            return $respond;
        }

        $respond = [
            'status'=> 201,
            'message' => "Category of id $id",
            'data' => $category,
        ];

        return $respond;
    }


    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'title' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            $respond = [
                'status'=> 404,
                'message' =>  $validator->errors()->first(),
                'data' => null,
            ];

            return $respond;
        }
        if ($files = $request->file('pic')) {
            $destinationPath = 'image/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
        }

        $category = new Category;
        $category->type = $request->type;
        $category->pic = $profileImage;
        $category->title = $request->title;
        $category->price = $request->price;
        $category->quantity = $request->quantity;
        $category->description = $request->description;
        $category->save();

        $respond = [
            'status' => 200,
            'message' => 'Category Created',
            'data' => $category,
        ];

        return $category;

    }
    public function update(Request $request, $id){

        $category = Category::find($id);


        if(isset($category)){

            $validator = Validator::make($request->all(), [
                'type' => 'string',
                'pic' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
                'title' => 'string',
                'price' => 'integer',
                'quantity' => 'integer',
                'description' => 'string',
            ]);

            if ($validator->fails()) {
                $respond = [
                    'status'=> 404,
                    'message' =>  $validator->errors()->first(),
                    'data' => null,
                ];

                return $respond;
            }

            if ($files = $request->file('pic')) {
                $destinationPath = 'image/'; // upload path
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
            }

            $request->type? $category->type = $request->type: null;
            $request->pic? $category->pic = $profileImage: null;
            $request->title? $category->title = $request->title: null;
            $request->price? $category->price = $request->price: null;
            $request->quantity? $category->quantity = $request->quantity: null;
            $request->description? $category->description = $request->description: null;
            $category->save();

            $respond = [
                'status'=> 201,
                'message' =>  "category updated successfully",
                'data' => $category,
            ];

            return $respond;
        }

        $respond = [
            'status'=> 404,
            'message' =>  "category with id=$id doesn't exist",
            'data' => null,
        ];

        return $respond;
    }
    public function delete($id){

        $category = Category::find($id);

        if(isset($category)){
            $category->delete();
            $all_categorys = Category::all();

            $respond = [
                'status'=> 201,
                'message' =>  "Successfully Deleted",
                'data' => $all_categorys,
            ];
            return $respond;
        }

            $respond = [
                'status'=> 404,
                'message' =>  "category with id=$id doesn't exist",
                'data' => null,
            ];

        return $respond;

    }
}

