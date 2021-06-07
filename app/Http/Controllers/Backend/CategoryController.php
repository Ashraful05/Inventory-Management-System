<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;
use App\User;
use Auth;

class CategoryController extends Controller
{
    public function addCategory(){
        return view('back-end.category.add-category');
    }
    public function saveCategory(Request $request){
        $category = new Category();
        $category->name=$request->name;
        $category->created_by = Auth::User()->id;
        $category->save();
        return redirect()->route('view-category')->with('message','Category Information added Successfully!!!');
    }
    public function viewCategory(){
        $categories = Category::all();
        return view('back-end.category.view-category',['categories'=>$categories]);
    }
    public function editCategory($id){
        $editCategory = Category::find($id);
        return view('back-end.category.edit-category',['editCategory'=>$editCategory]);
    }
    public function updateCategory(Request $request){
        $category = Category::find($request->category_id);
        $category->name = $request->name;
        $category->updated_by = Auth::User()->id;
        $category->update();
        return redirect()->route('view-category')->with('message','Category Information updated successfully!!!');

    }
    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('view-category')->with('message','Category Information deleted successfully');
    }
}
