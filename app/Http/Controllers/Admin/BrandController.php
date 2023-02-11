<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Catergory;

class BrandController extends Controller
{
    

    public function showBrandForm()
   {
        $categories = Catergory::orderby('id', 'desc')->where('status', 1)->get();
        return view('backend.brand.add', compact('categories'));
   }

   public function brandManage()
   {
        $brands = Brand::with('category')->orderby('created_at', 'desc')->get();
        return view('backend.brand.manage' , compact('brands'));
   }

   
   public function brandStore(Request $request)
   {
        $this->validate($request,[
            'catergory_id'=>'required|integer',
            'name'=>'required',
            'status'=>'required'
        ]);
        $brand = new Brand();
        $brand->catergory_id = $request->catergory_id;
        $brand->name = $request->name;
        $brand->slug = str_replace(' ','-', strtolower($request->name));
        $brand->status = $request->status;
        $brand->save();
        return redirect()->back()->with(session()->flash('success', 'brand is updated!'));

   }

   public function brandEdit($id)
   {
     $categories = Catergory::orderby('id', 'desc')->where('status', 1)->get();
     $brand = Brand::find($id);
     return view('backend.brand.edit', compact('brand','categories'));
   }

   public function brandUpdate(Request $request, $id)
   {
     $this->validate($request,[
          'catergory_id'=>'required|integer',
          'name'=>'required',
          'status'=>'required'
      ]);
     
      $brand = Brand::find($id);
      $brand->catergory_id = $request->catergory_id;
      $brand->name = $request->name;
      $brand->slug = str_replace(' ','-', strtolower($request->name));
      $brand->status = $request->status;
      $brand->save();
      return redirect('/brand/manage')->with(session()->flash('success', 'brand is updated!'));   

   }

   public function brandActive($id)
   {
     $brand = Brand::find($id);
     $brand->status = 1;
     $brand->save();
     return redirect()->back()->with(session()->flash('success', 'brand has been active!')); 
   }

   public function brandInactive($id)
   {
     $brand = Brand::find($id);
     $brand->status = 0;
     $brand->save();
     return redirect()->back()->with(session()->flash('success', 'brand has been inactive!')); 

   }

   public function brandDelete($id)
   {
    $brand = Brand::find($id);
    $brand->delete();
    return redirect()->back()->with(session()->flash('success', 'brand has been deleted.!')); 
   }


   
   

}
