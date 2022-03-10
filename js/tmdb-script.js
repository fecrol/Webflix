const BASE_URL = "https://api.themoviedb.org/3/";
const API_KEY = retrieveApiKey();

function retrieveApiKey() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./misc/api-key.json", false);
    xhr.send();
    var apiKeyJson = JSON.parse(xhr.responseText);
    return apiKeyJson["api-key"];
}

function getContent(type, id) {
    url = BASE_URL + type + "/" + id + API_KEY;

    fetch(url).then(res => res.json()).then(data => {
        console.log(data);
    })
}