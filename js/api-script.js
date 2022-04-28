const API_KEY = retrieveApiKey();
const BASE_URL = "https://api.themoviedb.org/3/";
const IMG_BASE_URL = "https://image.tmdb.org/t/p/w500";

const parentContainer = document.getElementById("content");

function retrieveApiKey() {
    /*
    Retrieves api key from .json file to be used for making calls to the api
    */

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./misc/api-key.json", false);
    xhr.send();
    let apiKeyJson = JSON.parse(xhr.responseText);
    return apiKeyJson["api-key"];
}

function fetchContent(contentType, contentId) {
    /*
    Fetches data from the api to be displayed on webpage.
    */

    const url = BASE_URL + contentType + "/" + contentId + API_KEY;

    fetch(url).then(res => res.json()).then(data => {
        displayContent(data, contentType, contentId);
    })
}

function displayContent(data, contentType, contentId) {
    /*
    Displays the cover image onto the screen
    */

    let title = "";
    
    // In the tmdb api, tv show name is set as original name rather than title.
    if(!data["title"]) {
        title = data["original_name"];
    }
    else {
        title = data["title"];
    }

    const poster_path = data["poster_path"];
    const IMG_URL = IMG_BASE_URL + poster_path;

    const card = document.createElement("div");
    card.classList.add("card");

    card.innerHTML = 
        `
        <a href="./content-preview.php?type=${contentType}&id=${contentId}"><img src="${IMG_URL}" alt="${title}"></a>
        `;
    
    parentContainer.appendChild(card);
}

function fetchSingleContent(contentType, contentId, trailer) {
    /*
    Fetches data from the api to be displayed on webpage.
    */

    const url = BASE_URL + contentType + "/" + contentId + API_KEY;

    fetch(url).then(res => res.json()).then(data => {
        displaySingleContent(data, trailer);
    })
}

function displaySingleContent(data, trailer) {

    let title = "";
    let release_date = "";
    
    // In the tmdb api, tv show name is set as original name rather than title.
    if(!data["title"]) {
        title = data["original_name"];
    }
    else {
        title = data["title"];
    }

    if(!data["release_date"]) {
        release_date = data["first_air_date"];
    }
    else {
        release_date = data["release_date"];
    }

    const card = document.createElement("div");
    card.classList.add("single-content-card");

    card.innerHTML =
        `
        <iframe src='${trailer}'></iframe>
        <h1>${title}</h1>
        <p>${data["overview"]}</p>
        <p>Relase Date: ${release_date}</p>
        `;
    
    parentContainer.appendChild(card);
}