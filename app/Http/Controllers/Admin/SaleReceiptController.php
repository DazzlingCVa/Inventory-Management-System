<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleReceiptController extends Controller
{
    /**
     * Download Sales Invoice PDF
     */
    public function download($id)
    {
        $sale = Sale::with([
            'saleItems.product'
        ])->findOrFail($id);

        $pdf = Pdf::loadView(
            'admin.sale_receipt.invoice',
            compact('sale')
        );

        return $pdf->download(
            'Sales_Invoice_' . $sale->invoice_no . '.pdf'
        );
    }
}