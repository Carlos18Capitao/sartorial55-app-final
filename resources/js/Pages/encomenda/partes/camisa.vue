<script setup>
import { useForm } from '@inertiajs/vue3';
const emit = defineEmits(['success']);

const props = defineProps({
    cliente: Object,
});

let form = useForm({
    colarinho: '',
    punho: '',
    pincas: '',
    carcela: '',
    acabamento: '',
});

function submit() {
    form.post(route('camisas.store'), {
        onSuccess: () => {
            emit('success', 'Camisa adicionada com sucesso!');
        }
    });
}
</script>

<template>
    <form @submit.prevent="submit" method="post">
        <div class="form-group">
            <label for="colarinho">Colarinho</label>
            <input type="text" v-model="form.colarinho" class="form-control" id="colarinho" placeholder="Colarinho">
        </div>

        <div class="form-group">
            <label for="punho">Punho</label>
            <input type="text" v-model="form.punho" class="form-control" id="punho" placeholder="Punho">
        </div>

        <div class="form-group">
            <label for="pincas">Pincas</label>
            <input type="text" v-model="form.pincas" class="form-control" id="pincas" placeholder="Pincas">
        </div>

        <div class="form-group">
            <label for="carcela">Carcela</label>
            <input type="text" v-model="form.carcela" class="form-control" id="carcela" placeholder="Carcela">
        </div>

        <div class="form-group">
            <label for="acabamento">Acabamento</label>
            <input type="text" v-model="form.acabamento" class="form-control" id="acabamento" placeholder="Acabamento">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</template>
