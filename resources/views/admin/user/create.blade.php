@extends('layouts.admin')
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
            <a href="{{route('user.index')}}" class="btn btn-sm btn-primary">Back</a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{route('user.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-4">
                <div class="mb-3">
                    <label for="" class="form-label">Role</label>
                    <select name="isAdmin" id="" class="form-control @error('isAdmin') is-invalid @enderror">
                        <option value="1">Admin</option>
                        <option value="0">User</option>
                    </select>
                    @error('isAdmin')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <button class="btn btn-sm btn-primary" type="submit">Submit</button> |
                    <button class="btn btn-sm btn-warning" type="reset">Cancel</button>
                </div>
        </form>
    </div>
</div>
@endsection