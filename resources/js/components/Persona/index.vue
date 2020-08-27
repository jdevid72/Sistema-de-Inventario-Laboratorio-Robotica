<template>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div>
                                <h4>Lista de Personas Registradas</h4>
                            </div>
                            <div>
                                <input type="text" class="form-control mr-50" placeholder="Buscar" v-model="searchFillter" @keyup="searchPersona">
                            </div>
                            <div>
                                <router-link :to="{name:'personaCreate'}" class="btn btn-success">Agregar Persona</router-link>
                            </div>
                        </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead><tr>

                                    <th>Perfil</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Direccion</th>
                                    <th>CI</th>
                                    <th>CU</th>
                                    <th>Tipo</th>
                                    <th>Telefono</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Nombre del Garante</th>
                                    <th>Telefono del Garante</th>
                                    <th colspan="2">Accion</th>
                                </tr></thead>
                                <tbody v-for="persona in searchPersona" :key="persona.id">
                                <tr>

                                    <td><img :src="persona.perfil" alt="image" style="width:60px;height:50px"></td>
                                    <td>{{persona.nombre}}</td>
                                    <td>{{persona.apellido}}</td>
                                    <td>{{persona.direccion}}</td>
                                    <td>{{persona.ci}}</td>
                                    <td>{{persona.cu}}</td>
                                    <td v-if="persona.tipo != null">{{persona.tipo.descripcion}}</td>
                                    <td v-else></td>
                                    <td>{{persona.telefono}}</td>
                                    <td>{{persona.fecha_nacimiento}}</td>
                                    <td>{{persona.nombre_respaldo}}</td>
                                    <td>{{persona.telefono_respaldo}}</td>


                                    <td colspan="1">
                                        <router-link :to="{name:'personaEdit',params:{id:persona.id}}" class="btn-sm btn-info"><i class="fas fa-edit"></i></router-link>
                                    </td>
                                    <td colspan="1">
                                        <a @click="personaDel(persona.id)" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
                personas:[],
                searchFillter:'',
            }
        },
        methods:{
            listarPersonas(){
                axios.get('api/personas')
                    .then(res=>{
                        this.personas = res.data;
                        console.log(res.data)
                    }).catch(error=>{console.log(error.response.data)});
            },
            personaDel(id){
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
                        axios.delete('api/personas/'+id)
                            .then(()=>{
                                Notification.error();
                                this.personas = this.personas.filter(persona=>{
                                    return persona.id != id;
                                })
                            }).catch(()=>{
                            this.$router.push({name:'personaIndex'})
                        })
                        }

                })
            }
        },
        created() {
            this.listarPersonas();
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
            searchPersona(){
                return this.personas.filter(persona=>{
                    return persona.nombre.match(this.searchFillter);
                })
            }
        }
    }
</script>

<style scoped>

</style>
