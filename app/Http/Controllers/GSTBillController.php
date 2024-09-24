<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\GstBill;
use App\Models\GstBillItem;
use Illuminate\Support\Facades\DB;

class GSTBillController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    # Function to load gst bills
    public function index()
    {
        $bills = GstBill::where('is_deleted', 0)->with('party')->get();
        return view("gst-bill.index", compact('bills'));
    }

    # Function to load add gst bill view
    public function addGstBill()
    {
        $data['parties'] = Party::where('party_type', 'client')->orderBy('full_name')->get();

        return view("gst-bill.add", $data);
    }

    # Function to create/store gst bill
    public function createGstBill(Request $request)
    {
        // Validate the request data
        $request->validate([
            'party_id' => 'required|exists:parties,id',
            'invoice_date' => 'required|date',
            'invoice_no' => 'required|string|max:255',
            'item_description.*' => 'required|max:250',
            'price.*' => 'required|numeric|min:0',
            'cgst_rate.*' => 'nullable|numeric|min:0|max:100',
            'sgst_rate.*' => 'nullable|numeric|min:0|max:100',
            'igst_rate.*' => 'nullable|numeric|min:0|max:100',
            'discount_rate.*' => 'nullable|numeric|min:0|max:100',
            'net_amount' => 'required|numeric|min:0',
        ]);

        // Create the GST Bill
        $gstBill = GstBill::create([
            'party_id' => $request->party_id,
            'invoice_date' => $request->invoice_date,
            'invoice_no' => $request->invoice_no,
            'net_amount' => $request->net_amount,
        ]);

        // Loop through each item and calculate the amounts
        foreach ($request->item_description as $index => $description) {
            // Safely access the item details
            $totalAmount = $request->price[$index] ?? 0;
            $discountRate = $request->discount_rate[$index] ?? 0;
            $cgstRate = $request->cgst_rate[$index] ?? 0;
            $sgstRate = $request->sgst_rate[$index] ?? 0;
            $igstRate = $request->igst_rate[$index] ?? 0;

            // Calculate the discount amount
            $discountAmount = ($discountRate / 100) * $totalAmount;
            $amountAfterDiscount = $totalAmount - $discountAmount;

            // Calculate taxes
            $cgstAmount = ($cgstRate / 100) * $amountAfterDiscount;
            $sgstAmount = ($sgstRate / 100) * $amountAfterDiscount;
            $igstAmount = ($igstRate / 100) * $amountAfterDiscount;

            // Total tax amount
            $totalTaxAmount = $cgstAmount + $sgstAmount + $igstAmount;

            // Calculate the net amount for this item (amount after discount + taxes)
            $netAmount = $amountAfterDiscount + $totalTaxAmount;

            // Create the GstBillItem record
            GstBillItem::create([
                'gst_bill_id' => $gstBill->id,
                'description' => $description,
                'price' => $totalAmount,
                'cgst_rate' => $cgstRate,
                'cgst_amount' => $cgstAmount,
                'sgst_rate' => $sgstRate,
                'sgst_amount' => $sgstAmount,
                'igst_rate' => $igstRate,
                'igst_amount' => $igstAmount,
                'tax_amount' => $totalTaxAmount,
                'discount_rate' => $discountRate,
                'discount_amount' => $discountAmount,
            ]);
        }

        // Redirect to manage bills
        return redirect()->route('manage-gst-bills')->withStatus("Bill created successfully");
    }



    

    # Function to load print gst bill view
    public function print($id)
    {
        $data['bill'] = GstBill::where('id', $id)->with('party')->first();
        return view("gst-bill.print", $data);
    }
}
