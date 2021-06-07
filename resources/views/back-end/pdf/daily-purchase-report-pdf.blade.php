<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Invoice Report</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>
                        <span class="text-center text-success" style="font-size: 20px;background-color: #00b0e8">Ashraf Traders</span>
                        <br>Saidpur, Nilphamari
                    </td>
                    <td>
                        <span>Mobile No: 0188734340</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr style="margin-bottom: 0px;">
            <table>
                <tbody>
                <tr>
                    <td width="25%"></td>
                    <td>
                        <u><strong><span style="font-size: 15px;">Daily Purchase Report({{date('d-m-Y',strtotime($startDate))}} - {{date('d-m-Y',strtotime($endDate))}})</span></strong></u>
                    </td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table border="1" width="100%">
                <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Purchase No.</th>
                    <th>Date</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
                </thead>
                <tbody>
                @php
                $totalSum='0';
                @endphp
                @foreach($reports as $key => $report)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$report->purchase_no}}</td>
                        <td>{{date('d-m-Y',strtotime($report->date))}}</td>
                        <td>{{$report['product']['name']}}</td>
                        <td>
                            {{$report->buying_quantity}}
                            {{$report['product']['unit']['name']}}
                        </td>
                        <td>{{$report->unit_price}}</td>
                        <td>{{$report->buying_price}} </td>
                       @php
                        $totalSum += $report->buying_price;
                       @endphp
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6" style="text-align: right;"><strong>Grand Total: </strong></td>
                    <td>{{$totalSum}}</td>
                </tr>
                </tbody>
            </table>
            <br>
            @php($date = new DateTime('now',new DateTimeZone('Asia/Dhaka')))
            <i>Printing Time: {{$date->format('F j, Y, g:i a')}}</i>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table border="0" width="100%">
                <tbody>
                <tr>
                    <td style="width: 40%"></td>
                    <td style="width: 20%"></td>
                    <td style="width: 40%; text-align: center;">
                        <p style="text-align: center; border-bottom: 1px solid #000;">Owner Signature</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>


