<script setup>

let form = defineProps({
    url: String,
    nome: String,
    telefone: String,
    email: String,
});

function submit() {
    form.post(route('cliente.store'));
}
</script>
<template>
    <form @submit.prevent="submit" method="post">

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
            <input type="text" v-model="form.url" class="form-control" id="basic-url" aria-describedby="basic-addon3">
        </div>

        <div class="form-group has-error has-feedback">
            <label for="errorInput">Nome</label>
            <input type="text" v-model="form.nome" id="errorInput" value="Error" class="form-control">
            <small id="emailHelp" class="form-text text-muted">Please provide a valid informations.</small>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Telefone</label>
            <input type="text" v-model="form.telefone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" v-model="form.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
    </form>
</template>
