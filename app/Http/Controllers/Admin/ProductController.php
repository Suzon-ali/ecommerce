<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Catergory;
use App\Models\Product;
use App\Models\ProductDetail;

class ProductController extends Controller
{
    
    public function showProductForm()
    {
        $categories = Catergory::get();
        $brands = Brand::get();
        return view('backend.product.add', compact('categories', 'brands' ));

        
    }

    public function productManage()
    {
        $products = Product::with('category', 'brand')->orderBY('created_at','desc')->get();
        return view('backend.product.manage', compact('products'));

       
    }

    public function productStore(Request $request)
    {
        $this->validate($request,[
            'catergory_id'      => 'required|integer',
            'brand_id'          => 'required|integer',
            'name'              => 'required|string',
            'price'             => 'required',
            'qty'               => 'required|integer',
            'color'             => 'required|string',
            'size'              => 'required|string',
            'short_description' => 'required|string',
            'long_description'  => 'required|string',
            'image'             => 'required',
            'images'            => 'required',
            'status'            => 'required|integer',
        ]);

        if($request->file('image')){
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $image= $request->image->move(public_path('product'),$imageName);

        }

        


        $product                    = new Product();
        $product->catergory_id	    = $request->catergory_id ;
        $product->brand_id	        = $request->brand_id ;
        $product->name	            = $request->name ;
        $product->slug	            = str_replace(' ','-',strtolower($request->name)) ;
        $product->price	            = $request->price ;
        $product->qty	            = $request->qty ;
        $product->discount_price	= $request->discount_price ;
        $product->short_description	= $request->short_description ;
        $product->long_description	= $request->long_description ;
        $product->color	            = $request->color ;
        $product->size	            = $request->size ;
        $product->status	        = $request->status ;
        $product->image	            = $imageName ;
        
        $product->save();

        if($product->save()){

            foreach($request->file('images') as $productImage){
                $imagesName = $productImage->getClientOriginalName();
                $images = $productImage->move(public_path('product/'), $imagesName);
                
                $productImages = new ProductDetail();
                $productImages->product_id = $product->id;
                $productImages->images = $imagesName;
                $productImages->save();
            }

        }

       


        return redirect()->back()->with(session()->flash('success','Product added succesfully'));
        
       
    }

    public function productEdit($id)
    {
        $products = Product::find($id);
        $brands = Brand::get();
        $categories = Catergory::get();
        $product = Product::with('productDetails')->find($id);
        return view('backend.product.edit', compact('products', 'brands', 'categories','product'));
        
    }  

    public function productUpdate(Request $request ,$id)
    {
        $this->validate($request,[
            'catergory_id'          => 'required|integer',
            'brand_id'              => 'required|integer',
            'name'                  => 'required|string',
            'price'                 => 'required',
            'qty'                   => 'required|integer',
            'color'                 => 'required|string',
            'size'                  => 'required|string',
            'short_description'     => 'required|string',
            'long_description'      => 'required|string',
            'image'                 => 'sometimes|nullable',
            'images'                => 'sometimes|nullable',
            'status'                => 'required|integer',
        ]);



        $product                    = Product::find($id);
        $product->catergory_id	    = $request->catergory_id;
        $product->brand_id	        = $request->brand_id;
        $product->name	            = $request->name ;
        $product->slug	            = str_replace(' ','-',strtolower($request->name)) ;
        $product->price	            = $request->price ;
        $product->qty	            = $request->qty ;
        $product->discount_price	= $request->discount_price ;
        $product->short_description	= $request->short_description ;
        $product->long_description	= $request->long_description ;
        $product->color	            = $request->color ;
        $product->size	            = $request->size ;
        $product->status	        = $request->status ;

        if($request->file('image')){
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $image= $request->image->move(public_path('product'),$imageName);
            $product->image = $imageName;
        }
        
        
        $product->save();

        if($product->save()){

            if($request->file('images')){
                foreach($request->file('images') as $productImage){
                    $imagesName = $productImage->getClientOriginalName();
                    $images = $productImage->move(public_path('product/'), $imagesName);
                    $productImages = new ProductDetail();
                    $productImages->product_id = $product->id;
                    $productImages->images = $imagesName;
                    $productImages->save();
                }
            }
            

        }

        


        return redirect('/product/manage')->with(session()->flash('success','Product added succesfully'));

    }


    public function productActive($id)
    {
        $product = Product::find($id);
        $product->status = 1;
        $product->save();
        return redirect()->back()->with(session()->flash('success','Product has been activated'));
        
    }

    public function productInactive($id)
    {
        $product = Product::find($id);
        $product->status = 0;
        $product->save();
        return redirect()->back()->with(session()->flash('success','Product has been Inactivated'));
        
    }

    public function productDelete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with(session()->flash('success','Product has been Deleted'));
    }

    public function deleteProductImage($id)
    {
        $productImage = ProductDetail::find($id);
        $productImage->delete();
        return redirect()->back()->with(session()->flash('success','Image has been Deleted'));
    }
  





}
