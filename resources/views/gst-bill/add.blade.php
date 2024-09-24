@extends('layout.app')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title font-weight-bold"> CREATE GST BILL </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!--Include alert file-->
                    @include('include.alert')

                    <h4 class="header-title text-uppercase">Invoice Basic Info</h4>
                    <hr>
                    <form action="{{ route('create-gst-bill') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Party</label>
                                    <select class="form-control border-bottom" name="party_id" id="validationCustom01">
                                        <option value="">Please select</option>
                                        @foreach($parties as $party)
                                        <option value="{{ $party->id }}">{{ $party->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Invoice Date</label>
                                    <input type="date" name="invoice_date" class="form-control border-bottom" id="validationCustom02">
                                </div>
                            </div>
                            @php
                                $today = \Carbon\Carbon::today()->format('dmy');
                                // Ensure $last->invoice_no exists and is long enough
                                $last = \App\Models\GstBill::orderBy('created_at','desc')->first();
                                if ($last && strlen($last->invoice_no) >= 7) {
                                    $numberFrom7th = substr($last->invoice_no, 6); // Start from the 7th character (index 6)
                                    $invNumber = $numberFrom7th + 01;
                                } else {
                                    dd("Invoice number is too short or does not exist.");
                                }
                                $invoiceNumber = $today . $invNumber;
                            @endphp
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Invoice Number</label>
                                    <input type="text" name="invoice_no" class="form-control border-bottom" id="validationCustom02" value="{{ $invoiceNumber ?? '' }}" placeholder="Enter Invoice number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h4 class="header-title text-uppercase">Item Details</h4>
                                <hr>
                            </div>
                        </div>

                        <div class="row mb-3" id="itemDetails">
                            <div class="col-md-4 border p-2">
                                <input class="form-control" name="item_description[]" placeholder="Item Description" required />
                            </div>
                            <div class="col-md-2 border p-2">
                                <input class="form-control" type="number" step="0.01" name="igst_rate[]" placeholder="IGST (%)" required oninput="calculateNetAmount()">
                            </div>
                            <div class="col-md-2 border p-2">
                                <input class="form-control" type="number" step="0.01" name="discount_rate[]" placeholder="Discount (%)" oninput="calculateNetAmount()">
                            </div>
                            <div class="col-md-2 border p-2">
                                <input class="form-control" type="number" step="0.01" name="price[]" placeholder="Price" required oninput="calculateNetAmount()">
                            </div>
                            <div class="col-md-2 border p-2">
                                <button type="button" class="btn btn-danger remove-row" id="removeBtn">Remove</button>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success add-item" id="addItemButton">Add Item</button>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div class="row mt-0">
                            <div class="col-md-3">
                                <label>CGST (%)</label>
                                <input type="text" class="form-control border-bottom" placeholder="CGST Rate" name="cgst_rate" id="cgst" oninput="calculateNetAmount()">
                                <span class="float-right gststyle" id="cgstDisplay">0</span>
                                <input type="hidden" id="cgstAmount" name="cgst_amount" value="0">
                            </div>

                            <div class="col-md-3">
                                <label>SGST (%)</label>
                                <input type="text" class="form-control border-bottom" placeholder="SGST Rate" name="sgst_rate" id="sgst" oninput="calculateNetAmount()">
                                <span class="float-right gststyle" id="sgstDisplay">0</span>
                                <input type="hidden" id="sgstAmount" name="sgst_amount" value="0">
                            </div>

                            <div class="col-md-3">
                                <label>IGST (%)</label>
                                <input type="text" class="form-control border-bottom" placeholder="IGST Rate" name="igst_rate" id="igst" oninput="calculateNetAmount()">
                                <span class="float-right gststyle" id="igstDisplay">0</span>
                                <input type="hidden" id="igstAmount" name="igst_amount" value="0">
                            </div>

                            <div class="col-md-3">
                                <ul style="list-style: none;float: right;">
                                    <li>
                                        <b>Total Amount:</b> ₹ <span type="text" id="totalAmountDisplay">0</span>
                                    </li>
                                    <li>
                                        <b>Tax:</b> ₹ <span type="text" id="taxDisplay">0</span>
                                        <input type="hidden" value="0" name="tax_amount" id="taxAmount">
                                    </li>
                                    <li>
                                        <b>Net Amount:</b> ₹ <span type="text" id="netAmountDisplay">0</span>
                                        <input type="hidden" value="0" name="net_amount" id="netAmount">
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="declaration" class="form-control border-bottom" id="validationCustom05" placeholder="Declaration">
                                </div>

                                <button type="submit" class="btn btn-primary float-right mb-2">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection