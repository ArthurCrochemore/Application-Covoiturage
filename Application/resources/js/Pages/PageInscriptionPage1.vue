<!-- Représente l'affichage de la première page d'inscription  -->

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { inject } from 'vue'
import { defineProps } from 'vue'
import axios from 'axios'

const props = defineProps({
    mail: String,
    nid: String
})

/* Constante pour les données saisies */
const mail = ref(props.mail)
const nid = ref(props.nid)
const motdepasse = ref('')
const confirmationmotdepasse = ref('')

const afficherMessageFunc = inject('afficherMessageFunc'); // Fonction qui gère l'affichage de messages généraux sur App_Connexion.vue

const router = useRouter() // Récupération du router vue-router pour la navigation

const continuer = async () => {
    console.log("Mail:", mail.value)
    console.log("NID:", nid.value)
    console.log("Mot de passe:", motdepasse.value)
    console.log("Confirmation du mot de passe:", confirmationmotdepasse.value)

    if (mail.value != "" && nid.value != "" && motdepasse.value != "") {
        try {
            const response = await axios.get('/verifier-email/' + encodeURI(mail.value));
            console.log(response.data);
            
            if (response.data) {
                afficherMessageFunc("Cette adresse email est déjà utilisée.", "Erreur");
            } else {
                // Vérification de la correspondance des mots de passe
                if (motdepasse.value == confirmationmotdepasse.value) {
                    router.push({
                        path: '/inscription-page2',
                        query: {
                            mail: mail.value,
                            nid: nid.value,
                            mdp: motdepasse.value,
                        }
                    });
                } else {
                    afficherMessageFunc("Les mots de passe ne correspondent pas ", "Erreur");
                }
            }
        } catch (error) {
            console.error('Erreur lors de la vérification de l\'email :', error);
            afficherMessageFunc("Une erreur s'est produite lors de la vérification de l'email.", "Erreur");
        }
    } else {
        afficherMessageFunc("Tous les champs n'ont pas été saisis ", "Erreur");
    }
}

/**
 * Ramène vers l'interface de connexion (Annulation de l'inscription)
 */
const annuler = () => {
    router.push({
        path: '/'

    });
}
</script>

<template>
    <div class="bloc-principal">
        <h1>Inscription</h1>
        <div class="bloc-label">
            <div class="icone-mail" id="icone"></div>
            <input type="text" class="label" v-model="mail" placeholder="Mail" />
        </div>
        <div class="bloc-label">
            <div class="icone-mail" id="icone"></div>
            <input type="text" class="label" v-model="nid" placeholder="NID" />
        </div>
        <div class="bloc-label">
            <div class="icone-cadenas" id="icone"></div>
            <input type="password" class="label" v-model="motdepasse" placeholder="Mot de Passe" />
        </div>
        <div class="bloc-label">
            <div class="icone-cadenas" id="icone"></div>
            <input type="password" class="label" v-model="confirmationmotdepasse"
                placeholder="Confirmer le mot de Passe" />
        </div>
        <div class="boutons">
            <div class="annuler" @click="annuler">
                <p class="intitule-annuler">Annuler</p>
            </div>
            <div class="continuer" @click="continuer">
                <p class="intitule-continuer">Continuer</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.bloc-label {
    display: flex;
    flex-direction: row;
    height: 50px;
    width: 75%;
    margin-left: 12.5%;
    justify-content: space-between;
    margin-bottom: 10px;
}

input {
    width: 90%;
    font-size: medium;
    border: none;
    border-bottom: 1px solid #dddddd;
}

#icone {
    background-size: 30px 30px;
    background-repeat: no-repeat;
    background-position: center;
    width: 50px;
    height: 50px;
}

.icone-mail {
    background: url('assets/icons/connexion-arobase.png');
}

.icone-cadenas {
    background: url('assets/icons/connexion-cadenas.png');
}

h1 {
    margin-bottom: 40px;
}

p,
h1 {
    text-align: center;
    border-top: 5px;
    color: black;
}

.boutons {
    display: flex;
    margin-left: 10%;
    margin-top: 20px;
    justify-content: space-between;
}

.annuler,
.continuer {
    background-color: #bbbbbb;
    width: 120px;
    height: 35px;
    margin: auto;
    border-radius: 10px;
}

.lien-mot-de-passe-oublie {
    border-top: auto;
    justify-content: right;
}
</style>
