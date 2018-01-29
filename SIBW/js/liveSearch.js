function showResult(str) {
    console.log(str);
    if (str.length==0) {
        document.getElementById("livesearch").style.opacity="0";
        return;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch").style.opacity="1";
        }
    }

    xmlhttp.open("GET","index.php?searching="+str,true);
    xmlhttp.send();
}

function hideResult(){
        document.getElementById("livesearch").innerHTML = "";
        document.getElementById("livesearch").style.border = "0px";
}

function marcar(buscando){
    var cosas = document.getElementById("livesearch");
    cosas = cosas.getElementsByTagName("a");
    console.info(cosas);
    cosas[0].contains(buscando);
}


