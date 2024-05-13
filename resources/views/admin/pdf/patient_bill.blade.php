<!DOCTYPE html>
<html>
<head>
    <title>Half Size A4 PDF</title>
    <style>
     .d-flex{
         display: flex !important;
     }  
    .d-flex .col-4{
         
         width: 30% !important;
    
     }
     .justify-content-between {
    -webkit-box-pack: justify !important;
    -ms-flex-pack: justify !important;
    justify-content: space-between !important;
}
    </style>
</head>
<body>
    
        <!-- Your content here -->
        <div style="text-align: center;">
            <h1>AGARWAL NURSING HOME</h1>
            <h3>SALARPUR ROAD, KURUKSHETRA - 136118</h3>
            <p>Ph. 01744-290355(N.H.), Mob. No. 82228-11455 Email: anhkkr@gmail.com</p>
        </div>
    <hr>
    
    <div style="display: flex !important;">
        <div style="display: flex !important;float:left;">
                <b>BillNo</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 01 <br>
                <b>MRNo</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 201<br>
                <b>Patient Name</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $data['prefix'] }}{{ $data['Fname'] }}{{ $data['Lname'] }}<br>
                <b>Patient Category</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Company<br>
                <b>Admiting Doctor</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Dr.Ajay Agarwal<br>
                <b>Company</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ECHS
        </div>
        
        
        <div style="padding-left:450px">
             <b>Bill Date</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 07/05/2024<br>
                   <b>Admission Date</b>     &nbsp;&nbsp; : 07/05/2024<br>
                <b>Admission No </b>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 123<br>
                <b>Bed No</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 111<br>
                <b>Bed Category</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : xyz<br>
               <b> Approvel Amt</b>          &nbsp;&nbsp;&nbsp;&nbsp; : <b>0.00</b>
        </div>
    </div>
    
    <hr>
    <div style="text-align: center;">
        <b>IPD DRAFT BILL</b>
    </div>    
    
    
        
        
   
</body>
</html>
