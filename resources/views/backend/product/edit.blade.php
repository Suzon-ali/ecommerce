@extends('backend.master')

@section('content')

<div class="container">

    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                @if (session()->has('success'))

                <div id="add-product-notify" style="display: flex;
                flex-direction:row; 
                justify-content: 
                space-between;
                align-items:center; 
                " id="alert-area" class="alert alert-success ">
                    <div>
                        {{ session()->get('success') }}
                    </div>
                    <button class="btn btn-success "  id="close_alert_area" >
                        x
                    </button>
                </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    </div>
                @endif
               

            <div class="card">
                <div class="card-header"> Add Product </div>
                <div class="card-body">
                    <form action="{{ url('/product/update/'.$products->id)}}" method="POST" enctype="multipart/form-data">  
                        @csrf
                        <div class="form-group">
                            <label for="name">Category</label>
                            <select name="catergory_id" class="form-control" >
                                <option disabled> ----Select A Category-----</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id}}" {{$category->id == $products->catergory_id ? 'selected' : ''}}>{{ $category->name}} </option>
                                @endforeach
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Brand</label>
                            <select name="brand_id" class="form-control" >
                                <option selected disabled> ----Select A Brand-----</option>
                                @foreach ($brands as $brand)
                               <option {{$brand->id == $products->brand_id ? 'selected' : ''}} value="{{ $brand->id}}">{{ $brand->name}}</option>
                               @endforeach
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $products->name }}" placeholder="Enter product name">
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control" value="{{ $products->price}}" placeholder="Enter product price">
                        </div>

                        <div class="form-group">
                            <label >Discount Price (Optional)</label>
                            <input type="text" name="discount_price" class="form-control" value="{{ $products->discount_price}}" placeholder="Enter discount price">
                        </div>

                        <div class="form-group">
                            <label >Quantity</label>
                            <input type="text" name="qty" class="form-control" value="{{ $products->qty}}" placeholder="Enter product quantity">
                        </div>

                        <div class="form-group">
                            <label >Color</label>
                            <input type="text" name="color" class="form-control" value="{{ $products->color}}" placeholder="Enter product color">
                        </div>

                        <div class="form-group">
                            <label >Size</label>
                            <input type="text" name="size" class="form-control" value="{{ $products->size}}" placeholder="Enter product size">
                        </div>

                        <div class="form-group">
                            <label >Short Description</label>
                            <textarea type="text" name="short_description" rows="5" class="form-control" placeholder="Enter product short description">{{ $products->short_description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label >Long Description</label>
                            <textarea class="form-control" name="long_description" id="long_description" placeholder="Enter long description" >{{ $products->long_description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label >Product Photo</label>
                            <input type="file" name="image" value="{{$products->image}}" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label class="d-block" >Uploded Photo</label>
                            <div class="d-flex flex-column " >
                                <img class="border p-2 mb-1" src="/product/{{$products->image}}"  alt="" width="75" height="95">
                               
                            </div>
                        </div>

                        <div class="form-group">
                            <label >Gallery Photo</label>
                            <input type="file" name="images[]" multiple class="form-control" >
                            
                        </div>

                        <div class="form-group">
                            <label class="d-block" >Uploded Photos</label>
                          
                          
                          <div class="row">
                            @foreach ($product->productDetails as $image)
                            <div class="d-flex flex-column mr-3">
                                <img class="border p-2 mb-1" src="{{asset('/product/'.$image->images)}}"  alt="{{ $image->images}}" width="75" height="95">
                                <a onclick="return confirm('Are you sure , you want to delete the image?')" class="btn btn-sm btn-danger" href="{{url('/delete/image/'.$image->id)}}"> Delete</a>
                            </div>
                            @endforeach
                          </div>
                           
                         
                        </div>


                        <div class="form-group">
                            <label for="name">Publication Status</label>
                            <select name="status" class="form-control" >
                                <option disabled> ----Select A Status-----</option>
                                <option value="1" {{$products->status == 1 ? 'selected' : ''}} >Active</option>
                                <option value="0" {{$products->status == 0 ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Upload Product</button>
                    </form>
                </div>
            </div>
        </div>
    
       <div class="col-md-2"></div>
        </div>
    </div>

</div>


<script>
    let alertArea = document.getElementById('alert-area');
    let alertClose = document.getElementById('close_alert_area');
    let notify = document.getElementById('add-product-notify');
    alertClose.addEventListener('click', function(){
        alertArea.style.display = 'none';
    })

    setTimeout(function(){
        notify.style.display = "none";
        }, 3000);
    
</script>



@endsection