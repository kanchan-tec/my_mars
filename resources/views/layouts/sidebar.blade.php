<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
     @if (Auth::user()->type == 'staff')
    <div class="navbar-brand-box">
        <a href="{{route('admin.home')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logos.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo.png') }}" alt="" height="30">
            </span>
        </a>

        <a href="{{url('index')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="20">
            </span>
        </a>
    </div>
    @endif
     @if (Auth::user()->type == 'admin')
    <div class="navbar-brand-box">
        <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logos.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo.png') }}" alt="" height="30">
            </span>
        </a>

        <a href="{{url('index')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="20">
            </span>
        </a>
    </div>
    @endif

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            @if (Auth::user()->type == 'staff')
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('translation.Menu')</li>

                <li>
                    <a href="{{route('admin.home')}}">
                        <i class="uil-home-alt"></i><span class="badge rounded-pill bg-primary float-end"></span>
                        <span>@lang('translation.Dashboard')</span>
                    </a>
                </li>

                {{--  <li>
                    <a href="{{ route('patient.list') }}" class="waves-effect">
                        <i class="uil-user-plus"></i>
                        <span>Patient</span>
                    </a>
                </li>  --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-user-plus"></i>
                        <span>Patient</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('patient.register') }}">Add Patient</a></li>
                        <li><a href="{{ route('patient.list') }}">Patient List</a></li>
                         <li><a href="{{ route('visit.add') }}">Add Visit</a></li>
                        <li><a href="{{ route('visit.list') }}">Visit List</a></li>
                    </ul>
                </li>

               

            </ul>
            @endif
            
            @if (Auth::user()->type == 'admin')
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('translation.Menu')</li>

                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <i class="uil-home-alt"></i><span class="badge rounded-pill bg-primary float-end"></span>
                        <span>@lang('translation.Dashboard')</span>
                    </a>
                </li> 

                <li>
                    <a href="{{ route('hospital.list') }}" class="waves-effect">
                        <i class="uil-building"></i>
                        <span>Hospital</span>
                    </a>
                </li>  
                
                <li>
                    <a href="{{ route('doctor.list') }}" class="waves-effect">
                       <i class="mdi mdi-stethoscope"></i> 
                        <span>Doctor</span>
                    </a>
                </li> 
                
                <li>
                    <a href="{{ route('insurance.list') }}" class="waves-effect">
                        <i class="uil-shield-check"></i>
                        <span>Insurance</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('service.list') }}" class="waves-effect">
                        <i class="uil-medical-square"></i>
                        <span>Service</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('specialization.list') }}" class="waves-effect">
                        <i class="uil-medical-square"></i>
                        <span>Specialization</span>
                    </a>
                </li>  

               

            </ul>
            @endif
            
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
