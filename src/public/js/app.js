// init vue app
let app = new Vue({
    el: '#app',
    data: {
        calculations: [],
        results: "",
        error: "",
    },
    methods: {
    }
})
let interval = false;


// initial function that will be run at bottom of file
init = function(){
    getCalculations();
    createInterval();
}
// send the xhr request
calculate = function(){

    let equation = getEqValue();
    //get csrf token to make sure it coming from an expected source
    let token = getCookie('XSRF-TOKEN');

    fetch('/api/calculate', {
        method: 'POST', // or 'PUT'
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ "equation" : equation }),
    })
        .then(response => response.json())
        .then(response => {
            if(response.success === true){
                app.calculations = response.data.calculations;
                app.results = response.data.results;
                app.error = "";
            }else{
                app.error = response.data.error;
            }
        })
        .catch((error) => {
            console.log(error);

        });
}

getEqValue = function(){
    return document.getElementById('equation').value;
}
// clear all the errors
clearErrors = function(){
    app.error = "";
}
// get Calculations from backend application
getCalculations = function(){
    let token = getCookie('XSRF-TOKEN')
    fetch('/api/calculations', {
        method: 'GET', // or 'PUT'
        headers: {
            'X-CSRF-TOKEN': token
        }
    })
        .then(response => response.json())
        .then(response => {
            if(response.success === true){
                app.calculations = response.data.calculations;
                app.error = "";
            }else{
                app.error = response.data.error;
            }
        })
        .catch((error) => {
            console.log(error);
        });
}
//helper function to get cookies
getCookie = function(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

//function to create the set interval
createInterval = function (){
    interval = setInterval( function() {
        getCalculations()
    },5000);
}

init();

