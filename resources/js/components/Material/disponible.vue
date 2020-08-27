<template>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div>
                                <h4>Stock Disponible</h4>
                            </div>
                            <div>
                                <input type="text" class="form-control mr-50" placeholder="Buscar" v-model="searchFillter" @keyup="searchmaterial">
                            </div>
                            <div>
                                <router-link :to="{name:'materialCreate'}" class="btn btn-success">Agregar Material de Laboratorio</router-link>
                            </div>
                        </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead><tr>

                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Modelo</th>
                                    <th>Caracteristica</th>
                                    <th>Cantidad Restante</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr></thead>
                                <tbody v-for="material in searchmaterial" :key="material.id">
                                <tr v-if="(material.cantidad_prestamo - material.cantidad_total) != 0">

                                    <td><img :src="material.imagen" alt="image" style="width:60px;height:50px"></td>
                                    <td>{{material.nombre}}</td>
                                    <td>{{material.modelo}}</td>
                                    <td>{{material.caracteristicas}}</td>
                                    <td>{{material.cantidad_total - material.cantidad_prestamo}}</td>
                                    <td>{{material.fecha}}</td>



                                    <td>
                                        <div v-if="(material.cantidad_total - material.cantidad_prestamo) != 0" class="badge badge-success">Disponible</div>
                                        <div v-else class="badge badge-danger">No Disponible</div>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
               
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "stock",
        data(){
            return {
                materials:[],
                searchFillter:'',
            }
        },
        methods:{
            allmaterial(){
                axios.get('api/materials')
                    .then(res=>{
                        this.materials = res.data;
                    }).catch(error=>{console.log(error.response.data)});
            },
          
        },
        created() {
            this.allmaterial();
        }
        ,
        mounted() {
            if(!User.loggedIn()){
                Toast.fire({
                    icon: 'warning',
                    title: 'Iniciar Session',
                });
                this.$router.push({name:'login'})
            }

        },
        computed:{
            searchmaterial(){
                return this.materials.filter(material=>{
                    return material.nombre.match(this.searchFillter);
                })
            }
        }
    }
</script>

<style scoped>

</style>
