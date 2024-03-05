
<?php
    $category = App\Models\Category::where('is_parent',1)->where('status','active')->take(5)->get();
?>


    <section>
        <div id="carouselExampleFade" class="carousel slide carousel-fade sn-carousel" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('frontend/images/cover image busmandu.jpg') }}" class="d-block w-100" alt="eastbus Cover Image">

                </div>
            </div>
        </div>
    </section>
    <section class="search-sec">
        <div class="container">
            <form action="{{ url('/bus-result') }}" method="get">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">




                            <!-- this is the col-4 -->
                            <div class="col-md-3 col-12">
                                <!-- this an div for the maintaining the div -->
                                <div class="for-text-form" style="position: relative">
                                    <h3 class="form-text" style="color:#ffffff;">Home</h3>
                                    <!-- making an input type text -->
                                    <div class="some">
                                        <img src="{{ asset('frontend/images/bus.png') }}" alt="" height="30px" width="30px" style="float: right;position: absolute;right:0;right: 24px;top: 30px;">
                                        <select class="form-control select2 search-slt" id="departureR" name="from">
                                            @foreach ($category as $categorylist)
                                                <option value="{{ $categorylist->name }}"
                                                    <?php
                                                        if(isset($_GET['from'])){
                                                            echo $_GET['from'] == $categorylist->name ? 'selected' : '';
                                                        }
                                                    ?>
                                                    >{{ $categorylist->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- this is the col-4 -->
                            <div class="col-md-3 col-12">
                                <!-- this is the copy and paste -->
                                <!-- this an div for the maintaining the div -->
                                <div class="for-text-form" style="position: relative;">
                                    <h3 class="form-text" style="color:#ffffff;">Destination</h3>
                                    <!-- making an input type text -->
                                    <div class="some">
                                        <img src="{{ asset('frontend/images/bus.png') }}" alt="" height="30px" width="30px" style="float: right;position: absolute;right:0;right: 24px;top: 30px;">
                                        <select class="form-control select2 search-slt" id="departureR" name="to">
                                            @foreach ($category as $categorylist)
                                                <option value="{{ $categorylist->name }}"
                                                    <?php
                                                        if(isset($_GET['to'])){
                                                            echo $_GET['to'] == $categorylist->name ? 'selected' : '';
                                                        }
                                                    ?>
                                                    >{{ $categorylist->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- this is the col-4 -->
                            <div class="col-md-3 col-12">
                                <!-- this is the copy and paste -->
                                <!-- this an div for the maintaining the div -->
                                <div class="for-text-form update-div-date">
                                    <h3 class="form-text" style="color:#ffffff;">Date</h3>
                                    <!-- making an input type text -->
                                    <input id="s_date" type="text" class="enter-city search-slt updating-the-div" name="date"
                                    <?php
                                        if(isset($_GET['date'])){
                                            echo 'value="'.$_GET['date'].'"';
                                        }else{
                                            echo 'value="'.now()->format("d/m/Y").'"';
                                        }
                                    ?>>
                                </div>
                            </div>
                            <div class="col-md-3 mt-4 d-flex">
                                <button type="submit" class="btn btn-danger wrn-btn mt-auto" > Search </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
