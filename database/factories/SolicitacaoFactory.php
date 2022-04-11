<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Solicitacao;

class SolicitacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'utilizador_id' => $this->faker->randomElement(User::pluck('id')),
            'situacao_academica' => $this->faker->randomElement(Solicitacao::SITUACAO_ACADEMICA),
            'referencia_interna' => $this->faker->randomDigitNotZero() . "/" . ucwords($this->faker->randomLetter()) . "/22",
            'estudante_id' => $this->faker->numberBetween(15000, 50000),
            'estudante_nome' => $this->faker->name(),
            'estudante_email' => $this->faker->unique()->safeEmail(),
            'estudante_telefone' => $this->faker->numberBetween(910000000, 969999999),
            'descricao' => $this->faker->text(10000)
        ];
    }
}
