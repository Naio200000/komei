var app = new Vue({
    el: ".formularioLogica",
    data:{
        dataSelected: "", 
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
        datosClases:{
            semanal:{
                1: "1 Clase",
                2: "2 Clase",
                3: "3 Clase"
            },
            personas: {
                Grupal: "Clases grupales",
                Personal: "Clases personales"
            },
        },
        datosRopa:{
            color:{
                Azul:"Azul",
                Negro:"Negro"
            },
            material:{
                Tetron:"Tetron",
                Algodon: "Algodon",
                Lana: "Lana"
            },
        },
        datosEquipos:{
            color:{
                Azul:"Azul",
                Negro:"Negro"
            },
            material:{
                acero1060:"Acero 1060",
                acero1095:"Acero 1095",
                Aluminio: "Aluminio",
                Incienso: "Incienso"
            }
        },
    }

});