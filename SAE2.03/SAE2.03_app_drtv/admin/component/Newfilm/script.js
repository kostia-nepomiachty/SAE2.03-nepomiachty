
let templateFile = await fetch("./component/Newfilm/template.html");
let template = await templateFile.text();

let Newfilm = {};

Newfilm.format = function (handler) {
  let html = template;
  html = html.replace("{{handler}}", handler);
  return html;
};

export { Newfilm };
