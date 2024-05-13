<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Patient;
use App\Models\admin\Doctor_db;
use App\Models\admin\DocCharge;
use App\Models\admin\Visitlog;
use App\Models\admin\HealthInsurance;
use App\Models\admin\PatientVital;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use PDF;

class PatientController extends Controller
{
    public function list()
    {
        $currentDate = Carbon::now()->toDateString();
        $patient=Patient::where('date',$currentDate)->orderBy('id','DESC')->get();
        $data=compact('patient');
        return view('admin.patient.list')->with($data);
    }
    public function register()
    {
        $url = route('patient.save');
        $insu = HealthInsurance::get();
        $data = compact('url','insu');
        return view('admin.patient.register')->with($data);
    }

    public function checkmobile(Request $request)
    {
       $mobileNumber = $request->input('mobile_no');

    // Check if the mobile number exists in the database
    $exists = Patient::where('mobile_no', $mobileNumber)->exists();

    // Return a JSON response indicating whether the mobile number exists
    return response()->json(['exists' => $exists]);
    }
    
    public function getName(Request $request)
    {
    $mobileNumber = $request->input('mobile_no');

    // Retrieve first name and last name based on the mobile number
    $patient = Patient::where('mobile_no', $mobileNumber)->first();

   if ($patient) {
        // Return patient information as JSON response
        return response()->json([
            'first_name' => $patient->Fname,
            'last_name' => $patient->Lname,
            'age' => $patient->age,
            'sex' => $patient->sex,
        ]);
    } else {
        // If patient with the given mobile number is not found, return an empty response
        return response()->json([]);
    }
    }


    public function save(Request $req)
    {

        $req->validate([
            'prefix'=> 'required',
            'Fname' => 'required',
            'email' => 'email',
            'gender' => 'required',
            'age' => 'required',
            'mobile_no' => 'required|digits:10|regex:/[6-9][0-9]{9}/',
            'first_reg_charge' => 'required'
        ]);

        //print_r($req->all());die;
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        $user = Auth::user();
        $org_id = $user->org_id;
        //print_r($org_id);

        $patient = new Patient;

        $patient->mr_no = "";
        $patient->i_cover = $req->i_cover;
        $patient->email_id = $req->email_id;
        $patient->prefix = $req->prefix;
        $patient->Fname = $req->Fname;
        $patient->Lname = $req->Lname;
        $patient->age = $req->age;
        $patient->sex = $req->gender;
        $patient->vpo = "";
        $patient->houseno = 0;
        $patient->street = "";
        $patient->city = "";
        $patient->state = "";
        $patient->login_id = "";
        $patient->mobile_no = $req->mobile_no;
        $patient->mnvs_otp = 0;
        $patient->district = "";
        $patient->Fathername = $req->Fathername;
        $patient->spousename = $req->spousename;
        $patient->guardian_name = $req->guardian_name;
        $patient->pin = 0;
        $patient->email_id1 = "";
        $patient->email_id2 = "";
        $patient->Mothername = "";
        $patient->dump = 0;
        $patient->passcode = "";
        $patient->user_p_level = 0;
        $patient->doctor_id = 0;
        $patient->org_name = "";
        $patient->hospital_id = $org_id;
        $patient->opr_name = "";
        $patient->opr_id = 0;
        $patient->mars_passcode = "";
        $patient->date = $currentDate;
        $patient->ipd_no = 0;
        $patient->time = $currentTime;
        $patient->admission_status = 0;
        $patient->m_count = 0;
        $patient->p_lang = 0;
        $patient->dob = $req->dob;;
        $patient->Address = $req->Address;
        $patient->lead_gen = $req->lead_gen;
        $patient->first_reg_charge = $req->first_reg_charge;
        $patient->whats_app_no = $req->whats_app_no;
        $patient->global_euid = 0;
        $patient->abha_add = "";
        $patient->abha_mobile = "";
        $patient->save();

        Alert::success('Success','Patient Registered Successfully');
         return redirect()->route('patient.list');


    }
    
    
    public function patient_filter(Request $req)
    {
        $startDate = $req->start_date;
        $endDate = $req->end_date;
        
        $data = Patient::whereRaw('DATE(date) >= ?', [$startDate])
        ->whereRaw('DATE(date) <= ?', [$endDate])
         
         ->orderBy('id', 'DESC')
        ->get();
        
        return response()->json($data);
    }
    
    public function gen_bill($id)
    {
        $data = Patient::where('id',$id)->first();
        $pdf = PDF::loadView('admin.pdf.patient_bill',['data' => $data]);
      // download PDF file with download method
      return $pdf->stream('pdf_file.pdf');
    }
    
    public function patient_view($id)
    {
        $patient = Patient::find($id);
        $data= compact('patient');
        return view('admin.patient.view')->with($data);
    }


    public function edit($id)
    {
        $patient = Patient::find($id);
        $url= route('patient.update',$id);
        $data = compact('patient','url');

        return view('admin.patient.add')->with($data);

    }

    public function update(Request $req,$id)
    {

    }
    
    public function visit_list()
    {
        $currentDate = Carbon::today()->toDateString(); 
       $visit = Visitlog::leftjoin('doctor_db','doctor_db.id','=','visitlog.doctor_id')->leftjoin('patient_vital_entry','patient_vital_entry.visit_id','=','visitlog.id')->whereDate('visitlog.date',$currentDate)->select('visitlog.*','visitlog.id as vid','visitlog.patient_id as pid','patient_vital_entry.*','doctor_db.name')->get();
       
        $data=compact('visit');
        return view('admin.patient.visit_list')->with($data);
    }
    
    public function visit_add()
    {
         $doctor = Doctor_db::get();
        $charges = DocCharge::get();
        $data = compact('doctor','charges');    
        return view('admin.patient.visit_add')->with($data);
    }
    
   public function getPatientDetails(Request $request)
{
    // Retrieve the UHID from the request
    $uhid = $request->input('uhid');

    // Retrieve patient details based on the UHID (ensure exact match)
    $patient = Patient::where('id', $uhid)->first();

    if ($patient) {
        // If patient is found, return the details as JSON response
        return response()->json([
            'success' => true,
            'patient' => [
                'fname' => $patient->Fname,
                'lname' => $patient->Lname,
                'age' => $patient->age,
                'sex' => $patient->sex
            ]
        ]);
    } else {
        // If patient is not found, return error as JSON response
        return response()->json([
            'success' => false,
            'message' => 'Patient details not found.'
        ]);
    }
}


    public function add_visit($id)
    {
        $doctor = Doctor_db::get();
        $charges = DocCharge::get();
        $visit = Visitlog::join('doctor_db','doctor_db.id','=','visitlog.doctor_id')->where('patient_id',$id)->select('visitlog.*','doctor_db.name')->get();
        $patient = Patient::where('id',$id)->first();
        $data = compact('doctor','id','charges','visit','patient');
        return view('admin.patient.visit')->with($data);
    }
    
    public function visit_save(Request $req)
    {
        
        $req->validate([
            'doctor' =>'required',
            'charges' => 'required'
            ]);
            
            $user = Auth::user();
        $org_id = $user->org_id;
        
        $visit = new Visitlog;
        $visit->patient_id = $req->uhid;
        $visit->hospital_id = $org_id;
        $visit->doctor_id = $req->doctor;
        $visit->ch = $req->charges;
        $visit->save();
        Alert::success('Success','Visit Added Successfully');
         return redirect()->route('patient.list');
    }
    
    
    public function visit_patsave(Request $req)
    {
        
        $req->validate([
            'uhid' => 'required',
            'doctor' =>'required',
            'charges' => 'required'
            ]);
            
            $user = Auth::user();
        $org_id = $user->org_id;
        
        $visit = new Visitlog;
        $visit->patient_id = $req->uhid;
        $visit->hospital_id = $org_id;
        $visit->doctor_id = $req->doctor;
        $visit->ch = $req->charges;
        $visit->save();
        Alert::success('Success','Visit Added Successfully');
         return redirect()->route('visit.list');
    }
    
    public function vital_add($id, $patient_id)
    {
        $pi = Patient::find($patient_id);
        $data= compact('id','patient_id','pi');
        return view('admin.patient.vital_add')->with($data);
    }
    
    public function vital_save(Request $req)
    {
        $currentDate = Carbon::now()->toDateString();
        $currentTime = Carbon::now()->toTimeString();
        
        
        $pv = new PatientVital;
        $pv->date = $currentDate;
        $pv->time =  $currentTime;
        $pv->height = $req->ht;
        $pv->weight = $req->wt;
        $pv->sbp = $req->sbp;
        $pv->dbp = $req->dbp;
        $pv->pr = $req->pr;
        $pv->rr = $req->rr;
        $pv->temp = $req->temp;
        $pv->patient_id = $req->uhid;
        $pv->visit_id = $req->vid;
        
        $pv->save();
        
        
        Alert::success('Success','Patient Vital Entry Added Successfully');
         return redirect()->route('visit.list');
    }
}
