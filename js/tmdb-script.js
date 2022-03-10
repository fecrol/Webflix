const BASE_URL = "https://api.themoviedb.org/3/";
const API_KEY = "?api_key=";

function getContent(type, id) {
    url = BASE_URL + type + "/" + id + API_KEY;

    fetch(url).then(res => res.json()).then(data => {
        console.log(data);
    })
}