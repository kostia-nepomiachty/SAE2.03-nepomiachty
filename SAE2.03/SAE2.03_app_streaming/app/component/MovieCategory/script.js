
let templateFile = await fetch("./component/MovieCategory/template.html");
let template = await templateFile.text();
let nbColonnes = 12;

let MovieCategory = {};

MovieCategory.format = function (f) {
  let html = template;
  for (var i = 1; i <= nbColonnes; i++) {
    html = html.replace("{{film" + i + ".titre}}", f[i - 1].name);
    html = html.replace("{{film" + i + ".desci}}", f[i - 1].description);
    html = html.replace("{{film" + i + ".ilustra}}", f[i - 1].image);
    html = html.replace("{{film" + i + ".handler}}", f[i - 1].handler);
  }
  return html;
};


MovieCategory.formatMany = function (mouvis, categorie) {
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

    html += MovieCategory.format(f);
  }
  return html;
};

export { MovieCategory };


