<script setup>
import { useForm } from '@inertiajs/vue3';
const emit = defineEmits(['success']);

const props = defineProps({
    cliente: Object,
});

let form = useForm({
    modelo: '',
    cos: '',
    vinco: '',
    bainha: '',
    bolsos: '',
    presilhas: '',
    botoes: '',
});

function submit() {
    form.post(route('calcas.store'), {
        onSuccess: () => {
            emit('success', 'Calça adicionada com sucesso!');
        }
    });
}
</script>

<template>
    <form @submit.prevent="submit" method="post">
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" v-model="form.modelo" class="form-control" id="modelo" placeholder="Modelo da calça">
        </div>

        <div class="form-group">
            <label for="cos">Cos</label>
            <input type="text" v-model="form.cos" class="form-control" id="cos" placeholder="Cos">
        </div>

        <div class="form-group">
            <label for="vinco">Vinco</label>
            <input type="text" v-model="form.vinco" class="form-control" id="vinco" placeholder="Vinco">
        </div>

        <div class="form-group">
            <label for="bainha">Bainha</label>
            <input type="text" v-model="form.bainha" class="form-control" id="bainha" placeholder="Bainha">
        </div>

        <div class="form-group">
            <label for="bolsos">Bolsos</label>
            <input type="text" v-model="form.bolsos" class="form-control" id="bolsos" placeholder="Bolsos">
        </div>

        <div class="form-group">
            <label for="presilhas">Presilhas</label>
            <input type="text" v-model="form.presilhas" class="form-control" id="presilhas" placeholder="Presilhas">
        </div>

        <div class="form-group">
            <label for="botoes">Botões</label>
            <input type="text" v-model="form.botoes" class="form-control" id="botoes" placeholder="Botões">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</template>
