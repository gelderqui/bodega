<template>
    <div id="layoutSidenav_content">
        <main>
            <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                <div class="container-xl px-4">
                    <div class="page-header-content pt-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto mt-4">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="filter"></i></div>
                                    Tables
                                </h1>
                                <div class="page-header-subtitle">An extension of the Simple DataTables library, customized for SB Admin Pro</div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main page content-->
            <div class="container-xl px-4 mt-n10">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Proveedores
                        <button type="button" @click="abrirModal('proveedor','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                        <option value="nombre">Nombre</option>
                                        <option value="contacto">Contacto</option>
                                        <option value="telefono">Telefono</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup="listarProveedor(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarProveedor(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Contacto</th>
                                    <th>Telefono</th>
                                    <th>Condicion</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="proveedor in arrayProveedor" :key="proveedor.id">
                                    <td v-text="proveedor.nombre"></td>
                                    <td v-text="proveedor.contacto"></td>
                                    <td v-text="proveedor.telefono"></td>
                                    <td>
                                        <div v-if="proveedor.condicion">
                                            <div class="badge bg-primary text-white rounded-pill">Activo</div>
                                        </div>
                                        <div v-else>
                                            <div class="badge bg-warning rounded-pill">Desactivado</div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" @click="abrirModal('proveedor','actualizar',proveedor)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil">Editar</i>
                                        </button> &nbsp;
                                        <template v-if="proveedor.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarProveedor(proveedor.id)">
                                                <i class="icon-trash">Eliminar</i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarProveedor(proveedor.id)">
                                                <i class="icon-check">Activar</i>
                                            </button>
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- agregar -->
        <div class="modal fade" :class="{'mostrar' : modal}" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel" v-text="tituloModal"></h5>
                        <button type="button" class="btn-close" @click="cerrarModal()" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre (*)</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" class="form-control" placeholder="Nombre del producto">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Contacto (*)</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="contacto" class="form-control" placeholder="Nombre del producto">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Telefono (*)</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="telefono" class="form-control" placeholder="Nombre del producto">
                                </div>
                            </div>
                            <div v-show="errorProveedor" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjProveedor" :key="error" v-text="error">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarProveedor()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarProveedor()">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
            <!-- Fin agregar -->
        </main>

        <footer class="footer-admin mt-auto footer-light">
            <div class="container-xl px-4">
                <div class="row">
                    <div class="col-md-6 small">Copyright &copy; Your Website 2021</div>
                    <div class="col-md-6 text-md-end small">
                        <a href="#!">Privacy Policy</a>
                        &middot;
                        <a href="#!">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        props: ['ruta'],
        data(){
            return{
                //listar
                arrayProveedor:[],
                buscar:'',
                criterio:'nombre',
                offset:3,
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },

                //Agregar-Editar
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                nombre: '',
                contacto:'',
                telefono:'',

                //Especialmente para editar
                proveedor_id: 0,

                //Validar Modal
                errorProveedor : 0,
                errorMostrarMsjProveedor : [],

            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;

            }
        },
        methods:{
            listarProveedor (page,buscar,criterio){
                let me=this;
                var url= this.ruta + '/proveedor?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProveedor = respuesta.proveedores.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarProveedor(page,buscar,criterio);
            },
            registrarProveedor(){
                if (this.validarProveedor()){
                    return;
                }

                let me = this;
                // console.log("registrar true");
                axios.post(this.ruta + '/proveedor/registrar',{
                    'nombre': this.nombre,
                    'contacto': this.contacto,
                    'telefono': this.telefono
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarProveedor(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarProveedor(){
               if (this.validarProveedor()){
                    return;
                }

                let me = this;

                axios.put(this.ruta + '/proveedor/actualizar',{
                    'nombre': this.nombre,
                    'contacto': this.contacto,
                    'telefono': this.telefono,
                    'id': this.proveedor_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarProveedor(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            desactivarProveedor(id){
               swal({
                title: 'Esta seguro de desactivar este proveedor?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put(this.ruta + '/proveedor/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarProveedor(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                }
                })
            },
            activarProveedor(id){
               swal({
                title: 'Esta seguro de activar este proveedor?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put(this.ruta + '/proveedor/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarProveedor(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                }
                })
            },
            validarProveedor(){
                this.errorProveedor=0;
                this.errorMostrarMsjProveedor =[];

                if (!this.nombre) this.errorMostrarMsjProveedor.push("El nombre del proveedor no puede estar vacío.");
                if (!this.contacto) this.errorMostrarMsjProveedor.push("El contacto no puede estar vacío.");
                if (!this.telefono) this.errorMostrarMsjProveedor.push("El telefono del Proveedor no puede estar vacío.");

                if (this.errorMostrarMsjProveedor.length) this.errorProveedor = 1;

                return this.errorProveedor;
            },
            cerrarModal(){
                this.modal=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "proveedor":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                console.log("hola");
                                this.modal = 1;
                                this.tituloModal = 'Registrar Proveedor';
                                this.tipoAccion = 1;
                                this.nombre= '';
                                this.contacto='',
                                this.telefono='';
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar Proveedor';
                                this.tipoAccion=2;
                                this.proveedor_id=data['id'];
                                this.nombre=data['nombre'];
                                this.contacto = data['contacto'];
                                this.telefono=data['telefono'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarProveedor(1,this.buscar,this.criterio);
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>