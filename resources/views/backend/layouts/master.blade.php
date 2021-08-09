<!DOCTYPE html>
<html lang="en" dir="">
    <head>
       @include('backend.partials.head')
       @yield('style')
    </head>
    <body>
  <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <!-- <div class='loadscreen' id="preloader">
            <div class="loader spinner-bubble spinner-bubble-primary"></div>
        </div> -->
            
            @include('backend.partials.nav')

            <div class="app-main">

                @include('backend.partials.sidebar')
            
                @yield('content')

           </div>

        @include('backend.partials.script')
        @yield('script')
        
        </div>
            
    </body>

</html>
