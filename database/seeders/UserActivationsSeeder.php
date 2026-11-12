<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder de la tabla `user_activations`.
 */
class UserActivationsSeeder extends Seeder
{
    /**
     * Pobla la tabla `user_activations` con registros ficticios.
     * Los registros existentes (por llave primaria o llaves únicas) no se modifican.
     */
    public function run(): void
    {
        // Entidades de las que depende esta tabla.
        $this->callOnce([
            UsersSeeder::class,
        ]);

        $tabla = 'user_activations';

        $llaves = [
            ['user_id', 'token'],
        ];

        $registros = [
            [
                'user_id'    => 1,
                'token'      => '7b91ab5df81d54594764919f76a7ef7370d925cfd71af79332770d99ff36c4a8',
                'created_at' => '2026-01-05 09:00:00',
            ],
            [
                'user_id'    => 2,
                'token'      => 'ed7ab81f7f56539085fce59dba48840571794d07b12fdd523edcbbc9e73b24ac',
                'created_at' => '2026-01-14 10:00:00',
            ],
            [
                'user_id'    => 3,
                'token'      => '2c1e41891cc91d9a1ef5aa93caccf0fc3edd67de242a0df079ee2a4f344c7cdb',
                'created_at' => '2026-01-23 11:00:00',
            ],
            [
                'user_id'    => 4,
                'token'      => '00b34430c87a083d4aad1f94e7ec6432de7f895f9b95a8d3e491bc58eb89c498',
                'created_at' => '2026-02-01 12:00:00',
            ],
            [
                'user_id'    => 5,
                'token'      => 'effeef15dac2d2d506c3f3d8e2e971fc0b2837d309c57eb1a8fd3c0e8b592518',
                'created_at' => '2026-02-10 13:00:00',
            ],
            [
                'user_id'    => 6,
                'token'      => '1e35dd501ef454003ec0e2f151617e86f6ae48ccf5f7bb78ea542ee036bd509b',
                'created_at' => '2026-02-19 14:00:00',
            ],
            [
                'user_id'    => 7,
                'token'      => '39ea33f62f83d26a00d539ff7a8f24627397984cc446fd77b2020c6bf9a54d50',
                'created_at' => '2026-02-28 15:00:00',
            ],
            [
                'user_id'    => 8,
                'token'      => 'efd2a28b741d8c61eef7f56c54e415b734577bf6544ac7f231ac9602c6c06cc7',
                'created_at' => '2026-03-09 16:00:00',
            ],
            [
                'user_id'    => 9,
                'token'      => 'dc42ce2976d4b2a26ec5538a7fc4b65d6529b1f67bf2673e1d8390f8bae34503',
                'created_at' => '2026-03-18 08:00:00',
            ],
            [
                'user_id'    => 10,
                'token'      => '07c61826bd970aea14d6064a231b7e6d93d3252a3c98fe541a26256561346c98',
                'created_at' => '2026-03-27 09:00:00',
            ],
            [
                'user_id'    => 11,
                'token'      => 'e5373db41b5dae29d906cd27aca94d4d6b3f73f054c005f4d488a5f9ab050e42',
                'created_at' => '2026-04-05 10:00:00',
            ],
            [
                'user_id'    => 12,
                'token'      => '42afe7188a08773f12047db7f5cd456ca3a294e9c3a8d8c49918102750acda57',
                'created_at' => '2026-04-14 11:00:00',
            ],
            [
                'user_id'    => 13,
                'token'      => '91572005f886f40fc3b3a8b6b5ae5b0369884f570396fbf85216c906f94dcd2c',
                'created_at' => '2026-04-23 12:00:00',
            ],
            [
                'user_id'    => 14,
                'token'      => 'afaed9f4eb04f323726f02c9ca4e6f2df89ec958c74cdabff96e4faa0a02fd98',
                'created_at' => '2026-05-02 13:00:00',
            ],
            [
                'user_id'    => 15,
                'token'      => 'd436cef92dfe0e32f106ba775453e108d321b9ea25e9a22ee3dc90c69a2694ed',
                'created_at' => '2026-05-11 14:00:00',
            ],
        ];

        foreach ($registros as $registro) {
            $existe = DB::table($tabla)
                ->where(function ($consulta) use ($llaves, $registro) {
                    foreach ($llaves as $llave) {
                        $consulta->orWhere(function ($condicion) use ($llave, $registro) {
                            foreach ($llave as $columna) {
                                $condicion->where($columna, $registro[$columna]);
                            }
                        });
                    }
                })
                ->exists();

            if (! $existe) {
                DB::table($tabla)->insert($registro);
            }
        }
    }
}
