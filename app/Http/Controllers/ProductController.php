<?php

namespace App\Http\Controllers;

use App\Models\Blog\Category;
use App\Models\Brand;
use App\Models\Good;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goods      = Good::whereStatus(true)->get();
        $categories = Category::whereStatus(true)->whereType( true)->get();
        $brands     = Brand::whereStatus(true)->get();
        return view('product.create', compact('goods', 'categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'good_id'       => 'required',
            'category_id'   => 'required',
            'brand_id'      => 'required',
            'model'         => 'required|min:2|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);

        $data = new Product();
        $data->good_id      = $request->good_id;
        $data->category_id  = $request->category_id;
        $data->brand_id     = $request->brand_id;
        $data->model        = $request->model;
        $data->details      = $request->details;

        if ($request->hasfile('image')) {
            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path      = $request->file('image')->storeAs('products', $imageName, 'public');
            $data->image = '/storage/' . $path;
        }

        $data->save();

        notify()->success("Product Created Successfully", "Success");
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product    = Product::with('category')->findOrFail($id);
        $goods      = Good::whereStatus(true)->get();
        $categories = Category::whereStatus(true)->whereType( true)->get();
        $brands     = Brand::whereStatus(true)->get();
        return view('product.edit', compact('product', 'goods', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'good_id'       => 'required',
            'category_id'   => 'required',
            'brand_id'      => 'required',
            'model'         => 'required|min:2|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);

        $product->findOrFail($product->id);
        $product->good_id       = $request->good_id;
        $product->category_id   = $request->category_id;
        $product->brand_id      = $request->brand_id;
        $product->model         = $request->model;
        $product->details       = $request->details;

        if ($request->hasfile('image')) {

            if(!is_null($product->image)){

                $image_path = public_path().$product->image;

                if (file_exists($image_path))
                {
                    unlink($image_path);
                }
            }
            $image     = $request->file('image');
            $imageName = date('YmdHis') . '.' . $image->getClientOriginalExtension();
            $path      = $request->file('image')->storeAs('products', $imageName, 'public');
            $product->image = '/storage/' . $path;
        }
        $product->save();

        notify()->success("Product Updated Successfully", "Success");
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function productList(Request $request, $show)
    {
        // $show 1 = all product list
        // $show 0 = only stock available product list

        // return $products = Product::with(['good', 'category', 'brand'])->orderByDesc('id')->get();

        if ($request->ajax()) {
            if($show == 1){
                // show all product list
                $products = Product::with(['good', 'category', 'brand'])->orderByDesc('id')->get();
            }else{
                // show only stock product list
                $products = Product::with(['good', 'category', 'brand'])->orderByDesc('id')->where('stock', '!=', 0)->get();
            }

            return Datatables::of($products)

                ->addIndexColumn()

                //--Category Name
                ->addColumn('define_category_name', function ($row) {
                    $category_name  = $row->category->name;
                    return view('product.product_category_name', compact(['category_name']));
                })

                //--Product Name
                ->addColumn('define_name', function ($row) {
                    $name  = $row->good->name;
                    $stock  = $row->stock;
                    return view('product.field_name', compact(['name', 'stock']));
                })

                //--Brand Name
                ->addColumn('define_brand_name', function ($row) {
                    $brand_name  = $row->brand->name;
                    return view('product.field_brand_name', compact(['brand_name']));
                })

                //--Product Stock
                ->addColumn('define_stock', function ($row) {
                    $stock  = $row->stock;
                    return view('product.field_stock', compact(['stock']));
                })

                //--Product image
                ->addColumn('define_image', function ($row) {
                    $logo_check = $row->image;
                    // $logo       = asset('images/workshop/logo/' . $row->image);

                    $logo       = asset($row->image);
                    return view('product.product_field_image', compact(['logo', 'logo_check']));
                })

                ->addColumn('define_status', function ($row) {
                    $id         = $row->id;
                    $status     = $row->status;
                    $tbl_name   = 'products';
                    return view('status.status', compact(['id', 'status', 'tbl_name']));
                })

                ->addColumn('action', function ($row) {
                    $id                     = $row->id;
                    $module                 = 'product';
                    $tbl_name               = 'products';
                    $tbl_foreign_id         = 'product_id';
                    $tbl_foreign_tbl_name   = 'stocks';
                    return view('destroy.destroy', compact(['id', 'module', 'tbl_name', 'tbl_foreign_id', 'tbl_foreign_tbl_name']));
                })

                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->updated_at)->format('Y-m-d');
                })

                ->rawColumns(['action'])
                ->toJson();
        }
    }

}
