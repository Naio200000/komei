var app = new Vue({
    el: ".formularioApp",
    data:{
        radio: ''
    },
    methods:{
        checked: function (){
            if (this.radio == '') {
                this.radio = 'select'
            }
        }
    }
});