@extends(backpack_view('blank'))
@php
    $role = ["Admin","Giáo viên","Học sinh","Đối tác"];
@endphp
@section('content')
    <p>Người dùng :{{backpack_user()->name}}</p>
    <p>Quyền hạn :{{$role[backpack_user()->role]}}</p>
    <p>Phiên bản ứng dụng beta 0.0.1</p>
    <p>Phần điều khiển đang nâng cấp</p>

@endsection
