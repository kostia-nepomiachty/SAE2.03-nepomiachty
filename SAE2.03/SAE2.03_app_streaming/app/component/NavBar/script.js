let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};
      
NavBar.format = function (hAbout, hHome, cProfil, hFavoris, hCategories, profilephoto) {
  let html = template;
  html = html.replaceAll("{{chemin}}", chemin);
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{hHome}}", hHome);
  html = html.replace("{{cProfil}}", cProfil);
  html = html.replace("{{hFavoris}}", hFavoris);
  html = html.replace("{{hCategories}}", hCategories);
  profilephoto = (profilephoto == '') ? 'pransparent.png' : profilephoto;
  html = html.replaceAll("{{profilephoto}}", profilephoto);
  return html;
};

export { NavBar };
