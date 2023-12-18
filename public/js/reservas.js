//seleccionamos nuestro contenedor de cantidad de comensales y creamos un fragmento
const contenedorNumerosComensales = document.querySelector(".numeros_container");
const fragmento = document.createDocumentFragment();

//creamos nuestro contenedor de la cantidad de comensales posibles a reservar y tomamos el input
const numerosContainer = document.querySelector(".numeros_container");
const inputCantidadComensales = document.getElementById("cantidad_comensales");

//crear todos los div que mostraran al usuario la cantidad de comensales a reservar
function addNumerosComensales(){
    for(let i = 1;i <=4;i++){
        let div = document.createElement("div");
        div.classList.add("numero_container");

        let p = document.createElement("p");
    
        p.innerHTML = i;

        div.appendChild(p);

        fragmento.appendChild(div);
    }

    //los añado a el contenedor
    contenedorNumerosComensales.appendChild(fragmento);

    addInputValue(inputCantidadComensales);
}

addNumerosComensales();


//añadimos al input el valor seleccionado
function addInputValue(input){
    for(let i = 0; i < numerosContainer.childElementCount;i++){
        //le damos a cada hijo el evento click
        let hijosContainer = numerosContainer.children[i];
        hijosContainer.addEventListener("click",(e)=>{
            
            e.stopPropagation();

            checkRepeatSelected(numerosContainer,e.currentTarget);

            if(e.currentTarget.classList.contains("number_selected")){
                input.value = "";
                e.currentTarget.classList.remove("number_selected");
            }
            else{
                //añadimos el valor al input
                const numeroP = e.currentTarget.firstElementChild;
                const valor = numeroP.textContent;
    
                input.value = valor;
                
                e.currentTarget.classList.add("number_selected");
            }
        })
    }
}

// en caso de que haya dos input seleccionados removemos la clase selected
function checkRepeatSelected(numerosContainer,selected){
    for(let i = 0; i < numerosContainer.childElementCount;i++){
        let hijo = numerosContainer.children[i];

        if(hijo != selected){
            hijo.classList.remove("number_selected");
        }
    }
}