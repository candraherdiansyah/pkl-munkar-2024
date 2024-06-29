@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
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
            <a href="{{route('product.index')}}" class="btn btn-sm btn-primary">Back</a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="" class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category</label>
                        <select name="category_id" id=""
                            class="form-control @error('category_id') is-invalid @enderror">
                            @foreach ($category as $data)
                            <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                        @error('isAdmin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                            placeholder="price">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                            placeholder="stok">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description Product</label>
                <textarea type="text" name="desc" class="form-control @error('desc') is-invalid @enderror"
                    placeholder="Description"></textarea>
                @error('desc')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="document">Image</label>
                <div class="dropzone" id="product-dropzone"></div>
            </div>
            <div class="mb-3">
                <button class="btn btn-sm btn-primary" type="submit">Submit</button> |
                <button class="btn btn-sm btn-warning" type="reset">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    Dropzone.options.productDropzone = {
        url: '{{ route('product.storeMedia') }}',
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = ''
            if (file.file_name) {
                name = file.file_name
            } else {
                name = file.name
            }
            $('form').find('input[name="images[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($product) && $product->images)
            var files = {!! json_encode($product->images) !!}
            for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
            }
            @endif
        }
}
</script>
<script src="https://cdn.tiny.cloud/1/ctgoj8efdfr1i2jqusoi0hyy1luhjn7lk7r8rnmmhe2f6r35/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker markdown',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      });
</script>
@endpush