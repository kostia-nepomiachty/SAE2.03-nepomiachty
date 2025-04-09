//let env = 'prod';
//let env = 'local';
//let HOST_URL = '';

//if (env == 'prod') {
//    HOST_URL = "https://mmi.unilim.fr/~nepomiachty1/SAE2.03_app_streming/";
//}
//else {
    let HOST_URL = "https://mmi.unilim.fr/~nepomiachty1/SAE2.03-nepomiachty/";
//}

let Datafilms = {};

//...
Datafilms.request = async function () {
  // fetch permet d'envoyer une requête HTTP à l'URL spécifiée.
  // L'URL est construite en concaténant HOST_URL à "/server/script.php?direction=" et la valeur de la variable dir.
  // L'URL finale dépend de la valeur de HOST_URL et de dir.
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=readmovie"
  );
  // answer est la réponse du serveur à la requête fetch.
  // On utilise ensuite la méthode json() pour extraire de cette réponse les données au format JSON.
  // Ces données (data) sont automatiquement converties en objet JavaScript.
  let data = await answer.json();
  // Enfin, on retourne ces données.
  return data;
};

Datafilms.getFilmsFiltresCategorie = async function (categorie) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readmovie&categorie="+categorie);
  let data = await answer.json();
  return data;
};

Datafilms.MovieDetail = async function (id) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readMovieDetail&id="+id);
  let data = await answer.json();
  return data;
};

Datafilms.getListCategories = async function () {
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=listCategories"
  );
  let data = await answer.json();
  return data;
};


export { Datafilms };