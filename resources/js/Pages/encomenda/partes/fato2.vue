<script setup>
import { useForm } from '@inertiajs/vue3';
const emit = defineEmits(['success']);

const props = defineProps({
    cliente: Object,
});

let form = useForm({
    casaco_id: '',
    calca_id: '',
    acabamento: '',
});

function submit() {
    form.post(route('fatos.store'), {
        onSuccess: () => {
            emit('success', 'Fato 2 peças adicionado com sucesso!');
        }
    });
}
</script>

<template>
    <form @submit.prevent="submit" method="post">
        <div class="form-group">
            <label for="casaco">Casaco</label>
            <select v-model="form.casaco_id" class="form-control" id="casaco">
                <option value="">Selecione um casaco</option>
                <!-- Aqui você pode popular com casacos disponíveis -->
            </select>
        </div>

        <div class="form-group">
            <label for="calca">Calça</label>
            <select v-model="form.calca_id" class="form-control" id="calca">
                <option value="">Selecione uma calça</option>
                <!-- Aqui você pode popular com calças disponíveis -->
            </select>
        </div>

        <div class="form-group">
            <label for="acabamento">Acabamento</label>
            <input type="text" v-model="form.acabamento" class="form-control" id="acabamento" placeholder="Acabamento">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</template>
