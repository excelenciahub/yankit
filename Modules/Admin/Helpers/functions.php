<?php

function admin_css($file){
    return str_replace('modules', 'Modules', Module::asset('Admin:Resources/assets/css/'.$file));
}
function admin_js($file){
    return str_replace('modules', 'Modules', Module::asset('Admin:Resources/assets/js/'.$file));
}
function admin_image($file){
    return str_replace('modules', 'Modules', Module::asset('Admin:Resources/assets/images/'.$file));
}
function admin_plugin($file){
    return str_replace('modules', 'Modules', Module::asset('Admin:Resources/assets/plugins/'.$file));
}
function admin_success_response($data=[]){
    $message = ['store'=>'Record saved successfully.', 'update'=>'Record saved successfully.', 'destroy'=>'Record deleted successfully.', 'password_update'=>'Password updated successfully.'];
    $data['status'] = true;
    $data['message'] = isset($data['message']) && isset($message[$data['message']])?$message[$data['message']]:'Success';
    return $data;
}
function admin_status_color($type){
    $types = ['Pending'=>'warning', 'Approved'=>'primary', 'Assigned'=>'info', 'On Hold'=>'warning', 'Picked Up'=>'primary', 'Delivered'=>'success', 'Rejected'=>'danger', 'Success'=>'success', 'Cancelled'=>'danger'];
    return $types[$type];
}
