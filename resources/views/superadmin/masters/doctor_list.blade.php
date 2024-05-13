@extends('layouts.master')
@section('title')
    Doctor List
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
    .switch {
  position: relative;
  display: inline-block;
  width: 44px;
  height: 22px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 0px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
    </style>
@endsection

@section('content')
     
    @include('sweetalert::alert')
     <div class="row justify-content-center align-items-center">
          <div class="col-xl-12">
         <h3>Doctor Add</h3>
         </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <form class="needs-validation" id="form" action="{{ $url }}" method="POST">
                        @csrf
                        <!--<div class="row">-->
                        <!--    <div class="col-md-6">-->
                        <!--        <div class="mb-3">-->
                        <!--            <label class="form-label" for="mr_no">Mr.No/Cr.No</label>-->
                        <!--            <input type="text" class="form-control" id="mr_no" name="mr_no">-->

                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-md-6"></div>-->
                        <!--</div>-->
                        <div class="row justify-content-center align-items-center">
                            
                           
                            
                            <div class="col-md-6">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="name">Doctor Name<span style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="name" name="name" placeholder=""
                                        value="@if(isset($doc->name)){{$doc->name}}@else{{old('name')}}@endif" onkeydown="return /[a-z .]/i.test(event.key)">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    </div>
                                    
                                </div>
                            </div>
                            </div>
                           
                            
                             <div class="row justify-content-center align-items-center">
                            <div class="col-md-6">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="mobile">Mobile<span style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder=""
                                        value="@if(isset($doc->contact_no)){{$doc->contact_no}}@else{{old('mobile')}}@endif"  maxlength="10" onkeypress="return isNumeric(event)">
                                        @if ($errors->has('mobile'))
                                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            </div>
                             <div class="row justify-content-center align-items-center">
                           <div class="col-md-6">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="spec" >Specialization<span style="color: red">*</span></label>
                                 <div class="col-sm-9">
                                    <select class="form-select" name="spec">
                                        <option value="">Select</option>
                                        @foreach($spec as $s)
                                       <option value="{{ $s->id }}" @if(isset($doc->key_spec) && $s->id == $doc->key_spec) selected  @elseif (old('s_id') == $s->id) selected @endif>
    {{ $s->name }}
</option>
                                        @endforeach 
                                       
                                    </select>
                                    @if ($errors->has('spec'))
                                        <span class="text-danger">{{ $errors->first('spec') }}</span>
                                    @endif
                                </div>
                                </div>
                            </div>
                            </div>

                       
                        
                        
                       <div class="row">
                             <div class="col-md-12">
                         <div class="text-center">


                        <button class="btn btn-primary" type="submit" id="btn-submit" >Submit </button>
                         </div>
                          </div>
                           </div>
                        <!--<a class="btn btn-primary" href="{{ route('doctor.list') }}" style="margin-left:6px;">Back</a>-->
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->


    </div>
    <div class="row">
         <h3>Doctor List</h3>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                 {{--   <div class="d-flex justify-content-between mb-3">
                        <div>
                            <table>
                                <tr>
                                    
                            <td><input type="date" class="form-control" name="start_date" id="start_date" required></td>
                            <td><input type="date" class="form-control" name="end_date" id="end_date" required></td>
                            <td><button type="button" class="btn btn-primary" id="find_btn" >Find</button></td>
                            </tr>
                            </table>
                            
                        </div>
                    
                </div>--}}
                <!--<a href="{{ route('add.doctor') }}" class="btn btn-primary waves-effect waves-light mt-3 mb-3" >Add Doctor</a>-->

                    <table id="datatable" class="table table-striped  dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Specialization</th>
                                <th>Action</th>
                                <th>Approve /Unapproved</th>
                            </tr>
                        </thead>


                        <tbody><span hidden>{{ $i=1; }}</span>
                            @foreach ($doc as $p)


                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->contact_no }}</td>
                                <td>{{ $p->specname }}</td>
                                <td>
                                <a title="Edit" href="{{ route('edit.doc',$p->id)}}" class="btn btn-outline-success btn-sm edit"><i class="fas fa-pencil-alt"></i></a>
                                {{--  <a title="Delete" href="{{ route('delete.doct',$p->id)}}" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-outline-danger btn-sm deleteAttr"><i class="fas fa-trash-alt"></i></a>  --}}
                                </td>
                                <td>
    <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
        <input type="checkbox" class="form-check-input toggle-checkbox"
               data-id="{{$p->id}}" {{ $p->active ? 'checked' : '' }}>
    </div>
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
        "order": [[ 1, "asc" ]],
    });
    
    // Modify the column structure
    $('#datatable_filter').parent().removeClass('col-md-6').addClass('col-md-12');
});
</script>

<script>
  $(function() {
    $('.toggle-checkbox').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
        
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{url('/changeStatus')}}",
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
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
    var generatebill = "{{ route('patient.bill', ':id') }}"
var visit = `<a href="${visitRoute.replace(':id', item.id)}" class="btn btn-primary waves-effect waves-light">Add Visit</a>`;
    var actionHtml = `<a title="Generate Bill" href="${generatebill.replace(':id', item.id)}" class="btn btn-outline-primary btn-sm "><i class="uil-bill"></i></a><a title="View" href="#" class="btn btn-outline-primary btn-sm "><i class="fas fa-eye"></i></a><a title="Edit" href="#" class="btn btn-outline-success btn-sm edit"><i class="fas fa-pencil-alt"></i></a>`;
    // Add data to the table using DataTables' row.add() method
    
    // Conditionally apply CSS class to mobile number based on $p->mnvs
    var mobileNoHtml = item.mnvs == 0 ? `<td style="color:red">${item.mobile_no}</td>` : `<td>${item.mobile_no}</td>`;
    
    table.row.add([
        index + 1,
        item.id,// Assuming you want to add an index column
        item.Fname ,
        item.age,
        item.sex,
        mobileNoHtml,
        
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
