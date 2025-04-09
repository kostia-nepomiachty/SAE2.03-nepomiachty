
let templateFile = await fetch("./component/MovieDetail/template.html");
let template = await templateFile.text();

let MovieDetail = {};


MovieDetail.format = function (m) {
    let html = template;
    html = html.replace("{{titre}}", m.name);
    html = html.replace("{{duree}}", m.length);
    html = html.replace("{{lienyt}}", m.trailer);
    html = html.replace("{{nom}}", m.director);
    html = html.replace("{{age}}", m.min_age);
    html = html.replace("{{annee}}", m.year);
    html = html.replace("{{categorie}}", m.category);
    html = html.replace("{{desci}}", m.description);
    html = html.replace("{{ilustra}}", m.image);
    return html;
};

export { MovieDetail };

