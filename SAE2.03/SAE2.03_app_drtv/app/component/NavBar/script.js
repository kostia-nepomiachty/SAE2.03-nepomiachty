let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};
      
NavBar.format = function (hAbout, hHome, cProfil, hFavoris, hCategorie, profilephoto) {
  let html = template;
  html = html.replaceAll("{{chemin}}", chemin);
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{hHome}}", hHome);
  html = html.replace("{{cProfil}}", cProfil);
  html = html.replace("{{hFavoris}}", hFavoris);
  html = html.replace("{{hCategorie}}", hCategorie);
  profilephoto = (profilephoto == '') ? 'pransparent.png' : profilephoto;
  html = html.replaceAll("{{profilephoto}}", profilephoto);
  return html;
};

export { NavBar };
