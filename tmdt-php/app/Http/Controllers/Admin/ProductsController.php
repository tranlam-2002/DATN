<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductAdminService;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $productService;

    public function __construct(ProductAdminService $productService){
        $this->productService = $productService;
    }
     
    public function index()
    {
        return view("admin.product.list", [
            'title'=> 'Danh Sách Sản Phẩm',
            'products'=> $this->productService->get()
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->query('search');

        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('id', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.product.list', compact('products'),[
            'title'=>'Danh Sách Sản Phẩm'
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            return view('admin.product.add',[
            'title' => 'Thêm Sản Phẩm Mới',
            'menus' => $this->productService->getMenu()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productService->create($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.edit', [
            'title' => 'Chỉnh Sửa Sản Phẩm',
            'product' => $product,
            'menus' => $this->productService->getMenu(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->productService->update($request, $product);
        if($request){
            return redirect('/admin/products/list');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result= $this->productService->delete($request);
        if($result){
            return response()->json([
                'error' => false,
                'massage' => 'Xóa thành công sản phẩm'
            ]);
        }
        return response()->json(['error' => true]);
    }
}