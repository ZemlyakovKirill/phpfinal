
function choice_field(element,ref){
    document.getElementById("choice_list").style.display="block";
    document.getElementById("choice_list").style.top=element.getBoundingClientRect().top;
    document.getElementById("choice_list").style.left=document.getElementById("tables").getBoundingClientRect().left+element.offsetWidth;
    document.getElementById("create_choice").href="create"+ref+".php";
    document.getElementById("update_choice").href="update"+ref+".php";
    document.getElementById("detail_choice").href="detail"+ref+".php";
    document.getElementById("list_choice").href=ref+"list.php";
}
function table_list(element){
    document.getElementById("tables").style.display="block";
    document.getElementById("tables").style.top=document.getElementById("top-nav").offsetHeight;
    document.getElementById("tables").style.left=element.getBoundingClientRect().left;
}
document.getElementById('choice_id').onkeyup=function(e){
    document.getElementById('choice_id').value=document.getElementById('choice_id').value.replace(/[^0-9]/g,"");
    document.cookie="id="+document.getElementById('choice_id').value;
}
document.getElementById("detail_choice").onmouseover=function(e){
    document.getElementById('identificator_selector').style.top=document.getElementById("detail_choice").getBoundingClientRect().top;
    document.getElementById('identificator_selector').style.left=document.getElementById("choice_list").getBoundingClientRect().left+document.getElementById("choice_list").offsetWidth;
    document.getElementById('identificator_selector').style.width=document.getElementById("choice_list").offsetWidth/2;
    document.getElementById('identificator_selector').style.display="block";
    document.getElementById('choice_id').focus();
    document.getElementById('choice_id').value="";
}
document.getElementById("detail_choice").onmouseleave=function(){
    document.getElementById('identificator_selector').style.display="none";
}
document.getElementById("update_choice").onmouseover=function(e){
    document.getElementById('identificator_selector').style.top=document.getElementById("update_choice").getBoundingClientRect().top;
    document.getElementById('identificator_selector').style.left=document.getElementById("choice_list").getBoundingClientRect().left+document.getElementById("choice_list").offsetWidth;
    document.getElementById('identificator_selector').style.width=document.getElementById("choice_list").offsetWidth/2;
    document.getElementById('identificator_selector').style.display="block";
    document.getElementById('choice_id').focus();
    document.getElementById('choice_id').value="";
}
document.getElementById("update_choice").onmouseleave=function(){
    document.getElementById('identificator_selector').style.display="none";
}
window.onload=function(){
    document.getElementById('user_icon').setAttribute("height",document.getElementById('user_link').offsetHeight/2);
    document.getElementById('user_icon').setAttribute("width",document.getElementById('user_icon').getAttribute("height"));
    document.getElementById('user_icon').style.display="block";
    if(document.getElementById('detail_card')){
        document.getElementById('detail_card').style.left=document.getElementById('top-nav').getBoundingClientRect().left;
    }
    if(document.getElementById('choiced_item')){
        document.getElementById('choiced_item').style.left=document.getElementById('top-nav').offsetLeft+document.getElementById('top-nav').offsetWidth/4+5;
    }
    if(document.getElementById('user_choice_list')){
        document.getElementById('user_choice_list').style.width=document.getElementById('top-nav').offsetWidth/4;
        document.getElementById('user_choice_list').style.marginTop=document.getElementById('top-nav').offsetHeight+5;
        document.getElementById('user_choice_list').style.left=document.getElementById('top-nav').getBoundingClientRect().left;
    }
    var cookie=document.cookie.replace(/[,;]/g,"");
    cookie=cookie.replace(/[=]/g," ");
    cookie=cookie.split(/( )/);
    for(var i=0;i<cookie.length;i++){
        if(cookie[i].match("login")){
            console.log(cookie[i+1]);
            return;
        }
    }
    var loc=document.location.href.toString();
    if(loc.indexOf("login.php")==-1&&loc.indexOf("registration.php")==-1){
        document.location="login.php";
    }
}

window.onmousemove=function(e){
    var pos=e.target.id;
    if( pos.indexOf("jobless_choice")==-1&&
        pos.indexOf("stipend_choice")==-1&&
        pos.indexOf("organization_choice")==-1&&
        pos.indexOf("program_choice")==-1&&
        pos.indexOf("group_choice")==-1&&
        pos.indexOf("passage_choice")==-1&&

        pos.indexOf("create_choice")==-1&&
        pos.indexOf("update_choice")==-1&&
        pos.indexOf("detail_choice")==-1&&
        pos.indexOf("list_choice")==-1&&

        pos.indexOf("jobless_link")==-1
        ){

        document.getElementById("tables").style.display="none";
        document.getElementById("choice_list").style.display="none";
    }
}