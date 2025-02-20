@extends('layout.app')

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Invoice</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        @if($bill)
        <div class="col-12">
            <div class="card-box">
                <!-- Company Info -->
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset("assets/images/web-wolf-logo.png") }}" alt="web-wolf-logo" class="img-fluid" style="height: 10rem;">
                    </div>
                    <div class="col-md-8">
                        <div class="clearfix">
                            <div class="text-right">
                                <h1>Web Wolf</h1>
                            </div>
                            <div class="text-right">
                                <span>Ground Floor, house No 221/25, NIT Jawahar Colony, Faridabad - Haryana - 121005</span><br>
                                <span><b>Email:</b> <a href="mailto:info@webwolf.in">info@webwolf.in</a> | <b>Web:</b> <a href="www.webwolf.in">www.webwolf.in</a> | <b>Mob:</b>
                                    <a href="tel:+918010589236">+91-8010589236</a></span>
                            </div>
                            <div class="text-right">
                                <span class="text-right"><b>PAN NO:</b> KGSPS5353C</span>
                                <span><b>GSTIN:</b> 06KGSPS5353C2ZU</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-12 text-center border">
                        <b>
                            <h3 class="m-1">GST INVOICE </h3>
                        </b>
                    </div>
                </div>
                <div class="row text-center ">
                    <div class="col-md-6 border p-0">
                        <b>
                            <div class="border-bottom">
                                <h5>Details of the Client | Billed to</h5>
                            </div>
                        </b>
                        <div class="row pl-2 pt-1">
                            <div class="col-12 d-flex justiy-content-start">
                                <label>Name:</label>
                                <span class="ml-1">{{ $bill->party->full_name }}</span>
                            </div>
                        </div>
                        <div class="row pl-2">
                            <div class="col-12 d-flex justiy-content-start">
                                <label>Phone:</label>
                                <span class="ml-1">{{ $bill->party->phone_no }}</span>
                            </div>
                        </div>
                        <div class="row pl-2">
                            <div class="col-12 d-flex justiy-content-start">
                                <label>Address:</label>
                                <span class="ml-1">{{ $bill->party->address }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 border p-0">
                        <b>
                            <div class="border-bottom">
                                <h5>Invoice Details</h5>
                            </div>
                        </b>
                        <div class="row pl-2 pt-1">
                            <div class="col-12 d-flex justiy-content-start">
                                <label>Invoice Number:</label>
                                <span class="ml-1">{{ $bill->invoice_no }}</span>
                            </div>
                        </div>
                        <div class="row pl-2">
                            <div class="col-12 d-flex justiy-content-start">
                                <label>Invoice Date:</label>
                                <span class="ml-1">{{ date("d-m-Y", strtotime($bill->invoice_date)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12 p-0">
                        <div class="table-responsive table-bordered">
                            <table class="table mt-4 table-centered border">
                                <thead>
                                    <tr>
                                        <th class="py-0" style="background-color: rgb(130, 210, 241); color: black;">
                                            DESCRIPTION</th>
                                        <th style="width: 15%; background-color: rgb(130, 210, 241); color: black;" class="text-center py-1">
                                            AMOUNT
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <b>{{ $bill->item_description }}</b>
                                        </td>
                                        <td class="text-center">₹{{ $bill->total_amount }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row border">
                    <div class="col-sm-6 col-lg-9 p-0">
                        <div class="clearfix pt-2 pb-2 mt-1 mb-1 ml-1 text-center" style="background-color: rgba(218, 218, 218, 0.37); border-radius: 5px; padding: 2rem;">
                            <h5><b>Bank Details</b></h5>
                            <div class="row">
                                <div class="col-md-6" style="border: 1px solid #ABABAB;">
                                    <p>Account Number: </p><p>45590200000292</p>
                                </div>
                                <div class="col-md-6" style="border: 1px solid #ABABAB;">
                                    <p>Account Holder's Name: </p><p>Web Wolf</p>
                                </div>
                                <div class="col-md-6" style="border: 1px solid #ABABAB;">
                                    <p>Bank Name: </p><p>Bank Of Baroda</p>
                                </div>
                                <div class="col-md-6" style="border: 1px solid #ABABAB;">
                                    <p>IFSC Code: </p><p>BARB0JAWFAR</p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-sm-6 col-lg-3 mt-1">
                        <ul class="list-unstyled">
                            <li><b>Total :</b> <span class="float-right"><i class="fas fa-rupee-sign"></i> {{ $bill->total_amount }}</span></li>
                            <li><b>CGST :</b><span class="float-right"><i class="fas fa-rupee-sign"></i> {{ $bill->cgst_amount }}</span></li>
                            <li><b>SGST :</b><span class="float-right"><i class="fas fa-rupee-sign"></i> {{ $bill->sgst_amount }}</span></li>
                            <li><b>IGST :</b><span class="float-right"><i class="fas fa-rupee-sign"></i> {{ $bill->igst_amount }}</span></li>
                            <li><b>Total Tax :</b><span class="float-right"><i class="fas fa-rupee-sign"></i> {{ $bill->tax_amount }}</span></li>
                            <li><b>Net Amount :</b><span class="float-right"><i class="fas fa-rupee-sign"></i> {{ $bill->net_amount }}</span></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->


                <div class="mt-4 mb-1">
                    <div class="text-right d-print-none">
                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light">Print <i class="mdi mdi-printer mr-1"></i></a>
                        <a href="{{ route('manage-gst-bills') }}" class="btn btn-danger waves-effect waves-light">All
                            Bills <i class="fas fa-rupee-sign"></i></a>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div>
        @else
        <div class="col-12">
            <div class="alert alert-danger">Invoice not found</div>
        </div>
        @endif
    </div>
    <!-- end row -->

</div> <!-- container -->
@endsection