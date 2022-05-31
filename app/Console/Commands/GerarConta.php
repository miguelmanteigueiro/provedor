<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GerarConta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'provedor:gerar-conta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adiciona uma conta manualmente à base de dados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $primeiro_nome = $this->ask('Primeiro Nome?');
        $ultimo_nome = $this->ask('Último Nome?');
        $email = $this->ask('Endereço de Email?');
        $password = $this->secret('Palavra-passe?');
        $confirmarPassword = $this->secret('Confirme a Palavra-passe');

        while ($password !== $confirmarPassword) {
            $this->error("As palavras-passe não coincidem. Tente novamente.");
            $password = $this->secret('Palavra-passe?');
            $confirmarPassword = $this->secret('Confirme a Palavra-passe');
        }

        $user = User::create([
            'primeiro_nome' => $primeiro_nome,
            'ultimo_nome' => $ultimo_nome,
            'email' => $email,
            'password' => $password,
            'administrador' => 1
        ]);

        $this->info("Foi criado o utilizador $user->nome");
    }
}
