function slide_func() {
    let slideshow = document.querySelector('.slide_box');
    let slideshowSlides = document.querySelector('.slide_img_box');
    let slides = document.querySelectorAll('.slide_img_box a');

    let prev = document.querySelector('.prev');
    let next = document.querySelector('.next');
    
    let slideCount = slides.length;
    let currentIndex = 0;
    let timer ="";
    let indicators = document.querySelectorAll('.indicator a');

    for(let i=0 ; i<slides.length; i++) {
        let newLeft = i*100+'%';
        slides[i].style.left = newLeft;
    }

    function gotoSlide(index){
        currentIndex = index;
        let newLeft = index * -100 + '%';
        slideshowSlides.style.left = newLeft;
    
        // 함수추가 슬라이드가 움직이면 indicators도 같이 움직인다 
        indicators.forEach((obj)=>{
            obj.classList.remove('active');
        });
        indicators[index].classList.add('active');
    }

    gotoSlide(0);

    function startTimer() {
        timer = setInterval(function(){
           let nextIndex = (currentIndex + 1) % slideCount;
           gotoSlide(nextIndex);
        }, 1000);
       }
       
       startTimer();

    // 마우스포인터를 가져가면 타임을 멈춘다
    slideshowSlides.addEventListener('mouseenter',()=>{
        clearInterval(timer);
    });

    slideshowSlides.addEventListener("mouseleave", function(){
        startTimer();
    });
    prev.addEventListener('mouseenter',()=>{
        clearInterval(timer);
    });
    next.addEventListener('mouseenter',()=>{
        clearInterval(timer);
    });

    prev.addEventListener('click',function(e){
        e.preventDefault(); //angker 기능을 막음
        let index = currentIndex;
        index = (index === 0 ) ? slideCount-1 : index-1; 
        gotoSlide(index);
    });

    next.addEventListener('click',function(e){
        e.preventDefault();
        let index = currentIndex;
        index = (index===(slideCount-1)) ? 0 : index+1;
       
        gotoSlide(index);
    });
    // indicators click 해당화면으로 이동
    indicators.forEach((obj)=>{
        obj.addEventListener('mouseenter', ()=>{
            clearInterval(timer);
        });
    });
    //디버깅하는방법
    //console.log("~~~~~~~obj.index~~~~~~~~~~~${obj.index}")
    for(let i=0; i<indicators.length ;i++){
        indicators[i].addEventListener('click', (e)=>{
            e.preventDefault();
            gotoSlide(i);
        });
    }
}//end of slide_func