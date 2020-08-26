// auth routes
let login = require('./components/Auth/Login.vue').default;
let register = require('./components/Auth/Register.vue').default;
let logout = require('./components/Auth/Logout.vue').default;
// dashboard routes
let home = require('./components/Home.vue').default;




// tipo routes
let tipoCreate = require('./components/Tipo/create.vue').default;
let tipoIndex = require('./components/Tipo/index.vue').default;
let tipoEdit = require('./components/Tipo/edit.vue').default;





// persona routes
let personaCreate = require('./components/Persona/create.vue').default;
let personaIndex = require('./components/Persona/index.vue').default;
let personaEdit = require('./components/Persona/edit.vue').default;
//let stock = require('./components/Product/stock.vue').default;


// material routes
let materialCreate = require('./components/Material/create.vue').default;
let materialIndex = require('./components/Material/index.vue').default;
let materialEdit = require('./components/Material/edit.vue').default;
//let materialstock = require('./components/Material/stock.vue').default;


let prestamoCreate = require('./components/Prestamos/create.vue').default;
let prestamoIndex = require('./components/Prestamos/index.vue').default;
let prestamoEdit = require('./components/Prestamos/edit.vue').default;



// Registro Inventario
let devueltosIndex = require('./components/InventarioPrestamos/devueltos.vue').default;
let pendientesIndex = require('./components/InventarioPrestamos/pendientes.vue').default;

let disponible = require('./components/Material/disponible.vue').default;
let ocupado = require('./components/Material/ocupado.vue').default;






export const routes = [
    { path: '/', component: login, name: 'login' },
    { path: '/register', component: register, name: 'register' },
    { path: '/logout', component: logout, name: 'logout' },

    { path: '/home', component: home, name: 'home' },


    // --tipo routes
    { path: '/add-tipo', component: tipoCreate, name: 'tipoCreate' },
    { path: '/tipos', component: tipoIndex, name: 'tipoIndex' },
    { path: '/tipo-edit/:id', component: tipoEdit, name: 'tipoEdit' },




    // -- persona routes
    { path: '/add-persona', component: personaCreate, name: 'personaCreate' },
    { path: '/personas', component: personaIndex, name: 'personaIndex' },
    { path: '/persona-edit/:id', component: personaEdit, name: 'personaEdit' },
    //{ path: '/stocks', component: stock, name: 'stock' },



    // material routes
    { path: '/add-material', component: materialCreate, name: 'materialCreate' },
    { path: '/materials', component: materialIndex, name: 'materialIndex' },
    { path: '/material-edit/:id', component: materialEdit, name: 'materialEdit' },
    //{ path: '/stocks', component: stock, name: 'stock' },


    // prestamo routes
    { path: '/add-prestamo', component: prestamoCreate, name: 'prestamoCreate' },
    { path: '/prestamos', component: prestamoIndex, name: 'prestamoIndex' },
    { path: '/prestamo-edit/:id', component: prestamoEdit, name: 'prestamoEdit' },


    // Registro Pendientes Devueltos
    { path: '/devueltos', component: devueltosIndex, name: 'devueltosIndex' },
    { path: '/pendientes', component: pendientesIndex, name: 'pendientesIndex' },

    { path: '/disponible', component: disponible, name: 'disponible' },
    { path: '/ocupado', component: ocupado, name: 'ocupado' },




];