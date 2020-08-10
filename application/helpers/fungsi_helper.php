<?php

function sudah_login()
{
    $ci =& get_instance();
    $user_session = $ci->session->userdata('id');
    if($user_session){
        redirect('/Sapi');
    }
}
function belum_login()
{
    $ci =& get_instance();
    $user_session = $ci->session->userdata('id');
    if(!$user_session){
        redirect('/Login');
    }
}