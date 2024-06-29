@extends('layouts.admin')
@section('styles')
<link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Dashboard</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Admin</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{route('product.create')}}" class="btn btn-sm btn-primary">Add Data</a>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<h6 class="mb-0 text-uppercase">Product</h6>
<hr>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stok</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($product as $data)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->price}}</td>
                        <td>{{$data->stok}}</td>
                        <td>{{$data->category->name}}</td>
                        <td>
                            <form action="{{route('product.destroy',$data->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="button"
                                    class="btn btn-sm rounded-pill btn-outline-secondary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false"> Choose
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="{{route('product.show',$data->id)}}"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Show</a>
                                    <a class="dropdown-item" href="{{route('product.edit',$data->id)}}"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <a href="{{ route('product.destroy', $data->id) }}" data-confirm-delete="true"
                                        class="dropdown-item"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script>
    $(document).ready(function() {
		$('#example').DataTable();
	});
</script>
@endpush