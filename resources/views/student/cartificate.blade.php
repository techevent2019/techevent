<?php $winner = $data ->winner; ?>
<center>
<style>
.signature, .title { 
float:left;
  border-top: 1px solid #000;
  width: 200px; 
  text-align: center;
}



</style>
<div style="width:970px; height:620px; padding:20px; text-align:center; border: 10px solid #787878; font-size:16px">
<div style="width:920px; height:570px; padding:20px; font-size:25px; text-align:center; border: 5px solid #787878">
   <span style="font-size:35px; font-weight:bold; font-family: Old English Text MT;  color: #0f4d47">{{ $data->college_name }}</span><br/>
       <span style="font-size:35px; font-weight:bold; font-family: Old English Text MT;      color:#B89521">Certificate</span>
       <br><br>
       <span style="font-size:25px"><i>This is to certify that</i></span>
       <br><br>
       <span style="font-size:30px; font-family: Old English Text MT;      color:#B89521"><b>{{ $stu_name = Auth::user()->stu_name }}</b></span><br/><br/>
       <span style="font-size:25px"><i>has Successfully participated in</span>
       <span style="font-size:25px "><b>{{ $data->event_name }} </b></span>  during <span>{{ $data->techfest_name }}</span>, <span>{{ $data->level }} Level</span> and secured <span><?php
         if($winner == '0' or is_null($winner))
          {?> ---- <?php
          }
          else
          {
            echo $winner.'st';
          }?></span> position in "TECH FEST 2K19" held in <span><b>{{ $data->college_name }}</b></span> from <span> {{ date('d-M-y', strtotime($data->event_start_date)) }} to {{ date('d-M-y', strtotime($data->event_end_date)) }}</i></span></p><br/>
     
<div style="text-align: center; margin-top: 80px;">
<img src="{{ asset('public/storage/colleges/'.$col->image) }}"  style="width: 23%; height: 150px; width: 150px;" > 
</div>
<div style="position: absolute; bottom: 120">

<div style="text-align: left;">
<table style="margin-top:40px;float:left">
<tr>
<td><span><b>$student.getFullName()</b></span></td>
</tr>
<tr>
<td style="width:200px;float:left;border:0;border-bottom:1px solid #000;"></td>
</tr>
<tr>
<td style="text-align:center"><span><b>{{ $col->col_principal_name }}</b></span></td></tr>
<tr>
<td style="text-align:center"><span>Principal</span></td>
</tr>
</table>
</div>

<div style="text-align: left;">
<table style="margin-top:40px;float:right">
<tr>
<td><span><b style="font-family: ;">Piyush Nakrani</b></span></td>
</tr>
<tr>
<td style="width:200px;float:right;border:0;border-bottom:1px solid #000;"></td>
</tr>
<tr>
<td style="text-align:center"><span><b>{{ $ev_co->stu_name }}</b></span></td>
</tr><tr>
<td style="text-align:center"><span>Event Co-odinator</span></td>
</tr>
</table>
</div>
</div>
</div>
</div>
</center>