<script setup>
import SartorialLayout from '@/Layouts/SartorialLayout.vue';
import { createApp, h } from 'vue';
import swal from 'sweetalert';
import { router } from '@inertiajs/vue3';
import fato2 from './partes/fato2.vue';
import fato3 from './partes/fato3.vue';
import calca from './partes/calca.vue';
import casaco from './partes/casaco.vue';
import camisa from './partes/camisa.vue';
import sapato from './partes/sapato.vue';

defineProps(
    {
        cliente: Object,
    }
);

function handleClick() {
    // Modal de seleção de tipo de item
    swal({
        title: "Selecionar Tipo de Item",
        text: "Escolha o tipo de item que deseja adicionar:",
        buttons: {
            fato2: {
                text: "Fato 2 Peças",
                value: "fato2",
            },
            fato3: {
                text: "Fato 3 Peças",
                value: "fato3",
            },
            calca: {
                text: "Calça",
                value: "calca",
            },
            casaco: {
                text: "Casaco",
                value: "casaco",
            },
            camisa: {
                text: "Camisa",
                value: "camisa",
            },
            sapato: {
                text: "Sapato",
                value: "sapato",
            },
        },
    }).then((value) => {
        if (value) {
            openItemForm(value);
        }
    });
}

function openItemForm(itemType) {
    let component;
    let title;

    switch (itemType) {
        case 'fato2':
            component = fato2;
            title = "Adicionar Fato 2 Peças";
            break;
        case 'fato3':
            component = fato3;
            title = "Adicionar Fato 3 Peças";
            break;
        case 'calca':
            component = calca;
            title = "Adicionar Calça";
            break;
        case 'casaco':
            component = casaco;
            title = "Adicionar Casaco";
            break;
        case 'camisa':
            component = camisa;
            title = "Adicionar Camisa";
            break;
        case 'sapato':
            component = sapato;
            title = "Adicionar Sapato";
            break;
        default:
            return;
    }

    // Cria um elemento container para o componente Vue
    const container = document.createElement('div');

    // Cria e monta a instância do componente Vue no container
    const app = createApp({
        render: () => h(component, {
            cliente: this.cliente,
            onSuccess: (msg) => {
                swal({
                    text: msg,
                    icon: "success",
                    timer: 1000,
                    buttons: false
                }).then(() => {
                    swal.close();
                    // Recarregar a página ou atualizar o estado
                    window.location.reload();
                });
            }
        }),
    });
    app.mount(container);

    // Exibe o SweetAlert com o componente como conteúdo
    swal({
        title: title,
        content: container,
        buttons: false, // O formulário controla os botões
    }).then(() => {
        // Limpa a instância do Vue quando o modal é fechado
        app.unmount();
    });
}
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
                    <button @click="handleClick" class="btn btn-primary btn-round">Adicionar Item</button>
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
