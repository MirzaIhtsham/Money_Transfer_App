<!DOCTYPE html>
<html >
        @include('layouts.admin.head')
<body>
    
        @include('layouts.admin.header')

        
        @include('layouts.admin.sidebar')

        <div class="content-wrapper">
                <section class="content-header">
                        <div class="container-fluid">
                          <div class="row mb-2">
                            <div class="col-sm-6">
                              <h1>          @yield('specific_title')</h1>
                            </div>
                            <div class="col-sm-6">
                              <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                              </ol>
                            </div>
                          </div>
                        </div><!-- /.container-fluid -->
                      </section>

                      
                 @yield('content')

        </div>
           
        @include('layouts.admin.footer')
    
</body>
@include('layouts.admin.foot')
</html>

