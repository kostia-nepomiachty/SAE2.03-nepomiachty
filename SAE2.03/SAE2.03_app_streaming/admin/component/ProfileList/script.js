
let templateFile = await fetch("./component/ProfileList/template.html");
let template = await templateFile.text();

let ProfileList = {};

ProfileList.format = function (data, handler) {
  var r = '';
  for(var i=0; i<data.length; i++) {
    var s = handler;
    s = s.replace('1', data[i].id);
    r += '<div onclick="' + s + '">' + data[i].name + '</div><br/>';
  }
  let html = template;
  html = html.replace("{{profils}}", r);
  return html;
};



export { ProfileList };
