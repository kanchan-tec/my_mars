@extends('layouts.master')
@section('title')
    Patient List
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Patient @endslot
        @slot('title') List @endslot
    @endcomponent
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <table>
                                <tr>
                                    
                            <td><input type="date" class="form-control" name="start_date" id="start_date" required value="<?php echo date('Y-m-d'); ?>"></td>
                            <td><input type="date" class="form-control" name="end_date" id="end_date" required value="<?php echo date('Y-m-d'); ?>" style="margin-left:6px;"></td>
                            <td><button type="button" class="btn btn-primary" id="find_btn" style="margin-left:6px;">Find</button></td>
                           <td> <a href="" class="btn btn-primary waves-effect waves-light " id="yesterday_btn" style="margin-left: 100px;">Yesterday</a></td>
                             <td> <a href="{{ route('patient.list') }}" class="btn btn-primary waves-effect waves-light" style="margin-left:6px;">Today</a></td>
                            </tr>
                            </table>
                            <a href="{{ route('patient.register') }}" class="btn btn-primary waves-effect waves-light mt-3" >Add Patient</a>
                        </div>
                         
                    
                </div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <!--<th>Sr. No.</th>-->
                                <th>UHID</th>
                                <th>Full Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Mobile</th>
                                <th>Date</th>
                                
                                
                                <th>Visit</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody><span hidden>{{ $i=1; }}</span>
                            @foreach ($patient as $p)


                            <tr>
                                <!--<td>{{ $i++ }}</td>-->
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->Fname }} {{ $p->Lname }}</td>
                                <td>{{ $p->age }}</td>
                                <td>{{ $p->sex }}</td>
                                @if($p->mnvs == 0)
                                <td style="color:red">{{ $p->mobile_no }}</td>
                                @else
                                <td>{{ $p->mobile_no }}</td>
                              @endif
                                
                                <td>{{ $p->date }}</td>
                                

                                
                                <td>
                                    <a href="{{ route('patient.visit',$p->id) }}" class="btn btn-primary waves-effect waves-light" >Add Visit</a>
                                </td>
                                <td>
                                    <a title="View" href="{{ route('patient.bill',$p->id)}}" class="btn btn-outline-primary btn-sm "><i class="uil-bill"></i></a>
                                      <a title="View" href="#" class="btn btn-outline-primary btn-sm "><i class="fas fa-eye"></i></a>
                                <a title="Edit" href="#" class="btn btn-outline-success btn-sm edit "><i class="fas fa-pencil-alt"></i></a>
                                {{--  <a title="Delete" href="" class="btn btn-outline-danger btn-sm deleteAttr"><i class="fas fa-trash-alt"></i></a>  --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->



@endsection
@section('script')
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#datatable').DataTable({
        "paging": false,
        "bInfo" : false,
    });

    // Modify the column structure
    $('#datatable_filter').parent().removeClass('col-md-6').addClass('col-md-12');
});
</script>

<script>
$(function () {
    $('#find_btn').on('click', function () { 
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        if(startDate == '' && endDate == ''){
            alert('Please Select Date');
        } else {
            fetchRecords(startDate, endDate);
        }
    });

    $('#yesterday_btn').on('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        
        var today = new Date();
        var yesterday = new Date(today);
        yesterday.setDate(yesterday.getDate() - 1); // Get yesterday's date

        // Format yesterday's date as yyyy-mm-dd
        var yyyy = yesterday.getFullYear();
        var mm = String(yesterday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var dd = String(yesterday.getDate()).padStart(2, '0');
        var formattedDate = yyyy + '-' + mm + '-' + dd;

        // Set start_date and end_date inputs to yesterday's date
        $('#start_date').val(formattedDate);
        $('#end_date').val(formattedDate);

        // Fetch records for yesterday
        fetchRecords(formattedDate, formattedDate);
    });

    function fetchRecords(startDate, endDate) {
        $.ajax({
            method: 'POST',
            url: "{{ route('patient.filter') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                start_date: startDate,
                end_date: endDate
            },
            success: function (data) { 
                if(data.length > 0) {
                    var table = $('#datatable').DataTable();
                    table.clear();
                    $.each(data, function(index, item) {
                        var formattedDate = formatDate(item.date);
                        var visitRoute = "{{ route('patient.visit', ':id') }}";
                        var generatebill = "{{ route('patient.bill', ':id') }}"
                        var visit = `<a href="${visitRoute.replace(':id', item.id)}" class="btn btn-primary waves-effect waves-light">Add Visit</a>`;
                        var actionHtml = `<a title="Generate Bill" href="${generatebill.replace(':id', item.id)}" class="btn btn-outline-primary btn-sm "><i class="uil-bill"></i></a><a title="View" href="#" class="btn btn-outline-primary btn-sm "><i class="fas fa-eye"></i></a><a title="Edit" href="#" class="btn btn-outline-success btn-sm edit"><i class="fas fa-pencil-alt"></i></a>`;
                        var mobileNoHtml = item.mnvs == 0 ? `<td style="color:red">${item.mobile_no}</td>` : `<td>${item.mobile_no}</td>`;
                        table.row.add([
                            // index + 1,
                            item.id,
                             item.Fname + ' ' + item.Lname,
                            item.age,
                            item.sex,
                            mobileNoHtml,
                            formattedDate,
                            visit,
                            actionHtml
                        ]).draw();
                    });
                } else {
                    alert("Data not found for this Date Range");
                    window.location.reload();
                }
            }
        });
    }

    function formatDate(inputDate) {
        var options = { year: 'numeric', month: 'short', day: '2-digit' };
        return new Date(inputDate).toLocaleDateString(undefined, options);
    }
});
</script>

 


    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
