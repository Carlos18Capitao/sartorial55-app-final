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

        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

            </div>
        </div>

    </SartorialLayout>
</template>
