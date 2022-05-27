<x-layout>
    <div class="w3-section w3-row">
        <div class="w3-row">
            <div class="w3-container w3-twothird">
                <h2>Analítica</h2>
            </div>
            <div class="w3-right-align w3-margin-top w3-container w3-third">
                <form>
                    <button formaction="/admin/analitica/assuntos" class="w3-btn w3-green w3-round">Gerir Assuntos</button>
                </form>
            </div>
        </div>
    </div>

    <table class="w3-table-all w3-hoverable">
        <tr class="w3-theme">
            <th>ID</th>
            <th>Tipo de Solicitação</th>
            <th>Forma de Apresentação</th>
            <th>Forma de Contacto</th>
            <th>Natureza do Assunto</th>
            <th>Estado</th>
            <th>Permissões</th>
            <th class="w3-right-align">Opções</th>
            <th></th>
        </tr>
    </table>

    <div class="w3-section">
        {{-- {{ $users->links() }} --}}
    </div>
</x-layout>