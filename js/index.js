import misProductos from '../productos.json' assert {type: 'json'};
// 'use strict';

/*
 *  Alsinet Nicolas
 */
/*Declaracion de Constantes */
const d = document
const htmlProductos = d.querySelector('#productos');
const exampleModal = d.getElementById('modalContactoDojos');
const btnVaciarCarrito = d.getElementById('vaciarCarrito');
const selectorCategoria = d.getElementById('categoria-producto');
const selectorOrdenar = d.getElementById('ordenar-producto');
const descuento = d.getElementById('descuento');
const btn_miniCarrito = d.querySelectorAll('.minicarrito-cantidad');
// Declaracion de Clases
/**
 * Clase Productos con sus metodos
 */
class Producto {

    /**
     * 
     * @param {Id del producto} id 
     * @param {Nombre del Producto} nombre 
     * @param {Descripcion de card} descrip 
     * @param {Descripcion del modal} descrip_larga 
     * @param {Precio} precio 
     * @param {Array de Imagenes} imagen 
     * @param {Array de text alt de imagenes} altImagen 
     * @param {categoria} categoria 
     */
    constructor(id,nombre, descrip, descrip_larga, precio, imagen,altImagen, categoria) {
        this.id = id;
        this.nombre = nombre;
        this.descrip = descrip;
        this.descrip_larga = descrip_larga;
        this.precio = precio;
        this.imagen = imagen;
        this.altImagen = altImagen
        this.categoria = categoria;
        this.card = this.crearHTMLproductoCard()
    };
    /**
     * Toma los datos del producto y crea el div con el precio y el boton de agregar a carrito
     * @returns div con los 2 elementos
     */
    creaPrecioBoton () {
        let productoPrecio = d.createElement('span');
        productoPrecio.className = 'col';
        productoPrecio.innerHTML = `$${this.precio}.00`;
        let productoBoton = d.createElement('button');
        productoBoton.className = 'btn btn-komei col';
        productoBoton.id = `${this.id}boton_agregar`;
        productoBoton.innerHTML = `Agregar <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16"><path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>`;
        productoBoton.addEventListener('click', (e) => {
            let boton = e.target;
            for (let i = 0; i < productos.length; i++) {
                if (parseInt(boton.id) == productos[i].id) {
                    carrito.agregar(productos[i])
                    break
                }
            }
            mostrarMiniCarrito();
        })
        let precioBoton = document.createElement('div');
        precioBoton.className = 'row px-2';
        precioBoton.append(productoPrecio, productoBoton);
        return precioBoton;
    }
    /**
     * Crea los elementos y los agrupa en un nodo
     * Crea el boton que escucha el evento click para abrir el modal del descript 
     * @returns Nodo de html con todos los elemntos de body de las tarjetas de productos
     */
    creaCardBody () {
        let productoNombre = d.createElement('h3');
        productoNombre.setAttribute('type', 'button');
        productoNombre.setAttribute('class', ' card-title titulocard');
        productoNombre.setAttribute('data-bs-toggle', 'modal');
        productoNombre.setAttribute('data-bs-target', '#ProductoModal')
        productoNombre.id = `${this.id}boton_mostrar`;
        productoNombre.addEventListener('click', (e) => {
            let boton = e.target;
            for (let i = 0; i < productos.length; i++) {
                if (parseInt(boton.id) == productos[i].id) {
                    productos[i].agregarDatosModal();
                    break
                }
            }
        })
        productoNombre.innerHTML = this.nombre;
        let productoDescrip = d.createElement('p');
        productoDescrip.className = 'card-text';
        productoDescrip.innerHTML = this.descrip;
        let precioBoton = this.creaPrecioBoton()
        let productoText = d.createElement('div');
        productoText.className = 'card-body';
        productoText.append(productoNombre, productoDescrip, precioBoton);
        return productoText;
    }
    /**
     * Genera todos los elementos que iran a las pastillas y llama a las funciones necesarias
     * @returns Nodo completo con la pastilla de producto
     */
    crearHTMLproductoCard(){
        let productoImg = d.createElement('img');
        productoImg.className = 'card-img-top';
        productoImg.setAttribute('src', this.imagen[0]);
        productoImg.setAttribute('alt', this.altImagen[0]);
        let productoCategoria = d.createElement('span');
        productoCategoria.className = 'mx-2 ms-auto';
        productoCategoria.innerHTML = this.categoria;
        let productoText = this.creaCardBody ();
        let productoCard = d.createElement('div');
        productoCard.className = 'card tarjetas-producto'
        productoCard.append(productoImg, productoCategoria, productoText);
        let col = d.createElement('div');
        col.className = 'col';
        col.append(productoCard);
        return col;
    }
    /**
     * Toma un elemento y le agrega el escuchhador del evento click para ejecutar la funcion que agrega los valores al mini carrito dentro del modal del producto
     */
    agregarBotonModal() {
        let boton = d.getElementById('botonProducto').children[0];
        if (boton.id == 'cambiarIDBoton') {
            boton.innerHTML = `Agregar <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16"><path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>`;
            boton.addEventListener('click', (e) => {
                let boton = e.target;
                for (let i = 0; i < productos.length; i++) {
                    if (parseInt(boton.id) == productos[i].id) {
                        carrito.agregar(productos[i])
                        break
                    }
                }
                mostrarMiniCarrito();
            })
        }
        boton.id = `${this.id}productoboton`;
    }
    /**
     * Crea el modal del producto
     * Toma los elementos del modal y modifica sus valores
     */
    agregarDatosModal() {
        d.getElementById('tituloProducto').innerHTML = this.nombre
        let carrousel = d.getElementById('carrusel-producto').children;
        for (let i = 0; i < carrousel.length; i++) {
            carrousel[i].innerHTML = '';
            let img = d.createElement('img');
            img.setAttribute('src', this.imagen[i]);
            img.setAttribute('alt', this.altImagen[i]);
            img.setAttribute('class', 'd-block w-100');
            carrousel[i].appendChild(img);
        }
        d.getElementById('categoriaProducto').innerHTML = this.categoria;
        d.getElementById('descripProducto').innerHTML = this.descrip_larga;
        d.getElementById('precioProducto').innerHTML = this.precio;
        d.getElementById('precioCuotas').innerHTML = (this.precio / 6).toFixed(2);
        this.agregarBotonModal();
    }
};
/**
 * Clase para el carrito
 */
class Carrito {
    
    /**
     *Se pusheando productos de la clase producto 
     */
    constructor (){
        this.producto = [];
    }
    /**
     * 
     * @param {Objeto de la clase Producto} objeto 
     */
    agregar(objeto){
        this.producto.push(objeto);
        this.producto.sort((a,b) => {
            return a.id - b.id;
        });
        agregarlocal ()
    }
    agregarstorage (array) {
        for (let i = 0; i < array.length; i++){
            this.agregar (array[i]);
        }
    }

    /**
     * 
     * @param {Clase de los elementos a buscar en el DOM} clase 
     * @param {Valor a modificar} valor 
     */
    armarMiniCarrito (clase, valor) {
        let span = d.getElementsByClassName(clase);
        for (let i = 0; i < span.length; i++){
            span[i].innerHTML = valor
        }
    }
    /**
     * Toma todos los productos ingresados en el carrito y suma su precio
     * @returns devuelve numero total de la suma de todos los precios agregados
     */
    calcularTotal() {
        let total = 0;
        for (let i = 0; i < carrito.producto.length; i++) {
            total += parseInt(this.producto[i].precio);
        }
        return total
    }
    /**
     * 
     * @param {Ingresa valor del index para modificar las clases} i 
     * @returns Devuelve un nodo de HTML con el boton para eliminar producto del carrito
     */
    creaBotonCerrar(i){
        let divBtnCerrar = d.createElement('div');
        divBtnCerrar.setAttribute('class', `productoCarritoCerrar ms-auto d-flex puntero`);
        divBtnCerrar.id = `${i}carritoProducto`
        let spanCerrar = d.createElement('span');
        spanCerrar.innerHTML = `<span id="${i}spanProducto" class="me-1"></span><svg id="${i}svgProducto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
        <path id="${i}pathProducto" d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
      </svg>`;
        divBtnCerrar.addEventListener('click', (e) => {
            let boton = e.target;
            let index = parseInt(boton.id);
            carrito.producto.splice((index),1)
            carrito.armarCarrito();
            mostrarMiniCarrito () 
            agregarlocal ()
        })
        divBtnCerrar.append(spanCerrar);
        return divBtnCerrar;
    } 
    /**
     * 
     * @param {Index del producto dentro del array de carrito} i 
     * @returns devuelve un NODO HTML con todos lo elementos que conforman el producto en el carrito
     */
    armarCarritoContenedores(i) {
        let divImagen = d.createElement('div');
        divImagen. setAttribute('class', 'productoCarritoImagen mx-auto');
        let imagen = d.createElement('img');
        imagen.setAttribute('src', this.producto[i].imagen[0]);
        imagen.setAttribute('alt', this.producto[i].altImagen[0]);
        imagen.setAttribute('class', 'rounded-2');
        divImagen.appendChild(imagen);
        let divTexto = d.createElement('div');
        divTexto. setAttribute('class', 'productoCarritoTexto my-auto');
        let pTitulo = d.createElement('p');
        let pDescrip = d.createElement('p');
        pTitulo.innerHTML = this.producto[i].nombre;
        pTitulo.setAttribute('class', 'h4');
        pDescrip.innerHTML = this.producto[i].descrip;
        divTexto.append(pTitulo, pDescrip);
        let divPrecio = d.createElement('div');
        divPrecio.setAttribute('class', 'productoCarritoPrecio ms-auto');
        divPrecio.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
        <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
        </svg>`;
        let spanPrecio = d.createElement('span');
        spanPrecio.id = `${i}productoCarritoPrecio`;
        spanPrecio.innerHTML = this.producto[i].precio;
        divPrecio.appendChild(spanPrecio);
        let divCerrar = this.creaBotonCerrar(i);
        let divContenedor = d.createElement('div');
        divContenedor.setAttribute('class', 'contenedor rounded-2')
        divContenedor.append(divImagen, divTexto, divCerrar, divPrecio);
        return divContenedor
    }
    armarCarritoVacio () {
        let contenedorProductosCarrito = d.getElementById('contenedorProductosCarrito');
        contenedorProductosCarrito.innerHTML = '';
        let iconoVacio = d.createElement('p');
        iconoVacio.setAttribute('class', 'text-center mt-4');
        iconoVacio.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-clipboard-x" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708z"/>
        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
        <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
        </svg>`
        let textoVacio = d.createElement('p');
        textoVacio.setAttribute('class', 'text-center h3');
        textoVacio.innerHTML = `Tu carrito está vacio.`
        contenedorProductosCarrito.append(iconoVacio, textoVacio)
        d.getElementById('carritoPrecioProducto').innerHTML = `0.00`;
        d.getElementById('carritoPrecioTotalCuota').innerHTML = `0.00`;
    }
    /**
     * Itera el metodo armarCarritoContenedores por cada producto en el array carrito
     * agrega el valor y las cuotas 
     */
    precioTotal(modificador = 1) {
        d.getElementById('carritoPrecioProducto').innerHTML = (modificador * this.calcularTotal());
        d.getElementById('carritoPrecioTotalCuota').innerHTML = (modificador * (this.calcularTotal() / 6).toFixed(2));
    }
    armarCarrito(){
        if (carrito.producto.length == 0) {
            this.armarCarritoVacio ();
        }else {
            let contenedorProductosCarrito = d.getElementById('contenedorProductosCarrito');
            contenedorProductosCarrito.innerHTML = '';
            let cantidad = 0;
            let j;
            for (let i = 0; i < carrito.producto.length; i++) {   
                if ( i == 0) {
                    j = i;
                    contenedorProductosCarrito.appendChild(this.armarCarritoContenedores(i));
                    cantidad++;
                    d.getElementById(`${j}spanProducto`).innerHTML = cantidad;
                } else if (this.producto[i].id == this.producto[i-1].id){
                    cantidad ++;
                    d.getElementById(`${j}spanProducto`).innerHTML = cantidad;
                    d.getElementById(`${j}productoCarritoPrecio`).innerHTML = cantidad * carrito.producto[j].precio;
                } else if (this.producto[i].id != this.producto[i-1].id) {
                    j = i;
                    contenedorProductosCarrito.appendChild(this.armarCarritoContenedores(i));
                    cantidad = 1;
                    d.getElementById(`${j}spanProducto`).innerHTML = cantidad;
                }           
            }
            this.precioTotal();
        }
    }
};
/* Armado de Objetos */
// Se declaran la productos y se ejecuta la funcion cargar productos que itera y crea el array de productos de clase Producto
let productos = [];
cargarProductos(misProductos);

// Se declara el objeto carrito de clase Carrito
let carrito = new Carrito;

function agregarlocal () {
    let jsonobject = JSON.stringify(carrito.producto);
    localStorage.setItem('carrito', jsonobject);
}
function traerlocal () {
    let parseobject = localStorage.getItem('carrito');
    let localCarrito = JSON.parse(parseobject);
    return localCarrito;
}
/**
 * Itera la creacion de nuevos Productos
 * @param {Objeto JSON} data 
 */
function cargarProductos(data) {
    for (let i = 0; i < data.productos.length; i++) {
       let producto = new Producto (data.productos[i].id, data.productos[i].nombre, data.productos[i].descrip, data.productos[i].descrip_larga, data.productos[i].precio, data.productos[i].imagen, data.productos[i].altImagen, data.productos[i].categoria);
       productos.push(producto);
    }
}
/**
 * Toma el nodo donde se van mostrar todas las tarjetas de productos y agrega las cards de cada producto
 * @param {Array de productos} array 
 */
function mostrarProductos (array) {
    htmlProductos.innerHTML = '';
    for (let i = 0; i < array.length; i++) {
        htmlProductos.appendChild(array[i].card);
    }
}
/**
 * Ejecuta los metodos del carrito para agregar los valores de cantidad y precio
 */
function mostrarMiniCarrito () {
    carrito.armarMiniCarrito('minicarrito-cantidad', carrito.producto.length);
    carrito.armarMiniCarrito('minicarrito-precio', carrito.calcularTotal());
}
/**
 * 
 * @param {Toma el valor del selector de categorias y filtra los productos por ese valor} valor 
 * @returns array de productos filtrados
 */
function filtrarProductos(valor) {
    let productosFiltrados = [];
    for (let i = 0; i < productos.length; i++) {
        if (productos[i].categoria == valor) {
            productosFiltrados.push(productos[i]);
        }
    }
    productos = productosFiltrados;
    return productos
}
function ordenarProductos() {
    switch (selectorOrdenar.value) {
        case 'relevancia':
            productos.sort((a,b) => {
                return a.id - b.id;
            });
            break;
        case 'mayor':
            productos.sort((a,b) => {
                return b.precio - a.precio;
            });
            break;
        case 'menor':
            productos.sort((a,b) => {
                return a.precio - b.precio;
            });
            break;
    }

    return productos
}
function validardescuento (valor) {
    switch (valor) {
        case 'Descuento10':
            return 0.9
        case 'Descuento20':
            return 0.8
        case 'Descuento30':
            return 0.7
        default:
            return 1
    }

}

/**
 * Agregar el event listener al boton del carrito para ejecutar el modal
 */
function btn_carrito() {
    for (let i = 0; i < btn_miniCarrito.length; i++){
        btn_miniCarrito[i].parentNode.addEventListener('click', () => {
            carrito.armarCarrito();
        })
    }
}
btnVaciarCarrito.addEventListener('click', () => {
    carrito.producto = []
    mostrarMiniCarrito () 
    carrito.armarCarrito();
    let jsonobject = JSON.stringify(carrito.producto);
    localStorage.setItem('carrito', jsonobject);
})
/**
 * Agrega el event listener 'change' en el selector de categoria y de ser necesario ejecuta la funcion filtrar y los muestra
 */
selectorCategoria.addEventListener('change', () => {
    productos = [];
    cargarProductos(misProductos);
    if (selectorCategoria.value == 'Todas') {
        mostrarProductos (productos);
    } else {
        mostrarProductos (filtrarProductos(selectorCategoria.value));
    }
})

selectorOrdenar.addEventListener('change', () => {
    mostrarProductos (ordenarProductos());
})

descuento.addEventListener('click', () => {
    let valor;
    if (!d.getElementById('cupon-descuento').value) {
        console.log('meg')
    } else {
        valor = validardescuento(d.getElementById('cupon-descuento').value);
        carrito.precioTotal(valor);
        d.getElementById('cupon-descuento').value = '';
    }
})
// d.getElementById('cupon-descuento').addEventListener('keypress', (e) => {
//     if (e.keycode == 13) {
//         e.preventDefault()
//         console.log(e);
//         let valor;
//         if (!d.getElementById('cupon-descuento').value) {
//             console.log('meg')
//         } else {
//             valor = validardescuento(d.getElementById('cupon-descuento').value);
//             carrito.precioTotal(valor);
//             d.getElementById('cupon-descuento').value = '';
//         }
//     }
// })
/**
 * Se ejecutan las primeras funciones de carga al iniciar la pagina
 */
mostrarProductos (productos);
btn_carrito();
if (localStorage.length > 0) {
    carrito.agregarstorage(traerlocal());
    mostrarMiniCarrito();
}
/**
 * Funciones de Bootstrap
 */
exampleModal.addEventListener('show.bs.modal', event => {
  // Button that triggered the modal
  const button = event.relatedTarget;
  // Extract info from data-bs-* attributes
  const recipient = button.getAttribute('data-bs-whatever');
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  const modalTitle = exampleModal.querySelector('.modal-title');
  const modalBodyInput = exampleModal.querySelector('.modal-body input');

  modalTitle.textContent = `Mensaje Nuevo ${recipient}`;
  modalBodyInput.value = recipient;
})