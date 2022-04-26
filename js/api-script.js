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
        <a href="./content-preview.php?type='${contentType}'?id='${contentId}'"><img src="${IMG_URL}" alt="${title}"></a>
        `;
    
    parentContainer.appendChild(card);
}