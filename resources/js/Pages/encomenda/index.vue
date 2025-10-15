<script setup>
import SartorialLayout from '@/Layouts/SartorialLayout.vue';

defineProps(
    {
        cliente: Object,
    }
);
</script>

<template>
    <SartorialLayout>

        <div class="card card-profile">
            <div class="card-header" style="background-image: url('assets/img/blogpost.jpg')">
                <div class="profile-picture">
                    <div class="avatar avatar-xl">
                        <img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="user-profile text-center">
                    <div class="name">{{ cliente.nome }}</div>
                    <div class="job">{{ cliente.telefone }}</div>
                    <div class="desc">{{ cliente.email }}</div>

                </div>
            </div>
            <div class="card-footer">
                <div class="row user-stats text-center">
                    <div class="col">
                        <div class="number">8</div>
                        <div class="title">Fatos</div>
                    </div>
                    <div class="col">
                        <div class="number">3</div>
                        <div class="title">Casaco</div>
                    </div>
                    <div class="col">
                        <div class="number">3</div>
                        <div class="title">Calças</div>
                    </div>
                    <div class="col">
                        <div class="number">12</div>
                        <div class="title">Camisas</div>
                    </div>
                    <div class="col">
                        <div class="number">4</div>
                        <div class="title">Sapato</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Encomendar</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <button href="#" class="btn btn-primary btn-round">Adicionar Item</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h1>fato</h1>
            </div>
            <div class="col">
                <h1>casaco</h1>
            </div>
            <div class="col">
                <h1>calça</h1>
            </div>
            <div class="col">
                <h1>camisa</h1>
            </div>
            <div class="col">
                <h1>sapatos</h1>
            </div>
            <div class="col">
                <h1>outros</h1>
            </div>
        </div>

    </SartorialLayout>
</template>
