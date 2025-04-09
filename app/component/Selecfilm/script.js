
let templateFile = await fetch("./component/Selecfilm/template.html");
let template = await templateFile.text();

let film = {};

film.format = function (mouvi) {
  let html = template;
  html = html.replace("{{titre}}", mouvi.name);
  html = html.replace("{{desci}}", mouvi.description);
  html = html.replace("{{ilustra}}", mouvi.image); 

  html = html.replace("{{id_movie}}", mouvi.id_movie); 
  
  //l'image <!-- <li> fais apell aux template vue de film -->
  // html = html.replace("{{categorie}}", mouvi.categorie);
  // html = html.replace("{{lienyt}}", mouvi.lienyt);
  // html = html.replace("{{annee}}", mouvi.annee);
  // html = html.replace("{{age}}", mouvi.age);

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

film.formatMany = function (mouvis) {
  let html = "";
  for (const mouvi of mouvis) {
    html += film.format(mouvi);
  }
  return html;
};

export {film};
