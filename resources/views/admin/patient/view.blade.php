@extends('layouts.master')
@section('title')
View
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Patient @endslot
        @slot('title') View @endslot
    @endcomponent
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                     <div class="row my-3">
                               <div class="col-md-2">
                                    <p class="mb-0"><strong>Name:</strong><br>
                                    <span id="address">{{$patient->prefix }} {{$patient->Fname }} @isset($patient->Lname){{$patient->Lname }} @endisset</span></p>
                                </div>
                                
                                <div class="col-md-2">
                                    <p class="mb-0"><strong>Age:</strong><br>
                                    <span id="address">{{$patient->age }} </span></p>
                                </div>
                                
                                <div class="col-md-2">
                                    <p class="mb-0"><strong>DOB:</strong><br>
                                    <span id="address">{{$patient->dob }} </span></p>
                                </div>
                                
                                <div class="col-md-2">
                                    <p class="mb-0"><strong>DOB:</strong><br>
                                    <span id="address">{{$patient->dob }} </span></p>
                                </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->


    </div>
    <!-- end row -->



@endsection
@section('script')
<script>
    function isNumeric(event) {
      // Get the key code of the pressed key
      const keyCode = event.which ? event.which : event.keyCode;

      // Check if the key code corresponds to a numeric character or a special key
      if (keyCode >= 48 && keyCode <= 57 || keyCode === 8 || keyCode === 9 || keyCode === 37 || keyCode === 39 || keyCode === 46) {
        return true; // Allow input
      } else {
        return false; // Prevent input
      }
    }
</script>
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
@endsection
