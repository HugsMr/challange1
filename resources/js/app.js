require('./bootstrap');

document.addEventListener("DOMContentLoaded", function (e) {
    if(window.location.pathname.includes("newest")){
        let filters = document.querySelectorAll(".filters li a");
        console.log(filters[0].getAttribute("href"));
        let new_href = filters[0].getAttribute("href").replace("newest","");
        filters[0].setAttribute("href",new_href);
        filters[0].parentElement.classList.add("active");
    }
});