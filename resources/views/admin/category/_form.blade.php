<div class="col-md-4">
    <h4 class="py-2 mb-2">
        @if(isset($category))
        Edit
        @else
        Add
        @endif
        Category Product
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}"
                method="POST">
                @csrf
                @if(isset($category))
                @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">Category Name</label>
                    <input type="text" class="form-control" name="name" id="defaultFormControlInput"
                        placeholder="Category" aria-describedby="defaultFormControlHelp"
                        value="{{ isset($category) ? $category->name : old('name') }}" />
                </div>
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-block btn-outline-primary">
                        <i class="bx bx-check"></i>&nbsp;
                        @if(isset($category))
                        Update
                        @else
                        Save
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>