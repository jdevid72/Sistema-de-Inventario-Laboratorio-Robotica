<template>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div>
                                <h4>Lista Tipo Persona</h4>
                            </div>
                            <div>
                                <input type="text" class="form-control mr-50" placeholder="Buscar" v-model="searchData" @keyup="searchFillter">
                            </div>
                            <div>&nbsp&nbsp
                                <router-link :to="{name:'tipoCreate'}" class="btn btn-success">Nuevo Tipo</router-link>
                            </div>
                        </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tbody>
                                <tr>
                                    <th>Descripcion</th>
                                    <th>Accion</th>
                                </tr>
                                <tr v-for="tipo in searchFillter" :key="tipo.id">
                                    <td>{{tipo.descripcion}}</td>
                                    <td>
                                        <router-link :to="{name:'tipoEdit',params:{id:tipo.id}}" class="btn-sm btn-info"><i class="fas fa-edit"></i></router-link>
                                        <a @click="eliminarTipo(tipo.id)" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
                tipos:[],
                searchData:'',
            }
        },
        methods:{
            listarTipos(){
                axios.get('api/tipos')
                    .then(res=>{
                        this.tipos = res.data;
                    }).catch(error=>{console.log(error.response.data)});
            },
            eliminarTipo(id){
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
                        axios.delete('api/tipos/'+id)
                            .then(()=>{
                                Notification.error();
                                this.tipos = this.tipos.filter(tipo=>{
                                    return tipo.id != id;
                                })
                            }).catch(()=>{
                            this.$router.push({name:'tipoIndex'})
                        })
                    }

                })
            }
        },
        created() {
            this.listarTipos();
        }
        ,
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
            searchFillter(){
                return this.tipos.filter(tipo=>{
                    return tipo.descripcion.match(this.searchData);
                })
            }
        }
    }
</script>

<style scoped>

</style>
