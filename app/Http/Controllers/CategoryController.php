<?php

namespace App\Http\Controllers;

use App\models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = Category::get();
        //return view("category.index")->with("items",$items);
        return view("admin.categories.index")->withItems($items);
    }
    public function SearchPaging(Request $request)
    {

        $q = $request->get("q")??'';
        $items = Category::where('name', 'like', "%{$q}%")
                  ->paginate(5)
                  ->appends(["q"=>$q]);;

        return view("admin.categories.search-paging")->with('items',$items);
    }

    public function search(Request $request)
    {
        $q = $request->get("q")??'';
        $items = Category::where('name', 'like', "%{$q}%")
            ->paginate(5)
            ->appends(["q"=>$q]);;
        return view("admin.categories.search-paging")->withItems($items);
    }

    public function paging()
    {
        //
        $items = Category::paginate(4);
        //return view("category.index")->with("items",$items);
        return view("admin.categories.paging")->withItems($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if(!$request->show){
            $request['show']=0;
        }
        Category::create($request->all());
        session()->flash("msg", "s: Created Successfully");
        return redirect(route("category.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view("admin.categories.show")->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Category = Category::find($id);
        if($Category==null){
            session()->flash("msg", "e: The Category was not found");
            return redirect(route("category.index"));
        }
        $categories = Category::all();
        return view("admin.categories.edit")->withCategory($Category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request,$id)
    {
        if(!$request->show){
            $request['show']=0;
        }
        Category::find($id)->update($request->all());

        session()->flash("msg", "i: Category Updated Successfully");
        return redirect(route("category.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Product::destroy($id);
        $Category = Category::find($id);
        if(!$Category){
            session()->flash("msg", "e: The Category was not found");
            return redirect(route("category.index"));
        }
        $Category->delete();
        session()->flash("msg", "w: Category Deleted Successfully");
        return redirect(route("category.index"));
    }
}
