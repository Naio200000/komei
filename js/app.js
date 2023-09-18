var app = new Vue({
    el: ".formularioLogica",
	data: {
        funciona: 'si',
        category: '',
        clases:{
            semanal: "Clases por semana", 
            personal: "En grupo o solo?"
        },
        ropa:{
            tipo: "Tipo de ropa",
            color: "Color de ropa",
            material: "Telad de la ropa"
        },
        equipos:{
            tipo: "Tipo del equipo",
            color: "Color del equipo",
            material: "Telad del equipo"
        }
    }
});