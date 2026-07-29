<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseReceiptController extends Controller
{
    public function download($id)
    {
        $purchase = Purchase::with([
            'supplier',
            'purchaseItems.product'
        ])->findOrFail($id);

        $pdf = Pdf::loadView(
            'admin.purchase_receipt.invoice',
            compact('purchase')
        );

        return $pdf->download(
            'Purchase_Invoice_' . $purchase->invoice_no . '.pdf'
        );
    }
}