<script setup>
import { useForm } from '@inertiajs/vue3';
const emit = defineEmits(['success']); // Adicione esta linha

let form = useForm({
    url: '',
    nome: '',
    telefone: '',
    email: '',
});


function submit() {
    form.post(route('clientes.store'), {
        onSuccess: () => {
            emit('success', 'Cliente cadastrado com sucesso!');
        }
    });
}
</script>
<template>
    <form @submit.prevent="submit" method="post">

        <div class="input-group">
            <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
            <input type="text" placeholder="link de foto" v-model="form.url" class="form-control" id="basic-url" aria-describedby="basic-addon3">
        </div>

        <div class="form-group">
            <input type="text" v-model="form.nome" id="errorInput" placeholder="Nome" class="form-control">
            <small v-if="false" id="nomelHelp" class="form-text text-muted">Please provide a valid informations.</small>
        </div>

        <div class="form-group">
            <input type="text" v-model="form.telefone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Telefone">
            <small v-if="false" id="telefoneHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <input type="email" v-model="form.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
            <small v-if="false" id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</template>
