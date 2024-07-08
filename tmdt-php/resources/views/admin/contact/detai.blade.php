@extends('admin.main')

@section('content')
<div class="contact-details">
    <table class="table">
        <thead>
            <tr class="table_head">
                <th class="column-1">ID</th>
                <th class="column-2">Email</th>
                <th class="column-3">Chi tiết liên hệ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="column-1">{{ $contact->id }}</td>
                <td class="column-2">{{ $contact->email }}</td>
                <td class="column-3">{{ $contact->message }}</td>
            </tr>
        </tbody>
    </table>
    <div class="text-right p-b-10 p-r-15">
        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Quay Lại Danh Sách</a>
    </div>
</div>
@endsection
