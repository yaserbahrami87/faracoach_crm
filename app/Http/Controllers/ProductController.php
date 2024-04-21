<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::orderby('id','desc')
                    ->get();
        return view('admin.products.products')
                            ->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::where('type','product')
                    ->where('status',1)
                    ->get();

        return view('admin.products.product-insert')
                            ->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'product'    =>'required|unique:products,product',
           'shortlink'  =>'required|unique:products,shortlink,',
           'image'      =>'required|max:200',
           'fi'         =>'required|numeric',
           'fi_off'     =>'required|numeric',
           'info'       =>'required|',
           'category_id'=>'required|array'
        ]);

        $product=Product::create($request->all()+
                [
                    'user_id'   =>Auth::user()->id
                ]
        );

        $product->categories()->attach($request->category_id);
        if($product)
        {
            alert()->success('محصول با موفقیت اضافه شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در اضافه کردن محصول')->persistent('بستن');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.product_single')
                            ->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories=Category::where('status','1')
                    ->get();
        return view('admin.products.product-edit')
                        ->with('categories',$categories)
                        ->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product'    =>'required|unique:products,product,'.$product->id,
            'shortlink'  =>'required|unique:products,shortlink,'.$product->id,
            'image'      =>'required|max:200',
            'fi'         =>'required|numeric',
            'fi_off'     =>'required|numeric',
            'info'       =>'required|',
            'category_id'=>'required|array'
        ]);

        $status=$product->update($request->all());
        DB::table('category_product')
                            ->where('product_id',$product->id)
                            ->delete();
        $product->categories()->attach($request->category_id);

        if($status)
        {
            alert()->success('دوره با موفقیت بروزرسانی شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در بروزرسانی')->persistent('بستن');
        }

        return redirect('/admin/products');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $status=$product->delete();
        if($status)
        {
            alert()->success('دوره با موفقیت حذف شد')->persistent('بستن');
        }
        else
        {
            alert()->error('خطا در حذف دوره')->persistent('بستن');
        }

        return back();
    }

    public function showAll()
    {
        $products=Product::where('status',1)
                    ->get();

        return view('products.products')
                    ->with('products',$products);
    }
}
