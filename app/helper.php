<?php

function orderCount($role){
    if($role == 'client'){
        $count = App\Models\Order::where('user_id',auth()->user()->id)->count();
    }else{
        $count = App\Models\Order::count();
    }
    return $count;
}