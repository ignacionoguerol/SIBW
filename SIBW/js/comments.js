/**
 * Created by Lopeare on 14/03/2017.
 */
/**
 * Limpia los campos del formulario
 *
 */
function ClearForm() {
    var form = document.getElementById("form");
    form['name'].value = "";
    form['email'].value = "";
    form['comment'].value = "";
}
/**
 * Alterna la visibilidad del div con id "comment".
 *
 */
function ToggleComment() {
    var x = document.getElementById("comment");
    if (x.style.pointerEvents == "none") {
        x.style.pointerEvents = "all";
        x.style.opacity = 1;
    } else {
        x.style.pointerEvents = "none";
        x.style.opacity = 0;
    }
    /* Cada vez que se habra la ventana de comentarios, se limpia el formulario */
    ClearForm();
}
/**
 * Cierra el div de comentarios con id "comment".
 * Esta función es utilizada al hacer click fuera del propio div de comentarios o fuera del botón:
 * -Se cierra la ventana de comentarios al hacer click fuera de ella.
 *
 * Se ha debido de hacer así por estas razones:
 * - Si se llamaba a la función cerrar desde el div contenedor (div padre de todos) la propiedad también se aplicaba al
 * propio botón y div, por lo que no se abrían los comentarios.
 * - Si para solucionar lo anterior colocábamos el div de comentarios fuera del contenedor, no se reajustaba bien al
 * redimensionar el navegador.
 */
function CloseComment(){
    var x = document.getElementById("comment");
    x.style.pointerEvents = "none";
    x.style.opacity = 0;
}
/**
 * Bloquea el documento excepto el pop-up emergente pasado como argumento
 *
 */
function BlockAllMessageWarning( pop_up_id_enable ) {
    var allElements = document.getElementsByClassName("container");
    allElements = allElements[0];
    var warningComment = document.getElementById(pop_up_id_enable);

    allElements.style.pointerEvents = "none";
    allElements.style.opacity = "0.4";

    warningComment.style.display = "inline";
    warningComment.style.opacity = "1";
    warningComment.style.pointerEvents = "all";
}
/**
 * Restaura el documento y oculta el pop-up pasado como argumento
 *
 */
function EnableAllMessageWarning( pop_up_id_disable) {
    var allElements = document.getElementsByClassName("container");
    allElements = allElements[0];
    var warningComment = document.getElementById(pop_up_id_disable);

    allElements.style.pointerEvents = "all";
    allElements.style.opacity = "1";

    warningComment.style.display = "none";
}
/**
 * Dado un objeto Date lo procesa en el formato "dd/mm/aaaa hora/min"
 * @param date
 * @returns {string}
 *
 */
function PrintFormatDate(date) {
    var date_format = date.getDate() + "/" +
        parseInt(date.getMonth() + 1) + "/" +
        date.getFullYear() + " " +
        date.getHours() + ":" +
        date.getMinutes();

    return date_format;
}

/**
 * Añade un comentario rellenado en el formulario al pulsar "enter" o el botón "send"
 *
 */
function AddComment() {
    /* Recogida de datos del formulario */
    /*var form = document.getElementById("form");
    var date = new Date();
    var name = form['name'].value;
    var comment = form['comment'].value;*/
    if (name != "" && comment != "") {
        /* Si se ha rellenado correctamente, se procede a borrar los campos del formulario */
        ClearForm();
        /* Introducción de los datos del formulario en la sección de comentarios */
        /*var html =
            '<hr>' +
            '<h1>Nombre: </h1> <p>' + name + '</p> ' +
            '<h1>Fecha y Hora: </h1> <p>' + PrintFormatDate(date) + '</p> ' +
            '<h1>Comentario: </h1> <p>' + comment + '</p>';
        document.getElementById("list-comments").innerHTML += html;*/
        BlockAllMessageWarning("comment-added");
    } else { /* Si no se han rellenado todos los campos requeridos */
        BlockAllMessageWarning("warning-comment");
    }
}

/**
 * Dentro de cualquier campo del formulario, al pulsar la tecla "Enter" cumple la misma funcionalidad (AddComment())
 * que pulsando el boton "send" del propio formulario.
 */
function SendEnter() {
    if (event.keyCode == 13) {
        document.getElementById('send').click();
    }
}

function OmitAccent(text) {
    var acentos = "ãàáäâèéëêìíïîòóöôùúüûÇç";
    var original = "aaaaaeeeeiiiioooouuuucc";

    for (var i = 0; i < text.length; i++) {
        for (var j = 0; j < acentos.length; j++) {
            text = text.replace(acentos.charAt(j), original.charAt(j));
        }
    }
    return text;
}
//var wordsOmit = ["tonto","puta","cabron","estupido","mierda"];



/**
 * Dado el filtro de palabras omitidas "wordsOmit", la función FilterText() comprueba si en el textArea indicado mediante
 * su ID existe alguna de ellas. De ser así la reemplaza por asteriscos, uno por cada letra de la palabra a reemplazar.
 * La función detecta:
 * -Mayúsculas
 * -Acentos
 * -Palabras entre signos de puntuación u otros carácteres.
 * -Si se cambia el cursor y se modifica alguna palabra
 * No detecta:
 * -Palabras con algún caracter en medio: ton(to, (mier)da, etc.
 */

function FilterText() {
    wordsOmit = JSON.parse(document.getElementById("data").textContent);
    var textAreaContent = document.getElementById("comment-form").value;
    var everyWords = textAreaContent.split(/[\s,./()!¡¿?|@#~€{} \[ \] 0-9]+/);
    var wordToCheck = "";
    var wordToDelete = "";
    var banned = "";
    for (var i = 0; i < everyWords.length; i++) {
        for (var j = 0; j < wordsOmit.length; j++) {
            /**
             * Comparamos todas las palabras del comentario con cada palabra del array wordsOmit.
             * Esto evita que se pueda escribir la palabra entre () o [] por ejemplo.
             * Sería más eficiente comprobar solamente la última palabra escrita, pero no cumpliría lo anterior.
             */
            wordToCheck = everyWords[i];
            wordToDelete = wordToCheck;
            wordToCheck = wordToCheck.toLowerCase();
            wordToCheck = OmitAccent(wordToCheck);

            if (wordToCheck == wordsOmit[j]) {
                banned = "";
                for (var k = 0; k < wordToCheck.length; k++) {
                    banned += "*";
                }
                textAreaContent = textAreaContent.replace(wordToDelete, banned);
                document.getElementById("comment-form").value = textAreaContent;
            }
        }
    }
}



