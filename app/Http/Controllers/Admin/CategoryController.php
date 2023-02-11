<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catergory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  

   public function showCatergoryForm()
   {
        return view('backend.category.add');
   }

   public function categoryManage()
   {
        $categories = Catergory::get();
        return view('backend.category.manage' , compact('categories'));
   }

   
   public function categoryStore(Request $request)
   {
        $this->validate($request,[
            'name'=>'required',
            'status'=>'required'
        ]);
        $category = new Catergory();
        $category->name = $request->name;
        $category->slug = str_replace(' ','-', strtolower($request->name));
        $category->status = $request->status;
        $category->save();
        return redirect()->back()->with(session()->flash('success', 'Category is updated!'));

   }

   public function categoryEdit( $id)
   {
     $category = Catergory::find($id);
     return view('backend.category.edit', compact('category'));
   }

   public function categoryUpdate(Request $request, $id)
   {
     $this->validate($request,[
          'name'=>'required',
          'status'=>'required'
      ]);
     
      $category = Catergory::find($id);
      $category->name = $request->name;
      $category->slug = str_replace(' ','-', strtolower($request->name));
      $category->status = $request->status;
      $category->save();
      return redirect('/category/manage')->with(session()->flash('success', 'Category is updated!')); 

   }

   public function categoryActive($id)
   {
     $category = Catergory::find($id);
     $category->status = 1;
     $category->save();
     return redirect()->back()->with(session()->flash('success', 'Category has been active!')); 
   }

   public function categoryInactive($id)
   {
     $category = Catergory::find($id);
     $category->status = 0;
     $category->save();
     return redirect()->back()->with(session()->flash('success', 'Category has been inactive!')); 

   }

   public function categoryDelete($id)
   {
    $category = Catergory::find($id);
    $category->delete();
    return redirect()->back()->with(session()->flash('success', 'Category has been deleted.!')); 
   }


  

  

   

}
