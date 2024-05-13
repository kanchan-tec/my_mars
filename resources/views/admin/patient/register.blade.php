@extends('layouts.master')
@section('title')
Register
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Patient @endslot
        @slot('title') Register @endslot
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
                                    <label for="prefix" class="col-sm-3 col-form-label">Prefix<span style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                       <select class="form-select" name="prefix">
                                        <option value="">Select Prefix</option>

                                        <option value = 'Mr.' {{ old('prefix') == 'Mr.' ? 'selected' : '' }}> Mr.</option>
                                        <option value = 'Ms.' {{ old('prefix') == 'Ms.' ? 'selected' : '' }}> Ms.</option>
                                        <option value = 'Mrs.' {{ old('prefix') == 'Mrs.' ? 'selected' : '' }}> Mrs.</option>
                                        <option value = 'Master' {{ old('prefix') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value = 'Miss.' {{ old('prefix') == 'Miss.' ? 'selected' : '' }}>Miss</option>
                                        <option value = 'Baby' {{ old('prefix') == 'Baby' ? 'selected' : '' }}>Baby</option>
                                        <option value = 'Baby of' {{ old('prefix') == 'Baby of' ? 'selected' : '' }}>Baby of</option>
                                        <option value = 'Dr.' {{ old('prefix') == 'Dr.' ? 'selected' : '' }}>Dr.</option>
                                    </select>
                                    @if ($errors->has('prefix'))
                                    <span class="text-danger">{{ $errors->first('prefix') }}</span>
                                @endif
                                    </div>
                                    
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="Fname">First name<span style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                       <input onkeydown="return /[a-z .]/i.test(event.key)"
 type="text" class="form-control" id="Fname" name="Fname" placeholder=""
                                        value="{{ old('Fname')  }}" >
                                        @if ($errors->has('Fname'))
                                        <span class="text-danger">{{ $errors->first('Fname') }}</span>
                                    @endif
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="Lname">Last name</label>
                                    <div class="col-sm-9">
                                    <input onkeydown="return /[a-z .]/i.test(event.key)"
 type="text" class="form-control" id="Lname" name="Lname" placeholder=""
                                        value="{{ old('Lname')  }}" >
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="age">Age<span style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="age" name="age" placeholder=""
                                        value="{{ old('age')  }}" onkeypress="return isNumeric(event)">
                                        @if ($errors->has('age'))
                                        <span class="text-danger">{{ $errors->first('age') }}</span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="dob">Date of Birth</label>
                                    <div class="col-sm-9">
                                    <input type="date" class="form-control" id="dob" name="dob" placeholder=""
                                        value="{{ old('dob')  }}" >
                                    </div>
                                </div>
                            </div>
                            
                             <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="gender">Gender<span style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                    <select class="form-select" name="gender">
                                        <option value="">Select </option>
                                        <option value = 'Male' {{ old('gender') == 'Male' ? 'selected' : '' }}> Male</option>
                                        <option value = 'Female' {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value = 'Other' {{ old('gender') == 'Other' ? 'selected' : '' }}> Other</option>

                                    </select>
                                    @if ($errors->has('gender'))
                                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="first_reg_charge">Registration charges <span style="color:red">* (do not enter consultation charges)</span></label>
                                    <div class="col-sm-9">
                                    <input onkeydown="return (event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode == 8" type="text" class="form-control" id="first_reg_charge" name="first_reg_charge" placeholder=""
                                        value="{{ old('first_reg_charge')  }}" >

                                    @if ($errors->has('first_reg_charge'))
                                        <span class="text-danger">{{ $errors->first('first_reg_charge') }}</span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="mobile_no">Mobile<span style="color: red">*</span></label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder=""
                                        value="{{ old('mobile_no')  }}"  maxlength="10" onkeypress="return isNumeric(event)">
                                        @if ($errors->has('mobile_no'))
                                        <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div id="name_display" class="row mb-4" style="display: none;">
                                <div class="row mb-4">
                                <label class="col-sm-3 col-form-label" for="name_info">Patient details</label>
                                <div class="col-sm-9" id="name_info"></div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="i_cover" >Insurance Cover</label>
                                 <div class="col-sm-9">
                                    <select class="form-select" name="i_cover">
                                        <option value="">Select</option>
                                        @foreach($insu as $i)
                                        <option value="{{ $i->id }}" {{ old('i_cover') == $i->id ? 'selected' : '' }}>{{ $i->insurance_agen}}</option>
                                        @endforeach 
                                       
                                    </select>
                                </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="Fathername">Father name</label>
                                     <div class="col-sm-9">
                                    <input onkeydown="return /[a-z .]/i.test(event.key)" type="text" class="form-control" id="Fathername" name="Fathername" placeholder=""
                                        value="{{ old('Fathername')  }}" >
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="spousename">Spouse name</label>
                                    <div class="col-sm-9">
                                    <input onkeydown="return /[a-z .]/i.test(event.key)" type="text" class="form-control" id="spousename" name="spousename" placeholder=""
                                        value="{{ old('spousename')  }}" >
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="guardian_name">Gardian name</label>
                                    <div class="col-sm-9">
                                    <input onkeydown="return /[a-z .]/i.test(event.key)" type="text" class="form-control" id="guardian_name" name="guardian_name" placeholder=""
                                        value="{{ old('guardian_name')  }}" >
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="lead_gen">Lead</label>
                                    <div class="col-sm-9">
                                    <select class="form-select" name="lead_gen">
                                        <option value="">Select </option>

                                        <option value = 'Newspaper' {{ old('lead_gen') == 'Newspaper' ? 'selected' : '' }}>Newspaper</option>
			                            <option value = 'Google ads' {{ old('lead_gen') == 'Google ads' ? 'selected' : '' }}>Google ads</option>
			                            <option value = 'Facebook' {{ old('lead_gen') == 'Facebook' ? 'selected' : '' }}>Facebook</option>
			                            <option value = 'Instagram' {{ old('lead_gen') == 'Instagram' ? 'selected' : '' }}>Instagram</option>
			                            <option value = 'Digital media' {{ old('lead_gen') == 'Digital media' ? 'selected' : '' }}>Digital media</option>
			                            <option value = 'Advertisement(board) on premises' {{ old('lead_gen') == 'Advertisement(board) on premises' ? 'selected' : '' }}>Advertisement(board) on premises</option>
			                            <option value = 'Word-of-mouth marketing' {{ old('lead_gen') == 'Word-of-mouth marketing' ? 'selected' : '' }}>Patient-to-patient</option>
			                            <option value = 'Radio campaign' {{ old('lead_gen') == 'Radio campaign' ? 'selected' : '' }}>Radio campaign</option>
			                            <option value = 'Just dial' {{ old('lead_gen') == 'Just dial' ? 'selected' : '' }}>Just dial</option>
			                            <option value = 'Others' {{ old('lead_gen') == 'Others' ? 'selected' : '' }}>Others</option>


                                    </select>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="email_id">Email</label>
                                    <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email_id" name="email_id" placeholder=""
                                        value="{{ old('email_id')  }}" >
                                    </div>
                                </div>
                            </div>
                            
                            
                             <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="whats_app_no">WhatsApp No</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="whats_app_no" name="whats_app_no" placeholder=""
                                        value="{{ old('whats_app_no')  }}" onkeypress="return isNumeric(event)" minlength="10" maxlength="10">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label" for="Address">Address</label>
                                    <div class="col-sm-9">
                                    <textarea  class="form-control" rows="5" name="Address">{{ old('Address')  }}</textarea>
                                    </div>
                                </div>
                            </div>


                        </div>
                        
                        
                       


                        <button class="btn btn-primary" type="submit" id="btn-submit">Submit </button>
                        <a class="btn btn-primary" href="{{ route('patient.list') }}" style="margin-left:6px;">Back</a>
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

                // Mobile number exists, now make another AJAX request to get first name and last name
                var getNameUrl = "{{ route('get.names') }}?mobile_no=" + encodeURIComponent(mobileNumber);

                fetch(getNameUrl)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(nameData => {
    // Display first name, last name, age, and sex in the name_info div
    var nameInfoDiv = document.getElementById('name_info');
    nameInfoDiv.innerHTML = 'Name: ' + nameData.first_name + ' ' + nameData.last_name + '<br>' +
                            'Age: ' + nameData.age + '<br>' +
                            'Sex: ' + nameData.sex;
    // Show the name_display div
    document.getElementById('name_display').style.display = 'block';
})

                    .catch(error => {
                        console.error('Error fetching name data:', error);
                        // Handle any errors that occur during the fetch
                    });
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
