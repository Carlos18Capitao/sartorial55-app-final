<template>
    <DashboardApp>
        <template #header>
            <h1>Clientes</h1>
        </template>
    </DashboardApp>
</template>
<script setup>
import { ref } from 'vue'
import DashboardApp from '../Dashboard-app.vue'

const props = defineProps({
    clientes: {
        type: Array,
        default: () => []
    }
})

const clientes = ref(props.clientes)

const deleteCliente = (id) => {
    if (confirm('Tem certeza que deseja excluir este cliente?')) {
        axios.delete(`/api/clientes/${id}`)
            .then(() => {
                clientes.value = clientes.value.filter(cliente => cliente.id !== id)
            })
            .catch(error => {
                console.error('Error deleting cliente:', error)
            })
    }
}
</script>
