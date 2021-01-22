<?php

namespace App\Traits;

use App\Commercial;
use http\Env\Request;

trait CommercialTrait{

    public function handleCommercials()
    {
        $commercials = Commercial::where('status',0)->orWhere('status',1)->get();
        foreach ($commercials as $commercial){
            if($commercial->status==0){
                if ($commercial->start_date==verta()->formatDate()){
                    $commercial->status=1;
                    $commercial->save();
                }
            }
            if($commercial->status==1){
                if (($commercial->total_click!=null && $commercial->click_count>= $commercial->total_click) || $commercial->finish_date==verta()->formatDate()){
                    $commercial->status=2;
                    $commercial->save();
                }
            }
        }
    }

}
