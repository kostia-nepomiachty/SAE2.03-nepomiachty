
let templateFile = await fetch("./component/SelecProfil/template.html");
let template = await templateFile.text();

let SelecProfil = {};
let nbColonnes = 3;

/*function openForm() {
  document.getElementById("popupForm").style.display = "block";
}
function closeForm() {
  document.getElementById("popupForm").style.display = "none";
}*/


SelecProfil.format = function (f, categorie) {
  let html = template;
  html = html.replace("{{categorie}}", categorie);
  html = html.replaceAll("{{chemin}}", '');
  for (var i=1; i<=nbColonnes; i++) {
    html = html.replace("{{profile" + i + ".name}}", f[i - 1].name);
    html = html.replace("{{profile" + i + ".photo}}", f[i - 1].photo);
    html = html.replace("{{profile" + i + ".min_age}}", f[i - 1].min_age);
    html = html.replace("{{profile" + i + ".handler}}", f[i - 1].handler);
    html = html.replace("{{profile" + i + ".id}}", f[i - 1].id);
  }
  return html;
};

export { SelecProfil };

