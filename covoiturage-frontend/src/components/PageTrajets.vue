<!-- <script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

</script>

<template>
    <div class="bloc-vos-trajets">

    </div>
</template>

<style scoped>
    .bloc-vos-trajets {
    width: 60%;
    height: auto;
    position: fixed;
    top: 150px;
    bottom: 150px;
    left: 20%;
    display: flex;
    flex-direction: column;
    background-color: white;
    border-radius: 40px;
    }
</style> -->
<template>
    <div class="bloc-de-creation">
        <div class="entete-bloc">
            <h1 class="intitule-bloc">Création trajet</h1>
        </div>
        <div class="form-container">
            <form>
                <div class="input-container">
                    <img src="../assets/icons/navigation-map-marker.png" alt="Localisation" class="icon">
                    <input type="text" v-model="pointDepart" placeholder="Départ">
                </div>

                <div class="input-container">
                    <img src="../assets/icons/navigation-map-marker.png" alt="Localisation" class="icon">
                    <input type="text" v-model="pointArrivee" placeholder="Arrivée">
                </div>

                <input type="date" v-model="date">

                <input type="time" v-model="heure">
                <div class="switch-container">
                    <input type="checkbox" id="switch1" v-model="trajetRegulier" class="input-checkbox">
                    <label for="switch1" class="switch-label"></label>
                    <label for="switch1">Trajet régulier</label>
                </div>
                
                <div class="switch-container">
                    <input type="checkbox" id="switch2" v-model="proposerTrajet" class="input-checkbox">
                    <label for="switch2" class="switch-label"></label>
                    <label for="switch2">Proposer un trajet</label>
                </div>

                <div v-if="trajetRegulier" class="switch-container" id="switchregulier">

                    <input type="checkbox" id="lundi" v-model="joursSemaine.lundi" class="input-checkbox2">
                    <label for="lundi" class="checkbox-label">Lundi</label>


                    <input type="checkbox" id="mardi" v-model="joursSemaine.mardi" class="input-checkbox2">
                    <label for="mardi" class="checkbox-label">Mardi</label>

                    <input type="checkbox" id="mercredi" v-model="joursSemaine.mercredi" class="input-checkbox2">
                    <label for="mercredi" class="checkbox-label">Mercredi</label>

                    <input type="checkbox" id="jeudi" v-model="joursSemaine.jeudi" class="input-checkbox2">
                    <label for="jeudi" class="checkbox-label">Jeudi</label>
                    
                    <input type="checkbox" id="vendredi" v-model="joursSemaine.vendredi" class="input-checkbox2">
                    <label for="vendredi" class="checkbox-label">Vendredi</label>

                    <input type="checkbox" id="samedi" v-model="joursSemaine.samedi" class="input-checkbox2">
                    <label for="samedi" class="checkbox-label">Samedi</label>

                    <input type="checkbox" id="dimanche" v-model="joursSemaine.dimanche" class="input-checkbox2">
                    <label for="dimanche" class="checkbox-label">Dimanche</label>

                </div>



                <div class="input-container">
                    <select v-model="bagage">
                        <option value="Beaucoup">Beaucoup</option>
                        <option value="Moyen">Moyen</option>
                        <option value="Peu">Peu</option>
                    </select>
                    <label class="label-right">Bagages</label>
                </div>

                <div class="input-container">
                    <input type="number" v-model="nombrePassagers">
                    <label class="label-right">Passagers</label>
                </div>

                <label>Description:</label>
                <textarea v-model="description"></textarea>

                <button type="submit">Suivant</button>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    name: 'CreationTrajet',
    data() {
        return {
            pointDepart: '',
            pointArrivee: '',
            date: '',
            heure: '',
            trajetRegulier: false,
            joursSemaine: {
                lundi: false,
                mardi: false,
                mercredi: false,
                jeudi: false,
                vendredi: false,
                samedi: false,
                dimanche: false
            },
            proposerTrajet: false,
            bagage: '',
            nombrePassagers: 1,
            description: ''
        }
    }

}
</script>

<style scoped>
.bloc-de-creation {
    width: 60%;
     height: auto;
     position: fixed;
     top: 150px;
     bottom: 150px;
     left: 20%;
     display: flex;
     flex-direction: column;
     background-color: white;
    border-radius: 40px;
}

.creation {
    width: 80%;
    height: auto;
    position: fixed;
    top: 50px;
    bottom: 150px;
    left: 10%;
    right: 10%;
    display: flex;
    flex-direction: column;
    background-color: white;
    border-radius: 30px;
    overflow: hidden;
}

h1 {
    text-align: center;
    margin-top: 5px;
    color: black;
}

label {
    display: block;
    margin-top: 10px;
    margin-bottom: 10px;
    font-weight: bold;
    color: black;
    margin-left: 2.5%;
    margin-right: 2.5%;
}

input[type="text"] {
    width: 100%;
    padding: 5px;
    margin-top: 25px;
    margin-right: 50px;
    border: none;
    border-bottom: 1px solid black;
    outline: none;
    color: black;
}

input[type="date"],
input[type="time"] {
    width: 40%;
    padding: 5px;
    margin-top: 20px;
    float: right;
    margin-right: 20px;
    color: black;
    border: 1px solid black;
    border-radius: 30px;
    padding-left: 10px;
    padding-right: 10px;
}

input[type="time"] {
    clear: both;
    margin-top: 15px;
}

.switch-container {
    display: flex;
    align-items: center;
    margin-left: 2.5%;
    position: relative;
}

.input-checkbox {
    display: none;
}

.switch-label {
    display: block;
    width: 40px;
    height: 20px;
    background-color: #ccc;
    border-radius: 10px;
    position: relative;
    cursor: pointer;
    margin-right: 5px;
}

.input-checkbox:checked+.switch-label {
    background-color: #007bff;
}

.switch-label::after {
    content: "";
    position: absolute;
    top: 2px;
    left: 2px;
    width: 16px;
    height: 16px;
    background-color: white;
    border-radius: 50%;
    transition: transform 0.3s;
}

.input-checkbox:checked+.switch-label::after {
    transform: translateX(20px);
}

select {
    width: 40%;
    padding-left: 15px;
    margin-top: 5px;
    border-radius: 30px;
    border: 1px solid black;
    margin-left: 2.5%;
    color: black;
}

input[type="number"] {
    width: 20%;
    padding: 5px;
    margin-top: 5px;
    border: none;
    border-bottom: 1px solid black;
    outline: none;
    text-align: center;
    color: black;
    margin-left: 2.5%;
}

.label-right {
    margin-left: 25px;
    color: black;

}

textarea {
    width: 95%;
    padding: 5px;
    left: 5px;
    right: 5px;
    margin-left: 2.5%;
    margin-right: 2.5%;
    height: 100px;
    color: black;
    border: 1px solid black;
    border-radius: 5px;
}

button[type="submit"] {
    width: 40%;
    padding: 10px;
    margin-bottom: 20%;
    margin-left: 58%;
    padding-top: 1%;
    padding-bottom: 1%;
    background-color: grey;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 30px 30px 30px 30px;
}

button[type="submit"]:hover {
    background-color: black;
}

.form-container {
    padding-bottom: 100px;
}


.input-container {
    display: flex;
    align-items: center;
}

.icon {
    width: 20px;
    height: 20px;
    margin-right: 5px;
    margin-top: 20px;
    margin-left: 5px;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(100%);
}

input[type="time"]::-webkit-calendar-picker-indicator {
    filter: invert(100%);
}

input[type="number"]::-webkit-calendar-picker-indicator {
    filter: invert(100%);
}

.switch-container#switchregulier{
    color: black;
    flex-wrap: wrap;
    justify-content: center;
}
.checkbox-label {
    margin-left: 5px;
    margin-right: 15px;
    color: black;
}

@media (max-height: 750px) {
    .creation {
        top: 30px;
        bottom: 100px;
    }

}

@media (max-width : 1300px) {
    .creation {
        width: 90%;
        left: 5%;
        right: 5%;
    }
}

@media (max-width : 900px) {
    .creation {
        width: 95%;
        left: 2.5%;
        right: 2.5%;
    }
}

@media (max-width : 800px) {
    .creation {
        width: 97.5%;
        left: 1.25%;
        right: 1.25%;
    }
}

@media (max-width : 700px) {
    .creation {
        width: 100%;
        left: 0;
        right: 0;
    }
}

@media (max-width : 600px) {
    .creation {
        width: 100%;
        left: 0;
        right: 0;
    }
}
</style> 