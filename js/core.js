/*
    Sistema de Busca de dados na web: findingweb
    Feito por Fabiano Moreira - fabianomoreira.ti@gmail.com - jul/2020
    Github: https://github.com/fmoreirati/findIngWeb
    Teste on-line:  http://fabianomoreira.gratisphphost.info/findingweb/
    Núcleo de solicitação de busca e tratamento de resultado em JS
*/


//Search ----------------------
function search(query, quants) {
    let url = "http://localhost/findingweb/api/" + query + "/" + quants;
    alerts()
    if (query) {
        alerts("Pesquisando por " + query + " !", "warning", true);
        searchFeedback(true)
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                listResult(this.responseText);
                searchFeedback(false);
                alerts("Busca finalizada!", "success", true);
            } else if (this.status == 404 || this.status == 302) {
                alerts("Erro ao acessar aos dados. Por favor, tente mais tarde!", "danger", true);
            }
            this.ontimeout = function (e) {
                if (this.statusText == "") {
                    alerts("Erro ao acessar aos dados. Por favor, tente mais tarde!", "danger", true);
                }
            }
        };
        xhttp.open("GET", url, true);
        xhttp.timeout = 5000;
        xhttp.send();
    } else {
        alerts("Campo Obrigatório", "danger", true)
    }
}


// View -------------------
function listResult(list) {
    let objAll = JSON.parse(list);
    let txt = "<table class='table'><tr> <th>Resultados: " + objAll.length + "</th> <tr>";

    for (obj of objAll) {
        txt += "<tr><td> <b>Nome</b>: " + obj.name + "<br> <b>Acesso:</b> <a href='" + obj.link + "' target='_blank'>" + obj.link + "</a> </td></tr>";
    }

    txt += "</table>";
    view(txt);
}


function view(text) {
    document.querySelector("#view").innerHTML = text
}


function alerts(text = "", type = "", status = false) {
    let obj = document.querySelector("#alerts");
    let view = "display:none";
    if (status) {
        view = "display:block";
    }
    switch (type) {
        case "danger":
            obj.className = "alert alert-danger";
            break;
        case "success":
            obj.className = "alert alert-success";
            break;
        case "warning":
            obj.className = "alert alert-warning";
            break;
    }
    obj.innerHTML = text;
    obj.style = view;
}


function searchFeedback(status, text = 'Pesquisando...') {
    let view = "display:none";
    let obj = document.querySelector("#status");
    if (status) {
        view = "display:block";
    }
    obj.innerHTML = text;
    obj.style = view;
}