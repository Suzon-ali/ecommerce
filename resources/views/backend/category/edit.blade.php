@extends('backend.master')

@section('content')

<div class="container">

    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                @if (session()->has('success'))

                <div style="display: flex;
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
                <div class="card-header"> Edit Category </div>
                <div class="card-body">
                    <form action="{{ url('/category/update/'.$category->id)}}" method="POST">  
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $category->name}}" placeholder="Enter Category name">
                        </div>
                        <div class="form-group">
                            <label for="name">Publication Status</label>
                            <select name="status" class="form-control" >
                                <option selected disabled> ----Select A Status-----</option>
                                <option value="1" {{ $category->status == 1? 'selected' : ''}} >Active</option>
                                <option value="0" {{ $category->status == 0? 'selected' : ''}} >Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Category</button>
                    </form>
                </div>
            </div>
        </div>
    
       <div class="col-md-3"></div>
        </div>
    </div>

</div>


<script>
    let alertArea = document.getElementById('alert-area');
    let alertClose = document.getElementById('close_alert_area');
    alertClose.addEventListener('click', function(){
        alertArea.style.display = 'none';
    })

    
</script>


@endsection