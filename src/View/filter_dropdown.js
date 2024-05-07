function showFilters(){
document.getElementById('options_dropdown').classList.toggle('show');
}

function preference(filtro){
    document.getElementById('btn_filters').innerText = filtro;
}

window.onclick = function(evento) {
    if(!evento.target.matches('filters_btn')){
        var dropdown = document.getElementById('filters_dropdown');
    }
}