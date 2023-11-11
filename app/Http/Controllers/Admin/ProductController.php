<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductSize;
use App\Services\UploadImage;
use Exception;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::with('details')->orderBy('product_name', 'asc')->get();
        $categories = Category::orderBy('category_name', 'asc')->get();
        foreach ($products as $item) {
            $category = Category::find($item->category_id);
            $item->category = $category->category_name;

            foreach ($item->details as $item2) {
                $size = ProductSize::where('id', $item2->product_size)->first();
                $item2->product_size = $size->product_size;
            }
        }


        return view('admin.product.index', compact('products', 'categories'));
    }


    public function create()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        $sizes = ProductSize::orderBy('product_size', 'asc')->get();
        return view('admin.product.create', compact('categories', 'sizes'));
    }


    public function store(Request $request)
    {

        try {
            $request->validate([
                'product_name' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric',
                'size_ids' => 'required|array',
                'size_ids.*' => 'exists:product_sizes,id',
                'description' => 'required|string',
                'images' => 'required|array',
                'images.*' => 'image',
                'thumbnail' => 'required|image',
                'stock' => 'required|array',
            ]);

            $product = new Product();
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->description = $request->description;



            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = time() . $file->getClientOriginalName();
                $file->move('assets/thumbnails/', $filename);
                $product->thumbnail = 'assets/thumbnails/' . $filename;
            }


            $product->category_id = $request->category_id;
            $product->save();

            if ($request->hasFile('images')) {
                $images = $request->file('images');

                foreach ($images as $item) {
                    $productImage = new Image();
                    $productImage->product_id = $product->id;

                    $filename = time() . $item->getClientOriginalName();
                    $item->move('assets/images/', $filename);

                    $product->image_path = 'assets/images/' . $filename;
                    $productImage->image_path = 'assets/images/' . $filename;

                    $productImage->save();
                }
            }


            // Get the selected sizes and quantities from the request
            $sizeIds = $request->input('size_ids');
            $stocks = $request->input('stock');

            $selectedStocks = [];
            foreach ($stocks as $item) {
                if ($item != 0) {
                    array_push($selectedStocks, $item);
                }
            }

            if ($selectedStocks) {
                for ($i = 0; $i < count($sizeIds); $i++) {
                    $productDetail = new ProductDetail();
                    $productDetail->product_id = $product->id;
                    $productDetail->product_size = $sizeIds[$i];
                    $productDetail->stock = $selectedStocks[$i];
                    $productDetail->save();
                }

                toastr()->success('A product is added successfully!');
                return back();
            }

            toastr()->error('Please set stocks!');
            return back();
        } catch (Exception $th) {
            dd($th);
            toastr()->error('Falied with ' . $th->getMessage());
            return back();
        }
    }


    public function edit(Product $product2)
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        $sizes = ProductSize::orderBy('product_size', 'asc')->get();
        $selectedSizeIds = $product2->details->pluck('product_size')->toArray();
        $stocks = $product2->details->pluck('stock')->toArray();
        // dd($stocks->toArray());
        $sizes = ProductSize::all();
        $mergedArray = [];

        foreach ($selectedSizeIds as $index => $sizeId) {           
            $mergedArray[$sizeId] = $stocks[$index];
        }
        
        $sizeStockArray = [];

        foreach ($sizes as $size) {
            $stock = isset($mergedArray[$size->id]) ? $mergedArray[$size->id] : 0;
            // Add the size and stock to the $sizeStockArray
            $sizeStockArray[] = [
                'size' => $size->product_size,
                'stock' => $stock,
            ];
        }

        
        return view('admin.product.edit', compact('categories', 'sizes', 'product2', 'selectedSizeIds', 'sizeStockArray'));
    }


    public function update(Request $request, Product $product2)
    {
        try {
            $request->validate([
                'product_name' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric',
                'size_ids' => 'required|array',
                'size_ids.*' => 'exists:product_sizes,id',
                'feature' => 'required|in:yes,no',
                'description' => 'required|string',
                'stock' => 'required|array'
            ]);


            $product2->product_name = $request->product_name;
            $product2->price = $request->price;
            $product2->feature = $request->feature;

            // upload new thumbnail
            if ($request->hasFile('thumbnail')) {
                unlink(public_path($product2->thumbnail));
                $thumbnail = $request->file('thumbnail');
                $thumbnail_new_name = time() . $thumbnail->getClientOriginalName();
                $thumbnail->move('assets/thumbnails/', $thumbnail_new_name);
                $product2->thumbnail = 'assets/thumbnails/' . $thumbnail_new_name;
            }

            $product2->category_id = $request->category_id;
            $product2->update();


            // upload new images
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($product2->images as $image) {
                    unlink(public_path($image->image_path)); // Delete the file from the filesystem
                    $image->delete(); // Delete the image record from the database
                }

                foreach ($images as $item) {
                    $productImage = new Image();
                    $productImage->product_id = $product2->id;

                    $filename = time() . $item->getClientOriginalName();
                    $item->move('assets/images/', $filename);

                    $product2->image_path = 'assets/images/' . $filename;
                    $productImage->image_path = 'assets/images/' . $filename;

                    $productImage->save();
                }
            }


            // Delete existing product details and recreate with the updated size IDs
            $product2->details()->delete();

            // Get the selected sizes and quantities from the request
            $sizeIds = $request->input('size_ids');
            $stocks = $request->input('stock');

            $selectedStocks = [];
            foreach ($stocks as $item) {
                if ($item != 0) {
                    array_push($selectedStocks, $item);
                }
            }

           // dd($selectedStocks);

            if ($selectedStocks) {
                for ($i = 0; $i < count($sizeIds); $i++) {
                    $productDetail = new ProductDetail();
                    $productDetail->product_id = $product2->id;
                    $productDetail->product_size = $sizeIds[$i];
                    $productDetail->stock = $selectedStocks[$i];
                    $productDetail->save();
                }

                toastr()->success('A product is updated successfully!');
                return back();
            }

            toastr()->error('Please set stocks!');
            return back();
        } catch (Exception $th) {
            dd($th->getMessage());
        }
    }


    public function destroy(Product $product2)
    {
        try {
            $product2->delete();
            toastr()->success('A product is deleted successfully!');
            return back();
        } catch (Exception $th) {
            toastr()->error('Falied with ' . $th->getMessage());
            return back();
        }
    }
}
