
//regroupera toutes les requêtes HTTP adressées au serveur 

// pour les profiles DataProfile.add

// prod = document.location.href.search("~nepomiachty1") > -1;
// let HOST_URL = "";
// if (prod)
//   HOST_URL = "https://mmi.unilim.fr/~nepomiachty1/SAE2.03-nepomiachty/";
// else HOST_URL = "http://sae2.03.localhost/";


let DataProfile = {};

DataProfile.add = async function (fdata) {
  // fetch possède un deuxième paramètre (optionnel) qui est un objet de configuration de la requête HTTP:
  //  - method : la méthode HTTP à utiliser (GET, POST...)
  //  - body : les données à envoyer au serveur (sous forme d'objet FormData ou bien d'une chaîne de caractères, par exempe JSON)
  let config = {
    method: "POST", // méthode HTTP à utiliser
    body: fdata, // données à envoyer sous forme d'objet FormData
  };
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=addProfile",
    config
  );
  let data = await answer.json();
  //window.alert("Film créé. Id="+data.id);
  V.renderLog("Profil créé. Id=" + data.id);
  return data;
};

DataProfile.update = async function (fdata) {
  // fetch possède un deuxième paramètre (optionnel) qui est un objet de configuration de la requête HTTP:
  //  - method : la méthode HTTP à utiliser (GET, POST...)
  //  - body : les données à envoyer au serveur (sous forme d'objet FormData ou bien d'une chaîne de caractères, par exempe JSON)
  let o = {}
  o.id = fdata.get('id');
  o.name = fdata.get('name');
  o.photo = fdata.get('photo');
  o.min_age = fdata.get('min_age');
 
  let config = {
    method: "PUT", // méthode HTTP à utiliser
    body: JSON.stringify(o), // données à envoyer sous forme d'objet FormData
  };
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=updateProfile",
    config
  );
  let data = await answer.json();
  //window.alert("Film créé. Id="+data.id);
  V.renderLog("Profil créé. Id=" + data.id);
  return data;
};


DataProfile.getProfiles = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readProfiles");
  let data = await answer.json();
  return data;
};

DataProfile.getProfile = async function (id) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readProfile&id=" + id);
  let data = await answer.json();
  return data;
};



export { DataProfile };
