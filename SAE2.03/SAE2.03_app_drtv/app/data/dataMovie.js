

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

Datafilms.getFilmsFiltresCategorie = async function (categorie, min_age, profile, favorite = false) {
  var param = (min_age == "") ? "" : "&min_age=" + min_age;
  if (favorite) {
    param += (param == '') ? '' : '&';
    param += 'favorite=1';
  }
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readmovie&categorie="+categorie+'profile='+profile+param);
  //console.log("getFilmsFiltresCategorie GET "+HOST_URL + "/server/script.php?todo=readmovie&categorie="+categorie+param);
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

Datafilms.readFavorite = async function (id_profile, id_movie) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readFavorite&id_profile="+id_profile+'&id_movie='+id_movie);
  let data = await answer.json();
  return data;
};

Datafilms.addFavorite = async function (id_profile, id_movie) {
  const formData = new URLSearchParams();
  formData.append('id_profile', id_profile);
  formData.append('id_movie', id_movie);

  let config = {
    method: "POST", // méthode HTTP à utiliser
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: formData.toString(), // données à envoyer sous forme d'objet FormData
  };
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=addFavorite",
    config
  );
  let data = await answer.json();
  return data;
};

Datafilms.deleteFavorite = async function (id_profile, id_movie) {
  let o = {}
  o.id_profile = id_profile;
  o.id_movie = id_movie;

  let config = {
    method: "DELETE", // méthode HTTP à utiliser
    body: JSON.stringify(o), // données à envoyer sous forme d'objet FormData
  };
  let answer = await fetch(
    HOST_URL + "/server/script.php?todo=deleteFavorite",
    config
  );
  let data = await answer.json();
  return data;
};

export { Datafilms };
