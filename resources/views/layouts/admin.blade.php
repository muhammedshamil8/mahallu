<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  @yield('css_scripts')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('admin/dashboard.index') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('admin/dashboard.index') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Noble Mahallu</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('dist/img/unknown.png') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview {{ (request()->is('admin/dashboard')) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/admin/dashboard')}}" class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard v1</p>
                  </a>
                </li>
              </ul>
            </li>
            @can('family-list')
            <li class="nav-item has-treeview {{ (request()->is('admin/families*')) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ (request()->is('admin/families*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Family Management
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('families.create')}}" class="nav-link {{ (request()->is('admin/families/create')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('families.index')}}" class="nav-link {{ (request()->is('admin/families*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Edit</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan
            <li class="nav-item has-treeview {{ (request()->is('admin/settings*')) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Master Settings
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">10</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
            @can('educations-list')
                <li class="nav-item">
                  <a href="{{route('educations.index')}}" class="nav-link {{ (request()->is('admin/settings/educations*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Education</p>
                  </a>
                </li>
            @endcan
            @can('islamic_educations-list')
                <li class="nav-item">
                  <a href="{{route('islamic_educations.index')}}" class="nav-link {{ (request()->is('admin/settings/islamic_educations*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Islamic Education</p>
                  </a>
                </li>
            @endcan
            @can('jobs-list')
                <li class="nav-item">
                  <a href="{{route('jobs.index')}}" class="nav-link {{ (request()->is('admin/settings/jobs*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Job</p>
                  </a>
                </li>
            @endcan
            @can('relations-list')
                <li class="nav-item">
                  <a href="{{route('relations.index')}}" class="nav-link {{ (request()->is('admin/settings/relations*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Relation</p>
                  </a>
                </li>
            @endcan
            @can('facilities-list')
                <li class="nav-item">
                  <a href="{{route('facilities.index')}}" class="nav-link {{ (request()->is('admin/settings/facilities*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Facility</p>
                  </a>
                </li>
            @endcan
            @can('relegion-list')
                <li class="nav-item">
                  <a href="{{route('relegion.index')}}" class="nav-link {{ (request()->is('admin/settings/relegion*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Relegion</p>
                  </a>
                </li>
            @endcan
            @can('masjid-list')
                <li class="nav-item">
                  <a href="{{route('masjid.index')}}" class="nav-link {{ (request()->is('admin/settings/masjid*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Masjid</p>
                  </a>
                </li>
            @endcan
            @can('designation-list')
                <li class="nav-item">
                  <a href="{{route('designation.index')}}" class="nav-link {{ (request()->is('admin/settings/designation*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Designation</p>
                  </a>
                </li>
            @endcan
            @can('districts-list')
                <li class="nav-item">
                  <a href="{{route('districts.index')}}" class="nav-link {{ (request()->is('admin/settings/districts*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>District</p>
                  </a>
                </li>
            @endcan
            @can('executive-members-list')
                <li class="nav-item">
                  <a href="{{route('executive-members.index')}}" class="nav-link {{ (request()->is('admin/settings/executive-members*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Non Mahallu Member</p>
                  </a>
                </li>
            @endcan
              </ul>
            </li>
            @can('committe-list')
            <li class="nav-item has-treeview {{ (request()->is('admin/committe*')) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ (request()->is('admin/committe*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Committee Management
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('committe.create')}}" class="nav-link {{ (request()->is('admin/committe/create')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('committe.index')}}" class="nav-link {{ (request()->is('admin/committe*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Edit</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan
            <li class="nav-item has-treeview {{ (request()->is('admin/accounts*')) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ (request()->is('admin/accounts*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Accounts
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">10</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
            @can('account_list-list')
                <li class="nav-item">
                  <a href="{{route('account_list.index')}}" class="nav-link {{ (request()->is('admin/accounts/account_list*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Account Head</p>
                  </a>
                </li>
            @endcan
            @can('receiver_list-list')
                <li class="nav-item">
                  <a href="{{route('receiver_list.index')}}" class="nav-link {{ (request()->is('admin/accounts/receiver_list*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Receiver</p>
                  </a>
                </li>
            @endcan
            @can('bank_account-list')
                <li class="nav-item">
                  <a href="{{route('bank_account.index')}}" class="nav-link {{ (request()->is('admin/accounts/bank_account*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bank</p>
                  </a>
                </li>
            @endcan
            @can('income-list')
                <li class="nav-item">
                  <a href="{{route('income.index')}}" class="nav-link {{ (request()->is('admin/accounts/income*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Income</p>
                  </a>
                </li>
            @endcan
            @can('expense-list')
                <li class="nav-item">
                  <a href="{{route('expense.index')}}" class="nav-link {{ (request()->is('admin/accounts/expense*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Expense</p>
                  </a>
                </li>
            @endcan
            @can('donors-list')
                <li class="nav-item">
                  <a href="{{route('donors.index')}}" class="nav-link {{ (request()->is('admin/accounts/donors*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Donor</p>
                  </a>
                </li>
            @endcan
            @can('helps-list')
                <li class="nav-item">
                  <a href="{{route('helps.index')}}" class="nav-link {{ (request()->is('admin/accounts/helps*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Help</p>
                  </a>
                </li>
            @endcan
            @can('beneficiaries-list')
                <li class="nav-item">
                  <a href="{{route('beneficiaries.index')}}" class="nav-link {{ (request()->is('admin/accounts/beneficiaries*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Beneficiary</p>
                  </a>
                </li>
            @endcan
            @can('staffs-list')
                <li class="nav-item">
                  <a href="{{route('staffs.index')}}" class="nav-link {{ (request()->is('admin/accounts/staffs*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Staff</p>
                  </a>
                </li>
            @endcan
            @can('shops-list')
                <li class="nav-item">
                  <a href="{{route('shops.index')}}" class="nav-link {{ (request()->is('admin/accounts/shops*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Shop</p>
                  </a>
                </li>
            @endcan
              </ul>
            </li>
            <li class="nav-item has-treeview {{ (request()->is('admin/academic*')) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ (request()->is('admin/academic*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>
                  Student Management
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
            @can('students-list')
                <li class="nav-item">
                  <a href="{{route('students.index')}}" class="nav-link {{ (request()->is('admin/academic/students*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Student</p>
                  </a>
                </li>
            @endcan
            @can('classes-list')
                <li class="nav-item">
                  <a href="{{route('classes.index')}}" class="nav-link {{ (request()->is('admin/academic/classes*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Class</p>
                  </a>
                </li>
            @endcan
              </ul>
            </li>
            <li class="nav-item has-treeview {{ (request()->is('admin/reports*')) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ (request()->is('admin/reports*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Report
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">3</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
            @can('family_reports-list')
                <li class="nav-item">
                  <a href="{{route('family_reports.index')}}" class="nav-link {{ (request()->is('admin/reports/family_reports')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Family Report</p>
                  </a>
                </li>
            @endcan
            @can('member_reports-list')
                <li class="nav-item">
                  <a href="{{route('member_reports.index')}}" class="nav-link {{ (request()->is('admin/reports/member_reports')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Member Report</p>
                  </a>
                </li>
            @endcan
            @can('tran_reports-list')
                <li class="nav-item">
                  <a href="{{route('tran_reports.index')}}" class="nav-link {{ (request()->is('admin/reports/tran_reports')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Transaction Report</p>
                  </a>
                </li>
            @endcan
              </ul>
            </li>
            @can('user-list')
            <li class="nav-item">
              <a href="{{ route('user.index') }}" class="nav-link {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  User Management
                </p>
              </a>
            </li>
            @endcan
            @can('role-list')
            <li class="nav-item">
              <a href="{{ route('role.index') }}" class="nav-link {{ (request()->is('admin/role*')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-tag"></i>
                <p>
                  Role Management
                </p>
              </a>
            </li>
            @endcan
            <li class="nav-header">LABELS</li>
            <li class="nav-item">

              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <i class="nav-icon far fa-circle text-danger"></i>
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="http://applet.com">Applet</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.5
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  @yield('scripts')

</body>

</html>