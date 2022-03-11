const BASE_URL = "https://api.themoviedb.org/3/";
const API_KEY = retrieveApiKey();
const IMG_BASE_URL = "https://image.tmdb.org/t/p/w500";

const cards = document.getElementById("cards");

function retrieveApiKey() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./misc/api-key.json", false);
    xhr.send();
    var apiKeyJson = JSON.parse(xhr.responseText);
    return apiKeyJson["api-key"];
}

function getContent(type, id) {
    const url = BASE_URL + type + "/" + id + API_KEY;

    fetch(url).then(res => res.json()).then(data => {
        console.log(data);
        showContent(data);
    })
}

function showContent(data) {
    cards.innerHTML = "";

    const title = data["title"] 
    const poster_path = data["poster_path"];
    const card = document.createElement("div");
    card.innerHTML = 
        `
        <img src="${IMG_BASE_URL + poster_path}" alt="${title}">
        `
    cards.appendChild(card);
}

getContent("movie", 11);