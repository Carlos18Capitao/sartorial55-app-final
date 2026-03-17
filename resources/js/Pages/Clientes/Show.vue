<template>
    <DashboardApp>
        <div class="page-content">
            <div class="container-fluid">
                <div class="profile-foreground position-relative mx-n4 mt-n4">
                    <div class="profile-wid-bg">
                        <img src="/assets/images/profile-bg.jpg" alt="" class="profile-wid-img">
                    </div>
                </div>
                <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
                    <div class="row g-4">
                        <div class="col-auto">
                            <div class="avatar-lg">
                                <img src="/assets/images/users/avatar-1.jpg" alt="user-img"
                                    class="img-thumbnail rounded-circle">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col">
                            <div class="p-2">
                                <h3 class="text-white mb-1">{{ cliente.user.name }}</h3>
                                <p class="text-white text-opacity-75">{{ cliente.telefone }}</p>
                                <div class="hstack text-white-50 gap-1">
                                    <div class="me-2"><i
                                            class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>California,
                                        United States</div>
                                    <div>
                                        <i
                                            class="ri-building-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>Themesbrand
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->


                    </div>
                    <!--end row-->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div class="d-flex profile-wrapper">
                                <!-- Nav tabs -->
                                <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1"
                                    role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#home-tab"
                                            role="tab" aria-selected="true">
                                            <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                                class="d-none d-md-inline-block">Home</span>
                                        </a>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link fs-14" data-bs-toggle="tab" href="#encomendas" role="tab"
                                            aria-selected="false" tabindex="-1">
                                            <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span
                                                class="d-none d-md-inline-block">Encomendas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link fs-14" data-bs-toggle="tab" href="#items" role="tab"
                                            aria-selected="false" tabindex="-1">
                                            <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                                class="d-none d-md-inline-block">Items</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="flex-shrink-0">
                                    <a href="pages-profile-settings.html" class="btn btn-info"><i
                                            class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                                </div>
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content pt-4 text-muted">
                                <div class="tab-pane active" id="home-tab" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xxl-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-5">Encomenda Em Curso</h5>
                                                    <div
                                                        class="progress animated-progress custom-progress progress-label">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                            <div class="label">30%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-3">Informação</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">Nome:</th>
                                                                    <td class="text-muted">{{ cliente.user.name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">Contacto:</th>
                                                                    <td class="text-muted">{{ cliente.telefone }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">E-mail:</th>
                                                                    <td class="text-muted">{{ cliente.user.email }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->

                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-9">
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="card card-animate">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none" stroke="currentColor"
                                                                            stroke-width="2" stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="feather feather-briefcase text-primary">
                                                                            <rect x="2" y="7" width="20" height="14"
                                                                                rx="2" ry="2"></rect>
                                                                            <path
                                                                                d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16">
                                                                            </path>
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                                <div class="flex-grow-1 overflow-hidden ms-3">
                                                                    <p
                                                                        class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                                                        Pedidos Anulados</p>
                                                                    <div class="d-flex align-items-center mb-3">
                                                                        <h4 class="fs-4 flex-grow-1 mb-0"><span
                                                                                class="counter-value"
                                                                                data-target="825">825</span></h4>
                                                                        <span
                                                                            class="badge bg-danger-subtle text-danger fs-12"><i
                                                                                class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>5.02
                                                                            %</span>
                                                                    </div>
                                                                    <p class="text-muted text-truncate mb-0">
                                                                        Projects this month</p>
                                                                </div>
                                                            </div>
                                                        </div><!-- end card body -->
                                                    </div>
                                                </div><!-- end col -->

                                                <div class="col-xl-4">
                                                    <div class="card card-animate">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none" stroke="currentColor"
                                                                            stroke-width="2" stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="feather feather-award text-warning">
                                                                            <circle cx="12" cy="8" r="7"></circle>
                                                                            <polyline
                                                                                points="8.21 13.89 7 23 12 20 17 23 15.79 13.88">
                                                                            </polyline>
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <p class="text-uppercase fw-medium text-muted mb-3">
                                                                        Entregue</p>
                                                                    <div class="d-flex align-items-center mb-3">
                                                                        <h4 class="fs-4 flex-grow-1 mb-0"><span
                                                                                class="counter-value"
                                                                                data-target="7522">7,522</span></h4>
                                                                        <span
                                                                            class="badge bg-success-subtle text-success fs-12"><i
                                                                                class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>3.58
                                                                            %</span>
                                                                    </div>
                                                                    <p class="text-muted mb-0">Leads this month</p>
                                                                </div>
                                                            </div>
                                                        </div><!-- end card body -->
                                                    </div>
                                                </div><!-- end col -->

                                                <div class="col-xl-4">
                                                    <div class="card card-animate">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm flex-shrink-0">
                                                                    <span
                                                                        class="avatar-title bg-info-subtle text-info rounded-2 fs-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none" stroke="currentColor"
                                                                            stroke-width="2" stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="feather feather-clock text-info">
                                                                            <circle cx="12" cy="12" r="10"></circle>
                                                                            <polyline points="12 6 12 12 16 14">
                                                                            </polyline>
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                                <div class="flex-grow-1 overflow-hidden ms-3">
                                                                    <p
                                                                        class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                                                        Total</p>
                                                                    <div class="d-flex align-items-center mb-3">
                                                                        <h4 class="fs-4 flex-grow-1 mb-0"><span
                                                                                class="counter-value"
                                                                                data-target="168">168</span>h
                                                                            <span
                                                                                class="badge bg-danger-subtle text-danger fs-12"><i
                                                                                    class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35
                                                                                %</span>
                                                                        </h4>
                                                                    </div>
                                                                    <p class="text-muted text-truncate mb-0">Work
                                                                        this month</p>
                                                                </div>
                                                            </div>
                                                        </div><!-- end card body -->
                                                    </div>
                                                </div><!-- end col -->
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>

                                <!--end tab-pane-->
                                <div class="tab-pane fade" id="encomendas" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-xxl-4 col-sm-6" v-for="encomenda in cliente.encomendas"
                                                    :key="encomenda.id">
                                                    <div
                                                        class="card profile-project-card shadow-none profile-project-warning">
                                                        <div class="card-body p-4">
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1 text-muted overflow-hidden">
                                                                    <h5 class="fs-14 text-truncate"><a href="#"
                                                                            class="text-body">Enc. {{
                                                                                formatDate(encomenda.created_at,
                                                                                    'DD/MM/YYYY') }}</a>
                                                                    </h5>
                                                                    <p class="text-muted text-truncate mb-0">
                                                                        Actuali.: <span class="fw-semibold text-body">{{
                                                                            formatDate(encomenda.updated_at,
                                                                                'DD/MM/YYYY') }}</span></p>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-2">
                                                                    <div
                                                                        class="badge bg-warning-subtle text-warning fs-10">
                                                                        Em Produção</div>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex mt-4">
                                                                <div class="flex-grow-1">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <div>
                                                                        </div>
                                                                        <div class="avatar-group"
                                                                            v-for="item in encomenda.itens"
                                                                            :key="item.id">

                                                                            <div class="avatar-group-item"
                                                                                v-if="item.tipo === 'colete'">
                                                                                <div class="avatar-xs">
                                                                                    <img src="/storage/icons/waistcoat.png"
                                                                                        alt="" class="img-fluid">
                                                                                    <span
                                                                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{
                                                                                            cliente.colete_count }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="avatar-group-item"
                                                                                v-if="item.tipo === 'casaco'">
                                                                                <div class="avatar-xs">
                                                                                    <img src="/storage/icons/measure-2.png"
                                                                                        alt="" class="img-fluid">
                                                                                    <span
                                                                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{
                                                                                            cliente.casaco_count }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="avatar-group-item"
                                                                                v-if="item.tipo === 'camisa'">
                                                                                <div class="avatar-xs">
                                                                                    <img src="/storage/icons/size.png"
                                                                                        alt="" class="img-fluid">
                                                                                    <span
                                                                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{
                                                                                            cliente.camisa_count }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="avatar-group-item"
                                                                                v-if="item.tipo === 'calca'">
                                                                                <div class="avatar-xs">
                                                                                    <img src="/storage/icons/suit-5.png"
                                                                                        alt="" class="img-fluid">
                                                                                    <span
                                                                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{
                                                                                            cliente.calca_count }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="avatar-group-item"
                                                                                v-if="item.tipo === 'fato'">
                                                                                <div class="avatar-xs">
                                                                                    <img src="/storage/icons/business-suit.png"
                                                                                        alt="" class="img-fluid">
                                                                                    <span
                                                                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{
                                                                                            cliente.fato_count }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="avatar-group-item"
                                                                                v-if="item.tipo === 'sapato'">
                                                                                <div class="avatar-xs">
                                                                                    <img src="/storage/icons/smart-shoe.png"
                                                                                        alt="" class="img-fluid">
                                                                                    <span
                                                                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{
                                                                                            cliente.sapato_count }}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end card body -->
                                                    </div>
                                                    <!-- end card -->
                                                </div>

                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="mt-4">
                                                        <ul
                                                            class="pagination pagination-separated justify-content-center mb-0">
                                                            <li class="page-item disabled">
                                                                <a href="javascript:void(0);" class="page-link"><i
                                                                        class="mdi mdi-chevron-left"></i></a>
                                                            </li>
                                                            <li class="page-item active">
                                                                <a href="javascript:void(0);" class="page-link">1</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a href="javascript:void(0);" class="page-link">2</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a href="javascript:void(0);" class="page-link">3</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a href="javascript:void(0);" class="page-link">4</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a href="javascript:void(0);" class="page-link">5</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a href="javascript:void(0);" class="page-link"><i
                                                                        class="mdi mdi-chevron-right"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card-body-->
                                    </div>
                                    <!--end card-->
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane fade" id="items" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-4">
                                                <h5 class="card-title flex-grow-1 mb-0">Items</h5>
                                                <div class="flex-shrink-0">
                                                    <input class="form-control d-none" type="file" id="formFile">
                                                    <label for="formFile" class="btn btn-primary"><i
                                                            class="ri-upload-2-fill me-1 align-bottom"></i> Upload
                                                        File</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table class="table align-middle table-nowrap"
                                                            id="invoiceTable">
                                                            <thead class="text-muted">
                                                                <tr>

                                                                    <th class="sort text-uppercase"
                                                                        data-sort="customer_name">Item</th>
                                                                    <th class="sort text-uppercase" data-sort="email">
                                                                        Modelo</th>
                                                                    <th class="sort text-uppercase" data-sort="country">
                                                                        Estado</th>
                                                                    <th class="sort text-uppercase" data-sort="date">
                                                                        Data</th>
                                                                    <th class="sort text-uppercase"
                                                                        data-sort="invoice_amount">Previsão</th>
                                                                    <th class="text-uppercase" data-sort="action">
                                                                        Opções</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="list form-check-all" id="invoice-list-data">
                                                                <template v-for="(iten, i) in cliente.encomendas">
                                                                    <tr v-for="(item, inde) in iten.itens" :key="inde"
                                                                        :id="`item-${item.id}`">
                                                                        <td class="customer_name">
                                                                            <div class="d-flex align-items-center">
                                                                                <img v-if="item.tipo === 'camisa'"
                                                                                    src="/storage/icons/size.png"
                                                                                    :alt="item.tipo"
                                                                                    class="avatar-xs me-2">
                                                                                <img v-if="item.tipo === 'casaco'"
                                                                                    src="/storage/icons/suit-5.png"
                                                                                    :alt="item.tipo"
                                                                                    class="avatar-xs me-2">
                                                                                <img v-if="item.tipo === 'calca'"
                                                                                    src="/storage/icons/measure-2.png"
                                                                                    :alt="item.tipo"
                                                                                    class="avatar-xs me-2">
                                                                                <img v-if="item.tipo === 'fato'"
                                                                                    src="/storage/icons/business-suit.png"
                                                                                    :alt="item.tipo"
                                                                                    class="avatar-xs me-2">
                                                                                <img v-if="item.tipo === 'colete'"
                                                                                    src="/storage/icons/waistcoat.png"
                                                                                    :alt="item.tipo"
                                                                                    class="avatar-xs me-2">
                                                                                {{ item.tipo }}
                                                                            </div>
                                                                        </td>
                                                                        <td class="email">Fula 2B</td>
                                                                        <td class="date">
                                                                            <span
                                                                                class="badge bg-success-subtle text-success">{{
                                                                                    item.estado }}</span>
                                                                        </td>
                                                                        <td class="invoice_amount">
                                                                            26 Apr 2026 <small class="text-muted">9:58
                                                                                PM</small>
                                                                        </td>
                                                                        <td class="status">
                                                                            26 Apr 2026 <small class="text-muted">9:58
                                                                                PM</small>
                                                                        </td>
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <button
                                                                                    class="btn btn-soft-secondary btn-sm dropdown"
                                                                                    type="button"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    <i
                                                                                        class="ri-more-fill align-middle"></i>
                                                                                </button>
                                                                                <ul
                                                                                    class="dropdown-menu dropdown-menu-end">
                                                                                    <li>
                                                                                        <Link type="button" preserve
                                                                                            class="dropdown-item"
                                                                                            @click.prevent="deleteItem(item.id);">
                                                                                            <i
                                                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                            Apagar
                                                                                        </Link>
                                                                                    </li>
                                                                                    <li><button class="dropdown-item"
                                                                                            href="javascript:void(0);"
                                                                                            onclick="EditInvoice(this);"
                                                                                            data-id="25000351"><i
                                                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                            Edit</button></li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="javascript:void(0);"><i
                                                                                                class="ri-download-2-line align-bottom me-2 text-muted"></i>
                                                                                            Download</a></li>
                                                                                    <li class="dropdown-divider"></li>

                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </tbody>
                                                        </table>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                            <!--end tab-content-->
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div><!-- container-fluid -->
        </div>

    </DashboardApp>
</template>
<script setup>
import DashboardApp from '../Dashboard-app.vue'
import { ref, defineProps } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import Swal from 'sweetalert2'

const props = defineProps({
    cliente: {
        type: Object,
        default: () => ({})
    }
})

const form = useForm({})

const cliente = ref(props.cliente)


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

const deleteItem = (itemId) => {
    // console.log(itemId)
    Swal.fire({
        title: 'Tem certeza?',
        text: 'Você não poderá reverter isso!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (!result.isConfirmed) return
        // Call the delete API endpoint
        form.delete(route('encomendas.removeItem', [cliente.value.id, itemId]), {
            preserveScroll: true,
            onSuccess: (response => {
                // remover reativamente do objeto cliente para evitar reload da página
                cliente.value.encomendas.forEach(en => {
                    var idx = en.itens.findIndex(i => i.id === itemId)
                    if (idx !== -1) en.itens.splice(idx, 1)
                })
                Swal.fire(
                    'Excluído!',
                    'O item foi excluído com sucesso.',
                    'success'
                )
                // Optionally, refresh the item list or remove the item from the UI
            })
        })
            .catch(error => {
                Swal.fire(
                    'Erro!',
                    'Ocorreu um erro ao excluir o item.',
                    'error'
                )
            })

    })
}

</script>
