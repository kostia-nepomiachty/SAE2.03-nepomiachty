
let templateFile = await fetch("./component/GridFilm/template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./component/GridFilm/template_film.html");
let template_film = await templateFile2.text();


let nbColonnes = 12;

let GridFilm = {};

GridFilm.format = function (f, categorie) {
  let html = template_film;
  html = html.replace("{{categorie}}", categorie);
  html = html.replaceAll("{{chemin}}", chemin);
  html = html.replace("{{film.titre}}", f.name);
  html = html.replace("{{film.desci}}", f.description);
  html = html.replace("{{film.ilustra}}", f.image);
  html = html.replace("{{film.handler}}", f.handler);
  html = html.replace("{{numero}}", f.numero);
  return html;
};

GridFilm.formatMany = function (mouvis, categorie) {
  let html = "";
  //  for (const mouvi of mouvis) {
  let numero = 0;
  for (var i = 0; i < mouvis.length; i++) {
    let f = {};
    numero++;
    f.numero = numero;
    f.name = "";
    f.description = "";
    f.image = "transparent.png";
    if (typeof mouvis[i] !== "undefined") {
      f.name = mouvis[i].name;
      f.description = (mouvis[i].description.length > 140) ? mouvis[i].description.substring(0, 140) + "..." : mouvis[i].description;
      f.image = mouvis[i].image;
      f.handler = "C.MovieDetail(" + mouvis[i].id + ")";
    }

    //mettre en scène

    html += GridFilm.format(f, categorie);
  }

  let html_films = template;
  html_films = html_films.replace("{{categorie}}", categorie);
  html_films = html_films.replace("{{films}}", html);

  return html_films;
};

export {GridFilm};


