
let templateFile = await fetch("./component/MovieDetail/template.html");
let template = await templateFile.text();

let MovieDetail = {};


MovieDetail.format = function (m, is_favorite, handleraddFavorite, handlerdeleteFavorite, hbtn_fermer) {
    let html = template;
    html = html.replaceAll("{{chemin}}", chemin);
    html = html.replace("{{titre}}", m.name);
    html = html.replace("{{duree}}", m.length);
    html = html.replace("{{lienyt}}", m.trailer);
    html = html.replace("{{nom}}", m.director);
    html = html.replace("{{age}}", m.min_age);
    html = html.replace("{{annee}}", m.year);
    html = html.replace("{{categorie}}", m.category);
    html = html.replace("{{desci}}", m.description);
    html = html.replace("{{ilustra}}", m.image);
    html = html.replace("{{hbtn_fermer}}", hbtn_fermer);
    let btn = (is_favorite == 0) ? btn_fav_off : btn_fav_on;
    let handlerFav = (is_favorite == 0) ? handleraddFavorite : handlerdeleteFavorite;
    handlerFav = handlerFav.replace('1', window.profile + ',' + m.id);
    html = html.replace("{{btn_fav}}", btn);
    html = html.replace("{{handlerFav}}", handlerFav);
    
    return html;
};

export { MovieDetail };

