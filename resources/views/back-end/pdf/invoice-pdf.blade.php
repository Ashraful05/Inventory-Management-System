<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice PDF</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table>
                <tbody>
                <tr>
                    <td><p><strong>Invoie No# {{$invoice->invoice_no}}</strong></p></td>
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
    <hr>
    <div class="row">
        <div class="col-md-12">
            @php($payment = App\Payment::where('invoice_id',$invoice->id)->first())
            <table width="100%">
                <tbody>
                <tr>
                    <td width="15%"><p><strong>Customer Info:</strong></p> </td>
                    <td width="25%"><p><strong>Name :</strong> {{$payment['customer']['name']}}</p></td>
                    <td width="25%"><p><strong>Mobile Number :</strong> {{$payment['customer']['mobile_no']}}</p></td>
                    <td width="35%"><p><strong>Address :</strong> {{$payment['customer']['address']}}</p></td>
                </tr>
                <tr>
                    <td width="15%"></td>
                    <td width="85%" colspan="3"><p><strong>Description: </strong>{{$invoice->description}}</p></td>
                </tr>
                </tbody>
            </table>
            <table border="1" width="100%" style="margin-botton: 10px;">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
                </thead>
                <tbody>
                @php($totalSum = '0')

                @foreach($invoice['InvoiceDetails'] as $key => $details)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="text-center">{{$details['category']['name']}}</td>
                        <td class="text-center">{{$details['product']['name']}}</td>
                        <td class="text-center">{{$details->selling_quantity}}</td>
                        <td class="text-center">{{$details->unit_price}}</td>
                        <td class="text-center">{{$details->selling_price}}</td>
                    </tr>

                    @php($totalSum += $details->selling_price)

                @endforeach

                <tr class="text-center">
                    <td colspan="5" class="text-right"><strong style="background-color: #0C9A9A">Sub Total: </strong></td>
                    <td>{{$totalSum}}</td>
                </tr>
                <tr class="text-center">
                    <td colspan="5" class="text-right"><strong style="background-color: #D8FDBA">Paid Amount: </strong></td>
                    <td>{{$payment->paid_amount}}</td>
                </tr>
                <tr class="text-center">
                    <td colspan="5" class="text-right"><strong style="background-color: #00b0e8">Discount: </strong></td>
                    <td>{{$payment->discount_amount}}</td>
                </tr>
                <tr class="text-center">
                    <td colspan="5" class="text-right"><strong style="background-color: orangered">Due Amount: </strong></td>
                    <td>{{$payment->due_amount}}</td>
                </tr>
                <tr class="text-center">
                    <td colspan="5" class="text-right"><strong style="background-color: #5bc0de">Grand Total: </strong></td>
                    <td>{{$payment->total_amount}}</td>
                </tr>
                </tbody>
            </table>
            <br>
            @php($date = new DateTime('now',new DateTimeZone('Asia/Dhaka')))
            <i>Printing Time: {{$date->format('F j, Y, g:i a')}}</i>
        </div>
    </div>
</div>
</body>
</html>
