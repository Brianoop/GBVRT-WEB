<!DOCTYPE html>
<html lang="en">

<head>
 
    @include('dashboard.includes.head')

</head>

<body class="app">
    <header class="app-header fixed-top">
        <div class="app-header-inner">

           @include('dashboard.includes.app_header_inner')

        </div>
        <!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel">
            
            @include('dashboard.includes.app_side_panel_inner')

        </div>
        <!--//app-sidepanel-->
    </header>
    <!--//app-header-->

    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
           @yield('content')
        </div>
        <!--//app-content-->

        <footer class="app-footer">
            @include('dashboard.includes.app_footer')
        </footer>
        <!--//app-footer-->

    </div>
    <!--//app-wrapper-->

    @include('dashboard.includes.app_bottom_files')
    

</body>

</html>
