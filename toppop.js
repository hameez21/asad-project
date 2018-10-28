function asetWidth(){
    var movieDetail=document.getElementsByClassName("movieDetail");
    console.log(window.innerWidth);

    if(window.innerWidth<900 && movieDetail[0].style.width!="100%"){
        for(var i=0 ; i<movieDetail.length;i++)
        movieDetail[i].style.width="100%";
        console.log("changed");
    }
    else if (window.innerWidth>900 && movieDetail[0].style.width=="100%" )
    for(var i=0 ; i<movieDetail.length;i++)
        movieDetail[i].style.width="48%";
}
var movID= new Array();
function setMovieDetail(movieList){
    var movieDetail=document.getElementsByClassName("movieDetail");
    var movieImage = document.getElementsByClassName("movImage1");
    console.log(movieImage.length);    
    var rate = document.getElementsByClassName("rate");
    var name = document.getElementsByClassName("name");
    var release = document.getElementsByClassName("release");
    var rate1 = document.getElementsByClassName("rate1");
    var name1 = document.getElementsByClassName("name1");
    var release1 = document.getElementsByClassName("release1");
    var synopsis= document.getElementsByClassName("synopsis");
    for(var i=0; i<20;i++){
        console.log(movieList[0].length);
        if(i>=movieList[0].length){
            movieDetail[i].style.display='none';
    }
    else{
        movieImage[i].src=movieList[i].thumbnail;
        name[i].textContent=movieList[i].name;
        
        rate[i].textContent=Math.round(movieList[i].rating);
        
        release[i].textContent=movieList[i].releaseDate;
        synopsis[i].textContent=movieList[i].synopsis;
        movID[i]=movieList[i].id;
        name1[i].textContent=movieList[i].name;
        
        rate1[i].textContent=Math.round(movieList[i].rating);
        
        release1[i].textContent=movieList[i].releaseDate;
          
    }
    
    }
}
window.onload = function() {
    var anchors = document.getElementsByClassName("movieDetail");
    for(var i = 0; i < anchors.length; i++) {
        var anchor = anchors[i];
        anchor.setAttribute("id",i);
        anchor.onclick = function() {
            window.location="movie.php?blast="+movID[this.getAttribute("id")];
        }
    }
    this.document.getElementsByTagName('title')[0].innerText = document.getElementById('title').innerText + ' - MCDB';
}
function pageReturn(page,pageNo,type,media){
    var pag = page/20;
    var div=document.getElementById("pageNo");
    for(var i=0;i<pag;i++){
    var anchor=document.createElement("a");
    anchor.setAttribute("class","pageNumber");
    if(i==pageNo){
        anchor.setAttribute("id","pageActive");
    }
    anchor.href="toppop.php?page="+i+"&"+"type="+type+"&"+"media="+media;
    anchor.textContent=i+1;
    div.appendChild(anchor);
    console.log("anchor");

    }
}
