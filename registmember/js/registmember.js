function check_input(){
    if(!document.regist_form.id.value){
        document.regist_form.id.focus();
        return;
    }
    if(!document.regist_form.name.value){
        document.regist_form.name.focus();
        return;
    }
    if(!document.regist_form.pass1.value){
        document.regist_form.pass1.focus();
        return;
    }
    if(!document.regist_form.pass2.value){
        document.regist_form.pass2.focus();
        return;
    }
    if(document.regist_form.pass1.value  !== document.regist_form.pass2.value){
        document.regist_form.pass1.value = "";
        document.regist_form.pass2.value = "";
        document.regist_form.form.focus();
        return;
    }
    if(!document.regist_form.email.value){
        document.regist_form.email.focus();
        return;
    }
    document.regist_form.submit();
}

function reset_form(){
    document.regist_form.id.value = "";
    document.regist_form.name.value = "";
    document.regist_form.pass1.value = "";
    document.regist_form.pass2.value = "";
    document.regist_form.email.value = "";
    document.regist_form.id.focus();
    return;
}
