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
                        <i class="fa fa-align-justify"></i> Facturas
                        <button type="button" v-show="btnNuevo" @click="crearDetalle()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <template v-if="listado==0">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select class="form-control col-md-3" v-model="criterio">
                                            <option value="numero">Numero Factura</option>
                                            <!-- <option value="cantidad">Cantidad</option> -->
                                        </select>
                                        <input type="text" v-model="buscar" @keyup="listarFactura(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarFactura(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Usuario</th>
                                        <th>Proveedor</th>
                                        <th>Serie</th>
                                        <th>Número</th>
                                        <th>Fecha Hora</th>
                                        <th>Total</th>
                                        <th>Descuento</th>
                                        <th>Felte</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="factura in arrayFactura" :key="factura.id">
                                        <td>
                                            <button type="button" @click="verFactura(factura.id)" class="btn btn-success btn-sm">
                                            <i class="icon-eye"></i>
                                            </button> &nbsp;
                                            <!-- <button type="button" @click="pdfIngreso(factura.id)" class="btn btn-info btn-sm">
                                            <i class="icon-doc"></i>
                                            </button> &nbsp; -->
                                            <template v-if="factura.estado=='Registrado'">
                                                <button type="button" class="btn btn-danger btn-sm" @click="desactivarIngreso(factura.id)">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            </template>
                                        </td>
                                        <td v-text="factura.nombre_usuario"></td>
                                        <td v-text="factura.nombre_proveedor"></td>
                                        <td v-text="factura.serie"></td>
                                        <td v-text="factura.numero"></td>
                                        <td v-text="factura.factura_created_at"></td>
                                        <td v-text="factura.total"></td>
                                        <td v-text="factura.descuento"></td>
                                        <td v-text="factura.flete"></td>
                                        <td v-text="factura.condicion"></td>
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
                    </template>
                    <template v-else-if="listado==1">
                        <div class="card-body">
                            <div class="form-group row border">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Proveedor</label>
                                        <p v-text="proveedor"></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fecha</label>
                                        <p v-text="createdAt"></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Serie</label>
                                    <p v-text="serie"></p>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Número</label>
                                        <p v-text="numero"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row border">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr align="center">
                                                <th>Producto</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="arrayDetalle.length">
                                            <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                                <td align="center" v-text="detalle.producto">
                                                </td>
                                                <td align="center" v-text="detalle.precio">
                                                </td>
                                                <td align="center" v-text="detalle.cantidad">
                                                </td>
                                                <td align="right">
                                                    {{(detalle.precio*detalle.cantidad).toFixed(2)}}
                                                </td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="3" align="right"><strong>Total Parcial:</strong></td>
                                                <td align="right">&nbsp; Q {{totalParcial=(calcularsubTotal).toFixed(2)}}</td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="3" align="right"><strong>Flete:</strong></td>
                                                <td align="right">+ Q {{flete}}</td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="3" align="right"><strong>Descuento:</strong></td>
                                                <td align="right">- Q {{descuentoNota}}</td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="3" align="right"><strong>Total Neto:</strong></td>
                                                <td align="right">&nbsp; Q {{total}}</td>
                                            </tr>
                                        </tbody>
                                        <tbody v-else>
                                            <tr>
                                                <td colspan="4">
                                                    NO hay artículos agregados
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </template>
                    <template v-else-if="listado==2">
                        <div class="card-body">
                            <div class="form-group row border">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Proveedor(*)</label>
                                        <v-select :on-search="selectProveedor" label="nombre" :options="arrayProveedor" placeholder="Sin proveedor" :onChange="getDatosProveedor" >
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Serie Factura(*)</label>
                                        <input type="text" class="form-control" v-model="serie" placeholder="ingrese serie factura">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Número Factura(*)</label>
                                        <input type="text" class="form-control" v-model="numero" placeholder="ingrese no. factura">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Flete(*)</label>
                                        <input type="text" class="form-control" v-model="flete" value='0.00'>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Descuento(*)</label>
                                        <input type="text" class="form-control" v-model="descuentoNota">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div v-show="errorFactura" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjFactura" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group row border">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Producto(*)</label>
                                        <v-select  v-model="select" :on-search="selectProducto" label="nombre" :options="arrayProducto" placeholder="Sin producto" :onChange="getDatosProducto">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Precio <span style="color:red;" v-show="precio==0">(*Ingrese)</span></label>
                                        <input type="number" value="0" step="any" class="form-control" v-model="precio">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Cantidad <span style="color:red;" v-show="cantidad==0">(*Ingrese)</span></label>
                                        <input type="number" value="0" class="form-control" v-model="cantidad">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button @click="agregarProductoDetalle()" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i>Agregar</button>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group row border">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Opciones</th>
                                                <th>Producto</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="arrayDetalle.length">
                                            <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                                <td>
                                                    <button @click="eliminarProductoDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                        <i class="icon-close"></i>
                                                    </button>
                                                </td>
                                                <td v-text="detalle.producto">
                                                </td>
                                                <td>
                                                    <input v-model="detalle.precio" type="number" value="3" class="form-control">
                                                </td>
                                                <td>
                                                    <input v-model="detalle.cantidad" type="number" value="2" class="form-control">
                                                </td>
                                                <td>
                                                    {{detalle.precio*detalle.cantidad}}
                                                </td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="4" align="right"><strong>Total Pracial:</strong></td>
                                                <td>Q {{totalParcial=calcularsubTotal}}</td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="4" align="right"><strong>Total Neto:</strong></td>
                                                <td>Q {{total=calcularTotal}}</td>
                                            </tr>
                                        </tbody>
                                        <tbody v-else>
                                            <tr>
                                                <td colspan="5">
                                                    NO hay productos agregados
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                    <button type="button" class="btn btn-primary" @click="registrarIngreso()">Registrar Compra</button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
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
    import vSelect from 'vue-select';
    export default {
        props : ['ruta'],
        data (){
            return {
                // listar
                arrayFactura : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : '',
                buscar : '',
                listado:0,
                // ver
                proveedor:'',
                createdAt:'',
                flete:0.0,
                serie:'',
                numero:0,
                descuentoNota:0.0,
                total:0.0,
                arrayDetalle:[],
                totalParcial:0.0,
                // Nuevo
                arrayProveedor:[],
                arrayProducto:[],
                idProveedor:0,
                idProducto:0,
                cantidad:0,
                precio:0.0,
                producto:'',
                select:0,
                btnNuevo:1,
                errorFactura:0,
                errorMostrarMsjFactura:[]
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
            },
            calcularsubTotal: function(){
                var resultado=0.0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    resultado=resultado+(this.arrayDetalle[i].precio*this.arrayDetalle[i].cantidad)
                }
                return resultado;
            },
            calcularTotal: function(){
                var resultado=0.0;
                resultado=resultado+(this.totalParcial-this.descuentoNota)+parseFloat(this.flete);
                return resultado;
            }
        },
        components: {
            vSelect
        },
        methods : {
            listarFactura (page,buscar,criterio){
                let me=this;
                var url= this.ruta + '/factura?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayFactura = respuesta.facturas.data;
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
                me.listarFactura(page,buscar,criterio);
            },
            verFactura(id){
                let me=this;
                me.listado=1;
                me.btnNuevo=0;
                // var date;

                //Obtener los datos del ingreso
                var arrayFacturaT=[];
                var url= this.ruta + '/factura/obtenerCabecera?id=' + id;

                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayFacturaT = respuesta.factura;
                    // console.log(arrayFacturaT);

                    me.proveedor = arrayFacturaT['nombre'];
                    me.flete=arrayFacturaT['flete'];
                    me.serie=arrayFacturaT['serie'];
                    me.numero=arrayFacturaT['numero'];
                    me.descuentoNota=arrayFacturaT['descuento_nota'];
                    me.total=arrayFacturaT['total'];
                    me.createdAt=arrayFacturaT['factura_created_at'];
                    // console.log(arrayFacturaT);
                    // date=arrayFacturaT['created_at'];
                    // me.createdAt=date.substr(8,2)+'-'+date.substr(5,2)+'-'+date.substr(0,4);
                })
                .catch(function (error) {
                    console.log(error);
                });

                //Obtener los datos de los detalles
                var urld= this.ruta + '/factura/obtenerDetalles?id=' + id;

                axios.get(urld).then(function (response) {
                    // console.log(response);
                    var respuesta= response.data;
                    // console.log(respuesta);
                    me.arrayDetalle = respuesta.detalles;
                    console.log(me.arrayDetalle);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            ocultarDetalle(){
                let me=this;
                me.listado=0;
                me.btnNuevo=1;
            },
            crearDetalle(){
                let me=this;
                me.listado=2;
                me.btnNuevo=0;

                me.proveedor ="";
                me.flete=0.00;
                me.serie="";
                me.numero="";
                me.descuentoNota=0.00;
                me.total=0.00;
                me.createdAt="";
                me.arrayDetalle=[];
                me.cantidad=0;
                me.precio=0.0;
            },
            selectProveedor(search,loading){
                let me=this;
                loading(true)

                var url= this.ruta + '/proveedor/selectProveedor?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q: search
                    me.arrayProveedor=respuesta.proveedores;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosProveedor(val1){
                let me = this;
                me.loading = true;
                me.idProveedor = val1.id;
            },
            selectProducto(search,loading){
                let me=this;
                loading(true)

                var url= this.ruta + '/producto/selectProducto?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q: search
                    me.arrayProducto=respuesta.productos;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosProducto(val1){
                let me = this;
                me.loading = true;
                me.idProducto = val1.id;
                me.producto = val1.nombre;
            },
            encuentraProductoDetalle(id){
                var sw=0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    if(this.arrayDetalle[i].idProducto==id){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarProductoDetalle(index){
                let me = this;
                me.arrayDetalle.splice(index, 1);
            },
            agregarProductoDetalle(){
                let me=this;
                if(me.idProducto==0 || me.cantidad==0 || me.precio==0){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Error LLEnar todos los datos!',
                    })
                }
                else{
                    if(me.encuentraProductoDetalle(me.idProducto)){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese artículo ya se encuentra agregado!',
                            })
                    }
                    else{
                       me.arrayDetalle.push({
                            idProducto: me.idProducto,
                            producto: me.producto,
                            cantidad: me.cantidad,
                            precio: me.precio
                        });
                        me.producto='';
                        me.idProducto=0;
                        me.cantidad=0;
                        me.precio=0;
                        //Setea el atributo select
                        me.select=0;
                    }
                }
            },
            validarIngreso(){
                this.errorFactura=0;
                this.errorMostrarMsjFactura =[];

                if (this.idProveedor==0) this.errorMostrarMsjFactura.push("Seleccione un Proveedor");
                if (this.serie=='') this.errorMostrarMsjFactura.push("Ingrese serie");
                if (this.numero==0) this.errorMostrarMsjFactura.push("Ingrese el número de factura");
                if (this.arrayDetalle.length<=0) this.errorMostrarMsjFactura.push("Ingrese detalles");

                if (this.errorMostrarMsjFactura.length) this.errorFactura = 1;

                return this.errorFactura;
            },
            registrarIngreso(){
                if (this.validarIngreso()){
                    return;
                }
                let me = this;

                axios.post(this.ruta + '/factura/registrar',{
                    'idproveedor': this.idProveedor,
                    'numero' : this.numero,
                    'serie' : this.serie,
                    'total' : this.total,
                    'totalparcial' :this.totalParcial,
                    'descuento' : this.descuentoNota,
                    'flete' : this.flete,
                    'data': this.arrayDetalle

                }).then(function (response) {
                    me.listado=0;
                    me.btnNuevo=1;
                    me.idproveedor=0;
                    me.serie='';
                    me.numero=0;
                    me.total=0.0;
                    me.idproducto=0;
                    me.producto='';
                    me.cantidad=0;
                    me.precio=0;
                    me.arrayDetalle=[];
                    me.listarFactura(1,'','nombre');

                }).catch(function (error) {
                    console.log(error);
                });
            },
        },
        mounted() {
            this.listarFactura(1,this.buscar,this.criterio);
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
    @media (min-width: 600px) {
        .btnagregar {
            margin-top: 2rem;
        }
    }
</style>
