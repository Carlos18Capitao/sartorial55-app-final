<template>
    <DashboardApp>
        <div class="row">
            <div class="col-xl-12">
                <!-- Conteúdo da coluna -->
                <div class="card card-height-100">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title flex-grow-1 mb-0">Lista de Encomendas</h4>
                        <div class="flex-shrink-0">
                            <Link href="/encomendas/create" class="btn btn-soft-primary btn-sm">Nova Encomenda</Link>
                        </div>
                    </div><!-- end cardheader -->
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-nowrap table-centered align-middle">
                                <thead class="bg-light text-muted">
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col" style="width: 10%;">Opções</th>
                                    </tr><!-- end tr -->
                                </thead><!-- thead -->

                                <tbody>
                                    <!-- end tr -->
                                    <tr v-for="(cliente, index) in clientesList" :key="index" :id="`cliente-${cliente.id}`">
                                        <td>
                                            <img src="assets/images/users/avatar-3.jpg"
                                                class="avatar-xxs rounded-circle me-1" alt="">
                                            <Link :href="route('clientes.show', cliente.id)" class="text-reset">{{
                                                cliente.user.name
                                            }}</Link>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                                    <li>
                                                        <Link class="dropdown-item edit-item-btn" href="#api-key-modal"
                                                            data-bs-toggle="modal">View</Link>
                                                    </li>
                                                    <li>
                                                        <a @click.preventDefault="deleteCliente(cliente.id)" class="dropdown-item regenerate-api-btn"
                                                            href="#" >Delete
                                                    </a>

                                                    </li>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr><!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>

                        <!-- paginacao dinamica usando 'links' passado por props -->
                        <div class="align-items-center mt-xl-3 mt-4 justify-content-between d-flex">
                            <div class="flex-shrink-0">
                                <div class="text-muted">
                                    Estas a ver <span class="fw-semibold">{{ clientes.from }}</span> a
                                    <span class="fw-semibold">{{ clientes.to }}</span> de
                                    <span class="fw-semibold">{{ clientes.total }}</span> Resultados
                                </div>
                            </div>

                            <ul class="pagination pagination-separated pagination-sm mb-0">
                                <li v-for="(link, idx) in links" :key="idx"
                                    :class="['page-item', { disabled: !link.url, active: link.active }]">
                                    <Link preserve-scroll v-if="link.url" :href="link.url" class="page-link" v-html="link.label"></Link>
                                    <span v-else class="page-link" v-html="link.label"></span>
                                </li>
                            </ul>
                        </div>

                    </div><!-- end card body -->
                </div>
            </div>
        </div>
    </DashboardApp>
</template>
<script setup>
import { ref } from 'vue'
import DashboardApp from '../Dashboard-app.vue'
import Swal from 'sweetalert2'
import { Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
    clientes: Object
})

const form = useForm();
const { data: clientesList, links } = props.clientes


const deleteCliente = (id) => {

    Swal.fire({
        title: 'Tem a certeza?',
        text: "Esta ação não pode ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('clientes.destroy', id), {
                preserveScroll: true
            });
            document.getElementById(`cliente-${id}`).remove();
            //performDelete(id);
            Swal.fire(
                'Eliminada!',
                'A cliente foi eliminada.',
                'success'
            )
        }
    })
};
</script>
