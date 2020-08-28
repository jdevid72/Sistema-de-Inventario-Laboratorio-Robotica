<template>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div>
                                <h4>Lista de Materiales de Laboratorio</h4>
                            </div>
                            <div>
                                <input type="text" class="form-control mr-50" placeholder="Buscar" v-model="searchFillter" @keyup="searchMaterial">
                            </div>
                            <div>&nbsp&nbsp
                                <router-link :to="{name:'materialCreate'}" class="btn btn-success">Agregar Material</router-link>
                            </div>
                        </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tbody><tr>

                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Modelo</th>
                                    <th>Caracteristica</th>
                                    <th>Cantidad Total</th>
                                    <th>Cantidad Prestamo</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th colspan="2">Accion</th>
                                </tr>
                                <tr v-for="material in searchMaterial" :key="material.id">

                                    <td><img :src="material.imagen" alt="image" style="width:60px;height:50px"></td>
                                    <td>{{material.nombre}}</td>
                                    <td>{{material.modelo}}</td>
                                    <td>{{material.caracteristicas}}</td>
                                    <td>{{material.cantidad_total}}</td>
                                    <td>{{material.cantidad_prestamo}}</td>
                                    <td>{{material.fecha}}</td>



                                    <td>
                                        <div v-if="material.status == 1" class="badge badge-success">Disponible</div>
                                        <div v-else class="badge badge-danger">No Disponible</div>
                                    </td>


                                    <td colspan="1">
                                        <router-link :to="{name:'materialEdit',params:{id:material.id}}" class="btn-sm btn-info"><i class="fas fa-edit"></i></router-link>
                                    </td>
                                    <td colspan="1">
                                        <a @click="materialDel(material.id)" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
                materials:[],
                searchFillter:'',
            }
        },
        methods:{
            listarMaterials(){
                axios.get('api/materials')
                    .then(res=>{
                        this.materials = res.data;
                        console.log(res.data)
                    }).catch(error=>{console.log(error.response.data)});
            },
            materialDel(id){
                Swal.fire({
                    title: 'Seguro que Desea Eliminar?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/materials/'+id)
                            .then(()=>{
                                Notification.error();
                                this.materials = this.materials.filter(material=>{
                                    return material.id != id;
                                })
                            }).catch(()=>{
                            this.$router.push({name:'materialIndex'})
                        })
                        }

                })
            }
        },
        created() {
            this.listarMaterials();
        }
        ,
        mounted() {
            if(!User.loggedIn()){
                Toast.fire({
                    icon: 'warning',
                    title: '¡Inicie sesión primero!',
                });
                this.$router.push({name:'login'})
            }

        },
        computed:{
            searchMaterial(){
                return this.materials.filter(material=>{
                    return material.nombre.match(this.searchFillter);
                })
            }
        }
    }
</script>

<style scoped>

</style>
