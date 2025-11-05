<script setup>
import { useForm } from '@inertiajs/vue3';
const emit = defineEmits(['success']);

const props = defineProps({
    cliente: Object,
});

let form = useForm({
    modelo: '',
    acabamento: '',
});

function submit() {
    form.post(route('sapatos.store'), {
        onSuccess: () => {
            emit('success', 'Sapato adicionado com sucesso!');
        }
    });
}
</script>

<template>
    <form @submit.prevent="submit" method="post">
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" v-model="form.modelo" class="form-control" id="modelo" placeholder="Modelo do sapato">
        </div>

        <div class="form-group">
            <label for="acabamento">Acabamento</label>
            <input type="text" v-model="form.acabamento" class="form-control" id="acabamento" placeholder="Acabamento">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</template>
