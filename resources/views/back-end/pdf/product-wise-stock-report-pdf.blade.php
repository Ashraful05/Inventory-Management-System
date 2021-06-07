<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Supplier Wise Stock Report PDF</title>
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
                    <td width="50%"></td>
                    <td>
                        <u><strong><span style="font-size: 15px;">Product Wise Stock Report</span></strong></u>
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
                    <th>Supplier Name</th>
                    <th>Category Name</th>
                    <th>Product Name</th>
                    <th>In Quantity</th>
                    <th>Out Quantity</th>
                    <th>Stock</th>
                    <th>Unit Name</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $buyingTotal = App\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('buying_quantity');
                    $sellingTotal = App\InvoiceDetail::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('selling_quantity');
                @endphp

                    <tr>
                        <td>{{$product['supplier']['name']}}</td>
                        <td>{{$product['category']['name']}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$buyingTotal}}</td>
                        <td>{{$sellingTotal}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product['unit']['name']}}</td>
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




