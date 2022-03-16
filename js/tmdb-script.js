const BASE_URL = "https://api.themoviedb.org/3/";
const API_KEY = retrieveApiKey();
const IMG_BASE_URL = "https://image.tmdb.org/t/p/w500";

const movie_carousel = document.getElementById("movie-carousel");
const tv_carousel = document.getElementById("tv-carousel");

function retrieveApiKey() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./misc/api-key.json", false);
    xhr.send();
    var apiKeyJson = JSON.parse(xhr.responseText);
    return apiKeyJson["api-key"];
}

function addCardToCarousel(type, id, parent_container, is_first_card) {
    const url = BASE_URL + type + "/" + id + API_KEY;

    fetch(url).then(res => res.json()).then(data => {
        console.log(data);
        createCarouselCard(data, parent_container, is_first_card);
    })
}

function createCarouselCard(data, parent_container, is_frist_card) {
    
    var title = "";
    
    if(!data["title"]) {
        title = data["original_name"];
    }
    else {
        title = data["title"];
    }
    
    const overview = data["overview"];
    const poster_path = data["poster_path"];
    const carousel_item = document.createElement("div");
    carousel_item.classList.add("carousel-item");

    if(is_frist_card) {
        carousel_item.classList.add("active");
    }

    carousel_item.innerHTML = 
        `
        <div class="card">
            <div class="card-header">
            </div>
            <div class="row">
                <div class="card-image col-lg-3 col-md-4">
                    <img src="${IMG_BASE_URL + poster_path}" alt="${title}">
                </div>
                <div class="card-content col-lg-9 col-md-8">
                    <h3>${title}</h3>
                    <p>${overview}</p>
                </div>
            </div>
        </div>
        `
    parent_container.appendChild(carousel_item);
}

var content = [{"type": "movie", "id": 2}, {"type": "movie", "id": 3}, {"type": "movie", "id": 5}, {"type": "movie", "id": 6}, {"type": "movie", "id": 12}, {"type": "movie", "id": 13}];

var content2 = [{"type": "tv", "id": 2}, {"type": "tv", "id": 3}, {"type": "tv", "id": 5}, {"type": "tv", "id": 6}, {"type": "tv", "id": 500}, {"type": "tv", "id": 13}];

addCardToCarousel(content[0]["type"], content[0]["id"], movie_carousel, true);

for(let i=1; i<content.length; i++) {
    addCardToCarousel(content[i]["type"], content[i]["id"], movie_carousel, false);
}

addCardToCarousel(content2[0]["type"], content2[0]["id"], tv_carousel, true);

for(let i=1; i<content2.length; i++) {
    addCardToCarousel(content2[i]["type"], content2[i]["id"], tv_carousel, false);
}

