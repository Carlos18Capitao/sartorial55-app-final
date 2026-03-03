<template>
    <div>
        <h1>Clientes</h1>
        {{ JSON.stringify(clientes) }}
        <!-- <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cliente in clientes" :key="cliente.id">
                    <td>{{ cliente.id }}</td>
                    <td>{{ cliente.name }}</td>
                    <td>{{ cliente.email }}</td>
                    <td>{{ cliente.telefone }}</td>
                    <td>
                        <InertiaLink :href="route('clientes.edit', cliente.id)">Editar</InertiaLink>
                        <button @click="deleteCliente(cliente.id)">Excluir</button>
                    </td>
                </tr>
            </tbody>
        </table> -->
    </div>
</template>
<script setup>
import { ref } from 'vue'

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
