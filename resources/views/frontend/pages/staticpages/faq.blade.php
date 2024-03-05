@extends('frontend.layouts.hf')

@section('style')
    <style>
        body
        {
            background: #AC3365;  /* fallback for old browsers */
            background: linear-gradient(to right, #E60019, #AC3365, #4B4CB4);

        }

        .panel
        {
            margin-bottom: 0px;
        }
        .checkout-step
        {
            /*background: #e8eef1;*/

            background: #83a4d4;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #b6fbff, #83a4d4);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #b6fbff, #83a4d4); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


            border-top: 1px solid #607d8b21;
            color: #666;
            font-size: 14px;
            padding: 15px 10px;
            position: relative;
        }

        .checkout-step-number
        {
            border-radius: 50%;
            /* border: 1px solid #ced0d2; */
            display: inline-block;
            background: #065c9f;
            font-size: 12px;
            color: #fff;
            font-weight: bold;
            height: 32px;
            margin-right: 15px;
            padding: 6px;
            text-align: center;
            width: 32px;
        }
        .checkout-step-title
        {
            font-size: 16px;
            font-weight: 500;
            vertical-align: middle;display: inline-block; margin: 0px;
            color: #3d4884;
        }

        .checkout-step-body
        {
            background: #fbfbfb;
            padding: 15px 0px;
            margin: 20px 0px 0px;
        }

        /*Shyam*/

        .imi-joingform
        {
            margin-top: 50px;
        }

        .sn-jfheader
        {
            background: #fff;
            padding: 15px;
        }

        .sn-text h1
        {
            font-size: 20px;
            color: #00BCD4;
        }

        .sn-text h2
        {
            font-size: 12px;
        }

        .sn-jfeditbtn
        {
            padding: 5px;
            font-size: 12px;
            color: #fff;
            font-weight: bold;
            background: #29506f;
        }

    </style>
@endsection

@section('content')

<div id="tabs" class="project-tab">

    <div class="container imi-joingform">


        <!-- Start Header -->

        <div class="sn-jfheader">
            <div class="row">
                <div class="col-lg-6">
                    <div class="sn-logo">
                    <h3>FAQS</h3>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div id="accordion" class="">

                    <!-- Start First collapse -->
                    <div class="panel checkout-step">
                        <div role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >

                            <div class="row">
                                    <div class="col-10 col-lg-10">
                                        <span class="checkout-step-number">1</span>
                                        <h4 class="checkout-step-title"> <a role="button"> GENERAL</a></h4>
                                    </div>

                                    <div class="col-2 col-lg-2 text-right d-none d-sm-block d-md-block d-lg-block d-xl-block">
                                        <button id="nextBtn" name="nextBtn" class="btn btn-default sn-jfeditbtn"><i class="fas fa-angle-down    "></i></button>
                                    </div>
                            </div>

                        </div>
                        <div id="collapseOne" class="collapse in">

                            <!-- Start collapse body -->

                            <div class="checkout-step-body px-2">

                                <!-- Start row -->

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>Why eastbus for online bus ticket booking?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>There are several reasons to book a bus ticket through eastbus.:<br>
                                            - eastbus provides you the convenience to book bus from your home/ city.<br>
                                            - eastbus offers a wide variety of bus types by numerous bus operators on your selected route.<br>
                                            - You can download an m-ticket or e-ticket.<br>
                                            - It&rsquo;s the best platform for booking cheap bus tickets.<br>
                                            - Cancelling and Refund options are available with eastbus.<br>
                                            </p>
                                    </div>
                                </div>
                            </div>
                            <!-- End collapse body -->
                        </div>
                    </div>

                    <!-- End First collapse -->



                    <!-- Start First collapse -->
                    <div class="panel checkout-step">
                        <div role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOnes" >

                            <div class="row">
                                    <div class="col-10 col-lg-10">
                                        <span class="checkout-step-number">2 </span>
                                        <h4 class="checkout-step-title"> <a role="button"> TICKET RELATED </a></h4>
                                    </div>

                                    <div class="col-2 col-lg-2 text-right d-none d-sm-block d-md-block d-lg-block d-xl-block">
                                        <button id="nextBtn" name="nextBtn" class="btn btn-default sn-jfeditbtn"><i class="fas fa-angle-down    "></i></button>
                                    </div>
                            </div>

                        </div>
                        <div id="collapseOnes" class="collapse in">

                            <!-- Start collapse body -->

                            <div class="checkout-step-body px-2">

                                <!-- Start row -->

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>How do I buy a ticket on eastbus.com?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>You can book the tickets online which is a very simple three step process ( Select Route, Select Bus & Seat and then Make payment ). U will receive the ticket in your registered mobile number, also u can send ur ticket in your e-mail id. </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>What happens when my schedule/service is cancelled?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>We'll make every effort to ensure that your travel is not affected by providing alternate services to help you reach the destination.  </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>Do I have to pay extra when compared to buying the tickets offline?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>eastbus does not charge anything extra when compared to the traditional way (offline). The tickets are absolutely at the same cost that the travel bus partner has priced them. </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>How does your boarding process work?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>Please arrive at the pick-up ( boarding point ) point a minimum of 15 minutes before departure. Please have your SMS confirmation (or ticket printout in some cases) and a valid identity proof.  </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>I’ve lost my ticket printout. What do I do now?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>A copy of the ticket would have been sent to you by e-mail when you booked the ticket. Please take a printout of that mail and produce it at the time of boarding. If you have not received your ticket to the e-mail id you provided, you can take a printout on eastbus.com website by going to ' My Booking Section '. or u can contact eastbus team for assistance.  </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>Why is it mandatory to provide my mobile number during booking the ticket(s)?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>You must fill in the field "Mobile Number" when booking tickets. Your mobile number will be used to send Booking confirmation SMS, Boarding point details, bus partner will be able to contact you quickly in case you are not on time at the boarding point or eastbus will be able to contact you if there is any change in schedule.  </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>I have not received the tickets to my email id, what do I do?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>If you did not receive an email after your conformation of the booking, there can be two reasons: The net banking or wallet payment has failed. In this case the purchase is cancelled by the system. You have entered an incorrect e-mail address. The email ticket has ended up in spam folder. Please check your bank statement first to see if your account/card was charged, please contact us in order to solve this problem. If your account was not charged, then you can retry the booking. If you have any further questions, please feel free to call our 24/7 customer support.</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>I did not receive my SMS Ticket confirmation on mobile. Can you re-send it?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>Yes. Please contact our 24/7 customer support and we will be able to re-send you the SMS ticket confirmation with Ticket Number.</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>Is it mandatory to carry the required identity proofs along with the e-ticket?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>Yes, it is mandatory to carry identity proof along with the e-ticket. </p>
                                    </div>
                                </div>

                            </div>
                            <!-- End collapse body -->
                        </div>
                    </div>



                    <!-- End First collapse -->



                      <!-- Start First collapse -->
                      <div class="panel checkout-step">
                        <div role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOnep" >

                            <div class="row">
                                    <div class="col-10 col-lg-10">
                                        <span class="checkout-step-number">3</span>
                                        <h4 class="checkout-step-title"> <a role="button"> PAYMENTS RELATED  </a></h4>
                                    </div>

                                    <div class="col-2 col-lg-2 text-right d-none d-sm-block d-md-block d-lg-block d-xl-block">
                                        <button id="nextBtn" name="nextBtn" class="btn btn-default sn-jfeditbtn"><i class="fas fa-angle-down"></i></button>
                                    </div>
                            </div>

                        </div>
                        <div id="collapseOnep" class="collapse in">

                            <!-- Start collapse body -->

                            <div class="checkout-step-body px-2">

                                <!-- Start row -->

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>What Payment types do you accept?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>We accept digital wallet ( Khalti, E-sewa ), Connect IPS, Mobile Banking, E-Banking, SCT Cards. We accept cards that are issued in Nepal only.</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>Is there any other option to book tickets from eastbus?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>Yes, u can book ticket from eastbus by visiting the ticket counters of our Bus partners. </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>How safe are online transactions on eastbus.com?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>Transactions on eastbus.com are very safe. eastbus.com has the best-in-class security. eastbus.com uses Secure Socket Layers (SSL) data encryption. Using SSL ensures that the information exchanged with eastbus.com is never transmitted unencrypted thus protecting the information from being viewed by unauthorized individuals.  </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>Can I pay for someone else?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>Yes, you can pay/book bus tickets for others. It is not necessary that the payee has to travel. Please make sure you are giving the right details for all passengers and also make sure they carry ID cards to ensure that there won't be any issues. </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>Is Phone booking of bus tickets available?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>Yes. You can book your bus tickets by phone.</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>Is Home Delivery / Cash on Delivery of tickets available?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>No. We do not have that facility for now. You can either carry the SMS confirmation we send or in some cases you can carry the ticket printout that you can print after booking confirmation.</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 pb-2">
                                        <h5> <strong>How fast should I complete the online payment?</strong> </h5>
                                    </div>
                                    <div class="col-12">
                                        <p>Payment for any booking, after selecting the seats has to be completed within 10 minutes. If you don't complete the payment during the 10 minutes after selecting your seats, your order will be annulled/void and the seats will be released for others to book.</p>
                                    </div>
                                </div>


                            </div>
                            <!-- End collapse body -->





                        </div>
                    </div>
                <!-- End accordion -->


                <!-- Start First collapse -->
                <div class="panel checkout-step">
                    <div role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOneps" >

                        <div class="row">
                                <div class="col-10 col-lg-10">
                                    <span class="checkout-step-number">4</span>
                                    <h4 class="checkout-step-title"> <a role="button"> CANCELLATION RELATED </a></h4>
                                </div>

                                <div class="col-2 col-lg-2 text-right d-none d-sm-block d-md-block d-lg-block d-xl-block">
                                    <button id="nextBtn" name="nextBtn" class="btn btn-default sn-jfeditbtn"><i class="fas fa-angle-down"></i></button>
                                </div>
                        </div>

                    </div>
                    <div id="collapseOneps" class="collapse in">

                        <!-- Start collapse body -->

                        <div class="checkout-step-body px-2">

                            <!-- Start row -->

                            <div class="row">
                                <div class="col-12 pb-2">
                                    <h5> <strong>Can I cancel my bus ticket?</strong> </h5>
                                </div>
                                <div class="col-12">
                                    <p>Yes. The tickets booked through eastbus can be cancelled* before the cutoff time on the day of journey which is the start of the bus at the first boarding point. *Cancellation terms vary from bus partner to bus partner.</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 pb-2">
                                    <h5> <strong>How can I cancel my ticket, if I need to?</strong> </h5>
                                </div>
                                <div class="col-12">
                                    <p>To cancel your ticket, Login to your eastbus account. Open " My Booking " page, there u can see your ticket and can take actions on your ticket ( the action can be View, SMS, E-mail or Cancel the ticket ). By clicking on cancel my ticket, your ticket will be cancelled and refund process will be initiated.  </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 pb-2">
                                    <h5> <strong>Can I partially cancel my ticket?</strong> </h5>
                                </div>
                                <div class="col-12">
                                    <p>No, partial cancellation is not allowed till date, but we are working on this features and we will inform after updating this feature. </p>
                                </div>
                            </div>




                        </div>
                        <!-- End collapse body -->



            </div>
                </div>


             <!-- Start First collapse -->
             <div class="panel checkout-step">

                <div role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOnepsa" >

                    <div class="row">
                            <div class="col-10 col-lg-10">
                                <span class="checkout-step-number">5</span>
                                <h4 class="checkout-step-title"> <a role="button"> REFUND RELATED </a></h4>
                            </div>

                            <div class="col-2 col-lg-2 text-right d-none d-sm-block d-md-block d-lg-block d-xl-block">
                                <button id="nextBtn" name="nextBtn" class="btn btn-default sn-jfeditbtn"><i class="fas fa-angle-down"></i></button>
                            </div>
                    </div>

                </div>

                <div id="collapseOnepsa" class="collapse in">

                    <!-- Start collapse body -->

                    <div class="checkout-step-body px-2">

                        <!-- Start row -->

                        <div class="row">
                            <div class="col-12 pb-2">
                                <h5> <strong>I missed the bus, am I eligible for a refund?</strong> </h5>
                            </div>
                            <div class="col-12">
                                <p>eastbus provides 100% refund if the bus is missed due to either eastbus or its partner company's fault. However, if the bus is missed due to any other reasons not directly related to eastbus it does not provide any refund (for example: waiting at the wrong pickup point or arriving late at the pickup point is not considered for refund).</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 pb-2">
                                <h5> <strong>
                                    I have cancelled my booking and when can I get the refund amount?</strong> </h5>
                            </div>
                            <div class="col-12">
                                <p>Generally all refunds are processed the same day or instantly in most cases. Money is transferred/refunded back to the passenger's digital wallet or bank account by the payment gateway within 24 hours. After which depending on the customer’s bank, it takes 2-7 working days to reflect the credit in your account. </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 pb-2">
                                <h5> <strong>Would I get a full refund?</strong> </h5>
                            </div>
                            <div class="col-12">
                                <p>Full refund happens only when there has been an error from eastbus.com’s end or the bus partners end. In other cases, where the traveler requests for cancellation, partial refund happens. Please check the cancellation terms of the particular bus partner. Or please contact our customer support for more details. </p>
                            </div>
                        </div>




                    </div>
                    <!-- End collapse body -->



        </div>
             </div>




        <!-- Start First collapse -->
        <div class="panel checkout-step">
            <div role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOnepsb" >

                <div class="row">
                        <div class="col-10 col-lg-10">
                            <span class="checkout-step-number">6</span>
                            <h4 class="checkout-step-title"> <a role="button"> BUS PARTNER RELATED </a></h4>
                        </div>

                        <div class="col-2 col-lg-2 text-right d-none d-sm-block d-md-block d-lg-block d-xl-block">
                            <button id="nextBtn" name="nextBtn" class="btn btn-default sn-jfeditbtn"><i class="fas fa-angle-down"></i></button>
                        </div>
                </div>

            </div>

            <div id="collapseOnepsb" class="collapse in">

                <!-- Start collapse body -->

                <div class="checkout-step-body px-2">

                    <!-- Start row -->

                    <div class="row">
                        <div class="col-12 pb-2">
                            <h5> <strong>Are there any separate Bus Partner Rules I need to know?</strong> </h5>
                        </div>
                        <div class="col-12">
                            <p>Each Bus Partner has their own rules regarding amount of luggage allowed, available luggage space, extra payments for boxes, etc. Each Bus Partner has its own conditions of refunds - these are displayed to you when you are choosing the Bus during the booking process. Please feel free to call our 24/7 customer support if you need any specific information.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 pb-2">
                            <h5> <strong>
                                What are the rules on luggage?</strong> </h5>
                        </div>
                        <div class="col-12">
                            <p>Every Bus Partner has their own rules regarding amount of luggage allowed, available luggage space, extra payments for boxes, etc. Please feel free to call our 24/7 customer support if you need any specific information. </p>
                        </div>
                    </div>
                </div>
                <!-- End collapse body -->
            </div>
        </div>
        <!-- Start First collapse -->
        <div class="panel checkout-step">
            <div role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOnepsc" >

                <div class="row">
                        <div class="col-10 col-lg-10">
                            <span class="checkout-step-number">7</span>
                            <h4 class="checkout-step-title"> <a role="button"> DISCOUNTS & OFFERS </a></h4>
                        </div>

                        <div class="col-2 col-lg-2 text-right d-none d-sm-block d-md-block d-lg-block d-xl-block">
                            <button id="nextBtn" name="nextBtn" class="btn btn-default sn-jfeditbtn"><i class="fas fa-angle-down"></i></button>
                        </div>
                </div>

            </div>

            <div id="collapseOnepsc" class="collapse in">

                <!-- Start collapse body -->

                <div class="checkout-step-body px-2">

                    <!-- Start row -->

                    <div class="row">
                        <div class="col-12 pb-2">
                            <h5> <strong>Do you have any Discount Coupons that I can use?</strong> </h5>
                        </div>
                        <div class="col-12">
                            <p>Please check the offers page for any active offers.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 pb-2">
                            <h5> <strong>
                                I have a discount coupon but cannot get any discount?</strong> </h5>
                        </div>
                        <div class="col-12">
                            <p>The discount coupon that you are using might have expired or has crossed its usage limit or is not applicable for the partner you selected. Every coupon has its own set of rules and these might be changed without notice for various reasons. However you can check the offers page for any active offers. </p>
                        </div>
                    </div>






                 </div>

            </div>
        </div>

                            <!-- Start First collapse -->
                        <div class="panel checkout-step">
                    <div role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOnepsd" >

                <div class="row">
                <div class="col-10 col-lg-10">
                    <span class="checkout-step-number">8</span>
                    <h4 class="checkout-step-title"> <a role="button"> OTHER INFORMATION  </a></h4>
                </div>

                <div class="col-2 col-lg-2 text-right d-none d-sm-block d-md-block d-lg-block d-xl-block">
                    <button id="nextBtn" name="nextBtn" class="btn btn-default sn-jfeditbtn"><i class="fas fa-angle-down"></i></button>
                </div>
        </div>
                    </div>
    </div>

            <div id="collapseOnepsd" class="collapse in">

        <!-- Start collapse body -->

        <div class="checkout-step-body px-2">

            <!-- Start row -->

            <div class="row">
                <div class="col-12 pb-2">
                    <h5> <strong>What if I have additional questions?</strong> </h5>
                </div>
                <div class="col-12">
                    <p>If you have any additional questions, comments or other general customer service inquiries, please contact our 24/7 customer support.</p>
                </div>
            </div>

        </div>






        </div>
        <!-- End collapse body -->
                <!-- End collapse body -->





                <!-- End row -->





    <!-- End Joining Form -->

                </div>
            </div>


    </div>

  </div>
@endsection
{{-- @section('scripts')
<script src="{{ asset('maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js') }}"></script>
@endsection --}}
