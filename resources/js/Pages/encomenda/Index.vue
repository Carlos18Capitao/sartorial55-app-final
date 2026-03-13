<template>
    <DashboardApp>
        <template #header>
            <h1>Encomendas</h1>
        </template>
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
                                        <th scope="col">Progresso</th>
                                        <th scope="col">Itens</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" style="width: 12%;">Previsão</th>
                                        <th scope="col" style="width: 10%;">Opções</th>
                                    </tr><!-- end tr -->
                                </thead><!-- thead -->

                                <tbody>
                                    <!-- end tr -->
                                    <tr v-for="(encomenda, index) in encomendasList" :key="index">
                                        <td>
                                            <img src="assets/images/users/avatar-3.jpg"
                                                class="avatar-xxs rounded-circle me-1" alt="">
                                            <a href="javascript: void(0);" class="text-reset">{{
                                                encomenda.cliente.user.name
                                            }}</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 text-muted me-1">{{ getProgress(encomenda) }}%
                                                </div>
                                                <div class="progress progress-sm flex-grow-1"
                                                    :style="`width: ${getProgress(encomenda)}%`">
                                                    <div class="progress-bar bg-primary rounded" role="progressbar"
                                                        :style="`width: ${getProgress(encomenda)}%`"
                                                        :aria-valuenow="getProgress(encomenda)" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <a v-if="encomenda.calca_count" href="javascript: void(0);"
                                                    class="avatar-group-item">
                                                    <img src="storage/icons/measure-2.png" alt="Calça"
                                                        class="avatar-xs">
                                                    <span
                                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{
                                                        encomenda.calca_count }}</span>
                                                </a>
                                                <a v-if="encomenda.camisa_count" href="javascript: void(0);"
                                                    class="avatar-group-item">
                                                    <img src="storage/icons/size.png" alt="Camisa"
                                                        class="avatar-xs">
                                                    <span
                                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-primary">{{
                                                        encomenda.camisa_count }}</span>
                                                </a>
                                                <a v-if="encomenda.casaco_count" href="javascript: void(0);"
                                                    class="avatar-group-item">
                                                    <img src="storage/icons/suit-5.png" alt="Casaco"
                                                        class="avatar-xs">
                                                    <span
                                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-success">{{
                                                        encomenda.casaco_count }}</span>
                                                </a>
                                                <a v-if="encomenda.fato_count" href="javascript: void(0);"
                                                    class="avatar-group-item">
                                                    <img src="storage/icons/business-suit.png" alt="Fato"
                                                        class="avatar-xs">
                                                    <span
                                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-warning">{{
                                                        encomenda.fato_count }}</span>
                                                </a>
                                                <a v-if="encomenda.sapato_count" href="javascript: void(0);"
                                                    class="avatar-group-item">
                                                    <img src="storage/icons/smart-shoe.png" alt="Sapato"
                                                        class="avatar-xs">
                                                    <span
                                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-info">{{
                                                        encomenda.sapato_count }}</span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <span :class="`badge ${getStatusBadge(encomenda.estado).class}`">{{
                                                getStatusBadge(encomenda.estado).text }}</span>
                                        </td>
                                        <td class="text-muted">{{ formatDate(encomenda.data_encomenda, 'dd/MM/yyyy') }}
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
                                                        <a @click.preventDefault="deleteEncomenda(encomenda.id)" class="dropdown-item regenerate-api-btn"
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
                                    Estas a ver <span class="fw-semibold">{{ encomendas.from }}</span> a
                                    <span class="fw-semibold">{{ encomendas.to }}</span> de
                                    <span class="fw-semibold">{{ encomendas.total }}</span> Resultados
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
import DashboardApp from '../Dashboard-app.vue'
import { computed, defineProps } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({
    encomendas: Object
})

const { data: encomendasList, links } = props.encomendas

const getStatusBadge = (estado) => {
    switch (estado?.toLowerCase()) {
        case 'concluída':
            return { class: 'bg-success-subtle text-success', text: 'Concluída' }
            break;
        case 'completed':
            return { class: 'bg-success-subtle text-success', text: 'Concluída' }
            break;
        case 'pendente':
            return { class: 'bg-danger-subtle text-danger', text: 'Pendente' }
            break;
        case 'cancelada':
            return { class: 'bg-danger-subtle text-danger', text: 'Cancelada' }
            break;
        case 'entregue':
            return { class: 'bg-danger-subtle text-success', text: 'Entregue' }
            break;
        case 'em progresso':
            break;
        case 'progress':
            return { class: 'bg-warning-subtle text-warning', text: 'Em Progresso' }
            break;
        default:
            return { class: 'bg-secondary-subtle text-secondary', text: 'Desconhecido' }
    }
}

const formatDate = (dateString, format) => {
    if (!dateString) return ''

    const date = new Date(dateString)
    if (isNaN(date.getTime())) return ''

    const options = {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    }

    return new Intl.DateTimeFormat('pt-BR', options).format(date)
}

const getProgress = (encomenda) => {
    // Simple mock: based on itens length or estado
    if (encomenda.estado?.toLowerCase().includes('concluída')) return 100
    if (encomenda.estado?.toLowerCase().includes('progress')) return 65
    return 20
}


const form = useForm();


const deleteEncomenda = (id) => {

    swal.fire({
        title: 'Tem a certeza?',
        text: "Esta ação não pode ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('encomendas.destroy', id), {
                preserveScroll: true
            });
            performDelete(id);
            swal.fire(
                'Eliminada!',
                'A encomenda foi eliminada.',
                'success'
            )
        }
    })
};

</script>
