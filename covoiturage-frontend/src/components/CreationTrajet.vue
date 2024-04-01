
<template>
    <div>
        <h1>Créer un nouveau trajet</h1>
        <div class="form-container">
        <form>
            <div class="input-container">
                <img src="../assets/icons/localisation.png" alt="Localisation" class="icon">
                <input type="text" v-model="pointDepart" placeholder="Départ">
            </div>

            <div class="input-container">
                <img src="../assets/icons/localisation.png" alt="Localisation" class="icon">
                <input type="text" v-model="pointArrivee" placeholder="Arrivée">
            </div>

            <input type="date" v-model="date">

            <input type="time" v-model="heure">
            
            <label>Trajet régulier:</label>
            <input type="checkbox" v-model="trajetRegulier">
            <br><br><br><br>
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
h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #3f51b5;
}

label {
    display: block;
    margin-top: 20px;
    margin-bottom: 15px;
    font-weight: bold;
}

input[type="text"]{
    width: 100%;
    padding: 5px;
    margin-top: 25px;
    margin-right: 50px;
    border: none; 
    border-bottom: 1px solid black;
    outline: none; 
}
input[type="date"],
input[type="time"] {
    width: 40%;
    padding: 5px;
    margin-top: 20px;
    float: right;
    margin-right: 20px;
}

input[type="time"] {
    clear: both;
    margin-top: 15px;
}

select {
    width: 40%;
    padding: 5px;
    margin-top: 5px;
    border-radius: 1px;
}

input[type="number"] {
    width: 10%;
    padding: 5px;
    margin-top: 5px;
    border: none; 
    border-bottom: 1px solid black;
    outline: none; 
    text-align: center;
}

.label-right {
    margin-left: 25px;
    
}

textarea {
    width: 100%;
    padding: 5px;
    margin-top: 5px;
    height: 100px;
}

button[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    background-color: #3f51b5;
    color: white;
    border: none;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #2e408f;
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
</style>