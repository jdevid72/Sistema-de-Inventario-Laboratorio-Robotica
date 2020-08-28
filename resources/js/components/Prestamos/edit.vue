<template>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Actualizar Prestamo</h4>
                            </div>
                            <div>&nbsp&nbsp
                                <router-link :to="{name:'prestamoIndex'}" class="btn btn-success">Ver Prestamos</router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="prestamoEdit">
                            <div class="row">

                                <div class="col-md-6">
                                    <fieldset disabled>
                                        <div class="form-group">
                                        <label>Persona Que Solicita Prestamo</label>
                                        <select v-model="form.persona_id" class="form-control">
                                            <option value="">--seleccionar persona--</option>

                                            <option v-for="persona in personas" :value="persona.id">{{persona.nombre}} {{persona.apellido}}</option>

                                        </select>
                                         <small class="text-danger" v-if="errors.persona_id">{{errors.persona_id[0]}}</small>
                                    </div>
                                    </fieldset>
                                </div>


                                <div class="col-md-6">
                                    <fieldset disabled>
                                        <div class="form-group">
                                        <label>Material de Laboratorio a ser Prestado</label>
                                        <select v-model="form.material_id" class="form-control">
                                            <option value="">--seleccionar material--</option>
                                             <option v-for="material in materials" :value="material.id">{{material.nombre}} {{material.modelo}}</option>
                                        </select>
                                        <small class="text-danger" v-if="errors.material_id">{{errors.material_id[0]}}</small>
                                    </div>
                                    </fieldset>
                                </div>


                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cantidad Prestamo<span class="text-danger">*</span></label>
                                        <input v-model="form.cantidad_prestamo" required type="number" class="form-control" placeholder="Cantidad Prestamo">
                                        <small class="text-danger" v-if="errors.cantidad_prestamo">{{errors.cantidad_prestamo[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Persona que Devuelve el Material</label>
                                        <select v-model="form.persona_idev" class="form-control" required>
                                            <option value="">--seleccionar persona--</option>

                                            <option v-for="persona in personas" :value="persona.id">{{persona.nombre}}</option>

                                        </select>
                                         <small class="text-danger" v-if="errors.persona_id">{{errors.persona_id[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <fieldset disabled>
                                        <div class="form-group">
                                        <label>Fecha Prestamo</label>
                                        <input v-model="form.fecha_prestamo" type="date" class="form-control" placeholder="MM/DD/YYYY">
                                        <small class="text-danger" v-if="errors.fecha_prestamo">{{errors.fecha_prestamo[0]}}</small>
                                    </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha Devolucion</label>
                                        <input v-model="form.fecha_devolucion" type="date" class="form-control" placeholder="MM/DD/YYYY">
                                        <small class="text-danger" v-if="errors.fecha_devolucion">{{errors.fecha_devolucion[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-info"><i class="fas fa-plus"></i>&nbsp Registrar Devolucion</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "edit",
        data(){
            return {
                form:{
                    persona_id:'',
                    material_id:'',
                    user_id:'',
                    cantidad_prestamo:'',
                    persona_idev:'',
                    fecha_prestamo:'',
                    fecha_devoluciones:'',

                },
                errors:{},
                personas:{},
                materials:{},
                users:{},
            }
        },
        created() {

            axios.get('api/personas')
            .then(res=>{this.personas = res.data})

            axios.get('api/materials')
            .then(res=>{this.materials = res.data})

            axios.get('api/auth/users')
            .then(res=>{
                this.users = res.data;
                console.log("users" + this.users);
                })

            let id = this.$route.params.id;

            axios.get('api/prestamos/'+id)
            .then(res=>{
                this.form = res.data;
            })
                .catch(error=>{})
        },
        methods:{
            prestamoEdit(){
                let id = this.$route.params.id;
                axios.patch('api/prestamos/'+id,this.form)
                    .then(res=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Se acaba de Registrar la Devolucion con Exito'

                        });
                        this.$router.push({name:'prestamoIndex'})
                    })
                    .catch(error=>{
                        this.errors = error.response.data.errors;
                        console.log(error.response.data.errors)
                    })
            },
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
    }
</script>

<style scoped>

</style>
