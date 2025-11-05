<script setup>
import { useForm } from '@inertiajs/vue3';
const emit = defineEmits(['success']);

const props = defineProps({
    cliente: Object,
});

let form = useForm({
    modelo: '',
    lapela: '',
    bolsos: '',
    forro: '',
    botao: '',
    manga: '',
    costas: '',
    acabamento: '',
});

function submit() {
    form.post(route('casacos.store'), {
        onSuccess: () => {
            emit('success', 'Casaco adicionado com sucesso!');
        }
    });
}
</script>
<template>
    <form @submit.prevent="submit" method="post">
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" v-model="form.modelo" class="form-control" id="modelo" placeholder="Modelo do casaco">
        </div>

        <div class="form-group">
            <label for="lapela">Lapela</label>
            <input type="text" v-model="form.lapela" class="form-control" id="lapela" placeholder="Lapela">
        </div>

        <div class="form-group">
            <label for="bolsos">Bolsos</label>
            <input type="text" v-model="form.bolsos" class="form-control" id="bolsos" placeholder="Bolsos">
        </div>

        <div class="form-group">
            <label for="forro">Forro</label>
            <input type="text" v-model="form.forro" class="form-control" id="forro" placeholder="Forro">
        </div>

        <div class="form-group">
            <label for="botao">Botão</label>
            <input type="text" v-model="form.botao" class="form-control" id="botao" placeholder="Botão">
        </div>

        <div class="form-group">
            <label for="manga">Manga</label>
            <input type="text" v-model="form.manga" class="form-control" id="manga" placeholder="Manga">
        </div>

        <div class="form-group">
            <label for="costas">Costas</label>
            <input type="text" v-model="form.costas" class="form-control" id="costas" placeholder="Costas">
        </div>

        <div class="form-group">
            <label for="acabamento">Acabamento</label>
            <input type="text" v-model="form.acabamento" class="form-control" id="acabamento" placeholder="Acabamento">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</template>
