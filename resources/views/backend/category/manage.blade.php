@extends('backend.master')

@section('content')
    


    <!-- Page Wrapper -->
    <div  id="wrapper ">

        <!-- Content Wrapper -->
        <div style="overflow: auto" id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>

                    @if (session()->has('success'))

                    <div id="notify" style="display: flex;
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
                   
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Product Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                        @foreach ($categories as $category)

                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @if ($category->status == 0)
                                                    <span>Inactive</span>
                                                @else
                                                    <span>Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-success" href="{{url('category/edit/'.$category->id)}}">Edit</a>
                                                @if ($category->status == 1)
                                                    <a style="width: 6rem" class="btn btn-primary " href="{{url('category/inactive/'.$category->id)}}">Active</a>
                                                @else
                                                    <a style="width: 6rem" class="btn btn-warning " href="{{url('category/active/'.$category->id)}}">Inactive</a>
                                                @endif
                                                <a class="btn btn-danger" href="{{url('category/delete/'.$category->id)}}" onclick="return confirm('Do you want to delete this category?')">Delete</a>  
                                            </td>
                                            
                                        </tr>

                                        @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

 
    <script>
        let alertArea = document.getElementById('alert-area');
        let alertClose = document.getElementById('close_alert_area');
        let notify = document.getElementById('notify');
        alertClose.addEventListener('click', function(){
            alertArea.style.display = 'none';
        })

        setTimeout(function(){
        notify.style.display = "none";
        }, 3000);
        
        
    </script>




@endsection