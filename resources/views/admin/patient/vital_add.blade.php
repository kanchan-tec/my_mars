@extends('layouts.master')
@section('title')
Add Vitals
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Vitals @endslot
        @slot('title') Add @endslot
    @endcomponent
    @include('sweetalert::alert')
    <div class="row justify-content-center align-items-center">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">

                    <form class="needs-validation" action="{{ route('vital.save') }}" method="POST">
                        @csrf
                        <div class="row">
                             
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">UHID</label>
                                    <input  type="text" name="uhid" id="uhid" class="form-control"  value=" {{ $patient_id }}" readonly>
                                     
                                   <input  type="hidden" name="vid" id="vid" class="form-control"  value=" {{ $id }}" >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no"> Patient Name</label>
                                    <input type="text" name="name"  class="form-control"  readonly  value="{{ $pi->prefix }}{{ $pi-> Fname }} {{ $pi->Lname }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no"> Age</label>
                                    <input type="text" name="age"  class="form-control"  readonly  value="{{ $pi->age }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no"> Gender</label>
                                    <input type="text" name="gender"  class="form-control"  readonly  value="{{ $pi->sex }}">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">Temp</label>
                                    <input type="text" name="temp"  class="form-control"   value="{{ old('temp')  }}" >
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">SBP/DBP</label>
                                     <input type="text" name="sbp"  class="form-control"   value="{{ old('sbp')  }}" >
                                  
                                </div>
                                
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">&nbsp;</label>
                                     <input type="text" name="dbp"  class="form-control"   value="{{ old('dbp')  }}" >
                                 
                                </div>
                                
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">PR</label>
                                     <input type="text" name="pr"  class="form-control"   value="{{ old('pr')  }}" >
                                  
                                </div>
                                
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">RR</label>
                                     <input type="text" name="rr"  class="form-control"   value="{{ old('rr')  }}" >
                                 
                                </div>
                                
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">HT</label>
                                     <input type="text" name="ht"  class="form-control"   value="{{ old('ht')  }}" >
                                  
                                </div>
                                
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">WT</label>
                                     <input type="text" name="wt"  class="form-control"   value="{{ old('wt')  }}" >
                                 
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
