<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Sales Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
        }

        h2,
        h3 {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
        }

        .no-border {
            border: none;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>

</head>

<body>

    <h2>

        Inventory Management System

    </h2>

    <h3>

        Sales Invoice

    </h3>

    <br>

    <table class="no-border">

        <tr class="no-border">

            <td class="no-border">

                <strong>Invoice No :</strong>

                {{ $sale->invoice_no }}

            </td>

            <td class="no-border text-right">

                <strong>Date :</strong>

                {{ date('d-m-Y', strtotime($sale->sale_date)) }}

            </td>

        </tr>

        <tr class="no-border">

            <td class="no-border">

                <strong>Customer :</strong>

                {{ $sale->customer_name }}

            </td>

            <td class="no-border text-right">

                <strong>Total :</strong>

                ₹ {{ number_format($sale->total_amount, 2) }}

            </td>

        </tr>

    </table>

    <br>

    <table>

        <thead>

            <tr>

                <th width="8%">

                    S.No

                </th>

                <th>

                    Product

                </th>

                <th width="15%">

                    Price

                </th>

                <th width="15%">

                    Quantity

                </th>

                <th width="20%">

                    Sub Total

                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($sale->saleItems as $key => $item)

                <tr>

                    <td class="text-center">

                        {{ $key + 1 }}

                    </td>

                    <td>

                        {{ $item->product->product_name }}

                    </td>

                    <td class="text-right">

                        ₹ {{ number_format($item->price, 2) }}

                    </td>

                    <td class="text-center">

                        {{ $item->quantity }}

                    </td>

                    <td class="text-right">

                        ₹ {{ number_format($item->subtotal, 2) }}

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

                    ₹ {{ number_format($sale->total_amount, 2) }}

                </th>

            </tr>

        </tfoot>

    </table>

    <br><br><br>

    <table class="no-border">

        <tr class="no-border">

            <td class="no-border">

                ________________________

                <br><br>

                Prepared By

            </td>

            <td class="no-border text-right">

                ________________________

                <br><br>

                Authorized Signature

            </td>

        </tr>

    </table>

</body>

</html>