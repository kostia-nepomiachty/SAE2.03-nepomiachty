
let templateFile = await fetch("./component/MovieCategory/template.html");
let template = await templateFile.text();




// GridFilm.formatMany = function (mouvis) {
//   let html = "";
//   //  for (const mouvi of mouvis) {
//   for (var i = 0; i < mouvis.length; i++) {
//     let f = [];

//     for (var j = 0; j <= nbColonnes - 1; j++) {
//       f[j] = {};
//       f[j].name = "";
//       f[j].description = "";
//       f[j].image = "transparent.png";
//       if (typeof mouvis[i] !== "undefined") {
//         f[j].name = mouvis[i].name;
//         f[j].description =
//           mouvis[i].description.length > 140
//             ? mouvis[i].description.substring(0, 140) + "..."
//             : mouvis[i].description;
//         f[j].image = mouvis[i].image;
//         f[j].handler = "C.MovieDetail(" + mouvis[i].id + ")";
//       }
//       i++;
//     }
//     i--;

//     html += GridFilm.format(f);
//   }
//   return html;
// };






let MovieCategory = {};

MovieCategory.format = function (m) {
  let html = template;
  html = html.replace("{{titre}}", m.name);
  html = html.replace("{{categorie}}", m.category);
  html = html.replace("{{desci}}", m.description);
  html = html.replace("{{ilustra}}", m.image);
  return html;
};

export { MovieCategory };