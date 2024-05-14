<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\products;

class AdminController extends Controller
{
    //redirect admin to the view category
    public function view_category()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }

    //adding category from the admin
    public function add_category(Request $request)
    {

        $data = new category;
        $data->category_name = $request->category;
        $data->save();

        return redirect()->back()->with('msg', 'Category Added Successfully!!');
    }

    //delete a category by it's id
    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('msg', 'Category Deleted Successfully!!');
    }

    //redirect to the add product view
    public function view_product()
    {

        $category = category::all();
        return view('admin.product', compact('category'));
    }

    //Add Product to db
    public function add_product(Request $request)
    {
        $product = new products;
        $product->title = $request->title;
        $product->description = $request->desc;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->quantity = $request->Quantity;

        $image = $request->image;
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imagename);

        $product->image = $imagename;

        $product->save();

        return redirect()->back()->with('msg', 'Product Added Successfully!!');
    }

    //show Product that admin add it
    public function show_product()
    {
        $products = products::all();
        return view('admin.show_product', compact('products'));
    }

    //Delete product by id
    public function delete_product($id){
        $product = products::find($id);

        $product->delete();

        return redirect()->back()->with('msg', 'Product Deleted Successfully!!');
    }

    //update product by id
    public function update_product($id){

        $product = products::find($id);
        $category = Category::all();
        return view('admin.update_product', compact('product', 'category'));
    }

    //Save the product's update
    public function save_update(Request $request, $id) {
        $product = products::find($id);

        $product->title = $request->title;
        $product->description = $request->desc;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->quantity = $request->Quantity;

        $image = $request->image;

        if($image)
        {
            $imagename = time() ."".$image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->save();

        return redirect()->back()->with('msg','Product Updated Successfully!');
    }
}
