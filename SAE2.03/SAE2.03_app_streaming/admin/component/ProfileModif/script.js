
let templateFile = await fetch("./component/ProfileModif/template.html");
let template = await templateFile.text();

let ProfileModif = {};

ProfileModif.format = function (handler, d) {
  let html = template;
  //console.log('ProfileModif.format');
  //console.log(d);
  html = html.replace("{{handler}}", handler);
  html = html.replace("{{id}}", d['id']);
  html = html.replace("{{name}}", d['name']);
  html = html.replace("{{min_age}}", d['min_age']);
  html = html.replace("{{photo}}", d['photo']);
  return html;
};

export { ProfileModif };
