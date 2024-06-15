@extends('account.layouts')

@section('account-content')
<div class="main-content-wrapper">
    <h2>Chỉnh Sửa Thông Tin Tài Khoản</h2>
    @include('alert')
    <form action="{{ route('account.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>
</div>
@endsection
