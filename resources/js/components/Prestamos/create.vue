<template>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Añadir Prestamo</h4>
                            </div>
                            <div>
                                <router-link :to="{name:'prestamoIndex'}" class="btn btn-success">Listar Prestamos</router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="prestamoAdd">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Persona Que Solicita Prestamo</label>
                                        <select v-model="form.persona_id" class="form-control">
                                            <option value="">--seleccionar persona--</option>

                                            <option v-for="persona in personas" :value="persona.id">{{persona.nombre}} {{ persona.apellido }}</option>

                                        </select>
                                         <small class="text-danger" v-if="errors.persona_id">{{errors.persona_id[0]}}</small>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Material de Laboratorio a ser Prestado</label>
                                        <select v-model="form.material_id" class="form-control">
                                            <option value="">--seleccionar material--</option>
                                             <option v-for="material in materials" :value="material.id">{{material.nombre}} {{ material.modelo }}</option>
                                        </select>
                                        <small class="text-danger" v-if="errors.material_id">{{errors.material_id[0]}}</small>
                                    </div>
                                </div>


                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cantidad Prestamo<span class="text-danger">*</span></label>
                                        <input v-model="form.cantidad_prestamo" type="number" class="form-control" placeholder="Cantidad Prestamo">
                                        <small class="text-danger" v-if="errors.cantidad_prestamo">{{errors.cantidad_prestamo[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha Prestamo</label>
                                        <input v-model="form.fecha_prestamo" type="date" class="form-control" placeholder="MM/DD/YYYY">
                                        <small class="text-danger" v-if="errors.fecha_prestamo">{{errors.fecha_prestamo[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-info"><i class="fas fa-plus"></i>Agregar Registro Prestamo</button>
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
        name: "create",
        data(){
            return {
                form:{
                    persona_id:'',
                    material_id:'',
                    cantidad_prestamo:'',
                    persona_idev:'',
                    fecha_prestamo:'',
                    fecha_devoluciones:'',

                },
                errors:{},
                personas:{},
                materials:{},
            }
        },
        created(){
            axios.get('api/personas')
            .then(res=>{this.personas = res.data})

            axios.get('api/materials')
            .then(res=>{this.materials = res.data})

        },
        methods:{
            prestamoAdd(){
                axios.post('api/prestamos',this.form)
                .then(res=>{
                    Toast.fire({
                            icon: 'success',
                            title: 'Nuevo Prestamo Registrado'

                        });
                    this.$router.push({name:'prestamoIndex'})
                })
                .catch(error=>{
                    this.errors = error.response.data.errors;
                    console.log(error.response.data.errors)
                })
            },

        }
        ,
        mounted() {
            if(!User.loggedIn()){
                Toast.fire({
                    icon: 'warning',
                    title: 'Iniciar Session!',
                });
                this.$router.push({name:'login'})
            }
        },
        

    }
    
</script>

<style scoped>

</style>
