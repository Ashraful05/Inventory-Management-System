<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Wise Credit Report</title>
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
                    <td width="55%"></td>
                    <td>
                        <u><strong><span style="font-size: 15px;">Customer Credit Report</span></strong></u>
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
                    <th>Customer Name</th>
                    <th>Invoice Number</th>
                    <th>Date</th>
                    <th>Due Amount</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalDue = '0';
                @endphp
                @foreach($credits as $key => $credit)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            {{$credit['customer']['name']}}
                            ({{$credit['customer']['mobile_no']}} - {{$credit['customer']['address']}})
                        </td>
                        <td class="center">Invoice No# {{$credit['invoice']['invoice_no']}}</td>
                        <td class="center">{{ date('d-m-Y',strtotime($credit['invoice']['date'] )) }}</td>
                        <td class="center">Tk. {{$credit->due_amount}}</td>
                        @php
                            $totalDue += $credit->due_amount;
                        @endphp
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align: right;">Grand Total</td>
                    <td>TK. {{$totalDue}}</td>
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

