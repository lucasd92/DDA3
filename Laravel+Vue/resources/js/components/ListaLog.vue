<template>
<div v-if="mostrarLog" class = "display: block">

    <h2 style = "display: inline">{{dispositivo.nombre}}</h2>
    <span style = "float: right">
    <button class="btn btn-primary btn-sm" @click="ocultarLog()">Ocultar</button>
    <button class="btn btn-primary btn-sm" @click="actualizar()">Actualizar</button>
    </span>
  <table class="table table-info table-striped table-bordered m-1">
    <thead>
      <tr>
        <th>Temperatura</th>
        <th>Humedad</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item,index) in listaLogs" :key="index">
        <td>{{item.temperatura}}</td>
        <td>{{item.humedad}}</td>
        <td>{{item.timestamp}}</td>
      </tr>
    </tbody>
  </table>

</div>
</template>

<script>
export default{
    data(){
        return{
            mostrarLog: 0,
            listaLogs: [],
            dispositivo: {id:'',nombre:''}
        }
    },
    created(){

        // Me suscribo al bus de comunicaciones
        this.$bus.$on('emit_log',(mensaje)=> {
            this.dispositivo = mensaje;
            axios.get(`/log_disp/${mensaje.id}`).then((res)=>{
                    console.log(res.data);
                    this.listaLogs = res.data;
                    this.mostrarLog = 1;
                });
            });
    },
    methods:{
        ocultarLog(){
            this.mostrarLog = 0;
        },
        actualizar(){
            axios.get(`/log_disp/${this.dispositivo.id}`).then((res)=>{
                    console.log(res.data);
                    this.listaLogs = res.data;
                    this.mostrarLog = 1;
                });
        },
        beforeDestroy(){
            // Me desuscribo al bus de comunicaciones
            this.$eventBus.$off('emit_log');
        }
    }
}
</script>