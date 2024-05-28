<!-- Représente l'interface pour la modifications des interfaces du profil  -->

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { defineProps } from 'vue'
import { inject } from 'vue'
import axios from 'axios'

const afficherMessageFunc = inject('afficherMessageFunc'); // Fonction qui gère l'affichage de messages généraux sur App.vue

const props = defineProps({
    mail: String,
    unite: String,
    numPoste: String,
    prenom: String,
    nomFamille: String,
    adressePostale: String,
    telephone: String
})

const router = useRouter() // Récupération du router vue-router pour la navigation

/* Constante pour les données saisies, chargées en fonction des données actuelles */
const mailValue = ref(props.mail)
const uniteValue = ref(props.unite)
const numPosteValue = ref(props.numPoste)
const prenomValue = ref(props.prenom)
const nomFamilleValue = ref(props.nomFamille)
const adressePostaleValue = ref(props.adressePostale)
const telephoneValue = ref(props.telephone)

/**
 * Emmène vers l'interface de profil, annulation des modifications
 */
const retour = () => {
    router.push({
        path: '/profil'
    });
}

/**
 * Enregistre les modifications TODO : tester
 */
const valider = async () => {
    try {
        await axios.post('/utilisateur/update', {
            Mail: mailValue.value,
            Unite: uniteValue.value,
            Numero_De_Poste: numPosteValue.value,
            Prenom: prenomValue.value,
            Nom: nomFamilleValue.value,
            Adresse_Postale: adressePostaleValue.value,
            Numero_De_Tel: telephoneValue.value,
        });
        afficherMessageFunc("La demande de modification a été enregistrée avec succès", "Succès");
        retour();
    } catch (error) {
        afficherMessageFunc("Erreur lors de la mise à jour du profil", "Erreur");
    }
}
</script>

<template>
    <div class="entete">
        <div class="retour" style="
                background: url('assets/icons/fleche_retour.png');
                background-size: 60px 60px;
                background-repeat: no-repeat;
                background-position: center;
            " @click="retour()"></div>
        <h1>Modification du Profil</h1>
    </div>
    <div class="bloc-principal">
        <div class="bloc-haut"></div>
        <div class="bloc-label">
            <input type="text" class="label" id="mail-label" placeholder="Mail" v-model="mailValue" />
        </div>
        <div class="bloc-label">
            <input type="text" class="label" id="unite-label" placeholder="N° Unité" v-model="uniteValue" />
        </div>
        <div class="bloc-label">
            <input type="text" class="label" id="num-poste-label" placeholder="N° de Poste" v-model="numPosteValue" />
        </div>
        <div class="bloc-label">
            <input type="text" class="label" id="prenom-label" placeholder="Prénom" v-model="prenomValue" />
        </div>
        <div class="bloc-label">
            <input type="text" class="label" id="nom-famille-label" placeholder="Nom de Famille"
                v-model="nomFamilleValue" />
        </div>
        <div class="bloc-label">
            <input type="text" class="label" id="adresse-postale-label" placeholder="Adresse Postale"
                v-model="adressePostaleValue" />
        </div>
        <div class="bloc-label">
            <input type="text" class="label" id="telephone-label" placeholder="Téléphone" v-model="telephoneValue" />
        </div>

        <div class="boutons">
            <div class="annuler" @click="retour">
                <p class="intitule-annuler">Annuler</p>
            </div>
            <div class="valider" @click="valider">
                <p class="intitule-valider">Valider</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.entete>h1 {
    margin: auto;
}

.bloc-haut {
    height: 3%;
}

.bloc-label {
    display: flex;
    width: 90%;
    padding-left: 7.5%;
    height: 8%;
}

.label {
    border: none;
    border-bottom: 1px solid #dddddd;
    height: 40px;
    font-size: medium;
    width: 100%;
}

.boutons {
    display: flex;
    height: 50px;
    width: 100%;
    justify-content: space-around;
    margin-top: auto;
}

.valider {
    background-color: #bbbbbb;
    width: 120px;
    height: 35px;
    border-radius: 10px;
}

p {
    color: black;
    text-align: center;
    font-size: 20px;
}
</style>
