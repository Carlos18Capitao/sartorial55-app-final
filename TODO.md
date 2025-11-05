# TODO: Implementar funcionalidade "Adicionar Item" na página de encomenda

## Passos a serem executados:

### 1. Verificar rotas existentes
- [x] Verificar se as rotas para store de cada item existem em `routes/web.php` (casacos, calcas, camisas, sapatos, fatos)
- [x] Adicionar rotas para casacos, calcas, camisas, sapatos, fatos

### 2. Modificar resources/js/Pages/encomenda/index.vue
- [x] Importar sweetalert
- [x] Adicionar função handleClick para abrir modal de seleção de tipo de item
- [x] Modificar o botão "Adicionar Item" para chamar handleClick

### 3. Criar componentes de formulário
- [x] Criar `resources/js/Pages/encomenda/partes/fato2.vue` (para fato 2 peças)
- [x] Criar `resources/js/Pages/encomenda/partes/fato3.vue` (para fato 3 peças)
- [x] Criar `resources/js/Pages/encomenda/partes/calca.vue`
- [x] Modificar `resources/js/Pages/encomenda/partes/casaco.vue` (ajustar para o contexto de encomenda)
- [x] Criar `resources/js/Pages/encomenda/partes/camisa.vue`
- [x] Criar `resources/js/Pages/encomenda/partes/sapato.vue`

### 4. Implementar lógica de seleção e abertura de modais
- [x] Implementar modal de seleção de tipo de item no handleClick
- [x] Baseado na seleção, abrir o modal correspondente com o formulário apropriado
- [x] Garantir que cada formulário submeta para a rota correta

### 5. Testes e ajustes
- [ ] Testar a funcionalidade completa
- [ ] Ajustar estilos e comportamentos conforme necessário
