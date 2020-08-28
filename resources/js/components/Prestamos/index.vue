<template>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div>
                                <h4>Lista de Prestamos</h4>
                            </div>
                            <div>
                                <input type="text" class="form-control mr-50" placeholder="Buscar" v-model="searchFillter" @keyup="searchPrestamo">
                            </div>
                            <div>&nbsp&nbsp
                                <router-link :to="{name:'prestamoCreate'}" class="btn btn-success">Nuevo Prestamo</router-link>
                            </div>
                        </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tbody><tr>

                                    <th>Solicitó</th>
                                    <th>Material</th>
                                    <th>Administrador</th>
                                    <th>Cantidad</th>
                                    <th>Devolvió</th>
                                    <th>Fecha Prestamo</th>
                                    <th>Fecha Devolucion</th>
                                    <th>Estado</th>
                                    <th colspan="2">Accion</th>
                                </tr>
                                <tr v-for="prestamo in searchPrestamo" :key="prestamo.id">
                                    <td v-if="prestamo.persona != null">{{prestamo.persona.nombre}} {{prestamo.persona.apellido}}</td>
                                    <td v-if="prestamo.material != null">{{prestamo.material.nombre}} {{prestamo.material.modelo}}</td>
                                    <td v-if="prestamo.user != null">{{prestamo.user.name}}</td>
                                    <td>{{prestamo.cantidad_prestamo}}</td>
                                    <td v-if="prestamo.persona != null">{{prestamo.persona.nombre}} {{prestamo.persona.apellido}}</td>
                                    <td>{{prestamo.fecha_prestamo}}</td>
                                    <td>{{prestamo.fecha_devolucion}}</td>

                                    <td>
                                        <div v-if="prestamo.status == 1 " class="badge badge-success">Pendiente</div>
                                        <div v-else class="badge badge-danger">Devuelto</div>
                                    </td>


                                    <td colspan="1">
                                        <router-link :to="{name:'prestamoEdit',params:{id:prestamo.id}}" class="btn-sm btn-info"><i class="fas fa-edit">Devolver</i></router-link>
                                    </td>
                                    <td colspan="1">
                                        <a @click="prestamoDel(prestamo.id)" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "index",
        data(){
            return {
                prestamos:[],
                searchFillter:'',
            }
        },
        methods:{
            listarPrestamo(){
                axios.get('api/prestamos')
                    .then(res=>{
                        this.prestamos = res.data;
                        console.log(this.prestamos);
                        console.log(res.data)
                    }).catch(error=>{console.log(error.response.data)});
            },
            prestamoDel(id){
                Swal.fire({
                    title: 'Está seguro?',
                    text: "No prodrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/prestamos/'+id)
                            .then(()=>{
                                Toast.fire({
                            icon: 'success',
                            title: 'Detalle Prestamos'

                        });
                                this.prestamos = this.prestamos.filter(prestamo=>{
                                    return prestamo.id != id;
                                })
                            }).catch(()=>{
                            this.$router.push({name:'prestamoIndex'})
                        })
                        }

                })
            }
        },
        created() {
            this.listarPrestamo();
        },
        mounted() {
            if(!User.loggedIn()){
                Toast.fire({
                    icon: 'warning',
                    title: 'Inicia sesión primero!',
                });
                this.$router.push({name:'login'})
            }

        },
        computed:{
            searchPrestamo(){
                return this.prestamos.filter(prestamo=>{
                    return prestamo.persona.nombre.match(this.searchFillter);
                })
            }
        }
    }
</script>

<style scoped>

</style>
