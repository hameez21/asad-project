 
    var widthm=5;
    var widthtv=5;
    function plusSlides(name,n){

        if(window.innerWidth<699){
        console.log(name);
        var imageHolder=document.getElementsByClassName("imageHolder");
        var slides = document.getElementsByClassName("movieImage");
        if(name=='tv'){
            slides=document.getElementsByClassName("tvImage");
            var imageHolder=document.getElementsByClassName("tvimageHolder");
        }
        var cSlide=currentSlide(name);
        var nextSlide = cSlide+n;
        if(nextSlide<0){
            nextSlide=slides.length-1;
        }
        if(nextSlide>=slides.length){
            nextSlide=0;
        }
        for(i=0;i<slides.length;i++){
            slides[i].style.display="none";
            imageHolder[i].style.display="none";
        }
        console.log(nextSlide);
        slides[nextSlide].style.display="block";
        imageHolder[nextSlide].style.display="block";
    }
    if(window.innerWidth>699){

        var flex=document.getElementsByClassName("flexContainer");
              
        if(n==1){ 
            
            if(name=='m'&&widthm==5){
                widthm=widthm-97;
                console.log(widthm);
                flex[0].style.marginLeft=widthm+"%";
            }
            else if(name=='tv'&&widthtv==5){
                widthtv=widthtv-97;
                flex[1].style.marginLeft=widthtv+"%";
            }
        }
        if(n==-1){
            if(name=='m'&&widthm!=97){
                widthm=5;
                flex[0].style.marginLeft=widthm+"%";
            }
            else if(name=='tv'&&widthtv!=97){
                widthtv=5;
                flex[1].style.marginLeft=widthtv+"%";
            }
        }
    }   
}

    function currentSlide(name){
        var slide=document.getElementsByClassName("movieImage");
        var imageHolder=document.getElementsByClassName("imageHolder")
        if(name=='tv'){
            slide=document.getElementsByClassName("tvImage");
            imageHolder=document.getElementsByClassName("tvimageHolder")
        }
        var cSlide=0;
        for(var i=0; i<slide.length;i++){
            if(slide[i].style.display=="block"&&imageHolder[i].style.display=="block"){
                 cSlide=i;}
            }
            return cSlide;}
    function resetStyle(){
        var imageHolder=document.getElementsByClassName("imageHolder");
        var tvimageHolder=document.getElementsByClassName("tvimageHolder");     
      var slide=document.getElementsByClassName("movieImage");
      var tvslide=document.getElementsByClassName("tvImage");
      if(window.innerWidth>699){
          for(var i=0;i<slide.length;i++){
            slide[i].style.display="block";
            imageHolder[i].style.display="block";
            }
          for(i=0;i<tvslide.length;i++){
            tvslide[i].style.display="block";
            tvimageHolder[i].style.display="block";
          }
        }
        else{
            var cSlide=currentSlide('m');
            for(var i=1;i<slide.length;i++){
            
            slide[i].style.display="none";
            imageHolder[i].style.display="none";}
            cSlide=currentSlide('tv');
          for(i=1;i<tvslide.length;i++)
          {
            tvslide[i].style.display="none";
            tvimageHolder[i].style.display="none";}
        }}
        function setMovieDetail(movieList){
            console.log("working");
            console.log(movieList[0][0].name);

            var anchor= document.getElementsByClassName("homeMovDetail");
            var Images = document.getElementsByClassName("movieImage");
            for( var i=0; i<Images.length;i++){
            anchor[i].textContent=movieList[0][i].name;
            Images[i].src="Images/"+movieList[0][i].thumbnail;
            console.log("Images/"+movieList[0][i].thumbnail);
        }
        
    }
    var imageHolder = document.getElementsByClassName('imageHolder');
    var tvImageHolder = document.getElementsByClassName('tvImageHolder');
    for(var i=0; i<imageHolder.length;i++);


function loadData(theaterList, onTvList, popList, topList,popTvList,topTvList)
{
    var onTheater1 = document.getElementsByClassName('ih1')[0].children;
    onTheater1[0].src = theaterList[0][2];
    onTheater1[1].innerHTML = theaterList[0][1];
    onTheater1[1].href = 'Movie.php?blast=' + theaterList[0][0];
    
    var onTheater2 = document.getElementsByClassName('ih2')[0].children;
    onTheater2[0].src =  theaterList[1][2];
    onTheater2[1].innerText = theaterList[1][1];
    onTheater2[1].href = 'Movie.php?blast=' + theaterList[1][0];
    
    var onTheater3 = document.getElementsByClassName('ih3')[0].children;
    onTheater3[0].src =  theaterList[2][2];
    onTheater3[1].innerText = theaterList[2][1];
    onTheater3[1].href = 'Movie.php?blast=' + theaterList[2][0];

    var onTheater4 = document.getElementsByClassName('ih4')[0].children;
    onTheater4[0].src =  theaterList[3][2];
    onTheater4[1].innerText = theaterList[3][1];
    onTheater4[1].href = 'Movie.php?blast=' + theaterList[3][0];

    var onTheater5 = document.getElementsByClassName('ih5')[0].children;
    onTheater5[0].src =    theaterList[4][2];
    onTheater5[1].innerText = theaterList[4][1];
    onTheater5[1].href = 'Movie.php?blast=' + theaterList[4][0];

    var onTheater6 = document.getElementsByClassName('ih6')[0].children;
    onTheater6[0].src =    theaterList[5][2];
    onTheater6[1].innerText = theaterList[5][1];
    onTheater6[1].href = 'Movie.php?blast=' + theaterList[5][0];

    var onTv1 = document.getElementsByClassName('tvih1')[0].children;
    onTv1[0].src =    onTvList[0][2];
    onTv1[1].innerText = onTvList[0][1];
    onTv1[1].href = 'Movie.php?blast=' + onTvList[0][0];
    
    var onTv2 = document.getElementsByClassName('tvih2')[0].children;
    onTv2[0].src =    onTvList[1][2];
    onTv2[1].innerText = onTvList[1][1];
    onTv2[1].href = 'Movie.php?blast=' + onTvList[1][0];
    
    var onTv3 = document.getElementsByClassName('tvih3')[0].children;
    onTv3[0].src =    onTvList[2][2];
    onTv3[1].innerText = onTvList[2][1];
    onTv3[1].href = 'Movie.php?blast=' + onTvList[2][0];

    var onTv4 = document.getElementsByClassName('tvih4')[0].children;
    onTv4[0].src =    onTvList[3][2];
    onTv4[1].innerText = onTvList[3][1];
    onTv4[1].href = 'Movie.php?blast=' + onTvList[3][0];

    var onTv5 = document.getElementsByClassName('tvih5')[0].children;
    onTv5[0].src =    onTvList[4][2];
    onTv5[1].innerText = onTvList[4][1];
    onTv5[1].href = 'Movie.php?blast=' + onTvList[4][0];

    var onTv6 = document.getElementsByClassName('tvih6')[0].children;
    onTv6[0].src =    onTvList[5][2];
    onTv6[1].innerText = onTvList[5][1];
    onTv6[1].href = 'Movie.php?blast=' + onTvList[5][0];

    var populars = document.getElementsByClassName('moviePop');     //Pop
    for(var i=0; i<6; i++)
    {
        var popular = populars[i].children;
        popular[0].src =    popList[i][2];
        popDetail = popular[1].children;
        popDetail[0].innerText = Math.round(popList[i][4]);
        popDetail[1].innerText = popList[i][1];
        popDetail[1].href = 'Movie.php?blast=' + popList[i][0];
        popDetail[2].innerText = popList[i][3];
    }

    for(var i=0; i<6; i++)                                          //Top
    {
        var popular = populars[i+6].children;console.log();
        popular[0].src =    topList[i][2];
        popDetail = popular[1].children;
        popDetail[0].innerText = Math.round(topList[i][4]);
        popDetail[1].innerText = topList[i][1];
        popDetail[1].href = 'Movie.php?blast=' + topList[i][0];
        popDetail[2].innerText = topList[i][3];
    }
    var j=12
    for(var i=0; i<6; i++)                                          //Top
    {
        var popular = populars[j].children;console.log();
        popular[0].src =  popTvList[i][2];
        popDetail = popular[1].children;
        popDetail[0].innerText = Math.round(popTvList[i][4]);
        popDetail[1].innerText = popTvList[i][1];
        console.log(popTvList[i][1]);
        popDetail[1].href = 'Movie.php?blast=' + popTvList[i][0];
        popDetail[2].innerText = popTvList[i][3];
        j++;
    }
    for(var i=0; i<6; i++)                                          //Top
    {
        var popular = populars[j].children;console.log();
        popular[0].src =    topTvList[i][2];
        popDetail = popular[1].children;
        popDetail[0].innerText = Math.round(topTvList[i][4]);
        popDetail[1].innerText = topTvList[i][1];
        popDetail[1].href = 'Movie.php?blast=' + topTvList[i][0];
        popDetail[2].innerText = topTvList[i][3];
        j++;
    }
}
  