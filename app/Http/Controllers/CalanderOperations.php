<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class CalanderOperations extends Controller
{
    protected $seven_days = [
        1 => 'Sun',
        2 => 'Mon',
        3 => 'Tue',
        4 => 'Wed',
        5 => 'Thu',
        6 => 'Fri',
        7 => 'Sat',
    ];


    protected $seven_days_rev = [
        'Sun' => 1,
        'Mon' => 2,
        'Tue' => 3,
        'Wed' => 4,
        'Thu' => 5,
        'Fri' => 6,
        'Sat' => 7,
    ];


    public function get_calander($date){
        $date = Carbon::parse($date);
        $lastDayofMonth =    \Carbon\Carbon::parse($date)->endOfMonth();
        $startDayofMonth =    \Carbon\Carbon::parse($date)->startOfMonth();
        $first_day = $startDayofMonth->format('D');
        $first_day_in_num = $this->seven_days_rev[$first_day];
        $month_end_day = $lastDayofMonth->format('d');

        $year_month = $date->format('Y-m');

        $dates = [];
        $d_c = 1;
        $weeks = 1;
        $l_e = 42;
        for($i = 1; $i <= $l_e; $i++){
            if($i <= 7){
                $weeks = 1;
            }else if(($i > 7) && ($i <= 14)){
                $weeks = 2;
            }else if(($i > 14) && ($i <= 21)){
                $weeks = 3;
            }else if(($i > 21) && ($i <= 28)){
                $weeks = 4;
            }else if(($i > 28) && ($i <= 35)){
                $weeks = 5;
            }else if(($i > 35) && ($i <= 42)){
                $weeks = 6;
            }else{
                return [];
            }
            if($i >= $first_day_in_num){
                if($d_c <= $month_end_day){
                    $dates[$weeks][$i] = $year_month . '-' . $d_c;
                    $d_c += 1;
                }else{
                    $dates[$weeks][$i] = null;
                }
            }else{
                $dates[$weeks][$i] = null;
            }
        }
        return $dates;
    }
}
