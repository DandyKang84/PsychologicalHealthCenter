function check_input(){
    if(!document.imageboard_form.subject.value){
        alert("제목을 입력 하세요!!");
        document.imageboard_form.subject.focus();
        return;
    }
    if(!document.imageboard_form.content.value){
        alert("내용을 입력 하세요!!");
        document.imageboard_form.content.focus();
        return;
    }
    document.imageboard_form.submit();
}

function modifycheck_input() {
    if (!document.imgboard_title.subject.value) {
      alert("제목을 입력하세요!");
      document.imgboard_title.subject.focus();
      return;
    }
    if (!document.imgboard_title.content.value) {
      alert("내용을 입력하세요!");
      document.imgboard_title.content.focus();
      return;
    }
    document.imgboard_title.submit();
  }