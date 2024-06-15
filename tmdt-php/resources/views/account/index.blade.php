@extends('account.layouts')

@section('account-content')
<div class="main-content-wrapper">
    <h2>Thông Tin Tài Khoản</h2>

    @include('alert')

    <table class="table">
        <tr>
            <th>Tên</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
    </table>
</div>
@endsection
