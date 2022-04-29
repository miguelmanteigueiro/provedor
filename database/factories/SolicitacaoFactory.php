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
            'estudante_telefone' => $this->faker->phoneNumber(),
            'descricao' => $this->faker->text(10000)

            // Adicionar o estado da solicitação e adicionar a data de início
        $estado_solicitacao = new EstadoSolicitacao($request->only('data_inicio'));
        $estado_solicitacao->estado = 'aberto';
        $estado_solicitacao->solicitacao_id = $solicitacao->id;
        $estado_solicitacao->save();
        ];
    }
}
