document.getElementById("usarFiltro").addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar que el formulario se envíe normalmente

    // Obtener los valores del formulario
    var tipoVivienda = document.getElementById("tipo_vivienda").value;
    var zona = document.getElementById("zona").value;
    var dormitorios = document.querySelector(`input[name="dormitorios"]:checked`);
    var precio = document.querySelector(`input[name="precio"]:checked`);
    var tamano = document.querySelector(`input[name="tamano"]:checked`);
    if(!dormitorios){
        dormitorios=""
    }else{
        dormitorios = document.querySelector(`input[name="dormitorios"]:checked`).value;
    }
    if(!precio){
        precio =""
    }else{

        precio = document.querySelector(`input[name="precio"]:checked`).value;
    }
    if(!tamano){
        tamano =""
    }else{
        tamano = document.querySelector(`input[name="tamano"]:checked`).value;

    }
    console.log(tipoVivienda);
    console.log(zona);
    console.log(dormitorios);
    console.log(precio);
    console.log(tamano);
    // Construir la URL con los parámetros
    var url = "../Api/filtro.php?" +
        "tipo_vivienda=" + encodeURIComponent(tipoVivienda) +
        "&zona=" + encodeURIComponent(zona) +
        "&dormitorios=" + encodeURIComponent(dormitorios) +
        "&precio=" + encodeURIComponent(precio) +
        "&tamano=" + encodeURIComponent(tamano);
console.log(url);
    // Realizar la solicitud fetch
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error ${response.status}: ${response.statusText}`);
            }
            return response.json(); // o response.text(), response.blob(), etc., según el contenido esperado
        })
        .then(data => {

        })

});