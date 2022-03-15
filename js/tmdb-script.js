const BASE_URL = "https://api.themoviedb.org/3/";
const API_KEY = retrieveApiKey();
const IMG_BASE_URL = "https://image.tmdb.org/t/p/w500";

const carousel_inner = document.getElementById("carousel-inner");

function retrieveApiKey() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./misc/api-key.json", false);
    xhr.send();
    var apiKeyJson = JSON.parse(xhr.responseText);
    return apiKeyJson["api-key"];
}

function addCardsToCarousel(type, id, isFirstCard) {
    const url = BASE_URL + type + "/" + id + API_KEY; 

    fetch(url).then(res => res.json()).then(data => {
        const title = data["title"];
        const overview = data["overview"];
        const poster_path = data["poster_path"];
        const carousel_item = document.createElement("div");
        carousel_item.classList.add("carousel-item");

        if(isFirstCard) {
            carousel_item.classList.add("active");
        }

        carousel_item.innerHTML = 
            `
            <div class="card">
                <div class="row">
                    <div class="card-image col-lg-3 col-md-4">
                        <img src="${IMG_BASE_URL + poster_path}" alt="${title}">
                    </div>
                    <div class="card-content col-lg-9 col-md-8">
                        <h1>${title}</h1>
                        <p>${overview}</p>
                    </div>
                </div>
            </div>
            `
        carousel_inner.appendChild(carousel_item);
    })
}

function displayCarousel() {
    var content = [{"type": "movie", "id": 2}, {"type": "movie", "id": 3}, {"type": "movie", "id": 5}, {"type": "movie", "id": 6}, {"type": "movie", "id": 12}, {"type": "movie", "id": 13}];

    addCardsToCarousel(content[0]["type"], content[0]["id"], true);

    for(let i=1; i<content.length; i++) {
            addCardsToCarousel(content[i]["type"], content[i]["id"]);
        }
}
