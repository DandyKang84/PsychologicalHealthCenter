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

function check_id() {
    window.open("regist_check_id.php?id=" + document.member_form.id.value,
   "IDcheck", "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes, status=no, titlebar=no, toolbar=no, location=no, menubar=no");

  }