<?php
use Carbon\Carbon;


// current years get function start here
function get_years(){
    $current_date=Carbon::now();
    $start_year= Carbon::now()->startOfYear();
    $end_year=Carbon::now()->endOfYear();
    if($current_date->format('m')>3){
      $start_year=Carbon::now()->format('Y-04-01');
      $end_year=Carbon::now()->addYear()->format('Y-03-31');
    //   dd($start_year,$end_year);
    }else{
      $start_year=Carbon::now()->subYear()->format('Y-04-01');
      $end_year=Carbon::now()->format('Y-03-31');
    }
    return (object) ['start_year'=>$start_year,'end_year'=>$end_year];
}




?>
