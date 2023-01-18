function check_inputboard() {
    if(!document.board_form.subject.value){
        document.board_form.subject.focus();
        return;
    }
    if(!document.board_form.content.value){
        document.board_form.content.focus();
        return;
    }
    document.board_form.submit();
}
function check_inputmodify() {
    if(!document.board_modify_form.subject.value){
        document.board_modify_form.subject.focus();
        return;
    }
    if(!document.board_modify_form.content.value){
        document.board_modify_form.content.focus();
        return;
    }
    document.board_modify_form.submit();
}