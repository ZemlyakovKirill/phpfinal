function positive_checker(element,max){
    element.value=element.value.replace(/[^0-9]/g,"");
    if(element.value>max){
        element.value=element.value.substring(0,2);
    }
}
function password_checker(element,origin_id,button_id){
    if(element.value!=document.getElementById(origin_id).value){
        document.getElementById(button_id).disabled=true;
    }
    else{
        document.getElementById(button_id).disabled=false;
    }

}
function username_checker(element){
    element.value=element.value.replace(/[^a-z0-9]/g,"");
}
