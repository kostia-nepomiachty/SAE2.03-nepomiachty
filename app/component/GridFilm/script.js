
let templateFile = await fetch("./component/GridFilm/template.html");
let template = await templateFile.text();
let nbColonnes = 12;

let GridFilm = {};

GridFilm.format = function (f, categorie) {
  let html = template;
  html = html.replace("{{categorie}}", categorie);
  html = html.replaceAll("{{chemin}}", chemin);
  for (var i=1; i<=nbColonnes; i++) {
    html = html.replace("{{film" + i + ".titre}}", f[i - 1].name);
    html = html.replace("{{film" + i + ".desci}}", f[i - 1].description);
    html = html.replace("{{film" + i + ".ilustra}}", f[i - 1].image);
    html = html.replace("{{film" + i + ".handler}}", f[i - 1].handler);
  }
  return html;
};

/*
[
  {
    "id":7,
    "name":"Interstellar",
    "description":"Un groupe d'explorateurs...",
    "image":"interstellar.jpg"
  }
]
*/

GridFilm.formatMany = function (mouvis, categorie) {
  let html = "";
  //  for (const mouvi of mouvis) {
  for (var i = 0; i < mouvis.length; i++) {
    let f = [];
    for (var j = 0; j <= nbColonnes - 1; j++) {
      f[j] = {};
      f[j].name = "";
      f[j].description = "";
      f[j].image = "transparent.png";
      if (typeof mouvis[i] !== "undefined") {
        f[j].name = mouvis[i].name;
        f[j].description = (mouvis[i].description.length > 140) ? mouvis[i].description.substring(0, 140) + "..." : mouvis[i].description;
        f[j].image = mouvis[i].image;
        f[j].handler = "C.MovieDetail(" + mouvis[i].id + ")";
      }
      i++;
    }
    i--;

    //mettre en scène

    html += GridFilm.format(f, categorie);
  }
  return html;
};

export {GridFilm};


