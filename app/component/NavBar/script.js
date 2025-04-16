let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (hAbout, hHome, cProfil, hFavoris) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{hHome}}", hHome);
  html = html.replace("{{cProfil}}", cProfil);
  html = html.replace("{{hFavoris}}", hFavoris);
  return html;
};

export { NavBar };
