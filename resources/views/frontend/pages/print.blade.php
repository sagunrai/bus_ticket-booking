<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Receipt example</title>
    <style>
        * {
            font-size: 16px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            width: 386px;
        }

        td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 388px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {
            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
    <script>
        function print() {
            const $btnPrint = document.querySelector("#btnPrint");
            $btnPrint.addEventListener("click", () => {
                window.print();
            });
        }
    </script>
</head>

<body style="background-color: rgb(192, 191, 191);">
    <div class="row">
        {{--  <div class="col-md-4 col-12"></div>  --}}
        <div class="col-md-5 col-12">
            <div class="ticket" style="background-color: white;padding: 25px;text-align: center;">
                <p style="float: right;">Reg.0949332RC</p><br>
                <img src="./logo.png" alt="Logo"><br>
                <p class="centered" style="font-size: 22px;text-align:center">Main BUs Deleux sewa
                    </p>
                <table>
                    <thead>
                        <tr>
                            <th class="quantity">Q.</th>
                            <th class="description">Description</th>
                            <th class="description">Seat-Number</th>
                            <th class="price">$$</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="quantity">1.00</td>
                            <td class="description">ARDUINO UNO R3</td>
                            <td class="description">02</td>
                            <td class="price">Rs.200</td>
                        </tr>
                        <tr>
                            <td class="quantity">1.00</td>
                            <td class="description">STICKER PACK</td>
                            <td class="description">09</td>
                            <td class="price">Rs.100</td>
                        </tr>
                        <tr>
                            <th class="quantity"></th>
                            <th class="quantity"></th>
                            <th class="description">TOTAL</th>
                            <th class="price">Rs.300</th>
                        </tr>
                    </tbody>
                </table>
                <p class="centered">Thanks for your purchase!
                    <br>eastbus.com</p>
            </div>
            <button id="btnPrint" class="hidden-print" onclick="window.print()" style="font-size: 22px">Print</button>
        </div>
        <div class="col-md-7 col-12"></div>
    </div>
</body>

</html>
