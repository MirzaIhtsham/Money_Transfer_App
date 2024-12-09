<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      
      <span class="brand-text font-weight-light">Money Transfer</span>
    </a>
    @php
      $User = Auth::user()?->usersdocuments->first();
    @endphp
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ "/storage/uploads/profilepics/".$User?->front_side }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('dashboard') }}" class="d-block">{{ Auth::user()?->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('dashboard') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>
        
          @can('admin')
          <li class="nav-item">
            <a href="{{ route('country.index') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Country
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('country.index')  }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Country</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('country.add-country')  }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add a  Country</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('currencies.index') }}" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Currencies
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('currencies.index')  }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Currency</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('currency.add-currency')  }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add a Currency</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('exchange_rates.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Exchange Rates
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('exchange_rates.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exchange Rate</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('exchange_rate.add-exchange_rate') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Exchange Rate</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('payout_method.index') }}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Payout Methods
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('payout_method.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payout Method</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('payout_method.add-payout') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Payout Method</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('transaction.admin.history') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Transaction history
                
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.ledgers.View') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Transaction Ledger
                
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.report') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Transaction Report
                
              </p>
            </a>
            
          </li>
          @endcan


          @can('isadmin')
          <li class="nav-item">
            <a href="{{ route('send.money') }}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Perform Transaction
               
              </p>
            </a>
           
          </li>
          <li class="nav-item">
            <a href="{{ route('transaction.history') }}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Transaction history
                
              </p>
            </a>
           
          </li>
          <li class="nav-item">
            <a href="{{ route('user.ledgers.View') }}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Transaction Ledger
                
              </p>
            </a>
           
          </li>
          <li class="nav-item">
            <a href="{{ route('showReport') }}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Transaction Report
                
              </p>
            </a>
           
          </li> 
          
          @endcan

          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>