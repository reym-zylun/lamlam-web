<?php
 
function is_unused_ticket($user_ticket)
{
    $started_date = $user_ticket->started_date;
    $total_num = $user_ticket->adult_num + $user_ticket->child_num;
    if(is_null($started_date) && $total_num > 0) {
        return true;
    }
 
    return false;
}

function is_inuse_ticket($user_ticket)
{
    $expired_date = $user_ticket->expired_date;
    $total_num = $user_ticket->adult_num + $user_ticket->child_num;
    if (!is_null($expired_date) && strtotime($expired_date) > time() && $total_num > 0) { 
        return true;
    }
 
    return false;
}

function isAdmin() {
    if(session()->has('user') && session()->get('user')->role == 'admin') {
        return true;
    }
    return false;
}
