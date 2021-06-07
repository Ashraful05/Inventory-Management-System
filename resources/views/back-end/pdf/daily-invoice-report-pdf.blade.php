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
                        <u><strong><span style="font-size: 15px;">Daily Invoice Report({{date('d-m-Y',strtotime($startDate))}} - {{date('d-m-Y',strtotime($endDate))}})</span></strong></u>
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
                    <th>Invoice No.</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                @php($totalSum = '0')
                @foreach($reports as $key => $report)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            {{$report['payment']['customer']['name']}}
                            ({{$report['payment']['customer']['mobile_no']}} - {{$report['payment']['customer']['address']}})
                        </td>
                        <td>#{{$report->invoice_no}}</td>
                        <td>{{$report->date}}</td>
                        <td>{{$report->description}}</td>
                        <td>{{$report['payment']['total_amount']}}</td>
                        @php($totalSum += $report['payment']['total_amount'])
                    </tr>
                @endforeach

                <tr>
                    <td colspan="5" style="text-align: right;">Grand Total</td>
                    <td>{{$totalSum}}</td>
                </tr>
                </tbody>
            </table>
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

