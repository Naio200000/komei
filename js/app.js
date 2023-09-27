Vue.filter('mayuscula', function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
}); 
var app = new Vue({
    el: ".formularioLogica",
    data:{
        dataSelected: "",
        cateSelected: "",
        category: {
            clases:{
                semanal: "Clases por semana", 
                personas: "En grupo o solo?"
            },
            equipos:{
                color:"Que color de equipo",
                material:"Que material de equipo",
            },
            ropa:{
                color:"Color de la Ropa",
                material:"Material de la Ropa"
            },
        },
        datosClases:{
            semanal:{
                1: "1 Clase",
                2: "2 Clase",
                3: "3 Clase"
            },
            personas: {
                grupal: "Clases grupales",
                personal: "Clases personales"
            },
        },
        datosRopa:{
            color:{
                azul:"Azul",
                negro:"Negro"
            },
            material:{
                tetron:"Tetron",
                algodon: "Algodon",
                lana: "Lana"
            },
        },
        datosEquipos:{
            color:{
                azul:"Azul",
                negro:"Negro"
            },
            material:{
                acero1060:"Acero 1060",
                acero1095:"Acero 1095",
                aluminio: "Aluminio",
                incienso: "Incienso"
            }
        },
    }

});