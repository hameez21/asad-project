window.addEventListener("scroll", backgroundMover, true);
document.addEventListener('click', updateUserRating);
document.addEventListener('touchstart', updateUserRating);

//Movie ID to be used in further requests
var movieID;

window.onload = function()
{
    if(canRate!="1")
    {
    addNameFieldComment();
    document.getElementById('loginToRate').style.display = 'block';
    }
}

function backgroundMover()
{
    if(document.getElementById('synopsis').getBoundingClientRect().top <= window.innerHeight-window.innerHeight/2)       //checking top of synopsis if it goes up BGImg's opacity is lowered
    {
        document.getElementById('backgroundImg').style.filter = "brightness(.1)";
        document.getElementById("backgroundImg").style.WebkitFilter = "brightness(.1)";

    }
    else
    {
        document.getElementById('backgroundImg').style.filter = "brightness(.5)";
        document.getElementById("backgroundImg").style.WebkitFilter = "brightness(.5)";
    }
}

/*function alterEpGuide()
{
    var episodeGuide = document.getElementById('episodeGuide');
    if(episodeGuide.style.display == "none")
    episodeGuide.style.display = "block"
    else
    episodeGuide.style.display = "none";
}*/

function addNameFieldComment()  //Dynamically Add Name Field For Guests
{
    var usersComment = document.getElementById('usersComment');
    var nameField = document.createElement('input');
    var nameFieldPlaceHolder = document.createAttribute('placeholder');
    nameFieldPlaceHolder.value = 'Your Name';
    var nameFieldID = document.createAttribute('id');
    nameFieldID.value = 'nameField';
    nameField.setAttributeNode(nameFieldPlaceHolder);
    nameField.setAttributeNode(nameFieldID);
    usersComment.insertAdjacentElement('beforebegin',nameField);
}

function updateUserRating(e)
{
    if(canRate=="1")
    {
    //Frontend Stuff
    if(e.target.getAttribute('class')=='rateStar')
    {
        var stars = e.target.parentNode.getElementsByClassName('rateStar');                                             //can also use document
        var number =  e.target.getAttribute('id').substring(1,2);
        for(var i=0; i<=9; i++)
        stars[i].style.color = "white";
        for(var i=0; i<=number; i++)
        stars[i].style.color = "yellow";

        //Backend Update Rating
        var requestRate = new XMLHttpRequest();
        var numberPlus1 = ++number;
        requestRate.open('GET', 'userRating.php?userRateNumber='+numberPlus1, true);
        requestRate.send();
    }
    }
}

function addUserComment()
{
    var currentUserComment = document.getElementsByTagName('textarea')[0].value.trim();      //Removie Special Chars From Comment
    var commentStatus = document.getElementsByClassName("commentStatus")[0];

    if(currentUserComment.length)
    {
        var requestComment = new XMLHttpRequest();
        requestComment.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200) 
            {
                if(this.responseText == "0")
                {
                commentStatus.innerHTML = 'There was a problem while submitting your comment.';
                commentStatus.style.color = 'rgb(177, 10, 10)';
                }
                else
                {
                    loadComments(JSON.parse(this.responseText));
                }
            }
        }
        if(canRate=="0")                                                                              //Do Only If not User
        {
            var guestName = document.getElementById('nameField').value.trim();                       //Removie Special Chars From Guest Name
            if(guestName.length)
            {
                requestComment.open('GET', 'userComment.php?userComment='+currentUserComment+"&guestName="+guestName,true);
            }
            else
            {
                commentStatus.innerHTML = 'Please enter your name.';
                commentStatus.style.color = 'rgb(177, 10, 10)';
                commentStatus.style.display = 'block';
                return;
            }
        }
        else
        requestComment.open('GET', 'userComment.php?userComment='+currentUserComment, true);
        requestComment.send();
    }
    else
    {
        commentStatus.innerHTML = 'Please enter a comment.';
        commentStatus.style.color = 'rgb(177, 10, 10)';
    }
    commentStatus.style.display = 'block';
}

function loadTvSeriesSeasons(NumberOfSeasons, firstEpisodeList)
{

    //Changes To FrontEnd Page Movie.php
    document.getElementById('movieInfoH1').innerText = 'Tv Series Info';
    document.getElementById('epGLink').style.display = 'inline';
    document.querySelector("a[href='#PGs']").innerText = 'Similar TV Shows';
    document.getElementById('PGs').getElementsByTagName('h1')[0].innerText = 'Similar TV Shows';
    document.getElementById('movieLength').parentNode.removeChild(document.getElementById('movieLength'));

    //Show Episode Guide Area
    document.getElementById('episodeGuide').style.display = "block";

    var seasonLinks = document.getElementsByClassName('seasonLinks')[0];
    
    //Assign Seasons
    for(var i=0; i<NumberOfSeasons; i++)
    {
        var linkToSeason = document.createElement('a');
        var linkToSeasonTN = document.createTextNode(i+1);
        var linkToSeasonClass = document.createAttribute('class');
        linkToSeason.appendChild(linkToSeasonTN);

        //Assign Season Loader To Each Season Link
        linkToSeason.onclick = function()
        {
        var requestEpisodes = new XMLHttpRequest();
        requestEpisodes.onreadystatechange = function()
        {
            if(requestEpisodes.readyState == 4 && requestEpisodes.status == 200)
            loadSeasonEpisodes(JSON.parse(this.responseText));
        }
        requestEpisodes.open('GET', 'seasonEpisodes.php?seasonNumber=' + this.innerText , true);
        requestEpisodes.send();

        //Change Color Of Active Season
        var allSeasonLinks = this.parentNode.children;
        for(var i=0; i<allSeasonLinks.length ;i++)
        allSeasonLinks[i].style.color = 'white';
        this.style.color = 'rgb(187, 70, 49)';
        }

        //Set Color of First Active Season
        if(i==0)
        linkToSeason.style.color = 'rgb(187, 70, 49)';
        
        //Finalize Season Link
        seasonLinks.appendChild(linkToSeason);
    }

    loadSeasonEpisodes(firstEpisodeList);
}

function loadSeasonEpisodes(episodeList)
{
    var episodes = document.getElementById('episodes');
    episodes.innerHTML = '';

    for(var i=0; i<episodeList.length; i++)
    {
        //Create One Episode Div
        var episode = document.createElement('div');
        var episodeClass = document.createAttribute('class');
        episodeClass.value = 'episode';
        episode.setAttributeNode(episodeClass);

        //Create Episode Thumbnail
        var episodeThumb = document.createElement('img');
        var episodeThumbSrc = document.createAttribute('src');
        var episodeThumbAlt = document.createAttribute('alt');
        episodeThumbSrc.value = episodeList[i][1];
        episodeThumbAlt.value = episodeList[i][0];
        episodeThumb.setAttributeNode(episodeThumbSrc);
        episodeThumb.setAttributeNode(episodeThumbAlt);

        //Create Episode Info Div
        var epInfo = document.createElement('div');
        var epInfoID = document.createAttribute('id');
        epInfoID.value = 'epInfo';
        epInfo.setAttributeNode(epInfoID);

        //Create Episode Info Childs
        var epName = document.createElement('p');
        var epNameID = document.createAttribute('id');
        epNameID.value = 'epName';
        epName.setAttributeNode(epNameID);
        epName.innerText = episodeList[i][0];

        var epNumber = document.createElement('p');
        var epNumberID = document.createAttribute('id');
        epNumberID.value = 'epNumber';
        epNumber.setAttributeNode(epNumberID);
        epNumber.innerText = 'Episode # ' + (i+1);

        //Assign To Episode Info
        epInfo.appendChild(epName);

        //Finalize One Episode Div
        episode.appendChild(episodeThumb);
        episode.appendChild(epInfo);
        episode.appendChild(epNumber);

        //Add To Episode List
        episodes.appendChild(episode);
    }
}


function loadMovieInfo(movieObject,actors,producers,directors,genres,trailers,comments,similarMovies,userRating)
{
    //Assign the Title Of The Page
    document.getElementsByTagName('title')[0].innerText = movieObject.name + ' - MCDB';

    //Assign movieID variable
    movieID = movieObject.id;

    //Assign Background Image
    document.getElementById('backgroundImg').style.backgroundImage = "url('" + movieObject.cover + "')";

    //Assign Thumbnail
    document.getElementById('thumbImg').src = movieObject.thumbnail;

    //Assign General Information
    document.getElementById('movieName').innerText = movieObject.name;
    document.getElementById('rating').innerText = Math.round(movieObject.rating);
    document.getElementById('movieActors').children[0].innerText = actors;
    document.getElementById('movieDirectors').children[0].innerText = directors;
    document.getElementById('movieProducers').children[0].innerText = producers;

    //Assign Movie Information
    document.getElementById('releaseDate').children[0].innerText = movieObject.releaseDate;
    document.getElementById('movieLength').children[0].innerText = movieObject.length;
    document.getElementById('movieGenres').children[0].innerText = genres;
    document.getElementById('movieInfoRating').children[0].innerText = Math.round(movieObject.rating);

    //Assign Synopsis
    document.getElementById('synopsis').getElementsByTagName('p')[0].innerText = movieObject.synopsis;

    //Assign All Trailers
    var trailers = trailers.split(",");
    var trailerId = document.getElementById('trailers');
    for(var i=0; i < trailers.length - 1; i++)
    {
        var trailerIframe = document.createElement('iframe');
        var iframeSrc = document.createAttribute('src');
        var allowFS = document.createAttribute('allowfullscreen');
        iframeSrc.value = trailers[i];
        trailerIframe.setAttributeNode(iframeSrc);
        trailerIframe.setAttributeNode(allowFS);
        trailerId.appendChild(trailerIframe);
    }

    //Load Similar Movies
    loadSimilarMovies(similarMovies);
    
    //Assign All Comments
    loadComments(comments);

    //Assign User Rating If Online
    if(userRating != null)
    {
        userRating -= 1;
        var stars = document.getElementsByClassName('rateStar');                     
        for(var i=0; i<=userRating; i++)
        stars[i].style.color = "yellow";
        console.log("CHLK");
    } 
}

function loadComments(comments)
{
    var allComments = document.getElementById('allComments');

    for(var i=0; i<comments.length; i++)
    {
        var savedComment = document.createElement('div');
        var savedCommentClass = document.createAttribute('class');
        savedCommentClass.value = "savedComment";
        savedComment.setAttributeNode(savedCommentClass);

        var commentUserName = document.createElement('p');
        var commentOfUser = document.createElement('p');
        var commentUserNameID = document.createAttribute('id');
        var commentOfUserID = document.createAttribute('id');
        var commentUserNameTN = document.createTextNode(comments[i][0]);
        var commentofUserTN = document.createTextNode(comments[i][1]);

        commentUserName.appendChild(commentUserNameTN);
        commentOfUser.appendChild(commentofUserTN);

        commentUserNameID.value = "userName";
        commentOfUserID.value = "userComment";

        commentUserName.setAttributeNode(commentUserNameID);
        commentOfUser.setAttributeNode(commentOfUserID);

        savedComment.appendChild(commentUserName);
        savedComment.appendChild(commentOfUser);
        savedComment.appendChild(document.createElement('hr'));

        allComments.appendChild(savedComment);
    }
    
    if(comments.length == 1)        //If Comment Inserted 
    {
        allComments.removeChild(allComments.lastChild);
        allComments.insertBefore(savedComment,allComments.firstChild);
    }
}

function loadSimilarMovies(similarList)
{
    var similarFlex = document.getElementsByClassName('similarFlex')[0];

    for(var i=0; i<similarList.length; i++)
    {
    var similarMovie = document.createElement('a');
    var similarMovieClass = document.createAttribute('class');
    similarMovieClass.value = 'similarLink';
    var similarMovieHREF = document.createAttribute('href');
    similarMovieHREF.value = 'Movie.php?blast=' + similarList[i][0];
    similarMovie.setAttributeNode(similarMovieClass);
    similarMovie.setAttributeNode(similarMovieHREF);

    var similarMovieImage = document.createElement('img');
    var similarMovieImageSrc = document.createAttribute('src');
    similarMovieImageSrc.value = similarList[i][2];
    var similarMovieImageAlt = document.createAttribute('alt');
    similarMovieImageAlt.value = similarList[i][1];
    similarMovieImage.setAttributeNode(similarMovieImageAlt);
    similarMovieImage.setAttributeNode(similarMovieImageSrc);

    var similarMovieName = document.createElement('div');
    var similarMovieNameClass = document.createAttribute('class');
    similarMovieNameClass.value = 'similarName';
    var similarMovieNameTN = document.createTextNode(similarList[i][1]);
    similarMovieName.setAttributeNode(similarMovieNameClass);
    similarMovieName.appendChild(similarMovieNameTN);

    similarMovie.appendChild(similarMovieImage);
    similarMovie.appendChild(similarMovieName);

    similarFlex.appendChild(similarMovie);
    }
}
