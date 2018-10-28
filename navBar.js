 function dropDown(){
        var dd =  document.getElementsByClassName("dropdownContainer");
        var ddActive=document.getElementById("dropDown");

        items= document.getElementsByClassName("dropdownItem");
        if(dd[0].style.display==""||dd[0].style.display=="none"){
            dd[0].style.display="block";
        for(var i=0; i<items.length;i++){
            items[i].style.display="block";
        }}
        else  if(dd[0].style.display=="block"){
            dd[0].style.display="none";
        for(var i=0; i<items.length;i++){
            items[i].style.display="none";
        }}
        console.log("CHECK");
    }
    function openMenu(){
        var menu = document.getElementsByClassName("sideNav");
        closeSearch();
        menu[0].style.width="250px";
        document.body.style.backgroundColor-"rgba(0,0,0,0.4)";

        var items=document.getElementsByClassName("hamMenuItems");
        for(var i=0; i<items.length;i++){
            items[i].style.display="block";
        }
       
    }
    function openSearch(){
        
        var search=document.getElementById("search");
        var searchbtn=document.getElementsByClassName("searchButton");
        var searchClose=document.getElementsByClassName("searchClose");
        var searchList=document.getElementsByClassName("searchResult");
        var sideNav=document.getElementsByClassName("sideNav");
    
        if(search.style.display=="none"||search.style.display==""){
            search.style.display="block"
            searchbtn[0].style.margin = "40px 0 0 0";
            searchClose[0].style.margin = "40px 0 0 0";
            searchClose[0].style.display="block";
            searchList[0].style.display="block";
            sideNav[0].style.width="0";
            }
    } 
    function closeSearch(){
        var search=document.getElementById("search");
        var searchbtn=document.getElementsByClassName("searchButton");
        var searchClose=document.getElementsByClassName("searchClose");
        var searchList=document.getElementsByClassName("searchResult");
        if(search.style.display=="block"){
            search.style.display="none"
            searchbtn[0].style.margin = "1.2% 0 0 0";
            searchClose[0].style.margin = "0px 0 0 0";
            searchClose[0].style.display="none";
            searchList[0].style.display="none";
            }
    }
    function closeMenu(){
        var menu = document.getElementsByClassName("sideNav");
        menu[0].style.width=0;    
        var items=document.getElementsByClassName("hamMenuItems");
        for(var i=0; i<6;i++){
            items[i].style.display="none";
        }
        document.getElementsByClassName('dropdownContainer')[0].style.display = "none";
    }
    function openLogin(returnto){
        if(window.innerWidth>499){
        var loginDiv= document.getElementsByClassName("loginPage");
        loginDiv[0].style.display="block";
    }
    else{
        window.location="login.php?return="+returnto;
    }
}
    function closeLogin(){
        var loginDiv= document.getElementsByClassName("loginPage");
        loginDiv[0].style.display="none";
    }
    function searchMovie(searchQuery){
        if(searchQuery.length==0){
            document.getElementById("searchList").innerHTML="";
        }
        else{
            var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                document.getElementById("searchList").innerHTML = this.responseText;
            }
            else{
                console.log("error");
            }
        }
        
        xmlhttp.open("GET", "search.php?q="+searchQuery, true);
        
        xmlhttp.send();
        }}
    