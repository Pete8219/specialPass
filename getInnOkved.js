"use strict";

let nomer_inn;
let okved='';
let requestData;
let array ={kod:'', desc:''};
var orgData ={
   inn:'',
   okved: [

    ],
}; 
let inn = document.querySelector('input[name="inn"]');


let btn = document.querySelector('.btn');

btn.addEventListener('click', (e)=> {
    e.preventDefault();

    nomer_inn = inn.value;
    orgData["inn"] = nomer_inn;


      
     
    post('https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party', {query: nomer_inn})
    .then(data => {
        
       
        let requestData = data['suggestions'];
        /*console.log(requestData);*/
        okved = requestData[0].data.okved;
        array.kod = okved;

        orgData["okved"].push(array);
        okved = orgData["okved"][0].kod;
        console.log(orgData);
        return okved;
            
    }
        )
    .then(okved => {
        postOkved('https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/okved2', {query: okved})
            .then(data => {
            let DataOkved = data['suggestions'];
            
            let desc = DataOkved[0].value;
            
            array.desc = desc;
            
           
                 
            } )
    } )  
             // обрабатываем результат вызова response.json()
    .catch(error => console.error(error))





function post(url, data) {
return fetch(url, {
    credentials: 'same-origin',  
    method: 'post',
    body: JSON.stringify(data),  
    headers: new Headers({
    'Content-Type':'application/json',
    'Accept':'application/json',
    'Authorization':'Token 0d59a29c02e4c0ea2cea6696d06705ea35d68a9a',
    })  
    })
    .then(response=>response.json());
}

});



function postOkved(url, data) {
return fetch(url, {
    credentials: 'same-origin',  
    method: 'post',
    body: JSON.stringify(data),  
    headers: new Headers({
    'Content-Type':'application/json',
    'Accept':'application/json',
    'Authorization':'Token 0d59a29c02e4c0ea2cea6696d06705ea35d68a9a',
    })  
    })
    .then(response=>response.json());
}
 
