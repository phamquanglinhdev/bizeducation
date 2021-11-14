<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('room') }}'><i class='nav-icon las la-users'></i> Lớp học</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon las la-book'></i> Nhật ký</a></li>
@if(backpack_user()->role==0)
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon las la-user'></i> Người dùng</a></li>
@endif
