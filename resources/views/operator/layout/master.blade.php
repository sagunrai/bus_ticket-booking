


<!doctype html>
<html lang="en">

@include('operator.layout.head')

<body>

    <div class="dashboard-main-wrapper">

        <!-- Header -->

        @include('operator.layout.header')

        <!-- end Header -->

        <!-- sidebar -->

        @include('operator.layout.sidebar')

        <!-- end sidebar -->

        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                @yield('main-content')
            </div>

            <!-- footer -->

            @include('operator.layout.footer')

            <!-- end footer -->

        </div>

    </div>

    <!-- end main wrapper  -->

    @include('operator.layout.foot')
</body>

</html>
