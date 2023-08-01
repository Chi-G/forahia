<?php

namespace App\Http\Controllers\Admin;
//namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\ProductDetails;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class ProductListController extends Controller
{
    public function ProductListByRemark(Request $request)
    {
        $remark = $request->remark;
        $productlist = ProductList::where('remark', $remark)->limit(8)->get();

        return $productlist;
    }

    public function ProductListByCategory(Request $request) {
        $category = $request->category;
        $productlist = ProductList::where('category', $category)->get();

        return $productlist;
    }

    public function ProductListBySubcategory(Request $request)
    {
        $category = $request->category;
        $subcategory = $request->subcategory;
        $productlist = ProductList::where('category', $category)->where('subcategory', $subcategory)->get();

        return $productlist;
    }

    public function ProductBySearch(Request $request)
    {
        $key = $request->key;
        $productlist = ProductList::where('title', 'LIKE', "%{$key}%")
            ->orwhere('brand', 'LIKE', "%{$key}%")
                ->orwhere('price', 'LIKE', "%{$key}%")
                    ->orwhere('category', 'LIKE', "%{$key}%")
                        ->orwhere('subcategory', 'LIKE', "%{$key}%")
                            ->orwhere('remark', 'LIKE', "%{$key}%")
                ->get();

        return $productlist;
    }

    public function SimilarProduct(Request $request)
    {
        $subcategory = $request->subcategory;
        $productlist = ProductList::where('subcategory', $subcategory)
            ->orderBy('id', 'desc')
                ->limit(6)->get();

        return $productlist;
    }

    public function GetAllProduct(){
         $products = ProductList::latest()->paginate(10);
            return view('backend.product.product_all',compact('products'));
    }

    public function AddProduct(){
        $category = Category::orderBy('category_name','ASC')->get();
        $subcategory = Subcategory::orderBy('subcategory_name','ASC')->get();
        
        return view('backend.product.product_add',compact('category','subcategory'));
    }

    public function getSubcategoriesByCategory(Request $request)
    {
        $categoryId = $request->input('category_id');
        $subcategories = Subcategory::where('category_id', $categoryId)->orderBy('subcategory_name', 'ASC')->get();
        return response()->json($subcategories);
    }

    public function StoreProduct(Request $request){
        $request->validate([
            'product_code' => 'required',
        ],[
            'product_code.required' => 'Input Product Code'
        ]);

        $request->validate([
            'product_code' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for the image file
        ], [
            'product_code.required' => 'Input Product Code',
            'image.required' => 'Upload an image',
            'image.image' => 'Uploaded file must be an image',
            'image.mimes' => 'Allowed image formats are: jpeg, png, jpg, gif',
            'image.max' => 'Maximum file size is 2MB',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(711,960)->save('upload/product/'.$name_gen);
        $save_url = 'http://127.0.0.1:8000/upload/product/'.$name_gen;

        // Insert Into Product List Table too
        $product_id = ProductList::insertGetId([
            'title' => $request->title,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
            'image' => $save_url,
        ]);

        // Insert Into Product Details Table
        $image1 = $request->file('image_one');
        $name_gen1 = hexdec(uniqid()).'.'.$image1->getClientOriginalExtension();
        Image::make($image1)->resize(711,960)->save('upload/productdetails/'.$name_gen1);
        $save_url1 = 'http://127.0.0.1:8000/upload/productdetails/'.$name_gen1;


        $image2 = $request->file('image_two');
        $name_gen2 = hexdec(uniqid()).'.'.$image2->getClientOriginalExtension();
        Image::make($image2)->resize(711,960)->save('upload/productdetails/'.$name_gen2);
        $save_url2 = 'http://127.0.0.1:8000/upload/productdetails/'.$name_gen2;

        $image3 = $request->file('image_three');
        $name_gen3 = hexdec(uniqid()).'.'.$image3->getClientOriginalExtension();
        Image::make($image3)->resize(711,960)->save('upload/productdetails/'.$name_gen3);
        $save_url3 = 'http://127.0.0.1:8000/upload/productdetails/'.$name_gen3;

        $image4 = $request->file('image_four');
        $name_gen4 = hexdec(uniqid()).'.'.$image4->getClientOriginalExtension();
        Image::make($image4)->resize(711,960)->save('upload/productdetails/'.$name_gen4);
        $save_url4 = 'http://127.0.0.1:8000/upload/productdetails/'.$name_gen4;

        ProductDetails::insert([
            'product_id' => $product_id,
            'image_one' => $save_url1,
            'image_two' => $save_url2,
            'image_three' => $save_url3,
            'image_four' => $save_url4,
            'short_description' => $request->short_description,
            'color' =>  $request->color,
            'size' =>  $request->size,
            'long_description' => $request->long_description,
        ]);

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all-product')->with($notification);
    }

    public function updateProduct(Request $request)
    {
        $product_id = $request->id;

        $request->validate([
            'product_code' => 'required',
        ], [
            'product_code.required' => 'Input Product Code',
        ]);

        try {
            $productListData = [
                'title' => $request->title,
                'price' => $request->price,
                'special_price' => $request->special_price,
                'category' => $request->category,
                'subcategory' => $request->subcategory,
                'remark' => $request->remark,
                'brand' => $request->brand,
                'product_code' => $request->product_code,
            ];

            $productDetailsData = [
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'color' => $request->color,
                'size' => $request->size,
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(711, 960)->save('upload/product/' . $name_gen);
                $save_url = 'http://127.0.0.1:8000/upload/product/' . $name_gen;
                $productListData['image'] = $save_url;
            }

            if ($request->hasFile('image_one')) {
                $image1 = $request->file('image_one');
                $name_gen1 = hexdec(uniqid()) . '.' . $image1->getClientOriginalExtension();
                Image::make($image1)->resize(711, 960)->save('upload/productdetails/' . $name_gen1);
                $save_url1 = 'http://127.0.0.1:8000/upload/productdetails/' . $name_gen1;
                $productDetailsData['image_one'] = $save_url1;
            }

            if ($request->hasFile('image_two')) {
                $image2 = $request->file('image_two');
                $name_gen2 = hexdec(uniqid()) . '.' . $image2->getClientOriginalExtension();
                Image::make($image2)->resize(711, 960)->save('upload/productdetails/' . $name_gen2);
                $save_url2 = 'http://127.0.0.1:8000/upload/productdetails/' . $name_gen2;
                $productDetailsData['image_two'] = $save_url2;
            }

            if ($request->hasFile('image_three')) {
                $image3 = $request->file('image_three');
                $name_gen3 = hexdec(uniqid()) . '.' . $image3->getClientOriginalExtension();
                Image::make($image3)->resize(711, 960)->save('upload/productdetails/' . $name_gen3);
                $save_url3 = 'http://127.0.0.1:8000/upload/productdetails/' . $name_gen3;
                $productDetailsData['image_three'] = $save_url3;
            }

            if ($request->hasFile('image_four')) {
                $image4 = $request->file('image_four');
                $name_gen4 = hexdec(uniqid()) . '.' . $image4->getClientOriginalExtension();
                Image::make($image4)->resize(711, 960)->save('upload/productdetails/' . $name_gen4);
                $save_url4 = 'http://127.0.0.1:8000/upload/productdetails/' . $name_gen4;
                $productDetailsData['image_four'] = $save_url4;
            }

            ProductList::where('id', $product_id)->update($productListData);
            ProductDetails::where('product_id', $product_id)->update($productDetailsData);

            $notification = [
                'message' => 'Product updated successfully',
                'alert-type' => 'success'
            ];
        } catch (\Exception $ex) {
            Log::error($ex);
            $notification = [
                'message' => 'Error updating the product',
                'alert-type' => 'error'
            ];
        }

        return redirect()->route('all-product')->with($notification);
    }

      public function EditProduct($id){
        $category = Category::orderBy('category_name','ASC')->get();
        $subcategory = Subcategory::orderBy('subcategory_name', 'ASC')->get();
        $product = ProductList::findOrFail($id);
        $details = ProductDetails::where('product_id', $id)->get();
        return view('backend.product.product_edit',
            compact('category','subcategory','product','details'));
      }


      public function DeleteProduct(Request $request){

        $productId = $request->id;

        //Delete ProductDetetails
        ProductDetails::where('product_id', $productId)->delete();

        //Delete ProductList
        ProductList::destroy($productId);

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
