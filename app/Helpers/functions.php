<?php

function front_css($file){
    return asset('public/frontend/css/'.$file);
}
function front_js($file){
    return asset('public/frontend/js/'.$file);
}
function front_image($file){
    return asset('public/frontend/img/'.$file);
}
function front_plugin($file){
    return asset('public/plugins/'.$file);
}
function front_success_response($data=[]){
    $message = ['store'=>'Record saved successfully.', 'update'=>'Record saved successfully.', 'destroy'=>'Record deleted successfully.', 'password_update'=>'Password updated successfully.'];
    $data['status'] = true;
    $data['message'] = isset($data['message']) && isset($message[$data['message']])?$message[$data['message']]:'Success';
    return $data;
}
function front_status_color($type){
    $types = ['Pending'=>'warning', 'Approved'=>'primary', 'Assigned'=>'info', 'On Hold'=>'warning', 'Picked Up'=>'primary', 'Delivered'=>'success', 'Rejected'=>'danger', 'Success'=>'success'];
    return $types[$type];
}
function front_force_logout(){
    Auth::logout();
    Auth::guard()->logout();
    request()->session()->flush();
    request()->session()->regenerate();
    return redirect(route('login'));
}
function front_cart_data(){
    $cart = new Cart;
    $view['share_cart'] = Cart::getContent();
    $total_quantity = 0;
    $currency_code = '';
    foreach($view['share_cart'] as $key=>$val){
        $currency_code = $val->attributes['currency_code'];
        $total_quantity += $val->attributes['total_quantity'];
    }
    $view['share_cart']->cartTotalQuantity = $total_quantity;
    $view['share_cart']->currency_code = $currency_code;
    $view['share_cart']->getTotal = Cart::getTotal();
    View::share($view);
}
function order_status(){
    $status = ['Pending', 'Processing', 'Approved', 'Assigned', 'On Hold', 'Picked Up', 'Delivered', 'Rejected', 'Cancelled'];
    return array_combine($status, $status);
}
function payment_status(){
    $status = ['Pending', 'Success', 'Failed'];
    return array_combine($status, $status);
}
function isCurrentRoute($name){
    return request()->route()->getName()==$name?true:false;
}