@extends('layouts.master')
@section('title')
Add Specialization
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Specialization @endslot
        @slot('title') Add @endslot
    @endcomponent
    @include('sweetalert::alert')
    <div class="row justify-content-center align-items-center">
        <div class="col-xl-8">
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
                        <div class="row">
                            
                           
                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="name">Specialization Name<span style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" id="name" name="name" placeholder=""
                                        value="@if(isset($spec->name)){{$spec->name}}@else{{old('name')}}@endif" onkeydown="return /[a-z .]/i.test(event.key)">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    </div>
                                    
                                </div>
                            </div>
                            
                           
                            
                            
                            

                        </div>
                        
                        
                       


                        <button class="btn btn-primary" type="submit" id="btn-submit" >Submit </button>
                        <a class="btn btn-primary" href="{{ route('specialization.list') }}" style="margin-left:6px;">Back</a>
                    </form>
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

    document.getElementById('mobile_no').onchange = function() {
    var mobileNumber = this.value;

    // Use route() function to generate the URL for the AJAX request
    var url = "{{ route('check.mobile') }}?mobile_no=" + encodeURIComponent(mobileNumber);

    // Make the AJAX request using Fetch API
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Handle the response data
            if (data.exists) {
                alert('Mobile number already exists');
                // You can also show a SweetAlert here
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            // Handle any errors that occur during the fetch
        });
};

</script>

<script type="text/javascript">
    $(document).ready(function()
    {
        $('#dob').change(function()
        {
            console.log("change");
            var dob = new Date(document.getElementById('dob').value);
            var today = new Date();
            var age = Math.floor((today-dob)/(365.25*24*60*60*1000));
            document.getElementById('age').value = age;
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function () {

            $("#form").submit(function (e) {

                $("#btn-submit").attr("disabled", true);

                return true;
            });
        });
    </script>


    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
@endsection
