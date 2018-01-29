/**
 * Created by Lopeare on 16/04/2017.
 */
function active( nombre, sub){
    var secP = document.getElementsByTagName("li");
    console.log(secP);
    var groupSecS = document.getElementsByClassName("dropdown-content");
    var secS;

    // Quitamos Iniciar Sesión / Cerrar Sesión (secP.length - 1)
    for( var i=0; i < secP.length -1; i++){
        secP[i].classList.remove("active");
        if( secP[i].innerText == nombre ){
            secP[i].classList.add("active");
        }
    }

    for( i=0; i < groupSecS.length; i++ ){
        secS = groupSecS[i].getElementsByTagName("a");

        for( var j=0; j < secS.length; j++){
            secS[j].classList.remove("active");
            if( secS[j].innerText == sub ){
                secS[j].classList.add("active");
            }
        }
    }
}

function activeMenuGest( nombre ){


    var menus = document.getElementsByTagName("li");console.info(menus);
    for( var i=0; i < menus.length; i++){

        menus[i].classList.remove("active");
        if( !menus[i].textContent.search(nombre)){
        //if( menus[i].textContent == nombre ){
            console.log("Son iguales");
            menus[i].classList.add("active");
        }
    }
}