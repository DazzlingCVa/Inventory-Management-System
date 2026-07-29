<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Purchase Invoice</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:14px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
        }

        table,th,td{
            border:1px solid #000;
        }

        th,td{
            padding:8px;
            text-align:left;
        }

        .text-center{
            text-align:center;
        }

        .text-right{
            text-align:right;
        }

        .no-border{
            border:none;
        }

    </style>

</head>

<body>

    <h2 class="text-center">

        Inventory Management System

    </h2>

    <h3 class="text-center">

        Purchase Invoice

    </h3>

    <br>

    <table class="no-border">

        <tr class="no-border">

            <td class="no-border">

                <strong>Invoice No :</strong>

                {{ $purchase->invoice_no }}

            </td>

            <td class="no-border text-right">

                <strong>Date :</strong>

                {{ date('d-m-Y',strtotime($purchase->purchase_date)) }}

            </td>

        </tr>

        <tr class="no-border">

            <td class="no-border">

                <strong>Supplier :</strong>

                {{ $purchase->supplier->supplier_name }}

            </td>

            <td class="no-border text-right">

                <strong>Total :</strong>

                ₹ {{ number_format($purchase->total_amount,2) }}

            </td>

        </tr>

    </table>

    <br>

    <table>

        <thead>

            <tr>

                <th width="8%">S.No</th>

                <th>Product</th>

                <th width="15%">Price</th>

                <th width="15%">Quantity</th>

                <th width="20%">Subtotal</th>

            </tr>

        </thead>

        <tbody>

            @foreach($purchase->purchaseItems as $key => $item)

            <tr>

                <td class="text-center">

                    {{ $key + 1 }}

                </td>

                <td>

                    {{ $item->product->product_name }}

                </td>

                <td class="text-right">

                    ₹ {{ number_format($item->price,2) }}

                </td>

                <td class="text-center">

                    {{ $item->quantity }}

                </td>

                <td class="text-right">

                    ₹ {{ number_format($item->subtotal,2) }}

                </td>

            </tr>

            @endforeach

        </tbody>

        <tfoot>

            <tr>

                <th colspan="4" class="text-right">

                    Grand Total

                </th>

                <th class="text-right">

                    ₹ {{ number_format($purchase->total_amount,2) }}

                </th>

            </tr>

        </tfoot>

    </table>

    <br><br>

    <table class="no-border">

        <tr class="no-border">

            <td class="no-border">

                _______________________

                <br>

                Prepared By

            </td>

            <td class="no-border text-right">

                _______________________

                <br>

                Authorized Signature

            </td>

        </tr>

    </table>

</body>

</html>