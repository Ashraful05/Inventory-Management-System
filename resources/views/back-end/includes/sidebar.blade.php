@php
    $prefix = Request::route()->getPrefix();
    $route  = Request::route()->getName();
@endphp
<div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li><a href="{{route('/dashboard')}}"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
            @if(Auth::User()->role=='Admin')
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet">Users</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{route('add-user')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Add User</span></a></li>
                    <li><a class="submenu" href="{{route('view-user')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Manage User</span></a></li>
                </ul>
            </li>
            @endif
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet">Profile</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{route('view-profile')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Manage Profile</span></a></li>
                    <li><a class="submenu" href="{{route('change-password')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Change Password</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet">Suppliers</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{route('add-supplier')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Suppliers</span></a></li>
                    <li><a class="submenu" href="{{route('view-supplier')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Manage Suppliers</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet">Customers</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{route('add-customer')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Customer</span></a></li>
                    <li><a class="submenu" href="{{route('view-customer')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Manage Customer</span></a></li>
                    <li><a class="submenu" href="{{route('credit-customer')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Credit Customer</span></a></li>
                    <li><a class="submenu" href="{{route('paid-customer')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Paid Customer</span></a></li>
                    <li><a class="submenu" href="{{route('customer-wise-report')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Customer Wise Report</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet">Units</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{route('add-unit')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Unit</span></a></li>
                    <li><a class="submenu" href="{{route('view-unit')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Manage Units</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Category</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{route('add-category')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Category</span></a></li>
                    <li><a class="submenu" href="{{route('view-category')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Manage Category</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet">Product</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{route('add-product')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Product</span></a></li>
                    <li><a class="submenu" href="{{route('view-product')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Manage Product</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet">Purchase</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{route('add-purchase')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Purchase</span></a></li>
                    <li><a class="submenu" href="{{route('view-purchase')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Manage Purchase</span></a></li>
                    <li><a class="submenu" href="{{route('pending-purchase')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Pending Purchase</span></a></li>
                    <li><a class="submenu" href="{{route('daily-purchase-report')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Daily Purchase Report</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet">Invoice</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{route('add-invoice')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Invoice</span></a></li>
                    <li><a class="submenu" href="{{route('view-invoice')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Manage Invoice</span></a></li>
                    <li><a class="submenu" href="{{route('pending-invoice')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Approval Invoice</span></a></li>
                    <li><a class="submenu" href="{{route('invoice-list')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Print Invoice</span></a></li>
                    <li><a class="submenu" href="{{route('daily-invoice-report')}}"><i class="icon-file-alt"></i><span class="hidden-tablet">Daily Invoice Report</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet">Manage Stock</span><span class="label label-important"></span></a>
                <ul>
                    <li><a class="submenu" href="{{route('view-report')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Stock Report</span></a></li>
                    <li><a class="submenu" href="{{route('view-supplier-wise-report')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Supplier/Product Wise Report</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
