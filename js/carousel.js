$(document).ready(function(){
    var slidePosition = 1;
    SlideShow(slidePosition);
    
    // forward/Back controls
    function plusSlides(n) {
      SlideShow(slidePosition += n);
    }
    
    //  images controls
    function currentSlide(n) {
      SlideShow(slidePosition = n);
    }
    
    function SlideShow(n) {
      var i;
      var slides = document.getElementsByClassName("Containers");
      var circles = document.getElementsByClassName("dots");
      if (n > slides.length) {slidePosition = 1}
      if (n < 1) {slidePosition = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < circles.length; i++) {
          circles[i].className = circles[i].className.replace(" enable", "");
      }
      slides[slidePosition-1].style.display = "block";
      circles[slidePosition-1].className += " enable";
    } 
    var slidePosition = 0;

    $("a").click(function(){
        if($(this).attr("class")=="back"){
            plusSlides(-1);
        }
        if($(this).attr("class")=="forward"){
            plusSlides(1);
        }
    });
    $(".dots").click(function(){
        if($(this).attr("class")=="dots first"){
            currentSlide(1);
        }
        if($(this).attr("class")=="dots second"){
            currentSlide(2);
        }
        if($(this).attr("class")=="dots third"){
            currentSlide(3);
        }
    });
});