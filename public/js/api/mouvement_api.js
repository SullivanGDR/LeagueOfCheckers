const API_URL_Mouv = "https://s3-4672.nuage-peda.fr/Damier/public/api/mouvements";
const API_URL_Dep = "https://s3-4672.nuage-peda.fr/Damier/public/api/deplacements";

async function getMouvement(idPartie) {
  try {
    const response = await fetch(`${API_URL_Dep}?parties=${idPartie}`);
    if (!response.ok) {
      throw new Error('Erreur : ' + response.statusText);
    }
    const data = await response.json();
    const deplacements = data['hydra:member']; // Accédez à la propriété hydra:member
    const mouvements = deplacements.map(deplacement => deplacement.mouvement);//recupere tout les mouvement efectuer dans la partie (depart arrivé)
    //console.log(mouvements[0])
    //console.log(mouvements[0].arriveX)
    //pour faire l'affichage faire un foreach
    return mouvements;
  } catch (error) {
    console.error('Erreur lors de la réception : ', error);
    throw error;
  }
}
async function createMouvement(emplacementX,emplacementY,idJoueur,typeMouv){
  try{
      const data = {
        "emplacementX": emplacementX,
        "emplacementY": emplacementY,
        "typeMouv": String(typeMouv),
        "joueur": `/Damier/public/api/joueurs/${idJoueur}`
      };

      //création des options de la requête
      const options = {
          method: 'POST', // Méthode HTTP
          body: JSON.stringify(data),
          headers: {
              'Content-Type': 'application/ld+json',
              'Accept': 'application/ld+json',
          },
      };

      const response = await fetch(`${API_URL_Mouv}`,options);
      if(!response.ok){
          throw new Error('Erreur :'+ response.statusText);
          //on va nous afficher l'erreur qu'on nous a retourner
      }
      const r = await response.json();
      //console.log(r.id);
      return r.id;
  }
  catch(erreur){
      console.error('Erreur lors de lauthentification: ',erreur);
      throw erreur;
      //throw erreur -> on va franchir l'erreur sans que le reste sois perturber
  }
}

async function patchArriveMouvement(idMouvement,arriveX,arriveY){
  try{
      const data = {
        "arriveX": arriveX,
        "arriveY": arriveY,
      };

      //création des options de la requête
      const options = {
          method: 'PATCH', // Méthode HTTP
          body: JSON.stringify(data),
          headers: {
              'Content-Type': 'application/merge-patch+json',
              'Accept': 'application/ld+json',
          },
      };

      const response = await fetch(`${API_URL_Mouv}/${idMouvement}`,options);
      if(!response.ok){
          throw new Error('Erreur :'+ response.statusText);
          //on va nous afficher l'erreur qu'on nous a retourner
      }
      const r = await response.json();
      console.log(r);
      return r;
  }
  catch(erreur){
      console.error('Erreur lors de lauthentification: ',erreur);
      throw erreur;
      //throw erreur -> on va franchir l'erreur sans que le reste sois perturber
  }
}



export { getMouvement,createMouvement,patchArriveMouvement }