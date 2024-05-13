<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\superadmin\Hospital;
use App\Models\admin\Doctor_db;
use App\Models\admin\DoctorSpec;
use App\Models\admin\HealthInsurance;
use App\Models\admin\Service;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function admin_login()
    {
        return view('superadmin.login');
    }
    
    public function admin_store(Request $request)
    {
        $input = $request->all();
       // print_r($input);die;
        $this->validate($request, [
           // 'email' => 'required|email',
            'username' => 'required|exists:users,name',
            'password' => 'required|min:8',
        ]);

        if(auth()->attempt(array('name' => $input['username'], 'password' => $input['password'])))
        {
           
                return redirect()->route('admin.dashboard');
                 

        }else{
            return redirect()->route('admin_login')->withErrors([
                'password' => 'You have entered an incorrect password,',
            ]);

        }
    }
    
    public function admin_dashboard()
    {
        return view('superadmin.dashboard');
    }
    
    public function admin_logout()
    {
         Auth::logout(); // Logout the admin user
        return redirect()->route('admin_login'); // Redirect to the admin login page
    }
    
    public function hospital_list()
    {
        $currentDate = Carbon::now()->toDateString();
       // $hosp=Hospital::where('active',1)->orderBy('id','DESC')->get();
         $url = route('save.hospital');
       $hosp=Hospital::get();
        $data=compact('hosp','url','hosp');
        return view('superadmin.masters.hospital_list')->with($data);
    }
    
    public function add_hospital()
    {
        $url = route('save.hospital');
       $hosp=Hospital::get();
       $data = compact('url','hosp');
        return view('superadmin.masters.hospital_add')->with($data);
    }
    
    public function save_hospital(Request $req)
    {
        //dd($req->all());
        
        $req->validate([
            
            'hname' => 'required',
            
            'mobile' => 'required|digits:10|regex:/[6-9][0-9]{9}/|unique:hospital,mobile'
            
        ]);
        
        $hosp = new Hospital;
        $hosp->name = $req->hname;
        $hosp->mobile = $req->mobile;
        $hosp->save();
        
        
        Alert::success('Success','Hospital Added Successfully');
         return redirect()->route('hospital.list');
    }
    
    public function edit_hospital($id)
    {
        $hosp = Hospital::find($id);
        $url = route('update.hospital',$id);
        $data = compact('url', 'hosp');
        return view('superadmin.masters.hospital_add')->with($data);
    }
    
    public function update_hospital(Request $req,$id)
    {
        //dd($req->all());
        $hosp = Hospital::find($id);
        $req->validate([
            
            'hname' => 'required',
            
            'mobile' => [
    'required',
    'digits:10',
    'regex:/[6-9][0-9]{9}/',
    Rule::unique('hospital')->ignore($hosp->id),
]
            
        ]);
        
        
        $hosp->name = $req->hname;
        $hosp->mobile = $req->mobile;
        $hosp->save();
        
        
        Alert::success('Success','Hospital Updates Successfully');
         return redirect()->route('hospital.list');
    }
    
    public function delete_hospital($id)
    {
         $doc = Hospital::find($id);
         $doc->active = 0;
         $doc->save();
         
         Alert::success('Success','Hospital Deleted Successfully');
         return redirect()->route('hospital.list');
    }
    
    public function hospital_status_update(Request $req)
    {
        //dd($item);
        $doc = Hospital::find($req->user_id);
        $doc->active = $req->status;
        $doc->save();
    }
    
    public function doctor_list()
    {
        
        $doc=Doctor_db::join('doctor_specialities','doctor_specialities.id','=','doctor_db.key_spec')
        ->select('doctor_db.*','doctor_specialities.name as specname')
        ->get();
       
         $url = route('save.doctor');
      // $doc=Doctor_db::get();
       $spec= DoctorSpec::get();
        $data=compact('doc','url','doc','spec');
        return view('superadmin.masters.doctor_list')->with($data);
    }
    
    public function add_doctor()
    {
        $url = route('save.doctor');
       $doc=Doctor_db::get();
       $spec= DoctorSpec::get();
       $data = compact('url','doc','spec');
        return view('superadmin.masters.doctor_add')->with($data);
    }
    
    public function save_doctor(Request $req)
    { 
        
         $req->validate([
            
            'name' => 'required',
            
            'mobile' => 'required|digits:10|regex:/[6-9][0-9]{9}/|unique:doctor_db,contact_no',
            'spec' => 'required'
            
        ]);
        
        $doc = new Doctor_db;
        $doc->name = $req->name;
        $doc->contact_no = $req->mobile;
        $doc->key_spec = $req->spec;
        $doc->save();
        
        Alert::success('Success','Doctor Added Successfully');
         return redirect()->route('doctor.list');
        
        
    }
    
    public function edit_doct($id)
    {
        
       $url= route('update.doctor',$id);
       $spec= DoctorSpec::get();
       $doc = Doctor_db::join('doctor_specialities', 'doctor_specialities.id','=','doctor_db.key_spec')
                ->where('doctor_db.id', $id)
                ->select('doctor_db.*', 'doctor_specialities.name as spec_name')
                ->first(); // Assuming you expect only one record, using first() instead of get()

       //$spec = DoctorSpec::join()
       $data = compact('url','doc','spec');
        return view('superadmin.masters.doctor_add')->with($data);
        
    }
    
    public function update_doctor(Request $req,$id)
    {
        $doc = Doctor_db::find($id);
       $req->validate([
            
            'name' => 'required',
            
            'mobile' => [
    'required',
    'digits:10',
    'regex:/[6-9][0-9]{9}/',
    Rule::unique('doctor_db', 'contact_no')->ignore($doc->id),
],
            'spec' => 'required'
            
        ]);
        
        
        $doc->name = $req->name;
        $doc->contact_no = $req->mobile;
        $doc->key_spec = $req->spec;
        $doc->save();
        
        Alert::success('Success','Doctor Updated Successfully');
         return redirect()->route('doctor.list');
        
        
    }
    
    public function delete_doct($id)
    {
         $doc = Doctor_db::find($id);
         $doc->active = 0;
         $doc->save();
         
         Alert::success('Success','Doctor Deleted Successfully');
         return redirect()->route('doctor.list');
    }
    
    public function doctor_status_update(Request $req)
    {
        //dd($item);
        $doc = Doctor_db::find($req->user_id);
        
        $doc->active = $req->status;
        $doc->save();
        
       
    }
    
    
    
    public function insurance_list()
    {
         $url = route('save.insurance');
        $insu=HealthInsurance::get();
        $data=compact('insu','url');
        return view('superadmin.masters.insurance_list')->with($data);
    }
    
    
     public function add_insurance()
    {
        $url = route('save.insurance');
       // $insu=HealthInsurance::get();
      // $spec= DoctorSpec::get();
       $data = compact('url');
        return view('superadmin.masters.insurance_add')->with($data);
    }
    
     public function save_insurance(Request $req)
    {
        $req->validate([
            
            'name' => 'required|unique:health_insurance_agen,insurance_agen',
            
            
            
        ]);
        
        $doc = new HealthInsurance;
        $doc->insurance_agen = $req->name;
       
        $doc->save();
        
        Alert::success('Success','Insurance Company Added Successfully');
         return redirect()->route('insurance.list');
    }
    
    public function edit_insurance($id)
    {
        
       $url= route('update.insurance',$id);
       $insu= HealthInsurance::find($id);
      

       //$spec = DoctorSpec::join()
       $data = compact('url','insu');
        return view('superadmin.masters.insurance_add')->with($data);
        
    }
    
    public function update_insurance(Request $req,$id)
    {
         $doc = HealthInsurance::find($id);
       $req->validate([
            'name' => [
    'required',
    Rule::unique('health_insurance_agen', 'insurance_agen')->ignore($doc->id),
],
            
            
        ]);
        
       
        $doc->insurance_agen = $req->name;
       
        $doc->save();
        
        Alert::success('Success','Insurance Company Updated Successfully');
         return redirect()->route('insurance.list');
    }
    
     public function insurance_status_update(Request $req)
    {
        //dd($item);
        $doc = HealthInsurance::find($req->user_id);
        $doc->active = $req->status;
        $doc->save();
    }
    
    public function delete_insurance($id)
    {
         $doc = HealthInsurance::find($id);
         $doc->active = 0;
         $doc->save();
         
         Alert::success('Success','Insurance Company Deleted Successfully');
         return redirect()->route('insurance.list');
    }
    
    public function service_list()
    {
          $url = route('save.service');
        $insu=Service::get();
        $data=compact('insu','url');
        return view('superadmin.masters.service_list')->with($data);
    }
    
    public function add_service()
    {
        $url = route('save.service');
       
       $data = compact('url');
       return view('superadmin.masters.service_add')->with($data); 
    }
    
    public function save_service(Request $req)
    {
        $req->validate([
            
            'name' => 'required|unique:service,name',
            
            
            
        ]);
        
        $doc = new Service;
        $doc->name = $req->name;
       
        $doc->save();
        
        Alert::success('Success','Service Added Successfully');
         return redirect()->route('service.list');
    }
    
    public function edit_service($id)
    {
        
       $url= route('update.service',$id);
       $insu= Service::find($id);
      

       //$spec = DoctorSpec::join()
       $data = compact('url','insu');
        return view('superadmin.masters.service_add')->with($data);
        
    }
    
    public function update_service(Request $req,$id)
    {
        $doc = Service::find($id);
       $req->validate([
            
            'name' => [
    'required',
    Rule::unique('service', 'name')->ignore($doc->id),
],
            
        ]);
        
        
        $doc->name = $req->name;
       
        $doc->save();
        
        Alert::success('Success','Service Updated Successfully');
         return redirect()->route('service.list');
    }
    
    public function delete_service($id)
    {
         $doc = Service::find($id);
         $doc->active = 0;
         $doc->save();
         
         Alert::success('Success','Service Deleted Successfully');
         return redirect()->route('service.list');
    }
    
    public function service_status_update(Request $req)
    {
        //dd($item);
        $doc = Service::find($req->user_id);
        $doc->active = $req->status;
        $doc->save();
    }
    
     public function specialization_list()
    {
         $url = route('save.specialization');
        $spec=DoctorSpec::get();
        $data=compact('spec','url');
        return view('superadmin.masters.specialization_list')->with($data);
    }
     public function add_specialization()
    {
        $url = route('save.specialization');
       
       $data = compact('url');
       return view('superadmin.masters.specialization_add')->with($data); 
    }
    
    public function save_specialization(Request $req)
    {
        $req->validate([
            
            'name' => 'required|unique:doctor_specialities,name',
        ]);
        
        $doc = new DoctorSpec;
        $doc->name = $req->name;
       
        $doc->save();
        
        Alert::success('Success','Specialization Added Successfully');
         return redirect()->route('specialization.list');
    }
    public function edit_specialization($id)
    {
        
       $url= route('update.specialization',$id);
       $spec= DoctorSpec::find($id);
      

       //$spec = DoctorSpec::join()
       $data = compact('url','spec');
        return view('superadmin.masters.specialization_add')->with($data);
        
    }
    
    public function update_specialization(Request $req,$id)
    {
         $doc = DoctorSpec::find($id);
       $req->validate([
            
            
             'name' => [
    'required',
    Rule::unique('doctor_specialities', 'name')->ignore($doc->id),
],
        ]);
        
       
        $doc->name = $req->name;
       
        $doc->save();
        
        Alert::success('Success','Specialization Updated Successfully');
         return redirect()->route('specialization.list');
    }
    
    public function specialization_status_update(Request $req)
    {
        //dd($item);
        $doc = DoctorSpec::find($req->user_id);
        $doc->active = $req->status;
        $doc->save();
    }
    
}
