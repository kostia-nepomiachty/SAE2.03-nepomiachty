
let templateFile = await fetch("./component/Selecfilm/template.html");
let template = await templateFile.text();

let film = {};

film.format = function (mouvi) {
  let html = template;
  html = html.replace("{{titre}}", mouvi.name);
  html = html.replace("{{desci}}", mouvi.description);
  html = html.replace("{{ilustra}}", mouvi.image); 
  html = html.replace("{{id_movie}}", mouvi.id_movie); 
  
  return html;
};

film.formatMany = function (mouvis) {
  let html = "";
  for (const mouvi of mouvis) {
    html += film.format(mouvi);
  }
  return html;
};

export {film};
