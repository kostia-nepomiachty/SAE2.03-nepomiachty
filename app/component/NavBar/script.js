let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (hAbout, hHome, cProfil) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{hHome}}", hHome);
  html = html.replace("{{cProfil}}", cProfil);
  return html;
};

export { NavBar };
