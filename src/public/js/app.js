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

console.log(app.data);
// create Http request
let xhr = new XMLHttpRequest();

//xhr has ran
xhr.onload = function () {

    let response = (JSON.parse(xhr.response));
    // Process our return data
    if (xhr.status >= 200 && xhr.status < 300) {
        //xhr success

        if(response.success){
            console.log(response.data)
            app.calculations = response.data.calculations;
            app.results = response.data.results;
            app.error = response.data.error;
        }else{
            console.log(response.message);
        }

    } else {

        //xhr has failed
        console.log('conection to server failed');
        app.error = response.data.error;
    }

};

// send the xhr request
calculate = function(){

    let equation = getEqValue();
    //add sort value if required
    xhr.open('POST', '/api/calculate');
    //get csrf token to make sure it coming from an expected source
    let token = getCookie('XSRF-TOKEN');
    xhr.setRequestHeader("X-CSRF-TOKEN", token);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.send(JSON.stringify({ "equation" : equation }));
}

getEqValue = function(){
    return document.getElementById('equation').value;
}

clearErrors = function(){
    app.error = "";
}

getCalculations = function(){
    //add sort value if required
    xhr.open('GET', '/api/calculations');
    //get csrf token to make sure it coming from an expected source
    let token = getCookie('XSRF-TOKEN');
    xhr.setRequestHeader("X-CSRF-TOKEN", token);
    xhr.send(JSON.stringify({ "equation" : equation }));
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

getCalculations();
