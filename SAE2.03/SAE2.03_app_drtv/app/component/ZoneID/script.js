let templateFile = await fetch("./component/ZoneID/template.html");
let template = await templateFile.text();

let ZoneID = {};

ZoneID.format = function () {
  let html = template;
  html = html.replaceAll("{{chemin}}", chemin);
  return html;
}

export { ZoneID };
