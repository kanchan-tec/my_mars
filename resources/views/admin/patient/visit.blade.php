@extends('layouts.master')
@section('title')
Visit
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Patient @endslot
        @slot('title') Visit @endslot
    @endcomponent
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <form class="needs-validation" action="{{ route('visit.save') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">UHID</label>
                                    <input type="text" name="uhid" class="form-control" value="{{ $id }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no"> Name</label>
                                    <input type="text" name="name" class="form-control" readonly value="@if(isset($patient)){{ $patient->Fname }} {{ $patient->Lname }}@else{{ old('Fname')}}@endif">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">Age</label>
                                    <input type="text" name="age" class="form-control" readonly value="@if(isset($patient->age)){{ $patient->age }}@else{{ old('age')}}@endif">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="mr_no">Gender</label>
                                    <input type="text" name="sex" class="form-control" readonly value="@if(isset($patient->sex)){{ $patient->sex }}@else{{ old('sex')}}@endif">
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
                                        <option value="{{ $d->id }}">{{ $d->name}}</option>
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
                                        <option value="{{$c->ch}}">₹ {{$c->ch}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('charges'))
                                    <span class="text-danger">{{ $errors->first('charges') }}</span>
                                @endif
                                </div>
                            </div>


                        </div>



                        <button class="btn btn-primary" type="submit">Submit </button>
                        <a class="btn btn-primary" href="{{ route('patient.list') }}">Back</a>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4>Visit List</h4><br>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Visit ID</th>
                                <th>Doctor</th>
                                <th>Charges</th>
                                
                                
                               
                            </tr>
                        </thead>


                        <tbody><span hidden>{{ $i=1; }}</span>
                            @foreach ($visit as $v)


                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $v->id }}</td>
                                <td>{{ $v->name }} </td>
                                <td>{{ $v->ch }}</td>
                                

                                
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
