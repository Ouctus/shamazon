<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
    <head>
       @include('web.partials.head')
       @yield('style')
    </head>
    <body>
            @include('web.partials.nav')
            @yield('content')
            
            @include('web.partials.footer')

            @include('web.partials.script')
            @yield('script')
        
    </body>

</html>
