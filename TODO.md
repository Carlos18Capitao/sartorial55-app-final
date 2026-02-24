# TODO: Implement Default Measurements for ItemEncomenda

## Task Understanding
When creating an ItemEncomenda with "default" measurements, the system should copy the default measurements from ClienteMedidas (the customer's default measurements) to the specific measure table (MedidaCamisa, MedidaColete, etc.).

## Implementation Status

### ✅ COMPLETED

1. **Migration** (`database/migrations/2026_02_24_135306_add_cliente_medidas_id_to_item_encomendas_table.php`)
   - Added `cliente_medidas_id` foreign key to item_encomendas table

2. **ItemEncomenda Model** (`app/Models/ItemEncomenda.php`)
   - Added `cliente_medidas_id` to `$fillable`
   - Added relationship `clienteMedidas()` to ClienteMedidas
   - Added method `createMedidaFromDefault()` to create measure from default

3. **MedidaCamisa Model** (`app/Models/MedidaCamisa.php`)
   - Added `createFromDefault()` method to create from ClienteMedidas
   - Mapping: all fields directly map (comprimento_camisa → comprimento)

4. **MedidaColete Model** (`app/Models/MedidaColete.php`)
   - Added `createFromDefault()` method to create from ClienteMedidas
   - Mapping:
     - tamanho_colete → tamanho
     - ombro_botao_colete → ombro_botao
     - comprimento_frente_colete → comprimento_frente
     - comprimento_costa_colete → comprimento_costa
     - meia_cinta_colete → meia_cinta

5. **ItemEncomendaFactory** (`database/factories/ItemEncomendaFactory.php`)
   - Added `camisaWithDefaultMedidas()` method
   - Added `coleteWithDefaultMedidas()` method

### NEXT STEPS
- Run migrations: `php artisan migrate`
- Test the implementation by creating items with default measurements

