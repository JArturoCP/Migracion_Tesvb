<?php
namespace App\Exports;

use App\RmBienes;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use DB;
use Maatwebsite\Excel\Concerns\WithTitle;

class Inv_reporteExport implements FromArray
{
/**
* @return \Illuminate\Support\Collection
*/
    public function array(): array
{
// Obtener los datos de RmBienes
$data = DB::select('SELECT rm_bienes.*,rm_colores.color,rm_tipobienes.tipob,rm_tipoadqui.tipoadqui,
rm_categorias.nombre as categoria, rm_categorias.descripcion as desc_categoria, rm_provedores.nombre as proveedor,
rm_modelos.modelo,rm_estadousos.estado,rm_marcas.marca FROM rm_bienes,rm_colores,rm_tipoadqui,rm_tipobienes,rm_provedores,
rm_modelos, rm_categorias, rm_estadousos,rm_marcas
WHERE rm_bienes.id_color=rm_colores.id and rm_tipoadqui.id=rm_bienes.id_tipoadqui and rm_tipobienes.id = rm_bienes.id_tipob
AND rm_bienes.id_categoria=rm_categorias.id and rm_bienes.id_provedor = rm_provedores.id and rm_modelos.id=rm_bienes.id_modelo
and rm_bienes.id_estado=rm_estadousos.id AND rm_marcas.id=rm_bienes.id_marca');

// Convert the array of stdClass objects to a collection
$collection = collect($data);

// Initialize the result as an empty array
$result = [];

// Add header row to result array
$result[] = [
'id', 'nombre', 'caracteristicas',
'num_inventario', 'nick', 'serie',
'costo', 'stock', 'factura', 'color', 'tipo del bien', 'tipo de adquisición', 'categoria',
'descripción de la categoria', 'proveedor', 'modelo', 'estado', 'marca'
];

// Iterate over the collection and add data to the result array
foreach ($collection as $item) {
$result[] = [
$item->id, $item->nombre, $item->caracteristicas,
$item->num_inventario, $item->nick, $item->serie, $item->costo, $item->stock,
$item->factura, $item->color, $item->tipob, $item->tipoadqui, $item->categoria,
$item->desc_categoria, $item->proveedor, $item->modelo, $item->estado, $item->marca
];
}

// Add an empty row as separator
$result[] = [''];

return $result;
}
}