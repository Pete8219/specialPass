import {DADATA_TOKEN} from './token.js';

document.addEventListener("DOMContentLoaded", () =>{

    let btnInn = document.querySelector('.zapros');
    let Inn = document.querySelector('.inn-value');
    let addInfoBlock = document.querySelector('.addInfoForm');
    let innBlock = document.querySelector('.inn');
    let btnGetPropusk = document.querySelector('.get-propusk');
    let btnIfError = document.querySelector('.ifErr');
    let addInfoForm = document.querySelector('.additionalInfo');
    let errInfo = document.querySelector('.errInfo');
    let email = document.querySelectorAll('.mail'),
        marka = document.querySelectorAll('.marka'),
        nomer = document.querySelectorAll('.nomer'),
        comment = document.querySelector('.comment');


function keyGen() {
        let text='';
        let  possible = "abcdefghijklmnopqrstuvwxyz";
    
        for(let i=0; i < 12; i++ ){
           text += possible.charAt(Math.floor(Math.random() * possible.length));   
        }

        return text;

    }




    let kods = ['84.11.3'];
    let organization =  {
        id: '',
        inn : '',
        okved: '',
        name: '',
        address: '',
        primaryActivity: '',
        manadgement: '',
        keygen: '',
        email: '',
        marka: '',
        nomer: '',
        comment:'',
        status: '',        
    };

    let messages = {
        success: '',
        warning: '',
    };
    
    btnInn.addEventListener ('click', (e) => {
        organization.keygen = keyGen();
        
        e.preventDefault();
        

        if(Inn.value == '') {
            alert('введите Ваш ИНН');
            
        } else {
            console.log(organization.keygen);
            getData(Inn.value);
        }
 
        
// получение номера ОКВЭД по ИНН        
    function getData(data) {

        post('https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party', {query: data})
        .then(data => {
            console.log(data);
           
            let requestData = data.suggestions;
            organization.inn = Inn.value;
            organization.okved = requestData[0].data.okved;
            organization.name = requestData[0].value;
            organization.address = requestData[0].data.address.value;
            organization.manadgement = requestData[0].data.management.name;
            
            
            
            kods.map((item) => {
                if(item == organization.okved) {
                     AddInfo();

                    console.log('Ваш ОКВЭД находится в списке разрешенных видов деятельности');
                }
                else {
                    showBlockErr();
                }
            });    
            return organization.okved;

            })
            .then(data => {
                postOkved('https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/okved2', {query: data})
                .then(data => {
  
                let request = data.suggestions;
                
                let transcript = request[0].value;
                
                organization.primaryActivity = transcript;
                     
                });

            })
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
          'Authorization':DADATA_TOKEN,
          })  
          })
          .then(response=>response.json());
        }



        function postOkved(url, data) {
            return fetch(url, {
              credentials: 'same-origin',  
              method: 'post',
              body: JSON.stringify(data),  
              headers: new Headers({
              'Content-Type':'application/json',
              'Accept':'application/json',
              'Authorization':DADATA_TOKEN,
              })  
              })
              .then(response=>response.json());
            }
    }

    // окончание функции получения номера ОКВЭД


    });

    function AddInfo() {
        console.log(organization);
        innBlock.style.display= 'none';
        addInfoBlock.style.display = 'block';
        organization.email = email[0].value;

    }

    function showBlockErr() {
        innBlock.style.display='none';
        errInfo.style.display = 'block';
    }

    btnGetPropusk.addEventListener('click', (e) => {
        e.preventDefault();
        organization.email = email[0].value;
        organization.marka = marka[0].value;
        organization.nomer = nomer[0].value;
        organization.status = "Выдан";
        organization.comment = "Пропуск выдан автоматически. Вид деятельности находится в списке разрешенных";  
        checkData();
        /* saveData(); */
            
        if(messages["warning"].length == 0){
            saveData();
            setTimeout(getPropusk, 2000);
            /* getPropusk(); */
        }else {
            showModal(messages["warning"]);
        }  
    
        
            
        

    });

    btnIfError.addEventListener('click', (e) => {
        e.preventDefault();
        organization.email = email[1].value;
        organization.marka = marka[1].value;
        organization.nomer = nomer[1].value;
        organization.comment = comment.value;
        organization.status = "Обработка";
        
        let result = checkData();
        if(result == '') {

            saveData();

            if(saveData) {
                let message = 'Ваш запрос отправлен на рассмотрение';
            showModal(message);
            }

        }     

    });



//Функция проверки на дубль госномера
function checkData() {
    let docForm = createFormData();

    var xhr = new XMLHttpRequest();
                  xhr.withCredentials = true;
                  
                  xhr.addEventListener("readystatechange", function() {
                  if(this.readyState === 4 && this.status == 200) {
                    
                      let data = (this.responseText);
                      console.log(data);
                    //если такого номера еще нет в базе выполнить условие
                      if(data === "") {

                          messages.warning = '';
                          console.log('you are here');
                          
                      }else { //иначе выводим модальное окно с сообщением
                          data= JSON.parse(this.responseText);
                          messages.warning = data;
                          showModal(data);
                      }
                       
                     
                     /*  console.log('Data saved successfully', data); */
                  }
                  });
                  
                  xhr.open("POST", "./api/checkData.php");
                  
                  xhr.send(docForm);
 
}

//Функция сохранения данных в базу
function saveData(){


    let docForm = createFormData();

    var xhr = new XMLHttpRequest();
                  xhr.withCredentials = true;
                  
                  xhr.addEventListener("readystatechange", function() {
                  if(this.readyState === 4 && this.status == 200) {
    
                      let data = JSON.parse(this.responseText);
                     
                        organization.id = data.id;
                        console.log(organization);
                      
                     
                  }
                  });
                  
                  xhr.open("POST", "./api/saveData.php");
                  
                  xhr.send(docForm);
                  


} 

//Формируем объект FormData для передачи данных скрипту на сервере
function createFormData() {
    let docForm  = new FormData();

    for (let key in organization) {
        docForm.append(key, organization[key]);
    } 

    return docForm;
}    

//Функция формирования пропуска в формате pdf

function getPropusk(){
    console.log(organization);

 
    let docInfo = {

        info: {
            title:'Разрешение на въезд',
            author:'Администрация МО город Салехард',
            subject:'Спецпропуск',
            keywords:'спецпропуск, Салехард, самоизоляция'
            },
    
            pageSize : 'A4',
            pageOrientation: 'portrait',
            pageMargins: [50,50,30,60],
    
          /*   header: function(currentPage, pageCount) {
                return {
                    text: currentPage.toString() + 'из' + pageCount,
                    alignment: 'right',
                    margin: [0,30,10,50]
                }
            }, */
    
            content: [
                {
                    text: 'Пропуск №'+organization.id,
                    fontSize: 40,
                    alignment:'center',
                    
                },
                {
                    text: 'Марка ' + organization.marka,
                    fontSize:30,
                    alignment: 'center',
                },
                
                {
                    text: 'Госномер '+ organization.nomer,
                    fontSize:30,
                    alignment: 'center',
                },
                {
                    qr: 'https://app.salekhard.org/auto.php?keygen='+organization.keygen,
                    fit:'300',
                alignment:'center',
            },
                
            ]
    
        }

     pdfMake.createPdf(docInfo).open();
     

       
    }




function showModal(data) {
    
    let modalB = document.querySelector('.modal-body');
    let ModalText = document.createTextNode(data);
    modalB.append(ModalText);
  
  
    $('#myModal').modal({
        keyboard: false
    });


    let btnCloseModal = document.querySelector('.closeModal');
    let close = document.querySelector('.close');

    close.addEventListener('.click', () => {
        ModalText.remove();
        let link = './zapros.php';
          window.location.href = link;
    }); 

    btnCloseModal.addEventListener('click', ()=>{

       ModalText.remove(); 
       let link = './zapros.php';
          window.location.href = link;
    });

}

});