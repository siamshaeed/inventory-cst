<nav id="sidebarMenu" class=" d-md-block sidebar custom-sidebar">
    <div class="logo-header">

        <a href="{{ route('dashboard') }}" class="logo">
            {{-- <img src="{{asset('assets/img/logo.svg')}}" alt="navbar brand" class="navbar-brand"> --}}
            <img src="{{ asset('images/logo_navbar.svg') }}" alt="navbar brand" class="navbar-brand logo1 p-0 me-0">
            <img src="{{ asset('images/only-logo.svg') }}" alt="navbar brand" class="navbar-brand logo2 p-0 me-0">
        </a>
    </div>
  <div class="scroll-hover">
    <div class="side-scroll">
        <ul class="nav flex-column gap-4- sidebar-menu" id="myDiv">
            <div class="text-center py-3 link fs-6"><b>Admin</b></div>
            {{-- Dashboard --}}
            <li class="nav-item item0">
                <a class="nav-link treeview {{ request()->is('dashboard') ? 'bar-active' : '' }} main-link"
                    aria-current="page" href="{{ url('dashboard') }}">
                    <img src="{{ asset('images/aicon/dashboard 1.svg') }}" alt="">
                    <span class="only-icon" style="margin-left: 5px;">Dashboard</span>
                </a>
            </li>


            {{-- Product --}}
            <li class="treeview item1">
                    <a href="#" class="nav-link main-link {{ request()->is('category*') || request()->is('brand*') || request()->is('good*') || request()->is('market-type*') || request()->is('supplier*') || request()->is('supplier*') || request()->is('warehouse*') || request()->is('product*') ? 'bar-active' : '' }}">
                    <img src="{{ asset('images/aicon/boxes.svg') }}" alt=""><span class="only-icon">Product</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>

                <ul class="treeview-menu" style="display: {{ request()->is('category*') || request()->is('brand*') || request()->is('good*') || request()->is('market-type*') || request()->is('supplier*') || request()->is('warehouse*') || request()->is('product*') ? 'block' : 'none' }}">
                    <li>
                        <a class="nav-link {{ request()->is('category*') ? 'list-active' : '' }}"
                           href="{{ route('category.index') }}">
                            Category
                        </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->is('brand*') ? 'list-active' : '' }}"
                           href="{{ route('brand.index') }}">
                            Brand
                        </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->is('good*') ? 'list-active' : '' }}"
                           href="{{ route('good.index') }}">
                            Goods Name
                        </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->is('market-type*') ? 'list-active' : '' }}"
                           href="{{ route('market-type.index') }}">
                            Market Type
                        </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->is('supplier*') ? 'list-active' : '' }}"
                           href="{{ route('supplier.index') }}">
                            Supplier
                        </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->is('warehouse*') ? 'list-active' : '' }}"
                           href="{{ route('warehouse.index') }}">
                            Warehouse
                        </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->is('product*') ? 'list-active' : '' }}"
                           href="{{ route('product.index') }}">
                            Product
                        </a>
                    </li>

                </ul>
            </li>


            {{-- Stock --}}
            <li class="treeview item2">
                <a href="#" class="nav-link main-link {{ request()->is('stock*') || request()->is('purchase') || request()->is('purchase-item') ? 'bar-active' : '' }}">
                    <img src="{{ asset('images/aicon/settings 2.svg') }}" alt=""><span class="only-icon">Stock</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>

                <ul class="treeview-menu" style="display: {{ request()->is('stock*') || request()->is('purchase') || request()->is('purchase-item') ? 'block' : 'none' }}">
                    <li>
                        <a class="nav-link {{ request()->is('purchase') ? 'list-active' : '' }}"
                           href="{{ route('purchase.index') }}">
                            Purchase
                        </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->is('purchase-item') ? 'list-active' : '' }}"
                           href="{{ route('purchase-item.index') }}">
                            Purchase Item
                        </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->is('stock*') ? 'list-active' : '' }}"
                           href="{{ route('stock.index') }}">
                            Stock Product
                        </a>
                    </li>

                </ul>
            </li>


            {{-- Order --}}
            <li class="treeview item3">
                <a href="#" class="nav-link main-link {{ request()->is('order') || request()->is('order/create') ? 'bar-active' : '' }}">
                    <img src="{{ asset('images/aicon/settings 4.svg') }}" alt=""><span class="only-icon">Order</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>

                <ul class="treeview-menu" style="display: {{ request()->is('order') || request()->is('order/create') ? 'block' : 'none' }}">
                    <li>
                        <a class="nav-link {{ request()->is('order') ? 'list-active' : '' }}"
                           href="{{ route('order.index') }}">
                            Order
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('order/create') ? 'list-active' : '' }}"
                           href="{{ route('order.create') }}">
                            Order Create
                        </a>
                    </li>
                </ul>
            </li>


            {{-- Sale --}}
                <li class="treeview item4">
                <a href="#" class="nav-link main-link {{ request()->is('sale') || request()->is('sale/create') || request()->is('sale-payment') ? 'bar-active' : '' }}">
                    <img src="{{ asset('images/aicon/settings 3.svg') }}" alt=""><span class="only-icon">Sale</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>

                <ul class="treeview-menu" style="display: {{ request()->is('sale') || request()->is('sale/create') || request()->is('sale-payment') ? 'block' : 'none' }}">
                    <li>
                        <a class="nav-link {{ request()->is('sale') ? 'list-active' : '' }}"
                           href="{{ route('sale.index') }}">
                            Sale
                        </a>
                    </li>
                </ul>
            </li>


            {{-- Expense --}}
            <li class="treeview item5">
                <a href="#" class="nav-link main-link {{ request()->is('expense') || request()->is('expense-category*') ? 'bar-active' : '' }}">
                    <img src="{{ asset('images/aicon/donate 1.svg') }}" alt=""><span class="only-icon">Expense</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>

                <ul class="treeview-menu" style="display: {{ request()->is('expense') || request()->is('expense-category*') ? 'block' : 'none' }}">
                    <li>
                        <a class="nav-link {{ request()->is('expense') ? 'list-active' : '' }}"
                           href="{{ route('expense.index') }}">
                            Expense
                        </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->is('expense-category*') ? 'list-active' : '' }}"
                           href="{{ route('expense-category.index') }}">
                            Expense Category
                        </a>
                    </li>
                </ul>
            </li>


            {{-- Report --}}
            <li class="treeview item7">
                <a href="#"
                   class="nav-link main-link {{ request()->is('report/purchase/customer') || request()->is('report/purchase/single-product') || request()->is('report/order/customer') || request()->is('report/sale/customer') || request()->is('report/sale/profit-loss') || request()->is('report/expense') ? 'bar-active' : '' }}">
                    <img src="{{ asset('images/aicon/chart-line-up 1.svg') }}" alt=""><span class="only-icon">Report</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>

                <ul class="treeview-menu" style="display: {{ request()->is('report/purchase/customer') || request()->is('report/purchase/single-product') || request()->is('report/order/customer') || request()->is('report/sale/customer') || request()->is('report/sale/profit-loss') || request()->is('report/expense') ? 'block' : 'none' }}">
                    <li>
                        <a class="nav-link {{ request()->is('report/purchase/customer') ? 'list-active' : '' }}"
                           href="{{ route('report.purchase.customer') }}">
                            Purchase Customer
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('report/purchase/single-product') ? 'list-active' : '' }}"
                           href="{{ route('report.purchase.singleProduct') }}">
                            Purchase Product
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('report/order/customer') ? 'list-active' : '' }}"
                           href="{{ route('report.order.customer') }}">
                            Order Report
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('report/sale/customer') ? 'list-active' : '' }}"
                           href="{{ route('report.sale.customer') }}">
                            Sale Customer
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('report/sale/profit-loss') ? 'list-active' : '' }}"
                           href="{{ route('report.sale.profitLoss') }}">
                            Sale Profit-Loss
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('report/expense') ? 'list-active' : '' }}"
                           href="{{ route('report.expense') }}">
                            Expense Report
                        </a>
                    </li>
                </ul>
            </li>


            {{-- Settings --}}
            <li class="treeview item6">
                <a href="#"
                    class="nav-link main-link {{ request()->is('division*') || request()->is('district*') || request()->is('upazila*') || request()->is('union*') ? 'bar-active' : '' }}">
                    <img src="{{ asset('images/aicon/settings 1.svg') }}" alt=""><span class="only-icon">Settings</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>

                <ul class="treeview-menu" style="display: {{ request()->is('division*') || request()->is('district*') || request()->is('upazila*') || request()->is('union*') ? 'block' : 'none' }}">
                    {{--<li>
                        <a class="nav-link {{ request()->is('warehouse*') ? 'list-active' : '' }}"
                            href="{{ route('warehouse.index') }}">
                            Warehouse
                        </a>
                    </li>--}}
                    <li>
                        <a class="nav-link {{ request()->is('division*') ? 'list-active' : '' }}"
                            href="{{ route('division.index') }}">
                            Division
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('district*') ? 'list-active' : '' }}"
                            href="{{ route('district.index') }}">
                            District
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('upazila*') ? 'list-active' : '' }}"
                            href="{{ route('upazila.index') }}">
                            Upazila
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->is('union*') ? 'list-active' : '' }} pb-5"
                            href="{{ route('union.index') }}">
                            Union
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
  </div>
</nav>
