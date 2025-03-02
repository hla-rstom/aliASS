<style>
    .bg-shopee {
        background: linear-gradient(45deg, #FF5722, #e13712);
    }

    .collapse-item.active {
        color: #e07a64 !important;
    }
</style>
<!-- Sidebar -->
<ul class="navbar-nav bg-shopee sidebar sidebar-dark accordion" id="accordionSidebar">
    @role('seller')
    <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex align-items-center justify-content-center mt-4">
        <img src="{{ asset('asset/img/fh-logo-white.png') }}" width="200"><br>
    </div>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-text mx-3">{{ Auth::user()->name }} <br> <span class="badge badge-dark" style="text-transform: lowercase">{{ Auth::user()->roles->pluck('name')[0] ?? '' }}</span></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0 mt-3">

    @include('partials._sidebar_wallet')

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>



    <!-- Nav Item - Transaksi -->
    <li class="nav-item {{ request()->is('transaction') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('transaction') }}">
            <i class="fas fa-solid fa-clipboard-list"></i>
            <span>Transaction</span></a>
    </li>


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed{{ Request::is('product') ? ' active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
            <i class="fas fa-solid fa-box"></i>
            <span>Products</span>
        </a>
        <div id="collapseProducts" class="collapse{{ Request::is('product') || Request::is('pricesetting') || Request::is('marketplace') || Request::is('category') ? ' show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item{{ Request::is('product') ? ' active' : '' }}" href="{{ route('product') }}">Master Products</a>
                <a class="collapse-item{{ Request::is('pricesetting') ? ' active' : '' }}" href="{{ route('pricesetting') }}">Price Setting</a>
                <a class="collapse-item{{ Request::is('marketplace') ? ' active' : '' }}" href="{{ route('marketplace') }}">Marketplace Store</a>
                <!--<a class="collapse-item" href="cards.html">Product Setting</a>-->

            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed{{ Request::is('inbound') ? ' active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseInventory" aria-expanded="true" aria-controls="collapseInventory">
            <i class="fas fa-solid fa-cube"></i>
            <span>Inventory</span>
        </a>
        <div id="collapseInventory" class="collapse{{ Request::is('inbound') || Request::is('stock') || Request::is('stocklist') || Request::is('stock') || Request::is('qcmiddle') || Request::is('stockopname') || Request::is('printbarcode') ? ' show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item{{ Request::is('inbound') ? ' active' : '' }}" href="{{ route('inbound') }}">Send Stock</a>
                <a class="collapse-item{{ Request::is('stock') ? ' active' : '' }}" href="{{ route('stock') }}">Stock</a>
                <a class="collapse-item{{ Request::is('stocklist') ? ' active' : '' }}" href="{{ route('stocklist') }}">Mutation Stock</a>
                <!--<a class="collapse-item{{ Request::is('stockeven') ? ' active' : '' }}" href="{{ route('stockeven') }}">Stock Spesial Event</a>-->
                <!--<a class="collapse-item{{ Request::is('qcmiddle') ? ' active' : '' }}" href="{{ route('qcmiddle') }}">QC Middle</a>-->
                <!--<a class="collapse-item{{ Request::is('stockopname') ? ' active' : '' }}" href="{{ route('stockopname') }}">Stock Opname</a>-->
                <!--<a class="collapse-item{{ Request::is('printbarcode') ? ' active' : '' }}" href="{{ route('printbarcode') }}">Request Print Barcode</a>-->
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed{{ Request::is('searchwarehouse') ? ' active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseWarehouse" aria-expanded="true" aria-controls="collapseWarehouse">
            <i class="fas fa-solid fa-home"></i>
            <span>Warehouses</span>
        </a>
        <div id="collapseWarehouse" class="collapse{{ Request::is('searchwarehouse') || Request::is('mywarehouse') || Request::is('move') || Request::is('exit') ? ' show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item{{ Request::is('searchwarehouse') ? ' active' : '' }}" href="{{ route('searchwarehouse') }}">Find Warehouse</a>
                <a class="collapse-item{{ Request::is('mywarehouse') ? ' active' : '' }}" href="{{ route('mywarehouse') }}">My Warehouses</a>
                <!-- <a class="collapse-item{{ Request::is('move') ? ' active' : '' }}" href="{{ route('move') }}">Move
                    Warehouse</a>
                <a class="collapse-item{{ Request::is('exit') ? ' active' : '' }}" href="{{ route('exit') }}">Exit
                    Warehouse</a> -->
            </div>
        </div>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->
    <!--<li class="nav-item">-->
    <!--    <a class="nav-link collapsed{{ Request::is('salereport') ? ' active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseReport">-->
    <!--        <i class="fas fa-solid fa-chart-bar"></i>-->
    <!--        <span>Report</span>-->
    <!--    </a>-->
    <!--    <div id="collapseReport" class="collapse{{ Request::is('salereport') || Request::is('productsalereport') || Request::is('transactionreport') || Request::is('stockadjustment') || Request::is('logisticreport') ? ' show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">-->
    <!--        <div class="bg-white py-2 collapse-inner rounded">-->
    <!--            <a class="collapse-item{{ Request::is('salereport') ? ' active' : '' }}" href="{{ route('salereport') }}">Sales</a>-->
    <!--            <a class="collapse-item{{ Request::is('productsalereport') ? ' active' : '' }}" href="{{ route('productsalereport') }}">Sales Produck</a>-->
    <!--            <a class="collapse-item{{ Request::is('transactionreport') ? ' active' : '' }}" href="{{ route('transactionreport') }}">Find Transaction</a>-->
    <!--            <a class="collapse-item" href="">Financial Report</a>-->
    <!--            <a class="collapse-item{{ Request::is('stockadjustment') ? ' active' : '' }}" href="{{ route('stockadjustment') }}">Stock Adjusment</a>-->
    <!--            <a class="collapse-item{{ Request::is('logisticreport') ? ' active' : '' }}" href="{{ route('logisticreport') }}">Logistics</a>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</li>-->

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed{{ Request::is('setting_account') ? ' active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseSetting" aria-expanded="true" aria-controls="collapseSetting">
            <i class="fas fa-solid fa-wrench"></i>
            <span>Setting</span>
        </a>
        <div id="collapseSetting" class="collapse{{ Request::is('setting_account') || Request::is('packagingtemplate') || Request::is('packagingfeeconfirms') || Request::is('shop') ? ' show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item{{ Request::is('setting_account') ? ' active' : '' }}" href="{{ url('setting_account') }}">Account</a>
                <a class="collapse-item{{ Request::is('packagingtemplate') ? ' active' : '' }}" href="{{ route('packagingtemplate') }}">Packaging</a>
                <a class="collapse-item{{ Request::is('packagingfeeconfirms') ? ' active' : '' }}" href="{{ route('packagingfeeconfirms') }}">Fee Packaging Confirm</a>
                <a class="collapse-item{{ Request::is('shop') ? ' active' : '' }}" href="{{ url('shop') }}">Store</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <!--<li class="nav-item">-->
    <!--    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHelp" aria-expanded="true" aria-controls="collapseHelp">-->
    <!--        <i class="fas fa-solid fa-comment"></i>-->
    <!--        <span>Support Center</span>-->
    <!--    </a>-->
    <!--    <div id="collapseHelp" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">-->
    <!--        <div class="bg-white py-2 collapse-inner rounded">-->
    <!--            <a class="collapse-item" href="login.html">Complain</a>-->
    <!--            <a class="collapse-item" href="login.html">Ticket</a>-->
    <!--            <a class="collapse-item" href="register.html">Chat</a>-->
    <!--            <a class="collapse-item" href="register.html">FAQ</a>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</li>-->
    @endrole

    @role('retail')
    <!-- Warehouse sidebar side -->

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-4" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            
        </div>
        <div class="sidebar-brand-text mx-3">{{ Auth::user()->name }} <span class="badge badge-dark" style="text-transform: lowercase">{{ Auth::user()->roles->pluck('name')[0] ?? '' }}</span></div>
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class='bx bx-home-circle bx-sm'></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item {{ request()->is('request') ? 'active' : '' }}">
        <a class="nav-link" href=" {{ route('request') }} ">
            <i class='bx bx-mail-send bx-sm' ></i>
            <span>Retail Request</span></a>
    </li>
    <li class="nav-item {{ request()->is('warehouseInbound') ? 'active' : '' }}">
        <a class="nav-link" href=" {{ route('warehouseInbound') }} ">
            <i class='bx bx-down-arrow-circle bx-sm' ></i>
            <span>Inbound</span></a>
    </li>
    <li class="nav-item {{ request()->is('outbound') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('outbound') }}">
            <i class='bx bx-up-arrow-circle bx-sm' ></i>
            <span>Outbound</span></a>
    </li>
    <li class="nav-item {{ request()->is('history_transaction') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('history_transaction') }}">
            <i class='bx bx-dollar-circle bx-sm'></i>
            <span>Fees History</span></a>
    </li>
    <li class="nav-item {{ request()->is('retailstore') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('retailstore') }}">
            <i class='bx bx-store bx-sm' ></i>
            <span>Retail Store</span></a>
    </li>
    <!--<li class="nav-item {{ request()->is('manifest') ? 'active' : '' }}">-->
    <!--    <a class="nav-link" href="{{ route('manifest') }}">-->
    <!--        <i class="fas fa-solid fa-file"></i>-->
    <!--        <span>Manifest</span></a>-->
    <!--</li>-->
    <!--<li class="nav-item">-->
    <!--    <a class="nav-link collapsed{{ Request::is('warehouseStock') ? ' active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseWarehouseInventory" aria-expanded="true" aria-controls="collapseWarehouseInventory">-->
    <!--        <i class="fas fa-solid fa-cube"></i>-->
    <!--        <span>Inventory</span>-->
    <!--    </a>-->
    <!--    <div id="collapseWarehouseInventory" class="collapse{{ Request::is('warehouseStock') || Request::is('qcrequest') ? ' show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">-->
    <!--        <div class="bg-white py-2 collapse-inner rounded">-->
    <!--            <a class="collapse-item{{ Request::is('warehouseStock') ? ' active' : '' }}" href="{{ route('warehouseStock') }}">Stock</a>-->
    <!--            <a class="collapse-item" href="">Load Product</a>-->
    <!--            <a class="collapse-item" href="">Stock Opname</a>-->
    <!--            <a class="collapse-item" href="">Migration use Bin</a>-->
    <!--            <a class="collapse-item{{ Request::is('qcrequest') ? ' active' : '' }}" href="{{ route('qcrequest') }}">Qc Request</a>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</li>-->
    <li class="nav-item">
        <a class="nav-link collapsed{{ Request::is('warehouseaccount') ? ' active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseSetting" aria-expanded="true" aria-controls="collapseSetting">
            <i class='bx bx-cog bx-sm' ></i>
            <span>Setting</span>
        </a>
        <div id="collapseSetting" class="collapse{{ Request::is('warehouseaccount') || Request::is('warehousedata') ? ' show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <a class="collapse-item" href="{{ route('warehouseaccount') }}">Account</a> -->
                <a class="collapse-item" href="{{ route('warehousedata') }}">Retail Data</a>
                <!--<a class="collapse-item" href="">About</a>-->
            </div>
        </div>
    </li>
    <!--<li class="nav-item {{ request()->is('warehousetransactionreport') ? 'active' : '' }}">-->
    <!--    <a class="nav-link" href="{{ route('warehousetransactionreport') }}">-->
    <!--        <i class="fas fa-solid fa-chart-bar"></i>-->
    <!--        <span>Reports</span></a>-->
    <!--</li>-->
    <li class="nav-item">
        <a class="nav-link collapsed{{ Request::is('sellerlist') ? ' active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseOther" aria-expanded="true" aria-controls="collapseOther">
            <i class='bx bx-rocket bx-sm' ></i>
            <span>Other</span>
        </a>
        <div id="collapseOther" class="collapse{{ Request::is('sellerlist') || Request::is('packaging') || Request::is('facility') || Request::is('logistic') ? ' show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item{{ Request::is('sellerlist') ? ' active' : '' }}" href="{{ route('sellerlist') }}">Seller List</a>
                <!--<a class="collapse-item" href="">Review</a>-->
            </div>
        </div>
    </li>
    <!--<li class="nav-item">-->
    <!--    <a class="nav-link" href="index.html">-->
    <!--        <i class="fas fa-solid fa-envelope"></i>-->
    <!--        <span>Ticket</span></a>-->
    <!--</li>-->
    @endrole


    @role('super_admin')
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-4" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ Auth::user()->name }} <span class="badge badge-dark" style="text-transform: lowercase">{{ Auth::user()->roles->pluck('name')[0] ?? '' }}</span></div>
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed{{ Request::is('topup') ? ' active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseApprove" aria-expanded="true" aria-controls="collapseApprove">
            <i class="fas fa-solid fa-clipboard-check"></i>
            <span>Approve</span>
        </a>
        <div id="collapseApprove" class="collapse{{ Request::is('topup') || Request::is('warehouse_account_approve') || Request::is('warehouse_approve') ? ' show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item{{ Request::is('topup') ? ' active' : '' }}" href="{{ route('topup') }}">Top Up</a>
                <a class="collapse-item{{ Request::is('warehouse_account_approve') ? ' active' : '' }}" href="{{ route('warehouse_account_approve') }}">Warehouse Account</a>
                <a class="collapse-item{{ Request::is('warehouse_approve') ? ' active' : '' }}" href="{{ route('warehouse_approve') }}">Warehouse</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed{{ Request::is('paymentHistory') ? ' active' : '' }}" href="#" data-toggle="collapse" data-target="#collapsePayment" aria-expanded="true" aria-controls="collapseApprove">
            <i class="fas fa-solid fa-dollar-sign"></i>
            <span>Payment</span>
        </a>
        <div id="collapsePayment" class="collapse{{ Request::is('paymentHistory') || Request::is('walletHistory') || Request::is('masterPayment') || Request::is('masterBank') ? ' show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item{{ Request::is('paymentHistory') ? ' active' : '' }}" href="{{ route('paymentHistory') }}">Payment History</a>
                <a class="collapse-item{{ Request::is('walletHistory') ? ' active' : '' }}" href="{{ route('walletHistory') }}">Wallet History</a>
                <a class="collapse-item{{ Request::is('masterPayment') ? ' active' : '' }}" href="{{ route('masterPayment') }}">Master Payment</a>
                <a class="collapse-item{{ Request::is('masterBank') ? ' active' : '' }}" href="{{ route('masterBank') }}">Master Banks</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed{{ Request::is('packaging') ? ' active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseMaster">
            <i class="fas fa-solid fa-rocket"></i>
            <span>Master</span>
        </a>
        <div id="collapseMaster" class="collapse{{ Request::is('category') || Request::is('packaging') || Request::is('facility') || Request::is('logistic') || Request::is('option') ? ' show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item{{ Request::is('packaging') ? ' active' : '' }}" href="{{ route('packaging') }}">Packaging</a>
                <a class="collapse-item{{ Request::is('facility') ? ' active' : '' }}" href="{{ route('facility') }}">Facility</a>
                <a class="collapse-item{{ Request::is('logistic') ? ' active' : '' }}" href="{{ route('logistic') }}">Logistic</a>
                <a class="collapse-item{{ Request::is('category') ? ' active' : '' }}" href="{{ route('category') }}">Category Product</a>
                <a class="collapse-item{{ Request::is('option') ? ' active' : '' }}" href="{{ route('option') }}">Option Global</a>
                <a class="collapse-item{{ Request::is('optionvalue') ? ' active' : '' }}" href="{{ route('optionvalue') }}">Option Value Global</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed{{ Request::is('setting_account') ? ' active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseSetting" aria-expanded="true" aria-controls="collapseSetting">
            <i class="fas fa-solid fa-wrench"></i>
            <span>Setting</span>
        </a>
        <div id="collapseSetting" class="collapse{{ Request::is('role') || Request::is('setting_account') ? ' show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item{{ Request::is('role') ? ' active' : '' }}" href="{{ route('role') }}">Role</a>
            </div>
        </div>
    </li>
    @endrole

</ul>


<!-- End of Sidebar -->