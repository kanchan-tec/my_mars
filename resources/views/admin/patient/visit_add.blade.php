@extends('layouts.master')
@section('title')
Add
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Visit @endslot
        @slot('title') Add @endslot
    @endcomponent
    @include('sweetalert::alert')
    <div class="row justify-content-center align-items-center">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">

                    <form class="needs-validation" action="{{ route('visit.patsave') }}" method="POST">
                        @csrf
                        <div class="row">
                             
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">UHID<span style="color: red">*</span></label>
                                    <input onkeydown="return (event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode == 8" type="text" name="uhid" id="uhid" class="form-control" oninput="getPatientDetails()" value="{{ old('uhid')  }}" >
                                     @if ($errors->has('uhid'))
                                    <span class="text-danger">{{ $errors->first('uhid') }}</span>
                                @endif
                                   <div id="uhid-error" class="text-danger"  ></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no"> Name</label>
                                    <input type="text" name="name" id="name" class="form-control"  readonly  value="{{ old('name')  }}">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">Age</label>
                                    <input type="text" name="age" id="age" class="form-control" readonly  value="{{ old('age')  }}" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">Gender</label>
                                    <input type="text" name="sex" id="sex" class="form-control" readonly value="{{ old('sex')  }}">
                                </div>
                            </div>
                        </div>
                       

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="doctor">Select Doctor<span style="color: red">*</span></label>

                                    <select class="form-select" name="doctor">
                                        <option value="">Select Doctor</option>
                                        @foreach ($doctor as $d)
                                        <option value="{{ $d->id }}" {{ old('doctor') == $d->id ? 'selected' : '' }}>{{ $d->name}}</option>
                                        @endforeach

                                    </select>
                                     @if ($errors->has('doctor'))
                                    <span class="text-danger">{{ $errors->first('doctor') }}</span>
                                @endif

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="charges">Select Charges<span style="color: red">*</span></label>

                                    <select class="form-select" name="charges">
                                        <option value="">Select Charges</option>
                                        @foreach($charges as $c)
                                        <option value="{{$c->ch}}" {{ old('charges') == $c->ch ? 'selected' : '' }}>₹ {{$c->ch}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('charges'))
                                    <span class="text-danger">{{ $errors->first('charges') }}</span>
                                @endif
                                </div>
                            </div>


                        </div>



                        <button class="btn btn-primary" type="submit" id="submit-button">Submit </button>
                        <a class="btn btn-primary" href="{{ route('visit.list') }}" style="margin-left:6px;">Back</a>
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

 var timeout = null;

function getPatientDetails() {
    clearTimeout(timeout); // Clear any existing timeout

    timeout = setTimeout(function() {
        var uhid = document.getElementById('uhid').value.trim();
        var errorContainer = document.getElementById('uhid-error');
        var submitButton = document.getElementById('submit-button');

        if (uhid !== '') {
            var url = "{{ route('get.patient.details') }}?uhid=" + encodeURIComponent(uhid);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('name').value = data.patient.fname + ' ' + data.patient.lname;
                        document.getElementById('age').value = data.patient.age;
                        document.getElementById('sex').value = data.patient.sex;
                        errorContainer.textContent = ''; // Clear error message if patient details are found
                        submitButton.disabled = false; // Enable submit button
                    } else {
                        clearPatientDetails();
                        errorContainer.textContent = 'Patient details not found for provided UHID';
                        submitButton.disabled = true; // Disable submit button if patient details not found
                        console.log("Patient details not found");
                    }
                })
                .catch(error => {
                    console.error('Error fetching patient details:', error);
                });
        } else {
            clearPatientDetails();
            errorContainer.textContent = 'Please enter UHID'; // Show error message if UHID is empty
            submitButton.disabled = true; // Disable submit button if UHID is empty
        }
    }, 500); // Adjust this value to change the delay (in milliseconds)
}

function clearPatientDetails() {
    document.getElementById('name').value = '';
    document.getElementById('age').value = '';
    document.getElementById('sex').value = '';
}


</script>

    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
@endsection
