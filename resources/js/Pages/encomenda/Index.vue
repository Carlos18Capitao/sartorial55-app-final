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
                                            <img src="assets/images/users/avatar-3.jpg" class="avatar-xxs rounded-circle me-1" alt="">
                                            <a href="javascript: void(0);" class="text-reset">{{ encomenda.cliente.user.name }}</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 text-muted me-1">{{ getProgress(encomenda) }}%</div>
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
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-7.jpg" alt=""
                                                            class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-8.jpg" alt=""
                                                            class="rounded-circle avatar-xxs">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span :class="`badge ${getStatusBadge(encomenda.estado).class}`">{{ getStatusBadge(encomenda.estado).text }}</span>
                                        </td>
                                        <td class="text-muted">{{ formatDate(encomenda.created_at, 'dd/MM/yyyy') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                                    <li><a class="dropdown-item edit-item-btn" href="#api-key-modal"
                                                            data-bs-toggle="modal">Rename</a></li>
                                                    <li><a class="dropdown-item regenerate-api-btn"
                                                            href="#api-key-modal" data-bs-toggle="modal">Regenerate
                                                            Key</a></li>
                                                    <li><a class="dropdown-item disable-btn"
                                                            href="javascript:void(0);">Disable</a></li>
                                                    <li><a class="dropdown-item remove-item-btn" data-bs-toggle="modal"
                                                            href="#deleteApiKeyModal">Delete</a></li>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr><!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>

                        <div class="align-items-center mt-xl-3 mt-4 justify-content-between d-flex">
                            <div class="flex-shrink-0">
                                <div class="text-muted">Showing <span class="fw-semibold">5</span> of <span
                                        class="fw-semibold">25</span> Results </div>
                            </div>
                            <ul class="pagination pagination-separated pagination-sm mb-0">
                                <li class="page-item disabled">
                                    <a href="#" class="page-link">←</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">3</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">→</a>
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
import { Link } from '@inertiajs/vue3'

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
</script>
