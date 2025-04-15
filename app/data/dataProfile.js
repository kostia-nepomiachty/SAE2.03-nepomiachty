
//DataProfile.read
//https://mmi.unilim.fr/.../script.php?todo=readProfiles

// let HOST_URL = "";
// if (chemin != "")
//   HOST_URL = "https://mmi.unilim.fr/~nepomiachty1/SAE2.03-nepomiachty/";
// else HOST_URL = "http://sae2.03.localhost/";

let DataProfile = {};


DataProfile.getProfiles = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readProfiles");
  let data = await answer.json();
  return data;
};

export { DataProfile };