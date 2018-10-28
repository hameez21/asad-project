var requestsArray = Array();

window.onload = function()
{
    document.addEventListener("touchmove", changeBGImg);
    document.addEventListener("mouseover", changeBGImg);
    document.addEventListener("click", setGenreActive);
}

function changeBGImg(e)
{
    var backgroundImg = document.getElementById('backgroundImg');
    if(e.target.getAttribute('class') == 'movieImg')
    backgroundImg.style.backgroundImage = "url('" + e.target.parentNode.parentNode.getElementsByClassName('currentBGImg')[0].innerText + "')";
}

function setGenreActive(e)
{
    if(e.target.getAttribute('class') == 'genreLink')
    {
        //For Backend Processing
        window.open('MovieGenre.php?requestedGenre='+e.target.innerText,'_self');
    }
}

function managePageRequest(requestPageNo)
{

    //Cancel All Ajax Requests Except Current
    var noOfPages = document.getElementsByClassName('pageLink');

    for(var i=1; i<=noOfPages.length; i++)
    {
        if(i != requestPageNo)
        {
            if(requestsArray[i])
            requestsArray[i].abort();
        }
    }

    //Cancel Current Images Load
    var movieThumbs = document.getElementsByClassName('movie');
    for(i=0; i<movieThumbs.length; i++)
    {
        var movieThumb = movieThumbs[i].children[0].children[0];
        movieThumb.src = ' ';
    }
}

function loadMovieList(unOrderedMovieList)
{
    if(unOrderedMovieList.length)
    {
    var moviesList = document.getElementsByClassName('moviesList')[0];
    moviesList.innerHTML = ' ';

    var bGS = document.getElementsByClassName('currentBGImg');
    for(i=0; i<bGS.length; i++)
    {
        bGS[i] = ' ';
    }

    for(var i=0; i<unOrderedMovieList.length; i++)
    {
        movieObject = createMovieObject(unOrderedMovieList[i]);
        moviesList.appendChild(movieObject);
    }

    //Set Initial Background Image
    document.getElementById('backgroundImg').style.backgroundImage = "url('" + unOrderedMovieList[0][0].cover + "')";
    }
}

function loadPages(movieCount)
{
    var pages = document.getElementById('pages');
    pages.innerHTML = '';
    Math.ceil( movieCount/=20 );                             //Load 20 Movies per page

    for(var i=0; i<movieCount; i++)        
    {
        //Create One Page Link
        var page = document.createElement('a');      
        var pageTN = document.createTextNode(i+1);
        var pageClass = document.createAttribute('class');
        pageClass.value = 'pageLink';
        page.appendChild(pageTN);
        page.setAttributeNode(pageClass);

        //Define Page Loader
        page.onclick = function()
        {
            var requestPage = new XMLHttpRequest();

            requestsArray[parseInt(this.innerText)] = requestPage;
            managePageRequest(this.innerText);

            requestPage.onreadystatechange = function()
            {
                if(requestPage.readyState == 4 && requestPage.status == 200)
                loadMovieList(JSON.parse(this.responseText));
            }
            var pg = (this.innerText - 1) * 20;
            requestPage.open('GET', 'MovieGenrePHP.php?pg=' + pg , true);
            requestPage.send();

            //Set Page Active (Color)
            var pageLinks = document.getElementsByClassName('pageLink');
            for(var i=0; i<pageLinks.length; i++)
            pageLinks[i].style.color = 'white';
            this.style.color = 'rgb(187, 70, 49)';
        }
        
        //Finalize One Page Link
        pages.appendChild(page);
    }
}

function createMovieObject(movieObject)
{
    //Create Movie Div
    var movie = document.createElement('a');
    var movieClass = document.createAttribute('class');
    movieClass.value = 'movie';
    movie.setAttributeNode(movieClass);

    //Create Thumbnail Image
    var movieThumbImg = document.createElement('img');
    var movieImgSrc = document.createAttribute('src');
    movieImgSrc.value = movieObject[0].thumbnail;
    movieThumbImg.setAttributeNode(movieImgSrc);
    var movieImgAlt = document.createAttribute('alt');
    movieImgAlt.value = movieObject[0].name;
    movieThumbImg.setAttributeNode(movieImgAlt);
    var movieThumbImgClass = document.createAttribute('class');
    movieThumbImgClass.value = 'movieImg';
    movieThumbImg.setAttributeNode(movieThumbImgClass);

    //Assing Thumbnail Image to movieThumb Div
    var movieThumb = document.createElement('div');
    var movieThumbID = document.createAttribute('id');
    movieThumbID.value = 'movieThumb';
    movieThumb.setAttributeNode(movieThumbID);
    movieThumb.appendChild(movieThumbImg);

    //Create Childs Of Movie Info
    //Movie Name
    var movieName = document.createElement('div');
    var movieNameID = document.createAttribute('id');
    movieNameID.value = 'movieName';
    movieName.setAttributeNode(movieNameID);
    var movieNameH1 = document.createElement('h1');
    var movieNameH1TN = document.createTextNode(movieObject[0].name);
    movieNameH1.appendChild(movieNameH1TN);
    movieName.appendChild(movieNameH1);

    //Movie Rating
    var movieRating = document.createElement('div');
    var movieRatingID = document.createAttribute('id');
    movieRatingID.value = 'movieRating';
    movieRating.setAttributeNode(movieRatingID);
    var starPic = document.createElement('div');
    var starPicID = document.createAttribute('id');
    starPicID.value = 'starPic';
    starPic.setAttributeNode(starPicID);
    var starPicP = document.createElement('p');
    var starPicPID = document.createAttribute('id');
    starPicPID.value = 'rating';
    starPicP.setAttributeNode(starPicPID);
    var starPicPTN = document.createTextNode(Math.round(movieObject[0].rating));
    starPicP.appendChild(starPicPTN);
    starPic.appendChild(starPicP);
    movieRating.appendChild(starPic);

    //Movie Genres
    var movieGenres = document.createElement('div');
    var movieGenresID = document.createAttribute('id');
    movieGenresID.value = 'movieGenres';
    movieGenres.setAttributeNode(movieGenresID);
    var genreList = document.createElement('p');
    genreList.appendChild(document.createTextNode('Genres: '));
    var genreListSpan = document.createElement('span');
    var genreListSpanID = document.createAttribute('id');
    genreListSpanID.value = 'genreValues';
    var genreListSpanTN = document.createTextNode(movieObject[1]);
    genreListSpan.appendChild(genreListSpanTN);
    genreListSpan.setAttributeNode(genreListSpanID);
    genreList.appendChild(genreListSpan);
    movieGenres.appendChild(genreList);

    //Movie Release Date
    var releaseDate = document.createElement('div');
    var releaseDateID = document.createAttribute('id');
    releaseDateID.value = 'releaseDate';
    releaseDate.setAttributeNode(releaseDateID);
    var releaseDateP = document.createElement('p');
    releaseDateP.appendChild(document.createTextNode('Released: '));
    var releaseDateSpan = document.createElement('span');
    var releaseDateSpanID = document.createAttribute('id');
    releaseDateSpanID.value = 'releaseDValue';
    releaseDateSpan.setAttributeNode(releaseDateSpanID);
    var releaseDateSpanTN = document.createTextNode(movieObject[0].releaseDate);
    releaseDateSpan.appendChild(releaseDateSpanTN);
    releaseDateP.appendChild(releaseDateSpan);
    releaseDate.appendChild(releaseDateP);

    //Movie Synopsis
    var synopsis = document.createElement('div');
    var synopsisID = document.createAttribute('id');
    synopsisID.value = 'synopsisPara';
    synopsis.setAttributeNode(synopsisID);
    var synopsisP = document.createElement('p');
    var synopsisPTN = document.createTextNode(movieObject[0].synopsis);
    synopsisP.appendChild(synopsisPTN);
    synopsis.appendChild(synopsisP);

    //Finalize Movie Info
    var movieInfo = document.createElement('div');
    var movieInfoID = document.createAttribute('id');
    movieInfoID.value = 'movieInfo';
    movieInfo.setAttributeNode(movieInfoID);
    movieInfo.appendChild(movieName);
    movieInfo.appendChild(movieRating);
    movieInfo.appendChild(movieGenres);
    movieInfo.appendChild(releaseDate);
    movieInfo.appendChild(synopsis);

    //Create Hidden Div For Cover Link
    var coverBG = document.createElement('div');
    var coverBGTN = document.createTextNode(movieObject[0].cover);
    var coverBTClass = document.createAttribute('class');
    coverBTClass.value = 'currentBGImg';
    coverBG.setAttributeNode(coverBTClass);
    coverBG.appendChild(coverBGTN);

    //Assign href To Movie Link
    var movieHREF = document.createAttribute('href');
    movieHREF.value = 'Movie.php?blast='+movieObject[0].id;

    //Assign Target As Blank To Movie
    var movieTarget = document.createAttribute('target');
    movieTarget.value = '_blank';

    //Finalize One Movie Container Div
    movie.appendChild(movieThumb);
    movie.appendChild(movieInfo);
    movie.appendChild(coverBG);
    movie.setAttributeNode(movieHREF);
    movie.setAttributeNode(movieTarget);

    return movie;
}
