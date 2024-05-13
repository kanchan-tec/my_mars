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
        @slot('pagetitle') Visit @endslot
        @slot('title') List @endslot
    @endcomponent
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <td>
                                    <a href="{{ route('visit.add') }}" class="btn btn-primary waves-effect waves-light" >Add Visit</a>
                                </td>
                        </div>
                    
                </div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Visit ID</th>
                                <th>Patient ID</th>
                                <th>Temp</th>
                                <th>SBP/DBP</th>
                                <th>PR</th>
                                <th>RR</th>
                                <th>Weight</th>
                                <th>Height</th>
                                
                                <th>Doctor</th>
                                <th>Charges</th>
                                <th>Vital</th>
                                
                               
                            </tr>
                        </thead>


                        <tbody><span hidden>{{ $i=1; }}</span>
                            @foreach ($visit as $v)


                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $v->vid }}</td>
                                <td>{{ $v->pid }}</td>
                                <td>{{ $v->temp }}</td>
                                <td> @if(isset( $v->sbp )) {{ $v->sbp }}/{{ $v->dbp }} @endif </td>
                                <td>{{ $v->pr }}</td>
                                <td>{{ $v->rr }}</td>
                                <td>{{ $v->weight }}</td>
                                <td>{{ $v->height }}</td>
                                <td>{{ $v->name }} </td>
                                <td>{{ $v->ch }}</td>
                                 <td>
                                    <a href="{{ route('vital.add', ['id' => $v->vid, 'patient_id' => $v->pid]) }}" class="btn btn-primary waves-effect waves-light" >Add Vitals</a>
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
        }
        $.ajax({
            method: 'POST',
            url: "{{ route('patient.filter') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                    start_date: startDate,
                    end_date: endDate
                },
           success: function (data) { 
               if(data!=""){
                var table = $('#datatable').DataTable();
 table.clear();
$.each(data, function(index, item) {
    // Use the formatDate function to format the date
    var formattedDate = formatDate(item.date);
    var visitRoute = "{{ route('patient.visit', ':id') }}";
var visit = `<a href="${visitRoute.replace(':id', item.id)}" class="btn btn-primary waves-effect waves-light">Add Visit</a>`;
    var actionHtml = `<a title="View" href="#" class="btn btn-outline-primary btn-sm "><i class="fas fa-eye"></i></a><a title="Edit" href="#" class="btn btn-outline-success btn-sm edit"><i class="fas fa-pencil-alt"></i></a>`;
    // Add data to the table using DataTables' row.add() method
    table.row.add([
        index + 1,
        item.id,// Assuming you want to add an index column
        item.Fname ,
        item.age,
        item.mobile_no,
        
        formattedDate ,
        visit,
        actionHtml
    ]).draw(); // Redraw the table to update the view
});
    
    function formatDate(inputDate) {
        var options = { year: 'numeric', month: 'short', day: '2-digit' };
        return new Date(inputDate).toLocaleDateString(undefined, options);
    }
               }else{
                   alert("Data not found for this Date Range");
                   window.location.reload();
               }
                }
                
        });
    });
});


</script>


    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
