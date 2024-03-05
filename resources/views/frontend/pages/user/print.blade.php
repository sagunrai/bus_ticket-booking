<!DOCTYPE html>
<html lang="en" id="html">
<head id="head">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket</title>
    <style>
        .sn-bus-detail{
            background-color: #fff;
            padding: 10px;
            width: 600px;
            height: auto;
            display: inline-block;
            border-radius: 10px;
        }.sn-row{
            display: flex;
            flex-wrap: wrap;
            padding: 5px 0;
        }.sn-col{
            width: 45%;
            padding: 0 2%;
        }
        body{
            background-color: rgb(170, 170, 170);
        }
        .sn-text-right{
            text-align: right;
        }
        .sn-head{
            padding: 0 20px;
            text-align: center;
            text-decoration: underline;
            line-height: 10px;
        }
        .sn-text-center{
            text-align: center;
            width: 100%;
        }.sn-badge{
            display: inline-block;
            padding: 2px 5px;
            margin: 0 2px;
            background-color: black;
            color: #fff;
        }
    </style>
</head>
<body onload="Clickheretoprint();">
    <section id="content">
        <div class="sn-bus-detail">
            <div class="sn-section sn-text-center">
                <h1 style="margin: 0">eastbus Pvt. Ltd.</h1>
                <p style="margin: 0">Kathmandu, Nepal</p>
                <div class="sn-row" style="margin-top: 20px;">
                    <div class="sn-col">Ticket No. : <strong>{{ $booking->ticket_number }}</strong></div>
                    <div class="sn-col">Printed Time : {{ now()->format('Y-m-d h:i A') }}</div>
                </div>
            </div>
            <hr>
            <div class="sn-section" style="padding-top: 10px;">
                <h1 class="sn-head">Bus Details</h1>
                <div class="sn-row">
                    <div class="sn-col">
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Route :</div>
                            <div class="sn-col">{{ $booking->busnameforpasger ? ($booking->busnameforpasger->busroutename ? $booking->busnameforpasger->busroutename->name : '') : '' }}</div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Bus Name :</div>
                            <div class="sn-col">{{ $booking->busnameforpasger ? $booking->busnameforpasger->name : '' }}</div>
                        </div>
                        {{-- <div class="sn-row">
                            <div class="sn-col sn-text-right">Bus No. :</div>
                            <div class="sn-col">1234</div>
                        </div> --}}
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Seat No. :</div>
                            <div class="sn-col">
                                    @php
                                        $bustype = $booking->busnameforpasger ? $booking->busnameforpasger->bustypename : '';
                                        // dd($bustype);
                                        $map = explode('|', $booking->map);
                                        $names = json_decode($bustype->seat_names, true);
                                        $count = 0;
                                        if($names){
                                            foreach($map as $m){
                                                $count += 1;
                                                echo '<span class="sn-badge">' . $names[$m] . '</span>';
                                            }
                                        }
                                    @endphp
                            </div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Total Seats :</div>
                            <div class="sn-col">{{ $count }}</div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Per Seat :</div>
                            <div class="sn-col">Rs. {{ $booking->busnameforpasger ? $booking->busnameforpasger->after_discount : 0 }}</div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Total Price :</div>
                            <div class="sn-col">Rs. {{ $booking->payment_amount }} </div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Paied Through :</div>
                            <div class="sn-col">{{ $booking->payment_from }}</div>
                        </div>
                    </div>
                    <div class="sn-col">
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Booking Date :</div>
                            <div class="sn-col">{{ $booking->created_at->format('Y M d') }}</div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Journey Date :</div>
                            <div class="sn-col">{{ \carbon\Carbon::parse($booking->bookingdate)->format('Y M d') }}</div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Departure Time :</div>
                            <div class="sn-col">{{ $booking->busnameforpasger->departuretime }}</div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Arival Time :</div>
                            <div class="sn-col">{{ $booking->busnameforpasger->arrivaltime }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sn-section">
                <h1 class="sn-head">Passengers Details</h1>
                <div class="sn-row">
                    <div class="sn-col">
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Name :</div>
                            <div class="sn-col">{{ $booking->pname }}</div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Email :</div>
                            <div class="sn-col">{{ $booking->pemail }}</div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Phone :</div>
                            <div class="sn-col">{{ $booking->pphone }}</div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Boarding Point :</div>
                            <div class="sn-col">{{ $booking->boarding_point }}</div>
                        </div>
                    </div>
                    <div class="sn-col">
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Address :</div>
                            <div class="sn-col">{{ $booking->address }}</div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Gender :</div>
                            <div class="sn-col">{{ $booking->pgender }}</div>
                        </div>
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Age :</div>
                            <div class="sn-col">{{ $booking->page }}</div>
                        </div>
                    </div>
                    <h4 class="sn-text-center">Remark: {{ $booking->remark }}</h4>
                </div>
            </div>
            <div class="sn-section">
                <h1 class="sn-head">Contact Details</h1>
                <div class="sn-row">
                    <div class="sn-col">
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">Bus Opeator: :</div>
                            <div class="sn-col">9828102545</div>
                        </div>
                    </div>
                    <div class="sn-col">
                        <div class="sn-row">
                            <div class="sn-col sn-text-right">eastbus :</div>
                            <div class="sn-col">9828102545</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sn-section sn-text-center" style="margin-top: 10px;">
                <p>Thank You!! <br> eastbus Team </p>
            </div>
        </div>
    </section>


    <script language="javascript">
        function Clickheretoprint()
        {
          var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
              disp_setting+="scrollbars=yes,width=400,left=100, top=25";
          var content_vlue = document.getElementById("content").innerHTML;
          var head_value = document.getElementById("head").innerHTML;

          var docprint=window.open("","",disp_setting);
           docprint.document.open();
           docprint.document.write(head_value);
            docprint.document.write('</head><body onLoad="self.print()" style="width: 400px; font-size: 12px; font-family: arial;"><style>thead tr rd {border-bottom: 1px dashed #222222;}</style>');
           docprint.document.write(content_vlue);
           docprint.document.close();
           docprint.focus();
        }
        </script>
</body>
</html>
