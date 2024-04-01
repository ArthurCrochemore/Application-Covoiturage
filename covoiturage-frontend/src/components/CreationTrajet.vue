
<template>
    <div class="creation">
        <h1>Création trajet</h1>
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
            bagage: '',
            nombrePassagers: 1,
            description: ''
        }
    }
    
}
</script>

<style scoped>
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
}
h1 {
    text-align: center;
    margin-top: 5px;
    color: black;
}

label {
    display: block;
    margin-top: 20px;
    margin-bottom: 15px;
    font-weight: bold;
    color: black;
    margin-left: 2.5%;
}

input[type="text"]{
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
.input-checkbox:checked + .switch-label {
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
.input-checkbox:checked + .switch-label::after {
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
</style>