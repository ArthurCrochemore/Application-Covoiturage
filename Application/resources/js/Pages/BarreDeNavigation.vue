<!-- Barre en bas de l'interface de l'application qui permet la navigation dans celle-ci -->
<script setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'

  const idSelectione = ref('recherche')

  /**
   * Permet d'indiquer la partie de l'application actuellement visionnée sur la barre
   *
   * @param id , id de l'élement à mettre en avant
   */
  function updateSelection(id) {
    idSelectione.value = id
  }

  const router = useRouter() // Récupération du router vue-router pour la navigation

  /**
   * Permet le chargement de l'inteface lié à ce qui a été cliqué sur la barre
   *
   * @param lien , id de l'élement cliqué
   * @param id , lien vers l'interface
   */
  const ouvrir = (lien, id) =>{
    updateSelection(id);
    router.push({
        path: lien
    });
  }

  /**
   * Permet le chargement de recherche, prend en charge ses props
   *
   * @param lien , id de l'élement cliqué
   * @param id , lien vers l'interface
   */
  const ouvrirRecherche = (lien, id) =>{
    updateSelection(id);
    router.push({
    path: lien,
    query: {
      ptDepart: "",
      ptArrive : ""
    }
  });
}

  const ouvrirCreation = (lien, id) => {
    updateSelection(id);

    // Récupération de la date et de l'heure actuelle
    const maintenant = new Date()
    const anneeActuelle = maintenant.getFullYear()
    const moisActuel = maintenant.getMonth() + 1 // Les mois commencent à partir de 0
    const jourActuel = maintenant.getDate()

    var date = ref(`${anneeActuelle}-${moisActuel.toString().padStart(2, '0')}-${jourActuel.toString().padStart(2, '0')}`)

    const heureActuelle = maintenant.getHours()
    const minuteActuelle = maintenant.getMinutes()

    var heure = ref(`${heureActuelle.toString().padStart(2, '0')}:${minuteActuelle.toString().padStart(2, '0')}`)

    router.push({
    path: lien,
        query: {
            ptDepart: "",
            ptArrive: "",
            booleenTrajetBaseDomicile : 0,
            trajetRegulier: 0,
            date : date.value,
            heure : heure.value,
            jours : [true, true, true, true, true, true, true],
            bagages: 1,
            nombrePassagers : 3,
            description : ""
        }
    });
}

</script>

<template>
  <div class="navigation-bar">
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'recherche' }"
      @click="ouvrirRecherche('/recherche', 'recherche')"
      classe-icone="recherche"
    ></div>
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'creation' }"
      @click="ouvrirCreation('/creation-trajet', 'creation')"
      classe-icone="creation"
    ></div>
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'vos trajet' }"
      @click="ouvrir('/vos-trajets', 'vos trajet')"
      classe-icone="vos trajet"
    ></div>
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'profil' }"
      @click="ouvrir('/profil', 'profil')"
      classe-icone="profil"
    ></div>
    <div
      class="enfant-navigation-bar"
      :class="{ selectionne: idSelectione === 'message' }"
      @click="ouvrir('/message', 'message')"
      classe-icone="message"
    ></div>
  </div>
</template>

<style scoped>
    .navigation-bar {
    width: 100%;
    height : 100px;
    background-color: white;
    position: fixed;
    bottom: 0;
    left: 0;
    display: flex;
    }

    [classe-icone="recherche"] {
    background: url('assets/icons/navigation-recherche.png');
    }
    [classe-icone="creation"] {
    background: url('assets/icons/navigation-add.png');
    }

    [classe-icone="vos trajet"] {
    background: url('assets/icons/navigation-map-marker.png');
    }

    [classe-icone="profil"] {
    background: url('assets/icons/navigation-profil.png');
    }

    [classe-icone="message"] {
    background: url('assets/icons/navigation-message.png');
    }

    .enfant-navigation-bar {
    padding: 50px 0;
    width: 24.8%;
    margin: 0.1%;
    color: #000;
    float: left;
    text-align: center;

    background-size: 60px 60px;
    background-repeat: no-repeat;
    background-position: center;
    }

    .enfant-navigation-bar:hover {
    background-color: #f0f0f0;
    }

    .enfant-navigation-bar.selectionne {
    box-shadow: 0 0 0 2px #bbbbbb;
    }

    @media (max-height: 750px) {
        .navigation-bar {
            height: 60px;
        }

        .enfant-navigation-bar {
            padding: 30px 0;
            background-size: 30px 30px;
            background-repeat: no-repeat;
            background-position: center;
        }
    }
</style>
