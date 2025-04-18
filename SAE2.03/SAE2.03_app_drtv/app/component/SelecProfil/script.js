
let templateFile = await fetch("./component/SelecProfil/template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./component/SelecProfil/template_profil.html");
let template_profil = await templateFile2.text();

let SelecProfil = {};


SelecProfil.formatProfil = function (p) {
  let html = template_profil;
  html = html.replace("{{profil.name}}", p.name);
  html = html.replace("{{profil.photo}}", p.photo);
  html = html.replace("{{profil.min_age}}", p.min_age);
  html = html.replace("{{handler}}", 'window.V.renderSelecProfilHide({{profil.id}})');
  html = html.replace("{{profil.id}}", p.id);
  html = html.replace("{{profil.handler}}", p.handler);
  html = html.replace("{{chemin}}", chemin);
  return html;
}


SelecProfil.format = function (f, categorie) {
  let html = '';
  for (var i=0; i<f.length; i++) {
    let p     = {};
    p.name    = f[i].name;
    p.photo   = f[i].photo;
    p.min_age = f[i].min_age;
    p.id      = f[i].id;
    p.handler = f[i].handler;
    html += SelecProfil.formatProfil(p);
  }

  let html_profils = template;
  html_profils = html_profils.replace("{{categorie}}", categorie);
  html_profils = html_profils.replaceAll("{{chemin}}", chemin);
  html_profils = html_profils.replaceAll("{{illustra1}}", 'your_name.jpg');
  html_profils = html_profils.replaceAll("{{illustra2}}", 'Dream_BBQ.png');
  html_profils = html_profils.replaceAll("{{profiles}}", html);

  return html_profils;
};

export { SelecProfil };

